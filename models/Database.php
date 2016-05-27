<?php
class Database
{
 static function connect()
  {
    global $config;
    return mysqli_connect(
                $config['server'],
                $config['username'],
                $config['password'],
                $config['database']);
            }
}