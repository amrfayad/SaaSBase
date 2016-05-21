<?php
	class DataBaseConnection{
        private $dbConnection;
        private static $_instance;
        public static function getInstance($dbConnection) {
			if(!self::$_instance) 
			{
				self::$_instance = new self($dbConnection);
			}
			return self::$_instance;
		}
        private function __construct($dbConnection) {
            $this->dbConnection = $dbConnection;
        }
        public function getConnection()
		{
			return $this->dbConnection->connect();
		}
    }
