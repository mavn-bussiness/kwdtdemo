<?php

namespace App\Livewire;

use App\Models\Donation;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DonationForm extends Component
{
    // ── Props ─────────────────────────────────────────────────────
    public bool $expanded = false; // true on a dedicated /donate page

    // ── Form state ────────────────────────────────────────────────
    public string $selectedAmount = '25';

    public string $customAmount = '';

    public string $currency = 'USD';

    public string $paymentMethod = 'paypal';

    public string $donorName = '';

    public string $donorEmail = '';

    public string $donorPhone = '';

    public string $reason = '';

    public bool $isAnonymous = false;

    // ── UI state ──────────────────────────────────────────────────
    public string $step = 'amount';  // 'amount' | 'details' | 'processing' | 'success' | 'failed'

    public string $errorMessage = '';

    // ── Suggested amounts with impact descriptions ─────────────────
    public array $amounts = [
        '10' => '$10 — Menstrual health supplies for 2 girls for a month',
        '25' => '$25 — Clean water for one family for a month',
        '50' => '$50 — Women\'s group skills training session',
        '100' => '$100 — Micro-business startup support for one woman',
        'custom' => 'Custom amount',
    ];

    // ── Validation rules ──────────────────────────────────────────
    public function rules(): array
    {
        return [
            'paymentMethod' => 'required|in:paypal',
            'currency' => 'required|in:USD',
            'isAnonymous' => 'boolean',
            'donorEmail' => 'nullable|email',
            'reason' => 'nullable|string|max:500',
            'donorName' => 'required_if:isAnonymous,false|string|max:255',
            'donorEmail' => 'required_if:isAnonymous,false|email|max:255',
        ];
    }

    // ── Computed: final donation amount ───────────────────────────
    #[Computed]
    public function finalAmount(): float
    {
        if ($this->selectedAmount === 'custom') {
            return (float) str_replace(',', '', $this->customAmount);
        }

        return (float) $this->selectedAmount;
    }

    // ── Dynamic impact text ───────────────────────────────────────
    #[Computed]
    public function impactText(): string
    {
        return $this->amounts[$this->selectedAmount]
            ?? "\${$this->selectedAmount} — Thank you for your generous contribution!";
    }

    // ── Select a preset amount ────────────────────────────────────
    public function selectAmount(string $amount): void
    {
        $this->selectedAmount = $amount;
        if ($amount !== 'custom') {
            $this->customAmount = '';
        }
    }

    // ── Proceed from amount → details ─────────────────────────────
    public function proceedToDetails(): void
    {
        $amount = $this->finalAmount;

        if ($this->selectedAmount === 'custom' && empty($this->customAmount)) {
             $this->errorMessage = 'Please enter a donation amount.';
             return;
        }

        if ($amount <= 0) {
            $this->errorMessage = 'Please enter a valid donation amount.';

            return;
        }

        if ($amount < 1) {
            $this->errorMessage = 'Minimum donation is $1.';

            return;
        }

        $this->errorMessage = '';
        $this->step = 'details';
    }

    // ── Submit donation ───────────────────────────────────────────
    public function submitDonation(): void
    {
        $this->validate();

        $this->step = 'processing';

        try {
            $donation = Donation::create([
                'donor_name' => $this->isAnonymous ? null : $this->donorName,
                'donor_email' => $this->isAnonymous ? null : $this->donorEmail,
                'reason' => $this->reason ?: null,
                'amount_original' => $this->finalAmount,
                'currency' => $this->currency,
                'payment_method' => $this->paymentMethod,
                'is_anonymous' => $this->isAnonymous,
                'status' => 'pending',
            ]);

            // Redirect to a payment gateway based on a method
            $this->redirectToGateway($donation);

        } catch (\Exception $e) {
            $this->step = 'failed';
            $this->errorMessage = 'Something went wrong. Please try again or contact us.';
            \Log::error('Donation creation failed', ['error' => $e->getMessage()]);
        }
    }

    // ── Gateway redirect ──────────────────────────────────────────
    private function redirectToGateway(Donation $donation): void
    {
        // These routes will be handled by DonateController,
        // which calls the appropriate payment service
        $this->redirect(route('donate.gateway', [
            'donation' => $donation->id,
            'method' => $this->paymentMethod,
        ]));
    }

    // ── Reset form ────────────────────────────────────────────────
    public function resetForm(): void
    {
        $this->reset([
            'selectedAmount', 'customAmount', 'donorName',
            'donorEmail', 'donorPhone', 'reason', 'isAnonymous',
        ]);
        $this->selectedAmount = '25';
        $this->step = 'amount';
        $this->errorMessage = '';
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.donation-form');
    }
}
