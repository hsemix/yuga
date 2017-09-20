<?php
namespace App\Middleware;

use Yuga\Http\Request;
use Yuga\Http\Redirect;
use Byakuno\Models\User;
use Yuga\Session\Session;
use Yuga\Http\Middleware\IMiddleware;
class ActiveUser implements IMiddleware
{
    protected $session;
    protected $redirect;
    protected $user;

    
    public function __construct(Session $session, Redirect $redirect, User $user)
    {
        $this->user = $user;
        $this->session = $session;
        $this->redirect = $redirect;
    }
    public function run(Request $request, \Closure $next)
    {
        if (!$this->session->isLoggedIn()) {
            return $this->redirect->route('user.login');
        }

        if (\Auth::user()->status != 'A') {
            return $this->redirect->route('user.register.step', ['step' => \Auth::user()->status]);
        }

        return $next($request);
    }
}