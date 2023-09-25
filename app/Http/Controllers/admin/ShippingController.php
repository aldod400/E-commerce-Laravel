<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreShippingRequest;
use App\Models\ShippingCharge;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shipping = ShippingCharge::paginate(10);

        if(!empty($request->get('search')))
            $shipping = ShippingCharge::where('country','like','%'.$request->get('search').'%')->paginate(10);

        return view('admin.shipping', ['shipping' => $shipping]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-shipping');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingRequest $request)
    {
        ShippingCharge::create([
            'country' => $request->country,
            'amount' => $request->amount,
        ]);

        return redirect(route('shipping.index'))->with('message','Shipping Added');
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
        $shipping = ShippingCharge::where('id', $id)->first();
        return view('admin.update-shipping', ['shipping' => $shipping]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreShippingRequest $request, string $id)
    {
        ShippingCharge::create([
        'country' => $request->country,
        'amount' => $request->amount,
        ]);

        return redirect(route('shipping.index'))->with('message','Shipping Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ShippingCharge::where('id', $id)->delete();
        return redirect(route('shipping.index'))->with('message','Shipping Deleted');
    }
}
