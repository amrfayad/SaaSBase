<?php
/*
 
        +---------------+---------+------+-----+---------+-------+
       | Field         | Type    | Null | Key | Default | Extra |
       +---------------+---------+------+-----+---------+-------+
       | team_id       | int(11) | NO   | PRI | NULL    |       |
       | users_user_id | int(11) | NO   | MUL | NULL    |       |
       +---------------+---------+------+-----+---------+-------+
       2 rows in set (0.12 sec)
 
 
 */
include_once 'Database.php';

class Team {

    function createTeam($user_id) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
            $query = "insert into teams (users_user_id) values (" . $user_id . ")";
            mysqli_query($conection, $query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function getTeams($admin_id) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
            $query = "select team_id from teams where users_user_id=$admin_id";
            //echo $query; exit;
            $result = mysqli_query($conection, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                return $row['team_id'];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function getTeamMember($team_id) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
            $query = "select user_id,user_name ,user_email,user_profile_info from users u , users_in_teams t where t.users_user_id=u.user_id and t.teams_team_id= $team_id";
            $result = mysqli_query($conection, $query);
            $a = array();
            while ($row = mysqli_fetch_assoc($result)) {
                  $a[] = $row;
                  
            }
            return $a;
             
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }
    
    
    // Auther : Amr
    // Desc   : This Function to get Team Admin ID 
    
    function getTeamAdmin($team_id){
         try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection');
            }
            $query = "select users_user_id from teams where team_id = $team_id ";
            $result = mysqli_query($conection, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                return $row['users_user_id'];
            }
            else
            {
                return -1;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

//function take admin email and return its ID
  function getAdminId($email){

 try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection');
            }
            $query = 'select user_id from users where user_email ="'. $email.'"';
            $result = mysqli_query($conection, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                return $row['user_id'];
            }
            else
            {
                return -1;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
  }  

}
