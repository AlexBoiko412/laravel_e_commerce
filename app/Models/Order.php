<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'status', 'total_price',
        'tax_amount', 'shipping_amount', 'shipping_address_id', 'billing_address_id'
    ];

    /**
     * Relationship: An Order has many Items.
     * Equivalent to EF Core's .HasMany()
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relationship: An Order belongs to a User.
     * Equivalent to EF Core's .HasOne() / .WithMany()
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
