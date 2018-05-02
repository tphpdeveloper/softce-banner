<?php


Route::group([
    'namespace' => 'Softce\Banner\Http\Controllers',
    'prefix' => 'admin/',
    'middleware' => ['web']
    ],function(){

    Route::resource( '/banner', 'BannerController', [ 'as' => 'admin', 'only' => ['index', 'store', 'update', 'destroy'] ] );

});