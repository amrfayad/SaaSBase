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
class User {
     function login($email,$passwd) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: ' . mysqli_connect_error());
            }
            $query = "select * from users where user_email = '$email' and password = '$passwd'";
            $result = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($result))
            {
                return $row;
            }
            return -1;
        }
		catch (Exception $e) {
            echo $e->getMessage();
        }
        return -1;
    }

    //check on user email and password + get user id

    function getUserId($email,$password)
    {
        try{
                $connection = Database::connect();
                if(!$connection){
                    die('Error In DbConnection:' .mysqli_connect_error());
                }

                $query = "select user_id from users where user_email='$email' and password='$password'";
                $result = mysqli_query($connection,$query);
                while($user = mysqli_fetch_assoc($result))
                {
                    return $user['user_id'];
                }
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
        return -1 ;

    }
}