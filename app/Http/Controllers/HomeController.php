<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $users = User::where('role_id','2')->get()->count();
        $orders = Order::get()->count();
        $orders_price = Order::get();
        $price = 0;
        foreach($orders_price as $order){
            $price += $order->total_price;
        }

        return view('admin.home',[
            'users'  => $users,
            'orders' => $orders,
            'price'  => $price,
        ]);
    }
    public function show(){

        $categories = Category::get();
        $products = Product::where('status','1')->take(8)->get();

        return view('welcome',[
        'categories' => $categories,
        'products'   => $products,
        ]);
    }

    public function about_us()
    {
        return view('about-us');
    }
    public function contact_us()
    {
        return view('contact-us');
    }
}
