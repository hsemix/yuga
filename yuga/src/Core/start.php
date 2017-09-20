<?php
use josegonzalez\Dotenv\Loader;
use Yuga\Application as App;
$_ENV['base_path'] = $path;
$_ENV['yuga_path'] = __DIR__;
$loader = require $_ENV['base_path'] . '/vendor/autoload.php';
include_once $_ENV['base_path'] .'/yuga/src/Core/Support/Helpers.php';
include_once $_ENV['base_path'] .'/app/helpers/helpers.php';
$Load = new Loader(env('base_path').'/environment/.env');
// Parse the .env file
$Load->parse();
// Send the parsed .env file to the $_ENV variable
$Load->toEnv();

$loader->addPsr4(env('APP_NAMESPACE') . '\\', $_ENV['base_path'] . 'app/');


$app = App::instance();
$app->run();