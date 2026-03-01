<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'provider', 'transaction_id', 'amount', 'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'integer',
    ];
}
