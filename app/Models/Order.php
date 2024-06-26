<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'status',
        'user_id',
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function product(){

        return $this->belongsToMany(Product::class,'order_items','id','order_id','product_id','quantity','price');
    }
}
