<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

//use Illuminate\Support\Facades\Auth;

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

//Route::get('/', function () {
//    return view('');
//});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::group([
        'namespace' => 'Backend',
        'middleware' => ['auth', 'auth_admin']
    ], function () {
        // Trang dashboard - trang chủ admin
        Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
        Route::get('/customers', 'DashboardController@customer')->name('backend.customer');
        Route::get('/test', 'DashboardController@test');
        Route::get('/incompetent', 'DashboardController@incompetent')->name('backend.incompetent');
        // Quản lý sản phẩm
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductController@index')->name('backend.product.index');
            Route::get('/get-data', 'ProductController@getData');
            Route::get('/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('backend.product.create');
            Route::any('/export', [\App\Http\Controllers\Backend\ProductController::class, 'export'])->name('backend.product.export');
            Route::post('/store', [\App\Http\Controllers\Backend\ProductController::class, 'store'])->name('backend.product.store');
            Route::get('/{id?}/edit', 'ProductController@edit')->name('backend.product.edit');
            Route::post('/{id?}/update', 'ProductController@update')->name('backend.product.update');
            Route::delete('/{id}/delete', 'ProductController@destroy')->name('backend.product.destroy');
            Route::delete('/{id}/force-delete', 'ProductController@hardDelete')->name('backend.product.force-delete');
            Route::get('/only-trashed', 'ProductController@onlyTrashed')->name('backend.product.only-trashed');
            Route::get('/{id}/restore', 'ProductController@restore')->name('backend.product.restore');
            Route::get('/show/{id?}', 'ProductController@show')->name('backend.product.show');
        });
        //Quản lý người dùng
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('backend.user.index');
            Route::get('/create', 'UserController@create')->name('backend.user.create');
            Route::get('/show/{id}', 'UserController@show')->name('backend.user.show');
            Route::get('/account/{id}', 'UserController@account')->name('backend.user.account');
            Route::get('/change-password/', 'UserController@change')->name('backend.user.password');
            Route::get('/reset-password/{id}', 'UserController@reset')->name('backend.user.reset');
            Route::post('/save-password/', 'UserController@saveNewPass')->name('backend.user.save');
            Route::post('/save-new-password/{id}', 'UserController@saveResetPass')->name('backend.user.savePass');
            Route::post('/{id}/update', 'UserController@update')->name('backend.user.update');
            Route::any('/{id}/delete', 'UserController@destroy')->name('backend.user.destroy');
            Route::post('/store', 'UserController@store')->name('backend.user.store');
        });
        //Quản lý thể loại
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@index')->name('backend.category.index');
            Route::get('/create', 'CategoryController@create')->name('backend.category.create');
            Route::post('/store', 'CategoryController@store')->name('backend.category.store');
            Route::get('/{id?}/edit', 'CategoryController@edit')->name('backend.category.edit');
            Route::post('/{id}/update', 'CategoryController@update')->name('backend.category.update');
            Route::delete('/{id}/delete', 'CategoryController@destroy')->name('backend.category.destroy');
            Route::get('/{id}/show', 'CategoryController@show')->name('backend.category.show');
        });
        //Quản lý tác giả
        Route::group(['prefix' => 'authors'], function () {
            Route::get('/', 'AuthorController@index')->name('backend.authors.index');
            Route::get('/create', 'AuthorController@create')->name('backend.authors.create');
            Route::post('/store', 'AuthorController@store')->name('backend.authors.store');
            Route::delete('/{author}/delete', 'AuthorController@destroy')->name('backend.authors.destroy');
            Route::get('/edit/{id}', 'AuthorController@edit')->name('backend.authors.edit');
            Route::post('/{id}/update', 'AuthorController@update')->name('backend.authors.update');
        });
        //NXB
        Route::group(['prefix' => 'publishings'], function () {
            Route::get('/', 'PublishingController@index')->name('backend.publishings.index');
            Route::get('/create', 'PublishingController@create')->name('backend.publishings.create');
            Route::post('/store', 'PublishingController@store')->name('backend.publishings.store');
            Route::delete('/{id}/delete', 'PublishingController@destroy')->name('backend.publishings.destroy');
            Route::get('/edit/{id}', 'PublishingController@edit')->name('backend.publishings.edit');
            Route::post('/{id}/update', 'PublishingController@update')->name('backend.publishings.update');
        });
        //Thống kê
        Route::group(['prefix' => 'statistics'], function () {
            Route::get('/30-days-ago', 'DashboardController@statistics30')->name('backend.statistics.month');
            Route::get('/7-days-ago', 'DashboardController@statistics7')->name('backend.statistics.week');
        });
    });
});

Route::group([
    'namespace' => 'Frontend',
], function () {
    //Trang chủ website
    Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('frontend.home.index');
    //Chi tiết sản phẩm
    Route::get('/product-page/{slug}', 'ProductController@show')->name('frontend.product-page.index');
    //Danh sach san pham
    Route::get('/products', 'ProductController@index')->name('frontend.product.index');
    Route::get('/hot', 'ProductController@hot')->name('frontend.product.hot');
    Route::get('/sale', 'ProductController@sale')->name('frontend.product.sale');
    Route::get('/new', 'ProductController@new')->name('frontend.product.new');
    Route::get('/author/{id}', 'ProductController@author')->name('frontend.product.author');
    Route::get('/category/{id}', 'ProductController@category')->name('frontend.product.category');
    Route::get('/publishing/{id}', 'ProductController@publishing')->name('frontend.product.publishing');
    Route::get('/search', 'ProductController@search')->name('frontend.product.search');
    //Giỏ hàng
    Route::get('/cart/list', 'CartController@index')->name('frontend.cart.index');
    Route::post('/cart/add', 'CartController@add')->name('frontend.cart.add');
    Route::delete('/cart/remove/{id}', 'CartController@remove')->name('frontend.cart.remove');
    Route::put('/cart/update/{id}', 'CartController@update')->name('frontend.cart.update');
    //Checkout
    Route::get('/checkout', 'CartController@checkout')->name('frontend.checkout')->middleware(['auth']);
});
//Order
Route::group([
    'namespace' => 'Backend',
    'prefix' => 'orders'
], function () {
    Route::get('/', 'OrderController@index')->name('order.index')->middleware('auth_admin');
    Route::get('/non-accept', 'OrderController@nonAcceptList')->name('order.nonAccept')->middleware('auth_admin');
    Route::get('/success', 'OrderController@successList')->name('order.successList')->middleware('auth_admin');
    Route::get('/get-data', 'OrderController@getData');
    Route::get('/get-success', 'OrderController@getSuccess');
    Route::get('/get-non-accept', 'OrderController@nonAccept');
    Route::post('/store', 'OrderController@store')->name('order.store');
    Route::any('/accept/{id}', 'OrderController@accept')->name('order.accept')->middleware('auth_admin');
    Route::delete('/delete/{id}', 'OrderController@destroy')->name('order.destroy')->middleware('auth_admin');
    Route::any('/success/{id}', 'OrderController@success')->name('order.success')->middleware('auth_admin');
    Route::get('/{id}/show', 'OrderController@show')->name('order.show')->middleware('auth_admin');
});

//Auth::routes();
Route::post('/register', 'Auth\RegisterCotroller@showRegistrationForm')->name('register.form');
Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'namespace' => 'Auth'
], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'LoginController@login')->name('login.store');
    Route::get('/get-google-sign-in-url', 'LoginController@getUrl')->name('login.google');
    Route::get('/callback', 'LoginController@loginCallback')->name('login.callback');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register.form');
    Route::post('/register', 'RegisterController@register')->name('register.store');
});

