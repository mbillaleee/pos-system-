<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Purchases;

class PurchaseExtra extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchases()
    {
        return $this->belongsTo(Purchases::class, 'purchases_id');
    }

    public function variants()
    {
        return $this->belongsTo(Variant::class, 'purchase_variants_id');
    }

    public function values()
    {
        return $this->belongsTo(Value::class, 'purchase_variants_value_id');
    }
}
