<?php
namespace Yuga\Authenticate;
use App;
use Exception;
class AuthenticateOld
{
    protected $user;
    protected $app;
    public function __construct()
    {
        $model = env('AUTH_MODEL');
        $this->user = new $model;
        $this->app = new App;
    }
    public function user()
    {
        $model = env('AUTH_MODEL');
        $session = $this->app->make('session');
        return ($session->isLoggedIn()) ? $model::find($session->user_id) : new $model;
    }

    public function login($username, $password)
    {
        $model = env('AUTH_MODEL');

        // model fields
        $fields = explode(',',env('AUTH_MODEL_USERNAME_FIELDS', 'username'));
        $userCode = env('AUTH_MODEL_TOKEN_FIELD', 'user_code');
        $passwordField = env('AUTH_MODEL_PASSWORD_FIELD', 'password');
        
        // form fields
        $loginFormUsernameField = env('AUTH_FORM_USERNAME_FIELD', 'username');
        $loginFormPasswordField = env('AUTH_FORM_PASSWORD_FIELD', 'password');
        
        $user = $this->user;
        $code = $user->hash->code(); // if not found use this
        
        $firstField = array_shift($fields);
        $login = $user->where($firstField, $username);
        
        if (count($fields) > 0) {
            foreach ($fields as $field) {
                $login->orWhere($field, $username);
            }
        }
        
        if ($fetched = $login->first()) { 
            
            $validation = $this->verifyPassword($fetched, $userCode, $password, $passwordField, $loginFormPasswordField);
            if (!$validation->hasMessages()) {
                $user->session->login($fetched);
                return $this->user();
            } else {
                
                return $validation->getFirst();
                // throw new Exception("The field {$loginFormPasswordField} is not defined in your form, fix this by 
                // defining AUTH_FORM_PASSWORD_FIELD in the [.env] file to your form field or rename your field to {$loginFormPasswordField} in your form");
            }
            
        } else {
            $validation = $this->userNotFound($user, $firstField, $fields, $loginFormUsernameField);
            if (!$validation->hasMessages()) {
                return true;
            } else {
                return $validation->errors();
                throw new Exception("The field {$loginFormUsernameField} is not defined in your form, fix this by 
                defining AUTH_FORM_USERNAME_FIELD in the [.env] file to your form field or rename your field to {$loginFormUsernameField} in your form");
            }
        }
        
        //return $this->user();

    }

    protected function verifyPassword($user, $userCode, $password, $passwordField, $loginFormPasswordField)
    {
        $cypt_password = $user->hash->password($password, '');
        
        if (!is_null($userCode)) {
            $code = $user->$userCode;
            
            if (!is_null($code) && $code != '') 
                $cypt_password = $user->hash->password($password, $code);
        }
        $userPassword = $user->$passwordField;
        $user->validate->addRuleMessage('found', 'Password or and Username mismatch');
        $user->validate->addRule('found', function($field, $value, $args) use($cypt_password) {
            return $cypt_password === $args;
        });
        $validation = $user->validate->validator([
            $loginFormPasswordField => [
                'found' => $userPassword,
            ]
        ]);
        
        //return ($validation->passed()) ? true : $validation->errors();
        return $validation;
    }

    protected function userNotFound($user, $firstField, $fields, $loginFormUsernameField)
    {
        $user->validate->addRuleMessage('userfound', 'Username Does not exist');
        $user->validate->addRule('userfound', function($field, $value, $args) use ($user, $firstField, $fields) {
            $loginUser = $user->where($firstField, $value);

            if (count($fields) > 0) {
                foreach ($fields as $field) {
                    $loginUser->orWhere($field, $value);
                }
            }
            return ($loginUser->first())? : false;
        });
        $validation = $user->validate->validator([
            $loginFormUsernameField => [
                'userfound' => true,
            ]
        ]);
        
        //return ($validation->passed()) ? true : $validation->errors();
        return $validation;
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