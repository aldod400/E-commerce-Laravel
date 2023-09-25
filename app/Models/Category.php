<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use App\Models\Product;


class Category extends Model
{
    use HasFactory;

protected $fillable = [
        'name',
        'slug',
        'picture',
        'showHome',
    ];
    public function subcategory(){

    return $this->hasMany(Subcategory::class);
    }

    public function product(){

    return $this->hasMany(Product::class);
    }
}
