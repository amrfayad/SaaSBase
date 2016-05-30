<?php
$mysql_host = "localhost";
$mysql_database = "saasTest";
$mysql_user = "iti";
$mysql_password = "iti";
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
$query = file_get_contents("saasBaseV5.sql");
$stmt = $db->prepare($query);
if ($stmt->execute())
     echo "Success";
 else 
     echo "Fail";