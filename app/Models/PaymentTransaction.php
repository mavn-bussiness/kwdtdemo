<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentTransaction extends Model
{
    use HasFactory;

    /**
     * Transactions are immutable financial records — no updated_at.
     * Never edit a transaction; create a new one if a status changes.
     */
    public $timestamps = false;

    const string CREATED_AT = 'created_at';

    protected $fillable = [
        'donation_id',
        'gateway',          // was 'payment_gateway'
        'gateway_ref',      // was 'transaction_id' — add this
        'amount',           // was 'amount_usd'
        'currency',
        'status',
        'raw_response',     // was 'gateway_response'
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'raw_response' => 'array',
            'paid_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The donation this transaction belongs to.
     */
    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
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

    public function scopeCancelled(Builder $query): Builder
    {
        return $query->where('status', 'cancelled');
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function isSuccessful(): bool
    {
        return $this->status === 'success';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Human-readable gateway label.
     */
    public function gatewayLabel(): string
    {
        return match ($this->payment_gateway) {
            'paypal' => 'PayPal',
            'mtn_momo' => 'MTN Mobile Money',
            'airtel_money' => 'Airtel Money',
            default => ucfirst($this->payment_gateway),
        };
    }
}
