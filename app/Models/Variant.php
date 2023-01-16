<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Value;

class Variant extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function  varient_values()
{
    return $this->hasMany(Value::class, 'variants_id', 'id');
}
}
