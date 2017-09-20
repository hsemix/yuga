<?php
namespace Yuga\Validate;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
class ErrorHandler
{
    protected $errors = [];
    public function addError($error, $key = null)
    {
        if ($key) {
            $this->errors[$key][] = $error;
        } else {
            $this->errors[] = $error;
        }
    }

    public function all($key = null) 
    {
        if ($key) {
            return $this->errors[$key];
        }
        //return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
        return $this->flattenArray($this->errors);
    }

    protected function flattenArray(array $args)
    {
        return iterator_to_array(new RecursiveIteratorIterator(
            new RecursiveArrayIterator($args)
        ), false);
    }
    public function hasErrors()
    {
        return count($this->all()) ?:false;
    }

    public function first($key) 
    {
        return ($this->all($key)[0]) ? $this->all($key)[0] : '';
    }

    public function has($key)
    {
        isset($this->errors[$key])?:false;
    }
}