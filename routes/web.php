<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('/new-arrivals', [App\Http\Controllers\Frontend\FrontendController::class, 'newArrival']);
Route::get('/featured-products', [App\Http\Controllers\Frontend\FrontendController::class, 'featuredProduct']);





Route::middleware(["auth"])->group(function(){
    Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);
    // Route::post('vnpay_payment', [App\Http\Controllers\Frontend\PaymentController::class, 'vnpay_payment']);
});

Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class,"index"])->name("admin.dashboard");

    // Route Slider
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function(){
        Route::get("/sliders","index");
        Route::get("/sliders/create","create");
        Route::post("/sliders","store");
        Route::get("/sliders/{slider}/edit","edit");
        Route::put("/sliders/{slider}","update");
        Route::get("/sliders/{slider}/delete","destroy");
    });

    // Route Danh mục
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function(){
        Route::get("/categories","index");
        Route::get("/categories/create","create");
        Route::post("/categories","store");
        Route::get("/categories/{category}/edit","edit");
        Route::put("/categories/{category}","update");
    });

    // Route Sản phẩm
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function(){
        Route::get("/products","index");
        Route::get("/products/create","create");
        Route::post("/products","store");
        Route::get("/products/{product}/edit","edit");
        Route::put("/products/{product}","update");
        Route::get("/products/{product}/delete","destroy");

        //Xóa ảnh sản phẩm
        Route::get("/product-image/{product_image_id}/delete","destroyImage");
    });

    Route::get("/brands", App\Livewire\Admin\Brand\Index::class);

    // Route Hóa đơn
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function(){
        Route::get("/orders","index");
        Route::get("/orders/{orderId}","show");
        Route::put("/orders/{orderId}","updateOrderStatus");

        Route::get("/invoice/{orderId}","viewInvoice");
        Route::get("/invoice/{orderId}/generate","generateInvoice");
    });

    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function(){
        Route::get("/users","index");
        Route::get("/users/create","create");
        Route::post("/users","store");
        Route::get("/users/{user}/edit","edit");
        Route::put("/users/{user}","update");
        Route::get("/users/{user}/delete","destroy");
    });
});

