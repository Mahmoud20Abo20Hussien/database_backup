<?php
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
date_default_timezone_set('EST');

$DB = new DB;

$DB->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => '',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
    'prefix' => '',
]);

// Make this DB instance available globally via static methods
$DB->setAsGlobal();

// Setup the Eloquent ORM
$DB->bootEloquent();

//$users = DB::table('test')->get();
//
//var_dump($users);
//
//
//class Test extends Illuminate\Database\Eloquent\Model {
//    protected $table = 'test';
//}
//
//$users = Test::all();
//
//var_dump($users);