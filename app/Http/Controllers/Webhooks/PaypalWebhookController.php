<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\PaymentTransaction;
use App\Services\Payment\PayPalService;
use Illuminate\Http\Request;

class PaypalWebhookController extends Controller
{
    public function __construct(private readonly PayPalService $paypal) {}

    // -------------------------------------------------------------------------
    // Capture after donor approves on PayPal
    // Route: GET /donate/paypal/{donation}/capture  name: donate.paypal.capture
    // PayPal appends ?token=ORDER_ID&PayerID=xxx on approval
    // -------------------------------------------------------------------------

    public function capture(Request $request, Donation $donation)
    {
        $paypalOrderId = $request->query('token');

        if (! $paypalOrderId) {
            return $this->popupClose('failed');
        }

        try {
            $result = $this->paypal->captureOrder($paypalOrderId, $donation);

            return $result['status'] === 'success'
                ? $this->popupClose('success')
                : $this->popupClose('failed');

        } catch (\Throwable $e) {
            report($e);

            $this->markTransactionFailed($paypalOrderId, $donation, ['error' => $e->getMessage()]);

            return $this->popupClose('failed');
        }
    }

    // -------------------------------------------------------------------------
    // Donor cancelled on PayPal (clicked "Cancel and return")
    // Route: GET /donate/paypal/{donation}/cancel  name: donate.paypal.cancel
    // PayPal appends ?token=ORDER_ID on cancellation
    // -------------------------------------------------------------------------

    public function cancel(Request $request, Donation $donation)
    {
        $paypalOrderId = $request->query('token');

        if ($paypalOrderId) {
            $this->markTransactionCancelled($paypalOrderId, $donation);
        }

        return $this->popupClose('cancelled');
    }

    // -------------------------------------------------------------------------
    // PayPal server-to-server webhook
    // Route: POST /donate/webhook/paypal  name: donate.webhook.paypal
    // Handles async events — source of truth for final payment status
    // -------------------------------------------------------------------------

    public function handle(Request $request)
    {
        if (! $this->paypal->verifyWebhookSignature($request)) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $payload   = $request->all();
        $eventType = $payload['event_type'] ?? null;
        $resource  = $payload['resource'] ?? [];

        match ($eventType) {
            'PAYMENT.CAPTURE.COMPLETED' => $this->onCaptureCompleted($resource, $payload),
            'PAYMENT.CAPTURE.DENIED'    => $this->onCaptureDenied($resource, $payload),
            'PAYMENT.CAPTURE.REFUNDED'  => $this->onCaptureRefunded($resource, $payload),
            'CHECKOUT.ORDER.CANCELLED'  => $this->onOrderCancelled($resource, $payload),
            default                     => null,
        };

        return response()->json(['received' => true]);
    }

    // -------------------------------------------------------------------------
    // Webhook event handlers
    // -------------------------------------------------------------------------

    private function onCaptureCompleted(array $resource, array $payload): void
    {
        // The order ID lives in supplementary_data for capture events
        $orderId = $resource['supplementary_data']['related_ids']['order_id']
            ?? $this->extractOrderIdFromLinks($resource['links'] ?? [])
            ?? null;

        if (! $orderId) return;

        $transaction = PaymentTransaction::where('gateway_ref', $orderId)->first();
        if (! $transaction) return;

        $transaction->update([
            'status'       => 'success',
            'paid_at'      => now(),
            'raw_response' => $payload,
        ]);

        $transaction->donation->update(['status' => 'success']);
    }

    private function onCaptureDenied(array $resource, array $payload): void
    {
        // For DENIED, resource is the capture object — get order ID from links
        $orderId = $this->extractOrderIdFromLinks($resource['links'] ?? [])
            ?? $resource['supplementary_data']['related_ids']['order_id']
            ?? null;

        if (! $orderId) return;

        $transaction = PaymentTransaction::where('gateway_ref', $orderId)->first();
        if (! $transaction) return;

        $transaction->update(['status' => 'failed', 'raw_response' => $payload]);
        $transaction->donation->update(['status' => 'failed']);
    }

    private function onCaptureRefunded(array $resource, array $payload): void
    {
        $orderId = $this->extractOrderIdFromLinks($resource['links'] ?? [])
            ?? $resource['supplementary_data']['related_ids']['order_id']
            ?? null;

        if (! $orderId) return;

        $transaction = PaymentTransaction::where('gateway_ref', $orderId)->first();
        if (! $transaction) return;

        $transaction->update(['status' => 'refunded', 'raw_response' => $payload]);
        $transaction->donation->update(['status' => 'refunded']);
    }

    private function onOrderCancelled(array $resource, array $payload): void
    {
        $orderId = $resource['id'] ?? null;
        if (! $orderId) return;

        $transaction = PaymentTransaction::where('gateway_ref', $orderId)->first();
        if (! $transaction) return;

        $transaction->update(['status' => 'cancelled', 'raw_response' => $payload]);
        $transaction->donation->update(['status' => 'cancelled']);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    private function markTransactionFailed(string $orderId, Donation $donation, array $extra = []): void
    {
        $donation->transactions()
            ->where('gateway_ref', $orderId)
            ->update(['status' => 'failed', 'raw_response' => $extra]);

        $donation->update(['status' => 'failed']);
    }

    private function markTransactionCancelled(string $orderId, Donation $donation): void
    {
        $donation->transactions()
            ->where('gateway_ref', $orderId)
            ->update(['status' => 'cancelled']);

        $donation->update(['status' => 'cancelled']);
    }

    private function extractOrderIdFromLinks(array $links): ?string
    {
        foreach ($links as $link) {
            if (isset($link['href']) && str_contains($link['href'], '/v2/checkout/orders/')) {
                $parts = explode('/v2/checkout/orders/', $link['href']);
                return explode('/', $parts[1] ?? '')[0] ?: null;
            }
        }
        return null;
    }

    private function popupClose(string $status): \Illuminate\Http\Response
    {
        $event       = $status === 'success' ? 'paypal-success' : 'paypal-failed';
        $fallbackUrl = $status === 'success' ? '/donate/success' : '/donate/failed';

        $html = <<<HTML
        <!DOCTYPE html>
        <html>
        <head><title>Processing...</title></head>
        <body>
        <p style="font-family:sans-serif;text-align:center;padding:2rem;">Processing your payment...</p>
        <script>
            (function() {
                try {
                    if (window.opener && !window.opener.closed) {
                        window.opener.dispatchEvent(new CustomEvent('{$event}'));
                        setTimeout(function() { window.close(); }, 300);
                    } else {
                        window.location.href = '{$fallbackUrl}';
                    }
                } catch(e) {
                    window.location.href = '{$fallbackUrl}';
                }
            })();
        </script>
        </body>
        </html>
        HTML;

        return response($html);
    }
}
