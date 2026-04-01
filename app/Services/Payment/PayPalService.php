<?php

namespace App\Services\Payment;

use App\Models\Donation;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * PayPalService
 *
 * Handles creating PayPal orders via the PayPal Orders v2 API.
 * Docs: https://developer.paypal.com/docs/api/orders/v2/
 *
 * Required .env keys:
 *   PAYPAL_CLIENT_ID=
 *   PAYPAL_CLIENT_SECRET=
 *   PAYPAL_MODE=sandbox   # or "live"
 */
class PayPalService
{
    private string $baseUrl;

    private string $clientId;

    private string $clientSecret;

    public function __construct()
    {
        $mode = config('services.paypal.mode', 'sandbox');

        $this->baseUrl = $mode === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';

        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }

    // -------------------------------------------------------------------------
    // Public API
    // -------------------------------------------------------------------------

    /**
     * Create a PayPal order and return the approval URL to redirect the donor.
     *
     * @throws RuntimeException|ConnectionException
     */
    public function createOrder(Donation $donation): string
    {
        $token = $this->getAccessToken();

        $response = \Http::withToken($token)
            ->withHeaders(['PayPal-Request-Id' => (string) Str::uuid()])
            ->post("{$this->baseUrl}/v2/checkout/orders", [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => (string) $donation->id,
                    'amount' => [
                        'currency_code' => 'USD',
                        // PayPal requires a string with 2 decimal places
                        'value' => number_format((float) $donation->amount_original, 2, '.', ''),
                    ],
                    'description' => 'Donation to Katosi Women Development Trust',
                ]],
                'application_context' => [
                    'return_url' => route('donate.paypal.capture', $donation),
                    'cancel_url' => route('donate.failed'),
                    'brand_name' => 'KWDT – Katosi Women Development Trust',
                    'landing_page' => 'LOGIN',
                    'user_action' => 'PAY_NOW',
                ],
            ]);

        if (! $response->successful()) {
            throw new RuntimeException('PayPal order creation failed: '.$response->body());
        }

        $data = $response->json();

        // Record the transaction so we can match the capture later
        $donation->transactions()->create([
            'gateway' => 'paypal',
            'gateway_ref' => $data['id'],   // PayPal order ID
            'status' => 'pending',
            'amount' => $donation->amount_original,
            'currency' => 'USD',
            'raw_response' => $data,
        ]);

        // Return the "payer-action" approval link
        return collect($data['links'])
            ->firstWhere('rel', 'payer-action')['href']
            ?? collect($data['links'])->firstWhere('rel', 'approve')['href'];
    }

    /**
     * Capture an approved PayPal order.
     * Called from the return URL after the donor approves on PayPal.
     *
     * @throws RuntimeException|ConnectionException
     */
    public function captureOrder(string $paypalOrderId, Donation $donation): array
    {
        $token = $this->getAccessToken();

        $response = \Http::withToken($token)
            ->withHeaders(['PayPal-Request-Id' => (string) Str::uuid()])
            ->post("{$this->baseUrl}/v2/checkout/orders/{$paypalOrderId}/capture");

        $data = $response->json();

        $status = match ($data['status'] ?? '') {
            'COMPLETED' => 'success',
            'PENDING' => 'pending',
            default => 'failed',
        };

        // Update the transaction record
        $donation->transactions()
            ->where('gateway_ref', $paypalOrderId)
            ->update([
                'status' => $status,
                'raw_response' => $data,
            ]);

        // Update the donation itself
        $donation->update(['status' => $status]);

        return ['status' => $status, 'data' => $data];
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Fetch a short-lived OAuth 2.0 access token from PayPal.
     * @throws ConnectionException
     */
    private function getAccessToken(): string
    {
        $response = \Http::asForm()
            ->withBasicAuth($this->clientId, $this->clientSecret)
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials',
            ]);

        if (! $response->successful()) {
            throw new RuntimeException('PayPal auth failed: '.$response->body());
        }

        return $response->json('access_token');
    }
}
