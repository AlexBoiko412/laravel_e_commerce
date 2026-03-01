<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'slug',
        'website_url',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
