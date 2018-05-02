<?php


Route::group([
    'namespace' => 'Softce\Banner\Http\Controllers',
    'prefix' => 'admin/',
    'middleware' => ['web']
    ],function(){

    Route::resource( '/slider', 'BannerController', [ 'as' => 'admin', 'only' => ['index', 'store', 'update', 'destroy'] ] );

});