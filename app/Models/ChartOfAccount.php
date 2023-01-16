<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    use HasFactory;

    public function child()
    {
        return $this->hasMany(ChartOfAccount::class, 'parent_id');
    }
}
