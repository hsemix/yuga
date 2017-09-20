<?php

function view($args, $data = null)
{
    return new \Yuga\Views\View($args, $data);
}


function session()
{
    return \Yuga\Session::instance();
}

function cookie()
{
    return \Yuga\Cookie::instance();
}



function csrf_token()
{
    $baseVerifier = Route::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getToken();
    }
    return null;
}


function class_base($class)
{
    $class = is_object($class) ? get_class($class) : $class;
    return basename(str_replace('\\', '/', $class));
}


if (! function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed   $target
     * @param  string|array  $key
     * @param  mixed   $default
     * @return mixed
     */
    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        while (($segment = array_shift($key)) !== null) {
            if ($segment === '*') {
                if ($target instanceof \Yuga\Collection) {
                    $target = $target->all();
                } elseif (! is_array($target)) {
                    return value($default);
                }

                $result = \Yuga\Arr::pluck($target, $key);

                return in_array('*', $key) ? \Yuga\Arr::collapse($result) : $result;
            }

            if (\Yuga\Arr::accessible($target) && \Yuga\Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if(!function_exists('resource')) {
    function resource($value ="")
    {
        return '/'.response()->getOrSetVars()->resource.$value;
    }
}

if(!function_exists('host')) {
    function host($value ="")
    {
        return scheme(response()->getOrSetVars()->host.$value);
    }
}

if(!function_exists('resource')) {
    function resource($value ="")
    {
        return '/'.response()->getOrSetVars()->resource.$value;
    }
}

if(!function_exists('env')) {
    function env($key, $default = null)
    {
        return isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }
}

if (!function_exists('app')) {
    function app()
    {
        return \Yuga\Application::instance();
    }
}
if(!function_exists('route')) {
    function route($name = null, $parameters = null, $getParams = null)
    {
        return Route::getUrl($name, $parameters, $getParams);
    }
}

/**
* @return \Yuga\Http\Response
*/
if(!function_exists('response')) {
    function response()
    {
        return Route::response();
    }
}

/**
* @return \Yuga\Http\Request
*/
if(!function_exists('request')) {
    function request()
    {
        return Route::request();
    }
}

/**
* Get input class
* @return \Yuga\Http\Input\Input
*/
if(!function_exists('input')) {
    function input()
    {
        return request()->getInput();
    }
}

if(!function_exists('redirect')) {
    function redirect($url, $code = null)
    {
        if ($code !== null) {
            response()->httpCode($code);
        }

        response()->redirect($url);
    }
}

if(!function_exists('full_host')) {
    function full_host($value ="")
    {
        return host($value);
    }
}

if(!function_exists('scheme')) {
    function scheme($value = null)
    {
        $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
        return $scheme .'://'.$value;
    }
}

if(!function_exists('assets')) {
    function assets($value = "")
    {
        return scheme($_SERVER['HTTP_HOST'].resource($value));
    }
}

if(!function_exists('slug')) {
    function slug()
    {
        $slug = '';
        $values = func_get_args();
        if (count($values) == 1) {
            $slug = str_replace(" ", "-", $values);
        } elseif (count($values) > 1) {
            $slug = implode("-", $values);
            $slug = str_replace(" ", "-", $slug);
        }
        return $slug;
    }
}

if(!function_exists('array_get')) {
    function array_get($array, $key, $default = null)
    {
        if (is_null($key)) return $array;
        foreach (explode('.', $key) as $segment)
        {
            if ( ! is_array($array) or ! array_key_exists($segment, $array))
            {
                return value($default);
            }

            $array = $array[$segment];
        }

        return $array;
    }
}

if (!function_exists('path')) {
    function path($file = null)
    {
        return $_ENV['base_path'].'/'.$file;
    }
}

if (!function_exists('storage')) {
    function storage($path = null) 
    {
        return path('storage/' . $path);
    }
}

if (!function_exists('debug')) {
    function debug($text)
    {
        if (app()->getDebugEnabled() === true) {
            app()->debug->add($text);
        }
    }
}