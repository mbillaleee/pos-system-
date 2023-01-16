<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariantValue;

class ProductVariant extends Model
{
    use HasFactory;

    public function productVariantValues()
    {
        return $this->hasMany(ProductVariantValue::class);
    }
}
