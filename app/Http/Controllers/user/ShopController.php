<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request, string $categorySlug = null, string $subCategorySlug = null)
    {
        $categorySelected = '';
        $subCategorySelected = '';
        $brandArray = [];
        $min_price = intval($request->price_min);
        $max_price = intval($request->price_max);
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('status','1')->get();

        if(!empty($categorySlug)){
            $category = Category::where('slug', $categorySlug)->first();
            $products = Product::where('category_id', $category->id)->get();
            $categorySelected = $category->id;
        }

        if(!empty($subCategorySlug)){
            $subcategory = Subcategory::where('slug', $subCategorySlug)->first();
            $products = Product::where('subcategory_id', $subcategory->id)->get();
            $subCategorySelected = $subcategory->id;
        }

        if(!empty($request->get('brands'))){
            $brandArray = explode(',', $request->get('brands'));
            $products = $products->whereIn('brand_id',$brandArray);
        }
        if($request->price_max != '' && $request->price_min != ''){
            $products = $products->whereBetween('price', [$min_price,$max_price]);
        }
        if(!empty($request->get('search'))){
            $products = Product::where('title','like','%'.$request->get('search').'%')->get();
        }
        return view('shop', [
            'categories'          => $categories,
            'brands'              => $brands,
            'products'            => $products,
            'categorySelected'    => $categorySelected,
            'subCategorySelected' => $subCategorySelected,
            'brandArray'          => $brandArray,
            'min_price'           => $min_price,
            'max_price'           => $max_price,
        ]);
    }

    public function show(string $id)
    {
        $product = Product::where('id', $id)->first();
        $related_products = Product::where('subcategory_id',$product->subcategory_id)->get();

        return view('product',[
            'product'          => $product,
            'related_products' => $related_products,
            'id'               => $id,
        ]);
    }
}
