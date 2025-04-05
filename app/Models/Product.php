<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'json'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(ProductCategory::class);
    }

    
}
