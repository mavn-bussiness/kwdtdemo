<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\PaymentTransaction;
use App\Services\Payment\AirtelMoneyService;
use Illuminate\Http\Request;

class AirtelWebhookController extends Controller
{
    public function __construct(private AirtelMoneyService $airtel) {}

    // -------------------------------------------------------------------------
    // Redirect — initiate Airtel push prompt
    // Route: GET /donate/airtel/{donation}  name: donate.airtel
    // -------------------------------------------------------------------------

    public function redirect(Donation $donation)
    {
        try {
            $airtelId = $this->airtel->requestPayment($donation);

            return redirect()->route('donate.airtel.status', [
                'donation' => $donation,
                'airtelId' => $airtelId,
            ]);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('donate.failed')
                ->with('error', 'Could not initiate Airtel Money. Please try again.');
        }
    }

    // -------------------------------------------------------------------------
    // Status polling
    // Route: GET /donate/airtel/{donation}/status  name: donate.airtel.status
    // -------------------------------------------------------------------------

    public function status(Request $request, Donation $donation)
    {
        $airtelId = $request->query('airtelId');

        if (! $airtelId) {
            return redirect()->route('donate.failed');
        }

        try {
            $status = $this->airtel->checkStatus($airtelId, $donation);

            return match ($status) {
                'success' => redirect()->route('donate.success'),
                'failed'  => redirect()->route('donate.failed'),
                default   => view('pages.donate-pending', [
                    'donation' => $donation,
                    'pollUrl'  => route('donate.airtel.status', [
                        'donation' => $donation,
                        'airtelId' => $airtelId,
                    ]),
                ]),
            };
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('donate.failed');
        }
    }

    // -------------------------------------------------------------------------
    // Webhook — Airtel posts payment callbacks here
    // Route: POST /donate/webhook/airtel  name: donate.webhook.airtel
    // -------------------------------------------------------------------------

    public function handle(Request $request)
    {
        $payload  = $request->all();
        $airtelId = $payload['transaction']['id'] ?? null;
        $txStatus = strtoupper($payload['transaction']['status'] ?? '');

        if ($airtelId && $txStatus) {
            $status = match ($txStatus) {
                'TS'  => 'success',
                'TIP' => 'pending',
                default => 'failed',
            };

            $transaction = PaymentTransaction::where('gateway_ref', $airtelId)->first();

            if ($transaction) {
                $transaction->update(['status' => $status, 'raw_response' => $payload]);
                $transaction->donation->update(['status' => $status]);
            }
        }

        return response()->json(['received' => true]);
    }
}
