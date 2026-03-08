<?php

namespace App\Services\Payment;

use App\Models\Donation;
use Illuminate\Support\Str;

/**
 * MtnMomoService
 *
 * Integrates with the MTN Mobile Money Collections API.
 * Docs: https://momodeveloper.mtn.com/docs/services/collection
 *
 * Required .env keys:
 *   MTN_MOMO_BASE_URL=https://sandbox.momodeveloper.mtn.com   # or production URL
 *   MTN_MOMO_SUBSCRIPTION_KEY=          # Primary key from developer portal
 *   MTN_MOMO_API_USER=                  # UUID generated via provisioning API (or set manually in sandbox)
 *   MTN_MOMO_API_KEY=                   # Generated alongside API_USER
 *   MTN_MOMO_ENVIRONMENT=sandbox        # sandbox | production
 *   MTN_MOMO_CURRENCY=UGX
 */
class MtnMomoService
{
    private string $baseUrl;
    private string $subscriptionKey;
    private string $apiUser;
    private string $apiKey;
    private string $environment;
    private string $currency;

    public function __construct()
    {
        $this->baseUrl         = rtrim(config('services.mtn_momo.base_url', 'https://sandbox.momodeveloper.mtn.com'), '/');
        $this->subscriptionKey = config('services.mtn_momo.subscription_key');
        $this->apiUser         = config('services.mtn_momo.api_user');
        $this->apiKey          = config('services.mtn_momo.api_key');
        $this->environment     = config('services.mtn_momo.environment', 'sandbox');
        $this->currency        = config('services.mtn_momo.currency', 'UGX');
    }

    // -------------------------------------------------------------------------
    // Public API
    // -------------------------------------------------------------------------

    /**
     * Initiate a "Request to Pay" — sends a USSD push to the donor's phone.
     * Returns the referenceId (UUID) used to poll for status.
     *
     * @throws \RuntimeException
     */
    public function requestToPay(Donation $donation): string
    {
        $referenceId = (string) Str::uuid();
        $token       = $this->getAccessToken();

        // Normalise the phone number to MSISDN format (no + or leading 0)
        $msisdn = $this->normaliseMsisdn($donation->donor_phone);

        $response = \Http::withToken($token)
            ->withHeaders([
                'X-Reference-Id'   => $referenceId,
                'X-Target-Environment' => $this->environment,
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
            ])
            ->post("{$this->baseUrl}/collection/v1_0/requesttopay", [
                'amount'      => (string) intval($donation->amount_original),   // MTN expects integer string
                'currency'    => $this->currency,
                'externalId'  => (string) $donation->id,
                'payer' => [
                    'partyIdType' => 'MSISDN',
                    'partyId'     => $msisdn,
                ],
                'payerMessage' => 'Donation to KWDT',
                'payeeNote'    => 'Thank you for supporting KWDT',
            ]);

        // 202 Accepted = request queued successfully
        if ($response->status() !== 202) {
            throw new \RuntimeException('MTN MoMo request failed: ' . $response->body());
        }

        // Store transaction for status polling / webhook matching
        $donation->transactions()->create([
            'gateway'      => 'mtn_momo',
            'gateway_ref'  => $referenceId,
            'status'       => 'pending',
            'amount'       => $donation->amount_original,
            'currency'     => $this->currency,
            'raw_response' => ['reference_id' => $referenceId],
        ]);

        return $referenceId;
    }

    /**
     * Poll MTN for the status of a requestToPay.
     * Returns: 'success' | 'pending' | 'failed'
     */
    public function checkStatus(string $referenceId, Donation $donation): string
    {
        $token = $this->getAccessToken();

        $response = \Http::withToken($token)
            ->withHeaders([
                'X-Target-Environment' => $this->environment,
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
            ])
            ->get("{$this->baseUrl}/collection/v1_0/requesttopay/{$referenceId}");

        $data   = $response->json();
        $status = match ($data['status'] ?? '') {
            'SUCCESSFUL' => 'success',
            'PENDING'    => 'pending',
            default      => 'failed',
        };

        // Update transaction + donation
        $donation->transactions()
            ->where('gateway_ref', $referenceId)
            ->update(['status' => $status, 'raw_response' => $data]);

        $donation->update(['status' => $status]);

        return $status;
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function getAccessToken(): string
    {
        $response = \Http::withBasicAuth($this->apiUser, $this->apiKey)
            ->withHeaders([
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                'X-Target-Environment'      => $this->environment,
            ])
            ->post("{$this->baseUrl}/collection/token/");

        if (! $response->successful()) {
            throw new \RuntimeException('MTN MoMo auth failed: ' . $response->body());
        }

        return $response->json('access_token');
    }

    /**
     * Strip leading zeros / + and ensure Uganda country code (256) is present.
     * e.g. 0772123456 → 256772123456  |  +256772123456 → 256772123456
     */
    private function normaliseMsisdn(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone); // digits only

        if (str_starts_with($phone, '0')) {
            $phone = '256' . substr($phone, 1);
        } elseif (! str_starts_with($phone, '256')) {
            $phone = '256' . $phone;
        }

        return $phone;
    }
}
