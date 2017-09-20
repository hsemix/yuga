<?php
namespace Yuga\Views;
use Yuga\Http\Request;
use Yuga\Application;
use Yuga\ServiceProvider\ServiceProvider;
class ViewServiceProvider extends ServiceProvider
{
    public function load(Application $app)
    {
        $app->singleton('view', SmxView::class);
        $template = $app->resolve('view', [
            './resources/views/'
        ]);
        $template->resource = 'resources/assets/';
        $template->host = (new Request)->getHost();
        
		return $template;
    }
}