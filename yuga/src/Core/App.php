<?php
namespace Yuga;

class App
{
  public static function __callStatic($method, $args)
  {
    return call_user_func_array([Application::instance(), $method], $args);
  }
  public function __call($method, $args) 
  {
    return call_user_func_array([Application::instance(), $method], $args);
  }
}