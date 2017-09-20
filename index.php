<?php
require_once "vendor/autoload.php";
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) 
{
    return false;
}
else 
{
    include __DIR__ . './public/index.php';
}