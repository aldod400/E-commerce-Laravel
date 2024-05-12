<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Order;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'picture',
        'status',
        'category_id',
        'subcategory_id',
        'brand_id',
    ];

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function Subcategory(){

        return $this->belongsTo(Subcategory::class);
    }

    public function Brand(){

        return $this->belongsTo(Brand::class);
    }

    public function order(){

        return $this->belongsToMany(Order::class,'order_items','id','order_id','product_id','quntity','price');
    }
}
