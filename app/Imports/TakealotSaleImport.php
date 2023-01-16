<?php

namespace App\Imports;

use App\Models\TakealotSale;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TakealotSaleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_id = Auth::user()->id;
        return new TakealotSale([
            'tsin'     => $row['tsin'],
            'order_item_id'    => $row['order_item_id'], 
            'order_id' => $row['order_id'],
            'order_date' => $row['order_date'],
            'product_name'    => $row['product_name'], 
            'selling_price' => $row['selling_price'],
            'quantity'     => $row['quantity'],
            'sale_status'    => $row['sale_status'], 
            'cust_name' => $row['cust_name'],
            'dc'  => $row['dc'],
            'user_id'    => $user_id,
        ]);
    }
}
