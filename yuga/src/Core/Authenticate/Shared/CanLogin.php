<?php
namespace Yuga\Authenticate\Shared;

use Yuga\Validate\Message;
use Yuga\Database\Elegant\Model;
use Yuga\Authenticate\Exceptions\FieldNameMisMatch;
trait CanLogin
{
    protected function checkLoginFields($envLoginUsername, $envLoginPassword)
    {
        $fieldsArray = array_keys($this->model->request->getInput()->all());

        if (!in_array($envLoginUsername, $fieldsArray)) {
            throw new FieldNameMisMatch("The Field Name {$envLoginUsername} in the .env doesn't match the one from the form");
        }

        if (!in_array($envLoginPassword, $fieldsArray)) {
            throw new FieldNameMisMatch("The Field Name {$envLoginPassword} in the .env doesn't match the one from the form");
        }

        return true;
    }

    protected function checkValidators($loginFormUsernameField, $loginFormPasswordField, $usernameValue, $passwordValue)
    {
        // model fields
        $fields                 = explode(',', env('AUTH_MODEL_USERNAME_FIELDS', 'username'));
        $modelPasswordField     = env('AUTH_MODEL_PASSWORD_FIELD', 'password');

        return $this->checkUserName($this->model, $fields, $usernameValue, $loginFormUsernameField, $passwordValue, $loginFormPasswordField, $modelPasswordField);
    }

    protected function checkUserName(Model $model, array $fields, $username, $loginFormUsernameField, $passwordValue, $loginFormPasswordField, $modelPasswordField)
    {
        $firstField = array_shift($fields);
        $login = $model->where($firstField, $username);
        if (count($fields) > 0) {
            foreach ($fields as $field) {
                $login->orWhere($field, $username);
            }
        }
        if (!$this->userNotFound($model, $firstField, $fields, $loginFormUsernameField) instanceof Message) {
            if ($fetched = $login->first()) { 
                if (!$this->verifyPassword($fetched, $passwordValue, $modelPasswordField, $loginFormPasswordField) instanceof Message) {
                    $fetched->session->login($fetched);
                    if ($fetched->request->isAjax()) 
                        return $fetched->validate->errors();
                    return true;
                }  else {
                    return $this->verifyPassword($fetched, $passwordValue, $modelPasswordField, $loginFormPasswordField);
                }
            }
        } else {
            return $this->userNotFound($model, $firstField, $fields, $loginFormUsernameField);
        }
    }

    protected function verifyPassword($user, $password, $passwordField, $loginFormPasswordField)
    {
        $user->hash->setAlgorithm($this->getAuthMethod());
        $crypt_password = $user->hash->password($password, $this->getSalt($user));
        
        $userPassword = $user->$passwordField;
        $user->validate->addRuleMessage('found', 'Password or and Username mismatch!');
        $user->validate->addRule('found', function ($field, $value, $args) use ($crypt_password) {
            return $crypt_password === $args;
        });
        $validation = $user->validate->validator([
            $loginFormPasswordField => [
                'found' => $userPassword,
            ]
        ]);
        
        if ($user->request->isAjax()) 
            return (!$validation->hasErrors()) ? true : $validation;
        return ($validation->passed()) ? true : false;
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
        if ($user->request->isAjax()) 
            return (!$validation->hasErrors()) ? true : $validation;
        return ($validation->passed()) ? true : false;
    }

    protected function getSalt(Model $model)
    {

        $modelUserSalt = env('AUTH_MODEL_TOKEN_FIELD');
        $appSecret = env('APP_SECRET', 'NoApplicationSecret');
        if (is_null($modelUserSalt)) {
            $modelUserSalt = $appSecret;
        } else {
            $modelUserSalt = $model->$modelUserSalt?:$appSecret;
        }

        return $modelUserSalt;
    }

    protected function getAuthMethod()
    {
        return env('AUTH_MODEL_CRYPT_TYPE', 'crypt');
    }
}