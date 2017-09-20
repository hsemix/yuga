<?php
namespace Yuga\Http\Middleware;

use Closure;
use Yuga\Http\Request;

interface IMiddleware
{
    /**
     * @param Request $request
     * @return Request|null
     */
    public function run(Request $request, Closure $next);

}