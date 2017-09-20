<?php
namespace Yuga\Support;
use Yuga\Application;
interface IServiceProvider
{
    public function register(Application $app);
}