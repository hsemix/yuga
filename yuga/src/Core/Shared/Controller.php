<?php
namespace Yuga\Shared;
use Yuga\App;
use Yuga\Hash\Hash;
use Yuga\Http\Request;
use Yuga\Http\Response;
use Yuga\Cookie\Cookie;
use Yuga\Session\Session;
use Yuga\Validate\Validate;
trait Controller
{
    public $app;
    public $hash;
    public $cookie;
    public $request;
    public $session;
    public $validate;
    public $response; 
    public $login_id;
    

    public function getApp()
    {
        return $this->app = App::instance();
    }
    public function getHash()
    {
        return $this->hash = App::resolve(Hash::class);
    }

    public function getCookie()
    {
        return $this->cookie = App::resolve(Cookie::class);
    }

    
    public function getRequest()
    {
        return $this->request = App::resolve(Request::class);
    }

    public function getSession()
    {
        return $this->session = App::resolve(Session::class);
    }
    public function getResponse()
    {
        return $this->response = App::resolve(Response::class);; 
    }

    public function getValidator()
    {
        return $this->validate = App::resolve(Validate::class);
    }

    public function getLoggedInUserId()
    {
        $this->login_id = $this->getSession()->getUserId();
    }
    public function middleWare($ware)
    {
		$middleWare = new MiddleWare();
		$routeMiddleWare = App::resolve($middleWare->routerMiddleWare[$ware]);
        $request = request();
        $results = $routeMiddleWare->run($request, function() use($request){
            if (!$request) {
                return false;
            }
            return $request;
        });
	}
}