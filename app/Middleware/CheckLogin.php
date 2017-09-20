<?php
namespace App\Middleware;
use Yuga\Http\Request;
use Yuga\Http\Redirect;
use Yuga\Session\Session;
use Yuga\Http\Middleware\IMiddleware;
class CheckLogin implements IMiddleware
{
    protected $session;
    protected $redirect;
    
    public function __construct(Session $session, Redirect $redirect)
    {
        $this->session = $session;
        $this->redirect = $redirect;
    }
    public function run(Request $request, \Closure $next)
    {
        if (!$this->session->isLoggedIn()) {
            return $this->redirect->route('user.login');
        }

        return $next($request);
    }
}