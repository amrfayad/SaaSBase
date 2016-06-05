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
                return 1;
            }else{
                return 0;
            }
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    } #Yasmine
 public function assign_role($team_id,$user_id,$role_id)
    {
     try
        {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: ' . mysqli_connect_error());
            }
            $query = "update users_in_teams set role_role_id = $role_id "
                    . "where teams_team_id = $team_id and  users_user_id = $user_id ";
            $result = mysqli_query($conection, $query);
            
            return $result ;
        }
        catch (Exception $e)
        {
                echo $e->getMessage();
        }
        return -1;
    } #Amr
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
            $row = $row = mysqli_fetch_assoc($result);
            return $row['users_user_id'] ;
        }
        catch (Exception $e)
        {
                echo $e->getMessage();
        }
        return -1;
    } #Amr
    
    
    
    function addUser($user_id,$team_id)
    {
        try {

            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  userCreate');
            }

            $query = "insert into users_in_teams(users_user_id,teams_team_id) values (" . $user_id . "," . $team_id . ")";
            mysqli_query($conection, $query);
        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    function activateUser_inTeam($team_id,$user_id)
    {
        try
        {
            $connection = Database::connect();
            if(!$connection)
            {
                die('Error: ' . mysqli_connect_error());
            }
            $query = "UPDATE users_in_teams SET Is_active= 1 WHERE users_user_id= $user_id AND teams_team_id = $team_id";
           // echo $query; exit;
            $result = mysqli_query($connection, $query);
            if($result != NULL)
            {
                return 1 ;
            }else{
                return 0 ;
            }
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
    } #Yasmine

    function deactivateUser_inTeam($user_id,$team_id)
    {
        try
        {
            $connection = Database::connect();
            if(!$connection)
            {
                die('Error: ' . mysqli_connect_error());
            }

            $query = "UPDATE `users_in_teams` SET `Is_active`= 0 WHERE `users_user_id`= $user_id AND `teams_team_id`= $team_id";
            $result = mysqli_query($connection, $query);
            if($result != NULL)
            {
                return 1 ;
            }else{
                return 0 ;
            }
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
    } #Yasmine

}