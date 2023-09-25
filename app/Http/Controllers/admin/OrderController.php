<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderitems;
use App\Models\Product;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::paginate(10);

        if(!empty($request->get('search')))
            $orders = Order::where('id','like','%'.$request->get('search').'%')->paginate(10);

        return view('admin.orders', ['orders' => $orders]);
    }

    public function detail(string $id)
    {
        $order = Order::where('id',$id)->first();
        $order_items = Orderitems::where('order_id',$order->id)->get();
        $products = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')->where('order_id','=',$order->id)
        ->select('*')
        ->get();

        $price = $order->total_price;


        return view('admin.order-detail', [
            'order'       => $order,
            'order_items' => $order_items,
            'products'    => $products,
            'price'       => $price
        ]);
    }
    public function UpdateDetail(Request $request,string $id)
    {
        if($request->status == 'Cancelled' || $request->status == 'Delivered' || $request->status == 'Pending'){
            Order::where('id',$id)->update([
            'status' => $request->status,
            ]);
        }
        return redirect(route('orders.index'))->with('message','Order Status Updated');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.order-detail');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
