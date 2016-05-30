<?php
include_once './config/config.php';
$mysql_host = $config['server'];
$mysql_user = $config['username'];
$mysql_password = $config['password'];
$mysql_database =  $config['database'] ;
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
$query = file_get_contents("DataBaseScheam.sql");
$stmt = $db->prepare($query);
if ($stmt->execute()) {
    echo " Data Base Already Created ";
} else {
    echo "DataBase Canot Be Created";
}