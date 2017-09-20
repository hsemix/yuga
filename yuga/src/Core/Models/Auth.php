<?php
namespace Yuga\Models;
use Yuga\Authenticate\Authenticate;
class Auth
{
    public static function __callStatic($method, $args) 
    {
      return call_user_func_array([new Authenticate, $method], $args);
    }
    public function __call($method, $args) 
    {
      return call_user_func_array([new Authenticate, $method], $args);
    }
}