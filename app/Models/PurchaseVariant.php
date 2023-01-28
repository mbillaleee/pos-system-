<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseVariant extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
