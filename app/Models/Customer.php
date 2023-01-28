<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

   

    public function sales()
    {
        return $this->hasMany(Product::class);
    }

}
