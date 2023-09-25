<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubcategoryRequest;
use Illuminate\Support\str;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subcategories = Subcategory::paginate(10);

        if(!empty($request->get('search')))
            $subcategories = Subcategory::where('name','like','%'.$request->get('search').'%')->paginate(10);

        return view('admin.subcategory', ['subcategories' => $subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.create-subcategory' ,['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcategoryRequest $request)
    {
        $slug = str::slug($request->name, '-');

        Subcategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category,
        ]);

        return redirect(route('subcategories.index'))->with('message', 'Sub Category Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::get();

        $subcategory = Subcategory::where('id', $id)->first();

        return view('admin.update-subcategory', [
            'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slug = str::slug($request->name, '-');

        if($request->category != null){
            Subcategory::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category,
            ]);
        }else{
            Subcategory::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $slug,
            ]);
        }

        return redirect(route('subcategories.index'))->with('message', 'Sub Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subcategory::where('id', $id)->delete();

        return redirect(route('subcategories.index'))->with('message', 'Sub Category Deleted');
    }
}
