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
    Route::get('/', [
        'as' => 'homepage',
        'uses' => 'User\HomepageController@Homepage'
    ]);
Route::get('/success', function () {
    return view('actions.failure_page');
})->name('success');
Route::get('/login', function () {
    return view('actions.login');
})->name('login');

Route::get('/registration', function () {
    return view('actions.registration');
})->name('registration');

/*Route::get('/user/checkout', function () {
    return view('actions.c');
})->name('cart');*/

Route::get('/product/search', function () {
    return view('actions.search');
})->name('search');

Route::get('/user/dashboard', function () {
    return view('actions.dashboard');
})->name('account');

//User Authentication
    Route::post('/user/registration', [
        'as' => 'user.registration',
        'uses' => 'Auth\AuthenticationController@userRegistration'
    ]);
    Route::post('/user/login', [
        'as' => 'user.login',
        'uses' => 'Auth\AuthenticationController@userLogin'
    ]);
    Route::post('/user/forgot-password', [
        'as' => 'user.forgot-password',
        'uses' => 'Auth\AuthenticationController@forgotPassword'
    ]);
    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'Auth\AuthenticationController@Logout'
    ]);
    Route::get('/user/change-password/{token}', [
        'as' => 'user.change-password',
        'uses' => 'Auth\AuthenticationController@changePassword'
    ]);
    Route::post('/user/final-change-password', [
        'as' => 'user.final-change-password',
        'uses' => 'Auth\AuthenticationController@finalChangePassword'
    ]);

    //set session for age

    Route::post('/set-age-session', [
        'as' => 'set-age-session',
        'uses' => 'Auth\AuthenticationController@setAgeSession'
    ]);

    // social media login

    Route::get('login/{social}', [
        'as' => 'login.social',
        'uses' => 'Auth\AuthenticationController@redirectToProvider',
    ]);
    Route::get('login/{social}/callback', [
        'as' => 'login.social.callback',
        'uses' => 'Auth\AuthenticationController@handleProviderCallback',
    ]);

    //product processes

    Route::get('product/{name}/{token}', [
        'as' => 'customer.view-product',
        'uses' => 'Product\ProductController@viewProduct',
    ]);

    Route::post('product/add-to-cart', [
        'as' => 'product.add-to-cart',
        'uses' => 'Product\ProductController@addToCart',
    ]);

    Route::get('products/search', [
        'as' => 'product.search',
        'uses' => 'Product\ProductController@searchProducts',
    ]);

    Route::get('products/category/{category}', [
        'as' => 'product.category',
        'uses' => 'Product\ProductController@searchProductsByCategory',
    ]);

    Route::get('products/brand/{brand_name}', [
        'as' => 'product.brand',
        'uses' => 'Product\ProductController@searchProductsByBrand',
    ]);

    Route::get('products/type/{drink_type}', [
        'as' => 'product.type',
        'uses' => 'Product\ProductController@searchProductsByType',
    ]);

    Route::get('/products', [
    'as' => 'products.all',
    'uses' => 'Product\ProductController@viewProducts',
    ]);

    //newsletter
    Route::get('/newsletter', [
        'as' => 'newsletter',
        'uses' => 'Newsletter\NewsletterController@addNewsletter',
    ]);

    //cart system
    Route::get('/cart',[
        'as' => 'user.cart',
        'uses' => "Product\ProductController@viewCart"
    ]);

    Route::post('/product/update-cart',[
        'as' => 'product.update-cart',
        'uses' => "Product\ProductController@updateCart"
    ]);

    Route::post('/cart/remove-product',[
        'as' => 'cart.remove-product',
        'uses' => "Product\ProductController@removeProduct"
    ]);

    Route::get('/cart/checkout',[
        'as' => 'cart.checkout',
        'uses' => "Product\ProductController@cartCheckout"
    ])->middleware('checkAuth');

    //payment system
    Route::post('/user/make-payment',[
        'as' => 'user.make-payment',
        'uses' => "Payment\PaymentController@makePayment"
    ])->middleware('checkAuth');

    Route::get('/user/confirm-payment',[
        'as' => 'user.confirm-payment',
        'uses' => "Payment\PaymentController@confirmPayment"
    ])->middleware('checkAuth');
