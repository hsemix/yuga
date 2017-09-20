<?php
namespace Yuga\Authenticate;

use App;
use Yuga\Validate\Message;
use Yuga\Authenticate\Shared\CanLogin;
use Yuga\Authenticate\Shared\CanBeRemembered;
use Yuga\Authenticate\Shared\CanResetPassword;
class Authenticate
{
    use CanLogin, CanBeRemembered, CanResetPassword;
    protected $model;
    protected $app;
    public function __construct()
    {
        $model = env('AUTH_MODEL');
        $this->model = new $model;
        $this->app = new App;
    }

    public function user()
    {
        $model = $this->model;
        $session = $this->app->make('session');
        return ($session->isLoggedIn()) ? $model->find($session->user_id) : $model;
    }

    public function login($username, $password)
    {        
        // form fields
        $loginFormUsernameField = env('AUTH_FORM_USERNAME_FIELD', 'username');
        $loginFormPasswordField = env('AUTH_FORM_PASSWORD_FIELD', 'password');

        
        if ($this->checkLoginFields($loginFormUsernameField, $loginFormPasswordField)) {
            $validation = $this->model->validate->validator([
                $loginFormUsernameField => 'required',
                $loginFormPasswordField => 'required',
            ]);

            return $this->checkValidators($loginFormUsernameField, $loginFormPasswordField, $username, $password); 
        }
    }

    public function logout()
    {
        return $this->app->make('session')->logout();
    }

    public function guest()
    {
        return !$this->app->make('session')->isLoggedIn();
    }
}