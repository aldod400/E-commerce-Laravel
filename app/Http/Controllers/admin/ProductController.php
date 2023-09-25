<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::paginate(10);

        if(!empty($request->get('search')))
            $products = Product::where('title','like','%'.$request->get('search').'%')->paginate(10);

        return view('admin.products', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = Subcategory::get();
        $brands = Brand::get();

        return view('admin.create-product', [
            'categories'    => $categories,
            'subcategories' => $subcategories,
            'brands'        => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $picture = time() . '-' . $request->title . '.' . $request->picture->extension();
        $request->picture->move('storage/images/product-image',$picture);

        Product::create([
            'title'          => $request->title,
            'description'    => $request->description,
            'price'          => $request->price,
            'quantity'       => $request->quantity,
            'picture'        => $picture,
            'status'         => $request->status,
            'category_id'    => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand_id'       => $request->brand,
        ]);

        return redirect(route('products.index'))->with('message', 'Product Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::get();
        $subcategories = Subcategory::get();
        $brands = Brand::get();
        $product = Product::where('id', $id)->first();

        return view('admin.update-product', [

        'categories'    => $categories,
        'subcategories' => $subcategories,
        'brands'        => $brands,
        'product'       =>$product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        if($request->picture != null){
            $picture = time() . '-' . $request->title . '.' . $request->picture->extension();
            $request->picture->move('storage/images/product-image',$picture);

            Product::where('id', $id)->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'price'          => $request->price,
            'quantity'       => $request->quantity,
            'picture'        => $picture,
            'status'         => $request->status,
            'category_id'    => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand_id'       => $request->brand,
        ]);
        }else{
            Product::where('id', $id)->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'price'          => $request->price,
            'quantity'       => $request->quantity,
            'status'         => $request->status,
            'category_id'    => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand_id'       => $request->brand,
        ]);
        }
        return redirect(route('products.index'))->with('message', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();

        return redirect(route('products.index'))->with('message', 'Product Deleted');
    }
}
