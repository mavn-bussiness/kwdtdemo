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
    // Redirect donor → PayPal
    // Called from DonateController::gateway() for method = 'paypal'
    // Route: GET /donate/paypal/{donation}  name: donate.paypal
    // -------------------------------------------------------------------------

    public function redirect(Donation $donation)
    {
        try {
            $approvalUrl = $this->paypal->createOrder($donation);

            return redirect()->away($approvalUrl);
        } catch (\Throwable $e) {
            report($e);

            return redirect()->route('donate.failed')
                ->with('error', app()->isLocal() ? $e->getMessage() : 'Could not connect to PayPal. Please try again.');
        }
    }

    // -------------------------------------------------------------------------
    // Capture after donor approves on PayPal
    // Route: GET /donate/paypal/{donation}/capture  name: donate.paypal.capture
    // -------------------------------------------------------------------------

    public function capture(Request $request, Donation $donation)
    {
        $paypalOrderId = $request->query('token'); // PayPal appends ?token=ORDER_ID

        if (! $paypalOrderId) {
            return redirect()->route('donate.failed');
        }

        try {
            $result = $this->paypal->captureOrder($paypalOrderId, $donation);

            return $result['status'] === 'success'
                ? redirect()->route('donate.success')
                : redirect()->route('donate.failed');
        } catch (\Throwable $e) {
            report($e);

            return redirect()->route('donate.failed');
        }
    }

    // -------------------------------------------------------------------------
    // Webhook (IPN) — PayPal posts payment events here
    // Route: POST /donate/webhook/PayPal name: donate.webhook.paypal
    // -------------------------------------------------------------------------

    public function handle(Request $request)
    {
        $payload = $request->all();
        $eventType = $payload['event_type'] ?? null;

        if ($eventType === 'PAYMENT.CAPTURE.COMPLETED') {
            $orderId = $payload['resource']['supplementary_data']['related_ids']['order_id']
                ?? $payload['resource']['id']
                ?? null;

            if ($orderId) {
                $transaction = PaymentTransaction::where('gateway_ref', $orderId)->first();
                if ($transaction) {
                    $transaction->update(['status' => 'success', 'raw_response' => $payload]);
                    $transaction->donation->update(['status' => 'success']);
                }
            }
        }

        if ($eventType === 'PAYMENT.CAPTURE.DENIED') {
            $orderId = $payload['resource']['id'] ?? null;
            if ($orderId) {
                $transaction = PaymentTransaction::where('gateway_ref', $orderId)->first();
                if ($transaction) {
                    $transaction->update(['status' => 'failed', 'raw_response' => $payload]);
                    $transaction->donation->update(['status' => 'failed']);
                }
            }
        }

        return response()->json(['received' => true]);
    }
}
