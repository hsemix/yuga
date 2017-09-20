<?php
namespace Yuga\Http;

class Redirect
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Set the http status code
     *
     * @param int $code
     * @return static
     */
    public function httpCode($code)
    {
        http_response_code($code);

        return $this;
    }

    /**
     * Redirect the response
     *
     * @param string $url
     * @param int $httpCode
     */
    public function to($url, $httpCode = null)
    {
        if ($httpCode !== null) {
            $this->httpCode($httpCode);
        }

        $this->header('location: ' . $url);
        die();
    }

    public function header($value)
    {
        header($value);

        return $this;
    }

    public function refresh()
    {
        $this->to($this->request->getUri());
    }

    public function back()
    {
        $this->header("HTTP/1.1 301 Moved Permanently");
        $this->to($this->request->getReferer());
        exit();
    }

    public function route($name = null, $parameters = null, $getParams = null)
    {
        $route = \Route::getUrl($name, $parameters, $getParams);
        
        $this->to($route);
    }
}