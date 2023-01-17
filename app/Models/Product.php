<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['name', 'sku', 'category', 'brand', 'image', 'weight', 'unit', 'description', 'sell_price', 'purchase_price', 'alert_query', 'product_type', 'status'];

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
    
}
