<?php

namespace App\Imports;

use App\Models\Takealot;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TakealotImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_id = Auth::user()->id;
        return new Takealot([
            'tsin'     => $row['tsin'],
            'offer_id'    => $row['offer_id'], 
            'title' => $row['title'],
            'selling_price' => $row['selling_price'],
            'rrp'    => $row['rrp'], 
            'quantity' => $row['quantity'],
            'sku'     => $row['sku'],
            'barcode'    => $row['barcode'], 
            'status' => $row['status'],
            'takealot_url'  => $row['takealot_url'],
            'user_id'    => $user_id,
        ]);
    }
}
