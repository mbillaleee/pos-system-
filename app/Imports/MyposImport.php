<?php

namespace App\Imports;

use App\Models\Mypos;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MyposImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_id = Auth::user()->id;
        return new Mypos([
            'product_id'     => $row['product_id'],
            'code'    => $row['code'], 
            'tsin' => $row['tsin'],
            'name' => $row['name'],
            'unit'    => $row['unit'], 
            'cost' => $row['cost'],
            'price'     => $row['price'],
            'quantity'    => $row['quantity'], 
            'type' => $row['type'],
            'rack_no'  => $row['rack_no'],
            'user_id'    => $user_id,
        ]);
    }
}
