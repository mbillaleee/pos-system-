<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;

class ProductVariantValue extends Model
{
    use HasFactory;


    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variants_id');
    }
}
