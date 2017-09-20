<?php
namespace Yuga\Http\Middleware;
class Middleware
{
    /**
    * The apps route's middleware is to be registered here
    *
    * @var array
    */
    public $routerMiddleWare = [
        "auth"          => \DataFrame\Middleware\Authenticate::class,
        "userLoggedIn"  => \App\Middleware\CheckLogin::class,
        "appLogin"      => \Yuga\Middleware\Login::class,
        'activeUser'    => \App\Middleware\ActiveUser::class,
    ];
}