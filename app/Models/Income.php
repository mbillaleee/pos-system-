<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $guarded = []; 
    
    public function cartofacc()
    {
        return $this->belongsTo(ChartOfAccount::class, 'cartofacc_id');
    }

    public function child()
    {
        return $this->hasMany(ChartOfAccount::class, 'cartofacc_id');
    }
}
