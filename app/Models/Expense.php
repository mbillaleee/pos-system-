<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = []; 

    protected $fillable = ['user_id', 'reference_num', 'supplier_id', 'date', 'expense_type', 'payment_method', 'total_amount', 'paid_amount'];


    public function cartofacc()
    {
        return $this->belongsTo(ChartOfAccount::class, 'cartofacc_id');
    }

    public function child()
    {
        return $this->hasMany(ChartOfAccount::class, 'cartofacc_id');
    }
}
