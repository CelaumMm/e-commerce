<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});

Route::group(['middleware' => ['auth']], function(){

    Route::get('my-orders', 'UserOrderController@index')->name('user.orders');

    Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
        // Route::prefix('stores')->name('stores.')->group(function(){
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store', 'StoreController@store')->name('store');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::post('/update/{store}', 'StoreController@update')->name('update');
        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        // });
            
        Route::resource('stores' ,'StoreController');
        Route::resource('products' ,'ProductController');
        Route::resource('categories' ,'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
        
        Route::get('orders/my', 'OrderController@index')->name('orders.my');

        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');
    });

});

Auth::routes();
