<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use Illuminate\Support\str;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::paginate(10);

        if(!empty($request->get('search')))
            $brands = Brand::where('name','like','%'.$request->get('search').'%')->paginate(10);

        return view('admin.brands', ['brands'=> $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-brand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $slug = str::slug($request->name, '-');

        Brand::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect(route('brands.index'))->with('message', 'Brand Added');
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
        $brand = Brand::where('id', $id)->first();
        return view('admin.update-brand', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBrandRequest $request, string $id)
    {
        $slug = str::slug($request->name, '-');

        Brand::where('id', $id)->update([
        'name' => $request->name,
        'slug' => $slug,
        ]);

        return redirect(route('brands.index'))->with('message', 'Brand Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::where('id', $id)->delete();

        return redirect(route('brands.index'))->with('message', 'Brand Deleted');
    }
}
