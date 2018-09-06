<?php
require __DIR__ . "/dbs_setup.php";

use Illuminate\Database\Capsule\Manager as DB;

// select active DB and connection info
$password = "";
$host = 'localhost';
$user_name = 'root';

// get tables names
$databases = DB::select('show databases;');
$backupFolder = __DIR__ ."/". "backup";
if (!file_exists($backupFolder) && !is_dir($backupFolder)) {
    mkdir($backupFolder);
}
foreach ($databases as $k => $db) {
    $dbName = $db->Database;
    $dbDir = $backupFolder . "/" . $dbName;
    if (!file_exists($dbDir) && !is_dir($dbDir)) {
        mkdir($dbDir);
    }
    $dbNameDate = $dbName . "_" . date("Y-m-d");
    echo ($k + 1) . ")- " . $dbName . "\n";
    // dump each db alone.
    $fileOutPutPath = $backupFolder . "/" . $dbName . "/" . $dbNameDate . ".sql";
    $cmd = "mysqldump --user={$user_name} --password='{$password}' --host={$host} {$dbName} > {$fileOutPutPath}";
    echo $cmd . "\n";
    exec($cmd);
    $c = "zip {$fileOutPutPath}.zip {$fileOutPutPath}";
    exec($c);
    $c = "rm {$fileOutPutPath}";
    exec($c);
}

//DB::disconnect($databaseName);