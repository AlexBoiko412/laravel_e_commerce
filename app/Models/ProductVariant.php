<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'compare_at_price',
        'cost_price',
        'quantity_in_stock',
        'weight_unit',
        'weight',
        'metadata',
    ];

    protected $casts = [
        'price'             => 'decimal:2',
        'compare_at_price'  => 'decimal:2',
        'cost_price'        => 'decimal:2',
        'weight'            => 'decimal:2',
        'quantity_in_stock' => 'integer',
        'metadata'          => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function inStock(): bool
    {
        return $this->quantity_in_stock > 0;
    }

    public function getMarginPercentage(): ?float
    {
        if (!$this->cost_price || $this->price <= 0) {
            return null;
        }

        return (($this->price - $this->cost_price) / $this->price) * 100;
    }
}
