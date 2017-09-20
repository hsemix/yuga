<?php
namespace App\Controllers;

use App\Widgets\Welcome;
class IndexController extends BaseController
{
    public function index()
    {
        echo new Welcome('Yuga Framework');
    }

    public function postLogin()
    {
        $auth = \Auth::login($this->request->get('login_username'), $this->request->get('login_password'));
        
        if ($this->request->isAjax()) {
            if ($auth->hasErrors()) 
                return $this->response->json(['responseText' => implode('<br />', $auth->getFirst()), 'status' => 100]);
            return $this->response->json(['redirectUrl' => route('user.home'), 'status' => 200]);
        }
        return $this->response->redirect->route('user.home');
        
    }

    public function getLogout()
    {
        \Auth::logout();
        $this->response->redirect->route('user.login');
    }
}