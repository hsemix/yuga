<?php
Route::group(['prefix' => 'auth'], function(){

    Route::get("/signin", 'Yuga\Controllers\AuthController@getSignin');
    Route::post("/signin", 'Yuga\Controllers\AuthController@postSignin');
    Route::get("/signup", 'Yuga\Controllers\AuthController@getSignup');
    Route::post("/signup", 'Yuga\Controllers\AuthController@postSignup');
    Route::get("/signout", 'Yuga\Controllers\AuthController@getSignout');
    
});

Route::group(['prefix' => 'css'], function(){
    Route::get('wrap', function(){
        return request()->get('files');
    });
});