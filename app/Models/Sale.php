<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
