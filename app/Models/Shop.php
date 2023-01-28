<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Purchases;
// use App\Models\Sale;
// use DB;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getQuantity($shop_id, $product_id, $variant_id=null, $variant_value_id=null) {
        $products = Product::findOrFail($product_id);
        if($products->product_type == 2){
            $all_purchases = Purchases::selectRaw('SUM(purchase_variants.quantity) as quantity,purchase_variants.purchase_variant_id as variant_id,purchase_variants.purchase_variants_value_id as variants_value_id')
            ->join('purchase_variants','purchase_variants.purchase_id','=','purchases.id')
            ->where('purchases.shop_id',$shop_id)
            ->where('purchase_variants.product_id',$product_id)
            ->where('purchase_variants.purchase_variant_id',$variant_id)
            ->where('purchase_variants.purchase_variants_value_id',$variant_value_id)
            ->groupBy('purchase_variants.purchase_variant_id','purchase_variants.purchase_variants_value_id')
            ->first();

            $all_sales = Sale::selectRaw('SUM(sale_variants.quantity) as quantity,sale_variants.sales_variants_id as variant_id,sale_variants.sales_variants_value_id as variants_value_id')
                ->join('sale_variants','sale_variants.sale_id','=','sales.id')
                ->where('sales.shop_id',$shop_id)
                ->where('sale_variants.product_id',$product_id)
                ->where('sale_variants.sales_variants_id',$variant_id)
                ->where('sale_variants.sales_variants_value_id',$variant_value_id)
                ->groupBy('sale_variants.sales_variants_id','sale_variants.sales_variants_value_id')
                ->first();

            // dd($all_purchases);

            $balance_qty = round(($all_purchases->quantity ?? 0 - $all_sales->quantity ?? 0),5);

 

        }elseif($products->product_type == 3){

        }else{
            $all_purchases = Purchases::selectRaw('SUM(purchase_extras.quantity) as quantity')
            ->join('purchase_extras','purchase_extras.purchase_id','=','purchases.id')
            ->where('purchases.shop_id',$shop_id)
            ->where('purchase_extras.product_id',$product_id)
            ->groupBy('purchase_extras.product_id')
            ->first();

            $all_sales = Sale::selectRaw('SUM(sale_extras.quantity) as quantity')
            ->join('sale_extras','sale_extras.sale_id','=','sales.id')
            ->where('sales.shop_id',$shop_id)
            ->where('sale_extras.product_id',$product_id)
            ->groupBy('sale_extras.product_id')
            ->first();

            $balance_qty = round(($all_purchases->quantity ?? 0 - $all_sales->quantity ?? 0),5);
        }

       

        return $balance_qty;
    }





    
}
