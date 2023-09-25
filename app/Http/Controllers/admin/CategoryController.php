<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::paginate(10);

        if(!empty($request->get('search'))){
            $categories = Category::where('name','like','%'.$request->get('search').'%')->paginate(10);
        }
        return view('admin.categories', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $slug = str::slug($request->name, '-');

        $pic = time() . '-' . $request->name . '.' . $request->picture->extension();
        $request->picture->move('storage/images/category-image',$pic);

        Category::create([
            'name'     => $request->name,
            'slug'     => $slug,
            'picture'  => $pic,
            'showHome' => $request->show,
        ]);
        return redirect(route('categories.index'))->with('message','Category Added');
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
        $category = Category::where('id', $id)->first();
        return view('admin.update-category', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $slug = str::slug($request->name, '-');

        if($request->picture != null){
            $pic = time() . '-' . $request->name . '.' . $request->picture->extension();
            $request->picture->move('storage/images/category-image',$pic);

            Category::where('id', $id)->update([
            'name'     => $request->name,
            'slug'     => $slug,
            'picture'  => $pic,
            'showHome' => $request->show,
            ]);
        }else{
            Category::where('id', $id)->update([
            'name'     => $request->name,
            'slug'     => $slug,
            'showHome' => $request->show,
            ]);
        }
        return redirect(route('categories.index'))->with('message', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();

        return redirect(route('categories.index'))->with('message', 'Category Deleted');
    }
}
