<?php

/*


  desc users;
  +-----------------------+--------------+------+-----+---------+----------------+
  | Field                 | Type         | Null | Key | Default | Extra          |
  +-----------------------+--------------+------+-----+---------+----------------+
  | user_id               | int(11)      | NO   | PRI | NULL    | auto_increment |
  | user_name             | varchar(45)  | YES  |     | NULL    |                |
  | user_email            | varchar(45)  | YES  |     | NULL    |                |
  | password              | varchar(100) | YES  |     | NULL    |                |
  | reset_password_token  | varchar(100) | YES  |     | NULL    |                |
  | token_expiration_date | time         | YES  |     | NULL    |                |
  | user_profile_info     | longtext     | YES  |     | NULL    |                |
  +-----------------------+--------------+------+-----+---------+----------------+
  7 rows in set (0.01 sec)

 */
include_once 'Database.php';
include_once 'Team.php';

class User {

    function login($email, $passwd) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: ' . mysqli_connect_error());
            }
            $query = "select * from users where user_email = '$email' and password = '$passwd'";
            $result = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
            return -1;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return -1;
    }

    function signUp($name, $email, $pass) {

        try {

            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  userCreate');
            }

            $query = "insert into users(user_name,user_email,password) values ('" . $name . "','" . $email . "','" . $pass . "')";
            $result = mysqli_query($conection, $query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function getUserId($email, $password) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  return user id');
            }
            $query = "select user_id from users where user_email='$email' and password='$password'";
            $result = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                return $row['user_id'];
            }
            return -1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function CheckMail($email) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  return user id');
            }
            $query = "SELECT * FROM users where user_email='" . $email . "'";
            $result = mysqli_query($conection, $query);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows >= 1) {
                return 1;
            } else
                return -1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function getUserProfile($user_id)
    {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  return user id');
            }
            $query = "SELECT user_name , user_email ,user_profile_info  FROM users where user_id='" . $user_id . "'";
            $result = mysqli_query($conection, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
        }
           catch (Exception $ex) {
            echo $ex->getMessage();
        } 
    }
}
