<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

Route::get('/',[HomeController::class, 'index']);

Route::middleware(['auth:sanctum','verified'])->get('/dashboard',function(){
    return view('dashboard');
})->name('dashboard');

Route::get('/redirect',[HomeController::class, 'redirect'])->middleware('auth','verified');

Route::get('/view_category', [AdminController::class, 'view_category']);

Route::post('/category/add', [AdminController::class, 'add_category']);

Route::get('/category/delete/{id}', [AdminController::class, 'delete_category']);

Route::get('/view_product',[AdminController::class, 'view_product']);

Route::get('/view_shop_product',[AdminController::class, 'view_shop_product']);

Route::post('/product/add',[AdminController::class, 'add_product']);

Route::post('/shop_product/add',[AdminController::class, 'add_shop_product']);

Route::get('/products', [AdminController::class, 'show_product']);

Route::get('/shop_products', [AdminController::class, 'show_shop_product']);

Route::get('/product/delete/{id}',[AdminController::class, 'delete_product']);

Route::get('/shop_product/delete/{id}',[AdminController::class, 'delete_shop_product']);

Route::get('/product/edit/{id}', [AdminController::class, 'edit_product']);

Route::get('/shop_product/edit/{id}', [AdminController::class, 'edit_shop_product']);

Route::post('/product/edit/{id}', [AdminController::class, 'update_product']);

Route::post('/shop_product/edit/{id}', [AdminController::class, 'update_shop_product']);

Route::get('/orders',[AdminController::class, 'orders']);

Route::get('/orders/{id}/delivered', [AdminController::class, 'delivered']);

Route::get('/orders/{id}/print', [AdminController::class , 'print_pdf']);

Route::get('/send_email/{id}', [AdminController::class, 'send_email']);

Route::post('/send_user_email/{id}',[AdminController::class, 'send_user_email']);

Route::get('/search', [AdminController::class, 'search']);


Route::get('auth/google', [HomeController::class, 'googlepage']);

Route::get('auth/google/callback', [HomeController::class, 'googlecallback']);

Route::get('/products/detail/{id}', [HomeController::class, 'detail_product']);

Route::post('/products/{id}/cart',[HomeController::class, 'add_cart']);

Route::post('/shop_products/{id}/cart',[HomeController::class, 'add_shop_cart']);

Route::get('/cart', [HomeController::class, 'show_cart']);

Route::get('/cart/delete/{id}', [HomeController::class, 'remove_cart']);

Route::get('/order/cash', [HomeController::class, 'cash_order']);

Route::get('/stripe/{total}', [HomeController::class, 'stripe']);

Route::post('/stripe/{total}', [HomeController::class, 'stripePost'])->name('stripe.post');

Route::get('/show_order',[HomeController::class, 'show_order']);

Route::get('/orders/cancel/{id}',[HomeController::class, 'cancel_order']);

Route::post('/products/{id}/comment/add', [HomeController::class, 'add_comment']);

Route::post('/reply', [HomeController::class, 'add_reply']);

Route::get('/products/search',[HomeController::class,'product_search']);

Route::get('/shop',[HomeController::class, 'shop']);

Route::get('/shop_product/detail/{id}', [HomeController::class, 'detail_shop_product']);

Route::get('/benefit',[HomeController::class, 'benefit']);

Route::get('/contact',[HomeController::class, 'contact']);

