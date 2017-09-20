<?php
namespace Yuga\Database;
use Yuga\Application;
use Yuga\Database\Connection\Connection;
use Yuga\ServiceProvider\ServiceProvider;
use Yuga\Database\ElegantManager\Manager;
class ElegantServiceProvider extends ServiceProvider
{
    public function load(Application $app)
    {
        $config = $app->config->load('providers.Config');
        $connection = $app->singleton('connection', Connection::class);
        $app->resolve('connection', [
            $config->get('db.'.$config->get('db.defaultDriver'))
        ]);
        
        $manager = new Manager;
        $manager->addConnection($app->getBinding('connection'));
        $manager->startElegant();
    }
}