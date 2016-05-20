<?php

include_once 'Database.php';

class Team {

    function createTeam($user_id) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
            $query = "insert into teams (users_user_id) values (" . $user_id . ")";
            //echo $query; exit;
            $result = mysqli_query($conection, $query);
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
           // echo $query; exit;
            $result = mysqli_query($conection, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                return $row;
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

}
