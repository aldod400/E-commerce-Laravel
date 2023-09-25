<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAccountRequest;
Use App\Models\User;
Use App\Models\Order;
Use App\Models\Orderitems;
use App\Models\WishList;
use DB;

class MyAccountController extends Controller
{

    public function MyAccount(string $id)
    {
        return view('account');
    }

    public function UpdateAccount(UpdateAccountRequest $request, string $id)
    {
        if($request->password != null){
            if($request->picture != null){
                $pic = time() . '-' . $request->name . '.' . $request->picture->extension();
                $request->picture->move('storage/images/user-image',$pic);
                User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'picture' => $pic,
                'phone' => $request->phone,
                'address' => $request->address,
                ]);
            }else{
                User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                ]);
            }
        }else{
            if($request->picture != null){
                $pic = time() . '-' . $request->name . '.' . $request->picture->extension();
                $request->picture->move('storage/images/user-image',$pic);
                User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'picture' => $pic,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            }else{
                User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                ]);
            }
        }
        return redirect('/')->with('message','Information Updated');
    }

    public function MyOrder(string $id)
    {
        $orders = Order::where('user_id', auth()->user()->id)->paginate(10);

        return view('my-orders', [
            'orders'      => $orders,
        ]);
    }

    public function MyOrderDetails(string $id)
    {
        $order = Order::where('id',$id)->where('user_id',auth()->user()->id)->first();
        $order_items = Orderitems::where('order_id', $id)->get();

        $products = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')->where('order_id','=',$order->id)
        ->select('*')
        ->paginate(10);

        return view('order-detail',[
            'order_items' => $order_items,
            'order'       => $order,
            'products'    => $products,
        ]);
    }

    public function storeInWishList($id){

        $wish_list_item = WishList::where('product_id', $id)->where('user_id',auth()->user()->id)->first();

        if($wish_list_item != null){
            return redirect(route('products'))->with('message','Product Aready Exist in Wish List');
        }
        else{
            WishList::create([
            'user_id' => auth()->user()->id,
            'product_id' => $id,
        ]);

        return redirect(route('products'))->with('message','Product Added to Wish List');
    }
}

    public function deleteFromWishList($id){

        $wish_list_item = WishList::where('product_id', $id)->where('user_id',auth()->user()->id)->first();

        if($wish_list_item == null){
            return redirect(route('products'))->with('message','Product Not Found in Wish List');
        }else{
            WishList::where('product_id', $id)->where('user_id', auth()->user()->id)->delete();
            return redirect(route('products'))->with('message','Product Deleted from Wish List');
        }
    }
    public function showWishList()
    {
        $products = DB::table('wish_lists')
        ->join('products', 'product_id', '=', 'products.id')->where('user_id', auth()->user()->id)
        ->select('*')
        ->paginate(10);
        return view('wishlist',[
            'products' => $products,
        ]);
    }
}
