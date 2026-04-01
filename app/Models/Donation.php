<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_email',
        'donor_phone',
        'reason',
        'amount_original',
        'currency',
        'amount_usd',
        'payment_method',
        'is_anonymous',
        'status',
        'gateway',
        'gateway_ref',
        'amount',
        'raw_response',
    ];

    protected function casts(): array
    {
        return [
            'amount_original' => 'decimal:2',
            'is_anonymous' => 'boolean',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * All payment attempts for this donation.
     * A donor might retry after a failed first attempt — each attempt is a new transaction.
     */
    public function transactions(): Donation|HasMany
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    /**
     * Convenience: just the most recent transaction.
     * Usage: $donation->latestTransaction->status
     */
    public function latestTransaction()
    {
        return $this->hasOne(PaymentTransaction::class)->latestOfMany();
    }

    // -------------------------------------------------------------------------
    // Scopes
    // -------------------------------------------------------------------------

    public function scopeSuccessful(Builder $query): Builder
    {
        return $query->where('status', 'success');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('status', 'failed');
    }

    /**
     * Filter by payment method.
     * Usage: Donation::viaPaypal()->get()
     */
    public function scopeViaPaypal(Builder $query): Builder
    {
        return $query->where('payment_method', 'paypal');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Display name for the donor — respects an anonymous flag.
     */
    public function displayName(): string
    {
        return $this->is_anonymous ? 'Anonymous' : ($this->donor_name ?? 'Anonymous');
    }

    /**
     * Human-readable payment method label.
     */
    public function paymentMethodLabel(): string
    {
        return 'PayPal';
    }

    /**
     * Whether this donation was paid in UGX (local Mobile Money).
     * @deprecated Only USD/PayPal supported now
     */
    public function isLocalCurrency(): bool
    {
        return false;
    }
}
