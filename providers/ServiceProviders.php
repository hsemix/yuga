<?php
/**
*   You can add as many providers as you want, by appending or prepending to the array
*/
return [
    \Yuga\Session\SessionServiceProvider::class,
    //\Yuga\Database\ElegantServiceProvider::class,
    \Yuga\ServiceProviders\ClassAliasServiceProvider::class,
    \Yuga\Views\ViewServiceProvider::class,
];