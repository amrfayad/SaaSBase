<?php

class DataBaseConnection {

    private $dbConnection;
    private $num;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function getConnection() {
        return $this->dbConnection->getConnection();
    }

}

/* How to test
 <?php
	include_once 'dataBaseConnection.php';
	include_once 'mySqlDatabase.php';

include_once './database/dataBaseConnection.php';
include_once './database/mySqlDatabase.php';


	$db1 = new DataBaseConnection(mySqlDatabase::getInstance());
	$conection = $db1->getConnection();


	if (!$conection) {
                die('Error: ' . mysqli_connect_error());
            }
	$query = "select * from users";
	$result = mysqli_query($conection, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		var_dump ($row);
	}	
?>
 */