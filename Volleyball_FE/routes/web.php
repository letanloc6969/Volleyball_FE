<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/category/{slug}/{id}', [
    'as' => 'category.product',
    'uses' => 'CategoryController@index'
]);


// Show sản phẩm trước khi Add to cart
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
Route::get('/thank-you', [
    'as' => 'thankyou',
    'uses' => 'HomeController@thankyou'
]);


Route::get('/tags/{tag_name}', [
    'as' => 'products.tag',
    'uses' => 'ProductController@tag'
]);


// Register, Login và Logout Người dùng
Route::get('/login-Customer', [
    'as' => 'customers.login',
    'uses' => 'HomeController@loginCustomer'
]);
Route::post('/login-Customer', [
    'as' => 'customers.post-login',
    'uses' => 'HomeController@postLoginCustomer'
]);
Route::get('/register-Customer', [
    'as' => 'customers.register',
    'uses' => 'HomeController@registertCustomer'
]);
Route::post('/register-Customer', [
    'as' => 'customers.post-register',
    'uses' => 'HomeController@postRegistertCustomer'
]);
Route::get('/logout-Customer', [
    'as' => 'customers.logout',
    'uses' => 'HomeController@logoutCustomer'
]);


// Router CHECKOUT Người dùng
Route::get('/check-out', [
    'as' => 'customers.checkout',
    'uses' => 'HomeController@checkout'
]);

// PHÍ VẬN CHUYỂN
Route::post('/select-delivery-user', [
    'as'=>'delivery.add',
    'uses' => 'CheckoutController@select_Delivery',
//            'middleware' => 'can:role-list'
]);

Route::post('/delivery-fee', [
    'as'=>'delivery.fee',
    'uses' => 'CheckoutController@delivery_Fee',
//            'middleware' => 'can:role-list'
]);

Route::get('/delete-delivery-fee', [
    'as'=>'delivery.delete.fee',
    'uses' => 'CheckoutController@delivery_Delete_Fee',
//            'middleware' => 'can:role-list'
]);

// ROUTER CHI TIẾT SẢN PHẨM
Route::get('/product-detail/{id}', [
    'as' => 'products.detail',
    'uses' => 'ProductController@detail'
]);

// Show sản phẩm sau khi Tìm kiếm
Route::post('/search-product', [
    'as' => 'products.search',
    'uses' => 'ProductController@search'
]);

/////////////////////////////
// Lưu product vào giỏ hàng (TEST)
Route::post('/save-cart',[
    'as' => 'products.saveCart',
    'uses' => 'CartController@saveCart'
]);
Route::post('/update-cart',[
    'as' => 'carts.updateCart',
    'uses' => 'CartController@updateCart'
]);

Route::get('/show-cart',[
    'as' => 'products.showCart',
    'uses' => 'CartController@showCart'
]);
Route::get('/delete-cart/{rowId}',[
    'as' => 'carts.deleteCart',
    'uses' => 'CartController@deleteCart'
]);

/////////////////////////////////
// Router thanh toan
Route::get('/checkout-cart',[
    'as' => 'checkout.loginCheckout',
    'uses' => 'CheckoutController@loginCheckout'
]);

Route::post('/save-checkout-customer',[
    'as' => 'checkout.saveCheckout',
    'uses' => 'CheckoutController@saveCheckout'
]);

Route::get('/payment',[
    'as'=>'checkout.payment',
    'uses'=>'CheckoutController@payment'
]);

Route::post('/post-payment',[
    'as'=>'checkout.postPayment',
    'uses'=>'CheckoutController@postPayment'
]);

//router coupon
Route::post('/check-coupon','CartController@check_coupon');
Route::get('/unset-coupon','CartController@unset_coupon');
