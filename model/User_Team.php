<?php

/*
 
  desc users_in_teams;
+---------------+------------+------+-----+---------+-------+
| Field         | Type       | Null | Key | Default | Extra |
+---------------+------------+------+-----+---------+-------+
| users_user_id | int(11)    | NO   | PRI | NULL    |       |
| teams_team_id | int(11)    | NO   | PRI | NULL    |       |
| Is_accept     | tinyint(1) | YES  |     | NULL    |       |
| Is_active     | tinyint(1) | YES  |     | NULL    |       |
| role_role_id  | int(11)    | YES  | MUL | NULL    |       |
+---------------+------------+------+-----+---------+-------+
5 rows in set (0.01 sec)




 
 */

include_once 'Database.php';
class User_Team
{
    function accept_invitation($user_id,$team_id)
    {
        try
        {
            $connection = Database::connect();
            if(!$connection){
                die('Error In Db Connection: ' . mysqli_connect_error());
            }
            //insert into db
            $query = "INSERT INTO users_in_teams(users_user_id, teams_team_id, Is_active) VALUES ($user_id,$team_id,1)";
            $result = mysqli_query($connection,$query);
            if($result != NULL){
                echo 'Data is inserted Successfully';
            }else{
                echo 'Error in Insertion';
            }
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
 public function assign_role($team_id,$user_id,$role_id)
    {
        try
        {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: ' . mysqli_connect_error());
            }
            $query = "update users_in_teams set role_role_id = $role_id "
                    . "where  teams_team_id = $team_id and  users_user_id = $user_id";
            $result = mysqli_query($conection, $query);
            return $result ;
        }
        catch (Exception $e)
        {
                echo $e->getMessage();
        }
        return -1;
    }
    public function get_billing_user($team_id,$billing_role_id) {
        try
        {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: ' . mysqli_connect_error());
            }
            $query = "select users_user_id from users_in_teams"
                    . " where teams_team_id = $team_id and role_role_id = $billing_role_id ";
            $result = mysqli_query($conection, $query);
            return $result ;
        }
        catch (Exception $e)
        {
                echo $e->getMessage();
        }
        return -1;
    }
}