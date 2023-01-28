<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;
use App\Models\Value;
use App\Models\Product;

class ProductVariant extends Model
{
    use HasFactory;

    // protected $table = 'product_variants';
    protected $guarded = [];

    public function product_variants()
    {
        return $this->belongsTo(Variant::class,'product_variants_id','id');
    }

    public function product_variant_values()
    {
        return $this->belongsTo(Value::class,'variants_value_id','id');
    }


    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
}
