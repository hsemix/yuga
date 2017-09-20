<?php
namespace Yuga\Route;
use Yuga\Router;
use Yuga\Application;
use Yuga\ServiceProvider\ServiceProvider;
class RouteServiceProvider extends ServiceProvider
{
    public function load(Application $app)
    {
        $app->singleton('router', Router::class);
        $app->resolve('router');
    }
}