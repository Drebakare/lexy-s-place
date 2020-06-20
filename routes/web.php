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
        'as' => 'store_session',
        'uses' => 'User\HomepageController@displayForm'
    ]);
    Route::get('/homepage', [
        'as' => 'homepage',
        'uses' => 'User\HomepageController@Homepage'
    ])->middleware('checkStoreSession');
    Route::get('/success', function () {
        return view('actions.failure_page');
    })->name('success');
    Route::get('/login', function () {
        return view('actions.login');
    })->name('login');

    Route::get('/registration', function () {
        return view('actions.registration');
    })->name('registration');

    Route::get('/product/search', function () {
        return view('actions.search');
    })->name('search');


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
    ])->middleware('checkAuth');

    Route::get('/user/update-password/{token}', [
        'as' => 'user.update-password',
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
    Route::post('/set-store-session', [
        'as' => 'set-store-session',
        'uses' => 'User\HomepageController@setStoreSession'
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

    // users account
    Route::get('user/dashboard', [
        'as' => 'user.dashboard',
        'uses' => 'User\DashboardController@Dashboard'
    ])->middleware('checkAuth');

    Route::get('user/view-order/{token}', [
        'as' => 'user.view-order',
        'uses' => 'User\DashboardController@viewOrder'
    ])->middleware('checkAuth');

    Route::post('user/update-profile', [
        'as' => 'user.update-profile',
        'uses' => 'User\DashboardController@updateProfile'
    ])->middleware('checkAuth');

    Route::post('user/change-password', [
        'as' => 'user.change-password',
        'uses' => 'User\DashboardController@changePassword'
    ])->middleware('checkAuth');

    Route::post('user/credit-wallet', [
        'as' => 'user.credit-wallet',
        'uses' => 'Payment\PaymentController@creditWallet'
    ])->middleware('checkAuth');

    // Room Bookings
    Route::get('user/book-room', [
        'as' => 'user.book-room',
        'uses' => 'Booking\BookingController@bookRoom'
    ])->middleware('checkAuth');

    Route::post('user/final-bookings', [
        'as' => 'user.final-bookings',
        'uses' => 'Booking\BookingController@finalBookings'
    ])->middleware('checkAuth');

    // Upgrade User
    Route::get('user/upgrade-membership', [
        'as' => 'user.upgrade-membership',
        'uses' => 'User\MembershipController@upgradeMembership'
    ])->middleware('checkAuth');


    //
    Route::get('system/run-membership-subscription',[
        'as' => 'system.run-membership-subscription',
        'uses' => 'Subscription\MembershipController@chargeUsers',
    ]);



    //Admin Processes Start Here
    Route::get('admin/dashboard',[
        'as' => 'admin.dashboard',
        'uses' => 'Admin\DashboardController@Dashboard',
    ])->middleware('checkAdmin');

    Route::get('admin/manage-stores',[
        'as' => 'admin.update-stores',
        'uses' => 'Admin\StoreController@index',
    ])->middleware('checkAdmin');

    Route::post('admin/create-store',[
        'as' => 'submit-store-form',
        'uses' => 'Admin\StoreController@createStore',
    ])->middleware('checkAdmin');

    Route::post('admin/edit-store-details/{token}',[
        'as' => 'edit-store-details',
        'uses' => 'Admin\StoreController@editStore',
    ])->middleware('checkAdmin');

    Route::get('admin/view-users',[
        'as' => 'admin.view-users',
        'uses' => 'Admin\UserController@index',
    ])->middleware('checkAdmin');

    Route::post('admin/edit-membership-details/{token}',[
        'as' => 'edit-membership-details',
        'uses' => 'Admin\UserController@editMembershipDetails',
    ])->middleware('checkAdmin');

    Route::get('admin/view-user-details/{token}',[
        'as' => 'admin.view-user-details',
        'uses' => 'Admin\UserController@viewUser',
    ])->middleware('checkAdmin');

    Route::get('admin/suspend-user/{token}',[
        'as' => 'admin.suspend-user',
        'uses' => 'Admin\UserController@suspendUser',
    ])->middleware('checkAdmin');

    Route::get('admin/activate-user/{token}',[
        'as' => 'admin.activate-user',
        'uses' => 'Admin\UserController@activateUser',
    ])->middleware('checkAdmin');

    Route::get('admin/add-new-user',[
        'as' => 'admin.add-new-user',
        'uses' => 'Admin\UserController@addUser',
    ])->middleware('checkAdmin');

    Route::post('admin/submit-new-user-form',[
        'as' => 'admin.submit-new-user-form',
        'uses' => 'Admin\UserController@submitNewUserForm',
    ])->middleware('checkAdmin');

    // admin products functionalities

    Route::get('admin/add-product-brand',[
        'as' => 'admin.add-product-brand',
        'uses' => 'Admin\ProductController@addProductBrand',
    ])->middleware('checkAdmin');

    Route::post('admin/edit-brand-details/{token}',[
        'as' => 'edit-brand-details',
        'uses' => 'Admin\ProductController@editBrand',
    ])->middleware('checkAdmin');

    Route::post('admin/create-brand',[
        'as' => 'submit-brand-form',
        'uses' => 'Admin\ProductController@createBrand',
    ])->middleware('checkAdmin');

    Route::get('admin/add-product-category',[
        'as' => 'admin.add-product-category',
        'uses' => 'Admin\ProductController@addProductCategory',
    ])->middleware('checkAdmin');

    Route::post('admin/edit-category-details/{token}',[
        'as' => 'edit-category-details',
        'uses' => 'Admin\ProductController@editCategory',
    ])->middleware('checkAdmin');

    Route::post('admin/create-category',[
        'as' => 'submit-category-form',
        'uses' => 'Admin\ProductController@createCategory',
    ])->middleware('checkAdmin');

    Route::get('admin/add-drink-type',[
        'as' => 'admin.add-product-type',
        'uses' => 'Admin\ProductController@addProductType',
    ])->middleware('checkAdmin');

    Route::post('admin/create-drink-tyoe',[
        'as' => 'submit-drinktype-form',
        'uses' => 'Admin\ProductController@createDrinkType',
    ])->middleware('checkAdmin');

    Route::post('admin/edit-drinktype-details/{token}',[
        'as' => 'edit-drink-details',
        'uses' => 'Admin\ProductController@editDrinkType',
    ])->middleware('checkAdmin');

    Route::get('admin/add-product',[
        'as' => 'admin.add-new-product',
        'uses' => 'Admin\ProductController@addProduct',
    ])->middleware('checkAdmin');

    Route::post('admin/submit-product-form',[
        'as' => 'submit-product-form',
        'uses' => 'Admin\ProductController@submitProductForm',
    ])->middleware('checkAdmin');

    Route::post('admin/edit-product-details/{token}',[
        'as' => 'edit-product-details',
        'uses' => 'Admin\ProductController@editProductDetails',
    ])->middleware('checkAdmin');

    //Order Modules

    Route::get('admin/raise-order',[
        'as' => 'admin.raise-order',
        'uses' => 'Admin\OrderController@raiseOrder',
    ])->middleware('checkAdmin');

    Route::post('fetch-stock',[
        'as' => 'order.fetch-stock',
        'uses' => 'Admin\OrderController@fetchStock',
    ])->middleware('checkAdmin');

    Route::post('user/raise-order',[
        'as' => 'user.raise-order',
        'uses' => 'Admin\OrderController@userRaiseOrder',
    ])->middleware('checkAdmin');
