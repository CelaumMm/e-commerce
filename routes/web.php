<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){

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

        Route::post('/photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
    });

});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
