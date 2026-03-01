<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'token'];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalQuantityAttribute(): int
    {
        return $this->items()->sum('quantity');
    }
}
