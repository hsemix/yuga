<?php
namespace Yuga\Events;

use SPLSubject;
use Closure;
use SPLObserver;
use SplPriorityQueue;
use Yuga\EventHandlers\HandlerInterface;
class Event implements SPLObserver
{
    private $name;
    private $params;
    private $events;
    protected $handlers = [];
    private static $instances = [];
    public function __construct()
    {
        $this->events = new SPLPriorityQueue;
    }
    final public static function instance()
    {
		$class_name = get_called_class();
        
		if (!isset(self::$instances[$class_name]))
			self::$instances[$class_name] = new $class_name;

		return self::$instances[$class_name];
	}

    public function attach()
    {
        $args = func_get_args();
        if(count($args) == 1){
            $handlers = $args[0];
            
            if(is_array($handlers))
            {
                foreach($handlers as $handler)
                {
                    if(!$handler instanceof HandlerInterface)
                    {
                        continue;
                    }
                    $this->handlers[] = $handler;
                }

                return;
            }

            if(!$handlers instanceof HandlerInterface)
            {
                return;
            }

            $this->handlers[] = $handlers;
        }
        else
        {
            if(count($args) == 2)
            {
                $name = $args[0];
                $callback = $args[1];
                $priority = 0;
            }
            elseif(count($args) == 3)
            {
                $name = $args[0];
                $callback = $args[1];
                $priority = 2;
            }
            $this->setName($name);
            $this->events->insert([$name, $callback], $priority);
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function dispatch($args = null)
    {
        $args = func_get_args();
        
        if(count($args) == 0)
        {
            foreach($this->handlers as $handler)
            {
                $handler->handle($this);
            }
        }
        else
        {
            if(count($args) == 1)
            {
                $name = $args[0];
                $params = [];
                $callback = null;
            }
            elseif(count($args) == 2)
            {
                $name = $args[0];
                $params = $args[1];
                $callback = null;
            }
            elseif(count($args) == 3)
            {
                $name = $args[0];
                $params = $args[1];
                $callback = $args[2];
            }
            $arguments = array_merge([$this], $params);
            
            foreach($this->events as $event) 
            {
                if($event[0] == $name) 
                {
                    call_user_func_array($event[1], $arguments);
                    if($callback instanceof Closure)
                        $callback($this);
                    
                }
            }
        }
        return $this;
    }

    public function update(SPLSubject $subject)
    {

    }
}