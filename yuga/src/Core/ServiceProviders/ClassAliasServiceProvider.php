<?php
namespace Yuga\ServiceProviders;
use Yuga\Application;
use Yuga\ServiceProvider\ServiceProvider;
class ClassAliasServiceProvider extends ServiceProvider
{
    public function load(Application $app)
    {
        $config = $app->config->load('providers.classAlias');

        foreach ($config->getAll() as $alias => $class) {
            class_alias($class, $alias);
        }
    }
}