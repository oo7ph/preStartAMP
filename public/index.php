<?php
// turn debugging on
ini_set("display_errors",1);
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('MST');

// auto-include
set_include_path(get_include_path() . PATH_SEPARATOR . "../secure/libs");
set_include_path(get_include_path() . PATH_SEPARATOR . "../secure/models");
set_include_path(get_include_path() . PATH_SEPARATOR . "../secure/controllers");

require_once 'Slim/Slim.php';
require_once 'idiorm.php';

\Slim\Slim::registerAutoloader();

/**
 * Set Default Route Parameters
 */
\Slim\Route::setDefaultConditions(array(
	'id' => '[0-9]*',
	'parentId' => '[0-9]{1,}'
));

// Setup DB CHANGE BELLOW CREDS
ORM::configure('mysql:host=localhost;dbname=test');
ORM::configure('username', 'root');
ORM::configure('password', 'root');


$app = new \Slim\Slim(array(
	'templates.path' => '../secure/Views',
	'cookies.secret_key' => 'F4EubS4lqq9KaV0NxcXt'
));

// AutoLoad Controller Routes
foreach (glob("../secure/controllers/*.php") as $filename)
{
    require_once $filename;
} 

$app->run();