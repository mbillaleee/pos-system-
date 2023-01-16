<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Product;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'sale_extras');
    // }
}
