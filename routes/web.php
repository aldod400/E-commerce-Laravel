<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubcategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\user\MyAccountController;
use App\Http\Controllers\user\ShopController;
use App\Http\Controllers\user\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'show'])->middleware('auth')->name('/');

// Route::get('/account', [ CartController::class, 'orderEmail']);

Auth::routes();

// admin routes.

Route::middleware(['auth', 'admin:admin'])->prefix('admin')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resources
        (
            [
            'categories'    => CategoryController::class,
            'subcategories' => SubcategoryController::class,
            'brands'        => BrandController::class,
            'products'      => ProductController::class,
            'users'         => UserController::class,
            'shipping'      => ShippingController::class,
            ],
            [
                'except' => 'show',
            ]
        );
        Route::resource('orders' , OrderController::class,
            [
                'only' => 'index' , 'detail' ,'UpdateDetail'
            ]

    );
    Route::get('orders/details/{id}',[OrderController::class,'detail'])->name('orders.details');
    Route::post('orders/updatedetails/{id}',[OrderController::class,'UpdateDetail'])->name('orders.updatedetails');
});

// user routes.

Route::prefix('product')->middleware('auth')->group(function () {

    Route::get ('/{id}',[ShopController::class,'show'])->name('product.show');
    Route::get('/', [ShopController::class, 'index'])->name('products');
    Route::get('/{categorySlug?}/{subCategorySlug?}', [ShopController::class,'index'])->name('product.subCategory');
});

Route::prefix('account')->middleware('auth')->group(function () {

    Route::get('/{id}', [MyAccountController::class, 'MyAccount'])->name('account');
    Route::post('/update/{id}', [MyAccountController::class,'UpdateAccount'])->name('account.update');
    Route::get('orders/{id}', [MyAccountController::class, 'MyOrder'])->name('account.orders');
    Route::get('order/details/{id}', [MyAccountController::class, 'MyOrderDetails'])->name('account.order.details');

});

Route::prefix('wishlist')->middleware('auth')->group(function () {

    Route::get('/', [MyAccountController::class, 'showWishList'])->name('show.wishlist');
    Route::get('/{id}', [MyAccountController::class, 'storeInWishList'])->name('store.wishlist');
    Route::get('/destroy/{id}', [MyAccountController::class, 'deleteFromWishList'])->name('destroy.wishlist');
});

Route::prefix('cart')->middleware('auth')->group(function () {

    Route::get('/', [CartController::class,'index'])->name('cart.index');
    Route::get('/store{id}', [CartController::class,'store'])->name('cart.store');
    Route::get('/update/{id}', [CartController::class,'update'])->name('cart.update');
    Route::get('/destroy/{id}', [CartController::class,'destroy'])->name('cart.destroy');
});

Route::prefix('checkout')->middleware('auth')->group(function () {

    Route::get('/', [CartController::class, 'checkoutIndex'])->name('checkout.index');
    Route::post('/store', [CartController::class, 'checkoutStore'])->name('checkout.store');
});

    Route::get('about-us', [HomeController::class, 'about_us'])->name('about-us');
    Route::get('contact-us', [HomeController::class, 'contact_us'])->name('contact-us');
    Route::get('thanks', [CartController::class, 'thankyou'])->name('thanks');

