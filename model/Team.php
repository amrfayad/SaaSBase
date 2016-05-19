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
            $query = "select team_id from teams where users_user_id='".$admin_id."'";
            $result = mysqli_query($conection, $query);
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
            $query = "select * from users u ,users_in_teams t where t.users_user_id='u.user_id and t.teams_team_id= '".$admin_id."'";
            $result = mysqli_query($conection, $query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }

}
