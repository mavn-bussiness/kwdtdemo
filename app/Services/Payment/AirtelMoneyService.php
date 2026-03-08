<?php

namespace App\Services\Payment;

use App\Models\Donation;
use Illuminate\Support\Str;

/**
 * AirtelMoneyService
 *
 * Integrates with the Airtel Africa Payments API.
 * Docs: https://developers.airtel.africa/documentation
 *
 * Required .env keys:
 *   AIRTEL_BASE_URL=https://openapi.airtel.africa     # or sandbox
 *   AIRTEL_CLIENT_ID=
 *   AIRTEL_CLIENT_SECRET=
 *   AIRTEL_COUNTRY=UG
 *   AIRTEL_CURRENCY=UGX
 */
class AirtelMoneyService
{
    private string $baseUrl;

    private string $clientId;

    private string $clientSecret;

    private string $country;

    private string $currency;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.airtel.base_url', 'https://openapi.airtel.africa'), '/');
        $this->clientId = config('services.airtel.client_id');
        $this->clientSecret = config('services.airtel.client_secret');
        $this->country = config('services.airtel.country', 'UG');
        $this->currency = config('services.airtel.currency', 'UGX');
    }

    // -------------------------------------------------------------------------
    // Public API
    // -------------------------------------------------------------------------

    /**
     * Initiate a Collections payment request (USSD push to donor's phone).
     * Returns the Airtel transaction ID for status polling.
     *
     * @throws \RuntimeException
     */
    public function requestPayment(Donation $donation): string
    {
        $token = $this->getAccessToken();
        $reference = (string) Str::uuid();
        $msisdn = $this->normaliseMsisdn($donation->donor_phone);

        $response = \Http::withToken($token)
            ->withHeaders([
                'X-Country' => $this->country,
                'X-Currency' => $this->currency,
            ])
            ->post("{$this->baseUrl}/merchant/v2/payments/", [
                'reference' => $reference,
                'subscriber' => [
                    'country' => $this->country,
                    'currency' => $this->currency,
                    'msisdn' => $msisdn,
                ],
                'transaction' => [
                    'amount' => (string) intval($donation->amount_original),
                    'country' => $this->country,
                    'currency' => $this->currency,
                    'id' => $reference,
                ],
            ]);

        $data = $response->json();

        // Airtel returns status.code "200" (as a string) on success
        $success = ($data['status']['code'] ?? null) === '200'
            || ($data['status']['success'] ?? false) === true;

        if (! $success) {
            throw new \RuntimeException('Airtel payment initiation failed: '.$response->body());
        }

        $airtelId = $data['data']['transaction']['id'] ?? $reference;

        $donation->transactions()->create([
            'gateway' => 'airtel_money',
            'gateway_ref' => $airtelId,
            'status' => 'pending',
            'amount' => $donation->amount_original,
            'currency' => $this->currency,
            'raw_response' => $data,
        ]);

        return $airtelId;
    }

    /**
     * Check the status of an Airtel transaction.
     * Returns: 'success' | 'pending' | 'failed'
     */
    public function checkStatus(string $airtelId, Donation $donation): string
    {
        $token = $this->getAccessToken();

        $response = \Http::withToken($token)
            ->withHeaders([
                'X-Country' => $this->country,
                'X-Currency' => $this->currency,
            ])
            ->get("{$this->baseUrl}/standard/v1/payments/{$airtelId}");

        $data = $response->json();
        $txStatus = strtoupper($data['data']['transaction']['status'] ?? '');

        $status = match ($txStatus) {
            'TS' => 'success',   // Transaction Successful
            'TIP' => 'pending',   // Transaction In Progress
            default => 'failed',
        };

        $donation->transactions()
            ->where('gateway_ref', $airtelId)
            ->update(['status' => $status, 'raw_response' => $data]);

        $donation->update(['status' => $status]);

        return $status;
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function getAccessToken(): string
    {
        $response = \Http::post("{$this->baseUrl}/auth/oauth2/token", [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials',
        ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Airtel auth failed: '.$response->body());
        }

        return $response->json('access_token');
    }

    /**
     * Airtel expects MSISDN without leading + or country prefix duplication.
     * Uganda format: 256XXXXXXXXX
     */
    private function normaliseMsisdn(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);

        if (str_starts_with($phone, '0')) {
            $phone = '256'.substr($phone, 1);
        } elseif (! str_starts_with($phone, '256')) {
            $phone = '256'.$phone;
        }

        return $phone;
    }
}
