<?php
require __DIR__ . "/db_setup.php";

use Illuminate\Database\Capsule\Manager as DB;

// select active DB and connection info
$databaseName = DB::connection()->getDatabaseName();
$password = "J<#-J9q*";
$host = 'localhost';
$user_name = 'root';
// create folder with now date
$databaseSelector = 'Tables_in_' . $databaseName;
$folderName = $databaseName . '_' . 'toTables' .'_' . date("Y-m-d");
exec("mkdir {$folderName}");
// get tables names
$databaseTables = DB::select('SHOW TABLES');
foreach ($databaseTables as $k => $table) {
    $tableName = $table->$databaseSelector;
    echo ($k + 1) . ")- " . $tableName . "\n";
    //dump each table alone.
    $fileOutPutPath = __DIR__ . "/" . $folderName . "/" . $tableName . ".sql";
    $cmd = "mysqldump --user={$user_name} --password='{$password}' --host={$host} {$databaseName} {$tableName}> {$fileOutPutPath}";
    echo $cmd;
    exec($cmd);
}
$c = "zip -r {$folderName}.zip {$folderName}";
exec($c);
$c = "rm -r {$folderName}";
exec($c);

//DB::disconnect($databaseName);