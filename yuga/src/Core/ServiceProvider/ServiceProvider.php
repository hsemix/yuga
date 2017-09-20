<?php
namespace Yuga\ServiceProvider;
use Yuga\Application;
use Yuga\Support\IServiceProvider;
abstract class ServiceProvider implements IServiceProvider
{
    public function register(Application $app)
    {
        return $this->load($app);
    }
    abstract public function load(Application $app);
}