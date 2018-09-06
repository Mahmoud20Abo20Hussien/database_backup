<?php
require __DIR__ . "/db_setup.php";

use Illuminate\Database\Capsule\Manager as DB;

// select active DB and connection info
$databaseName = DB::connection()->getDatabaseName();
$password = "";
$host = 'localhost';
$user_name = 'root';
// get tables names
$fileOutPutPath = __DIR__ . "/" . $databaseName . ".sql";
$cmd = "mysqldump --user={$user_name} --password='{$password}' --host={$host} {$databaseName} > {$fileOutPutPath}";
echo $cmd . "\n";
exec($cmd);

$c = "zip -r {$fileOutPutPath}.zip {$fileOutPutPath}";
exec($c);
$c = "rm {$fileOutPutPath}";
exec($c);

//DB::disconnect($databaseName);