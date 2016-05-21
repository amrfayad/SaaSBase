<?php
include_once './dataBaseStrategy.php';
class MySqlDatabase implements DataBaseStrategy
{
    
    private $_host = "localhost";
    private $_username = "iti";
    private $_password = "iti";
    private $_database = "saasBase";

  public function connect()
  {
    return mysqli_connect(            
                        $this->_host,
                        $this->_username, 
			$this->_password,
                        $this->_database);
  }
}