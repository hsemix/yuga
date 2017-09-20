<?php
namespace Yuga\Session;
use Yuga\Application;
use Yuga\ServiceProvider\ServiceProvider;
class SessionServiceProvider extends ServiceProvider
{
    public function load(Application $app)
    {
        $app->singleton('session', Session::class);
        $app->resolve('session');
    }
}