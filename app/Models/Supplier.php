<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchases;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function Purchases()
    {
        return $this->hasMany(Product::class);
    }
}
