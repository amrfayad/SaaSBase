<?php
/*
desc teams
 +-------------------------+------------+------+-----+---------+----------------+
| Field                   | Type       | Null | Key | Default | Extra          |
+-------------------------+------------+------+-----+---------+----------------+
| team_id                 | int(11)    | NO   | PRI | NULL    | auto_increment |
| users_user_id           | int(11)    | NO   | MUL | NULL    |                |
| payment_status          | tinyint(1) | YES  |     | 0       |                |
| subscribtions_subscr_id | int(11)    | YES  | MUL | NULL    |                |
+-------------------------+------------+------+-----+---------+----------------
 
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

 

    //get team Payment Status 
  function getPaymentStatus($team_id){
     try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection');
            }
            $query = "select payment_status from teams where team_id = $team_id ";
            $result = mysqli_query($conection, $query);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                return $row['payment_status'];
            }
            else
            {
                return -1;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

  }

  //Record Payment 

function asignPlan($team_id,$subscr_id)
{
 try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
            $query = "update teams set subscribtions_subscr_id=$subscr_id where team_id = $team_id";
            //echo $query; exit;
            mysqli_query($conection, $query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

}

//cancel plan
function cancelPlan($team_id){
 try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
            $query = "update teams set subscribtions_subscr_id=null where team_id = $team_id";
            mysqli_query($conection, $query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

}

//get Plans Of Team
function getPlan($team_id)
{

try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
        $query = "select s.name from teams t , subscribtions s where s.subscr_id=t.subscribtions_subscr_id and t.team_id= $team_id";
        $result=mysqli_query($conection, $query);
        $row = mysqli_fetch_assoc($result);
            if ($row) {
                return $row['name'];
            }
            else
            {
                return -1;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

}
}
