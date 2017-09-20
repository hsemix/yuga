<?php
namespace Yuga;
class Site
{
    private static $instances = [];
    private $debugMode;
    final public static function instance()
    {
		$class_name = get_called_class();

		if (!isset(self::$instances[$class_name]))
			self::$instances[$class_name] = new $class_name;

		return self::$instances[$class_name];
    }
    
    public function set($key, $value)
    {
        $_ENV[$key] = $value;
    }

    public function setDebugMode($mode = false)
    {
        $this->debugMode = $mode;
    }
}