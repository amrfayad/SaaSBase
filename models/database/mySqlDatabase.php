<?php
include_once './dataBaseStrategy.php';
class MySqlDatabase implements DataBaseStrategy
{
	private $_connection;
    private static $_instance;
    private $_host = "localhost";
    private $_username = "iti";
    private $_password = "iti";
    private $_database = "saasBase";
	
	private function __construct() {
            $this->_connection =
				mysqli_connect(            
								$this->_host,
								$this->_username, 
								$this->_password,
								$this->_database
							);
			// Error handling
			if(mysqli_connect_error()) {
				trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
					 E_USER_ERROR);
			}
        }
	
	
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	private function __clone() { }
	
	public function getConnection() {
		return $this->_connection;
	}
}