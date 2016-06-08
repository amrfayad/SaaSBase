<?php
include_once './config/config.php';
$mysql_host = $config['server'] ;
$mysql_user = $config['username'];
$mysql_password = $config['password'];

$db = new PDO("mysql:host=$mysql_host", $mysql_user, $mysql_password);
$query = file_get_contents("DataBaseScheam.sql");
$stmt = $db->prepare($query);
if ($stmt->execute()){
    echo "Data  Base succesfully Migrated";
}
     
 else {
     echo "Failed To migrate ";
 }
