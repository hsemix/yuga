<?php
namespace Yuga;
use Yuga\Route\Route;
use Yuga\Http\Middleware\BaseCsrfVerifier as Token;
class Router extends Route
{
    public function __construct()
    {
        $this->init();
        parent::start();
    }
    
    public static function init()
    {
        // Load routes.php
        parent::csrfVerifier(new Token());
        require_once env('base_path') . 'yuga' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Core'  . DIRECTORY_SEPARATOR .  'framework.php';
        require_once env('base_path') . 'routes' . DIRECTORY_SEPARATOR . 'web.php';
    }
}