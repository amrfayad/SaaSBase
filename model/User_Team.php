<?php
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
}
