<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductVariant;


class Purchases extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    // public function product_variants()
    // {
    //     return $this->belongsTo(ProductVariant::class,'product_variants_id');
    // }

    // public function product_variant_values()
    // {
    //     return $this->belongsTo(ProductVariant::class,'variants_value_id');
    // }

    
}
