<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\PaymentTransaction;
use App\Services\Payment\MtnMomoService;
use Illuminate\Http\Request;

class MtnWebhookController extends Controller
{
    public function __construct(private MtnMomoService $mtn) {}

    // -------------------------------------------------------------------------
    // Redirect — initiate MTN MoMo push prompt
    // Route: GET /donate/mtn/{donation}  name: donate.mtn
    // -------------------------------------------------------------------------

    public function redirect(Donation $donation)
    {
        try {
            $referenceId = $this->mtn->requestToPay($donation);

            // Redirect to a polling/status page so the donor can see progress
            return redirect()->route('donate.mtn.status', [
                'donation'    => $donation,
                'referenceId' => $referenceId,
            ]);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('donate.failed')
                ->with('error', 'Could not initiate MTN Mobile Money. Please try again.');
        }
    }

    // -------------------------------------------------------------------------
    // Status polling page
    // Route: GET /donate/mtn/{donation}/status  name: donate.mtn.status
    // -------------------------------------------------------------------------

    public function status(Request $request, Donation $donation)
    {
        $referenceId = $request->query('referenceId');

        if (! $referenceId) {
            return redirect()->route('donate.failed');
        }

        try {
            $status = $this->mtn->checkStatus($referenceId, $donation);

            return match ($status) {
                'success' => redirect()->route('donate.success'),
                'failed'  => redirect()->route('donate.failed'),
                default   => view('pages.donate-pending', [
                    'donation'    => $donation,
                    'referenceId' => $referenceId,
                    'pollUrl'     => route('donate.mtn.status', [
                        'donation'    => $donation,
                        'referenceId' => $referenceId,
                    ]),
                ]),
            };
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('donate.failed');
        }
    }

    // -------------------------------------------------------------------------
    // Webhook — MTN posts payment callbacks here
    // Route: POST /donate/webhook/mtn  name: donate.webhook.mtn
    // -------------------------------------------------------------------------

    public function handle(Request $request)
    {
        $payload     = $request->all();
        $referenceId = $payload['referenceId'] ?? $payload['externalId'] ?? null;
        $mtnStatus   = $payload['status'] ?? null;

        if ($referenceId && $mtnStatus) {
            $status = match (strtoupper($mtnStatus)) {
                'SUCCESSFUL' => 'success',
                'PENDING'    => 'pending',
                default      => 'failed',
            };

            $transaction = PaymentTransaction::where('gateway_ref', $referenceId)->first();

            if ($transaction) {
                $transaction->update(['status' => $status, 'raw_response' => $payload]);
                $transaction->donation->update(['status' => $status]);
            }
        }

        return response()->json(['received' => true]);
    }
}
