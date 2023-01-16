<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;

class Value extends Model
{
    use HasFactory;

    protected $table = 'varient_values';

    protected $guarded = [];


    public function variants()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
