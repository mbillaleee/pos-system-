<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['name', 'user_id', 'email', 'phone', 'date_of_birth', 'tax_number', 'opening_balance', 'address', 'city', 'state', 'country', 'zip_code', 'status'];


    public function sales()
    {
        return $this->hasMany(Product::class);
    }

}
