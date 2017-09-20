<?php
Route::get("/", "App\Controllers\IndexController@index")->name('user.login');
Route::post("/login", 'App\Controllers\IndexController@postLogin');
Route::post("/register", 'App\Controllers\IndexController@postRegister');

Route::group(['middleware' => 'userLoggedIn'], function(){
    Route::get("/register/{step}", 'App\Controllers\UserController@getRegister')->name('user.register.step');
    Route::post("/register/{step}", 'App\Controllers\UserController@postRegister');
    Route::group(['middleware' => 'activeUser'], function(){
        Route::get("/home", 'App\Controllers\HomeController@getIndex')->name('user.home');
    });
    Route::get("/logout", 'App\Controllers\IndexController@getLogout');
});