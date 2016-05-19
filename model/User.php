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

    function check_mail($email){
        try{
            $connection= Database::connect();
            if(!connection){die('Error:'.mysqli_connect_error());}
            $query="select user_id from users where user_email='$email'";
            $name=mysqli_fetch_assoc(mysqli_query($connection,$query));
            if($name){
                return 1;
            }
            else{
                return 0;
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function admin_id($admin_email){
        try{
            $connection=Database::connect();
            if(!connection){die('Error:'.mysqli_connect_error());}

            $query="select user_id from users where user_email='$admin_email'";
            $admin_id=mysqli_fetch_assoc(mysqli_query($connection,$query));
            if($admin_id){
                return $admin_id['user_id'];
            }
            else{
                return 0;
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function team_id($admin_id){
        try{
            $connection=Database::connect();
            if(!connection){die('Error:'.mysqli_connect_error());}

            $query="select team_id from teams where users_user_id='$admin_id'" ;
            $team_id=mysqli_fetch_assoc(mysqli_query($connection,$query));
            if($team_id){
                return $team_id['team_id'];
            }
            else{
                return 0;
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function invite($email,$admin_id){
        try{
            $connection=Database::connect();
            if(!connection){die('Error:'.mysqli_connect_error());}

        $query="select user_name from users where user_email='$email'";
        $names=mysqli_query($connection,$query);
            #$query2 ="select team_id from users_in_teams where users_user_id='$admin_id'" ;
            #$team_id= mysqli_fetch_assoc(mysqli_query($connection.$$query2));
        while($name = mysqli_fetch_assoc($names)){
        return "Login Form".$name; #.$team_name;
        }
        return "Sign up Form";#.$team_name;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}