<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ShippingCharge;
use App\Models\Orderitems;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderEmail;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;

class CartController extends Controller
{
    public function orderEmail($id)
    {
        $order = Order::where('id', $id)->with('product')->first();

        $order_items = Orderitems::where('order_id',$order->id)->get();

        $products = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')->where('order_id','=',$order->id)
        ->select('*')
        ->get();

        $mailData = [
        'subject' => 'Thanks For your Order',
        'order' => $order,
        'order_items' => $order_items,
        'products' => $products,
        ];

        Mail::to(auth()->user()->email)->send(new orderEmail($mailData));

    }

    public function index()
    {
        $cart_content = Cart::content();
        // dd($cart_content);
        return view('cart', ['cart_content' => $cart_content]);
    }

    public function  store(Request $request, string $id)
    {
        $product = Product::where('id', $id)->first();

        $items = Cart::Content();
        $aleady_in_cart = false;

        foreach($items as $item){
            if($item->id == $product->id)
                $aleady_in_cart = true;
        }

        if($aleady_in_cart)
            return redirect(route('product.show', $id))->with('danger', $product->title . ' Already in Cart');
        else{
            Cart::add($product->id,$product->title,1, $product->price, ['product_image' => $product->picture, 'product_qty' => $product->quantity]);
            return redirect(route('product.show', $id))->with('message', $product->title . ' Added to Cart');
            }
    }

    public function update(Request $request,string $id)
    {
        $item = Cart::get($id);

        if($request->has('down') && $item->qty > 1){
            Cart::update($id,$item->qty-1);
        }elseif($request->has('up') && $item->qty <= 10){
            if($item->options->product_qty <= $item->qty)
                return redirect(route('cart.index'))->with('danger' , 'Not Avilable more in the stock');
            else
                Cart::update($id,$item->qty+1);
        }

        return redirect(route('cart.index'))->with('message' , 'Item updated');
    }

    public function destroy(Request $request, string $id)
    {
        $cart = Cart::get($id);

        if($request->has('delete') && $cart != null)
            Cart::remove($id);
        return redirect(route('cart.index'))->with('message' , "Item Deleted");
    }

    public function checkoutIndex()
    {

        if(Cart::count() == 0)
            return redirect(route('cart.index'))->with('danger','Add to Cart First');
        $total_shipping = 0;
        $total_price = Cart::subtotal(2,'.','');
        $shipping = ShippingCharge::where('country', auth()->user()->country)->first();
        if($shipping != null){
            $total_qty = 0;
            foreach(Cart::content() as $cart){
            $total_qty += $cart->qty;
            }
            $total_shipping = $total_qty * $shipping->amount;
            $total_price = $total_shipping + Cart::subtotal(2,'.','');
            return view('checkout', [
            'total_shipping' => $total_shipping,
            'total_price' => $total_price,
            ]);
        }else{
            return view('checkout', [
            'total_shipping' => $total_shipping,
            'total_price' => $total_price,
        ]);
        }

    }

    public function checkoutStore(StorePaymentRequest $request) //4155279860457201
    {
        $shipping = ShippingCharge::where('country', auth()->user()->country)->first();

        $total_qty = 0;
        foreach(Cart::content() as $cart){
        $total_qty += $cart->qty;
        }
        $total_shipping = $total_qty * $shipping->amount;
        $total_price = $total_shipping + Cart::subtotal(2,'.','');

        $order = new Order;

        if(Cart::count() != 0){
            Payment::create([
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'cvv_code' => $request->cvv_code,
            'order_notes' => $request->order_notes,
            'user_id' => auth()->user()->id,
            ]);

            $order->total_price = $total_price;
            $order->status = 'Pending';
            $order->user_id = auth()->user()->id;
            $order->save();

            foreach(Cart::content() as $item){
            $order_item = new Orderitems;
            $order_item->order_id = $order->id;
            $order_item->product_id = $item->id;
            $order_item->quantity = $item->qty;
            $order_item->price = $item->price * $item->qty;
            $order_item->save();
            }

            $this->orderEmail($order->id);

            return redirect(route('thanks'));
        }else{
            return redirect(route('cart.index'))->with('danger', 'Cart is Empty');
        }
    }

    public function thankyou()
    {
        $order = null;
        if(Cart::count() != 0){
            $order = Order::where('user_id', auth()->user()->id)->orderBy('id','DESC')->first();
            Cart::destroy();
            return view('thanks', ['order' => $order]);
        }else{
            return view('thanks',['order' => $order]);
        }
    }
}
