<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductCategory extends Model
{
    protected $guarded = [];

    public function categories(): HasOne
    {
        return $this->hasMany(ProductCategory::class);
    }
    public function products(): HasOne
    {
        return $this->hasMany(Product::class);
    }
}
