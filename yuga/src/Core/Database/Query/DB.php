<?php
namespace Yuga\Database\Query;
class DB
{
    public static function __callStatic($method, $args) 
    {
		$instance = new Builder;
		return call_user_func_array([$instance, $method], $args);
    }
    
    public function __call($method, $args) 
    {
		$instance = new Builder;
		return call_user_func_array([$instance, $method], $args);
	}
}