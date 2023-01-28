<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Sale;
use App\Models\PurchaseExtra;
use App\Models\SaleExtra;
use DB;
use App\Models\ProductComboValues;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = ['name', 'sku', 'category', 'brand', 'image', 'weight', 'unit', 'description', 'sell_price', 'purchase_price', 'alert_query', 'product_type', 'status'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_categories()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function purchase_extras()
    {
        return $this->hasMany(PurchaseExtra::class);
    }

 

    // public function  product_varient()
    // {
    // return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    // }

    public function  product_combo_values()
    {
    return $this->hasMany(ProductComboValues::class, 'product_id', 'id');
    }

    static function available_qty($product_id)
    {
        $purchase_qty = PurchaseExtra::selectRaw('SUM(quantity) as qty')->where('product_id',$product_id)->groupBy('product_id')->first();
        $sale_qty = SaleExtra::selectRaw('SUM(quantity) as qty')->where('product_id',$product_id)->groupBy('product_id')->first();
        if($purchase_qty){
        $available_qty = $purchase_qty->qty ?? 0 - $sale_qty->qty ?? 0;
        }else{
            $available_qty = 0;
        }

        return $available_qty;
    }
    
}
