<?php
namespace Yuga\Views;
use App;
class View extends SmxView
{
	private static $instances = [];
	private $ext = 'php';
	private $data = [];
	public function __construct($view, $extras = null, $ext = null)
	{
		$starter = App::make('view');
		if ($ext) {
			$this->ext = $ext;
		}
		$view = str_replace(".", "/", $view);
		$file = $view;

		if ($extras) {
			$this->data = $extras;
		}
		
		foreach ($this->data as $var => $value) {
			$starter->$var = $value;
			
		}
		//$starter->csrfToken = generateToken();
		
		return $starter->display($file);
	}

	final public static function instance()
	{
		$class_name = get_called_class();

		if (!isset(self::$instances[$class_name]))
			self::$instances[$class_name] = new $class_name;

		return self::$instances[$class_name];
	}
}
