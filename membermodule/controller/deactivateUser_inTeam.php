<?php

include_once './models/User_Team.php';
include_once './models/User.php';


$user_id = $data['user_id'];
$team_id = $data['team_id'];
$admin_password = $data['password'];

$admin_obj = new User();

if($admin_obj->checkTeamAdminPassword($admin_password) == 1)
{
    $user_obj = new User_Team();
    $inactive_user = $user_obj->deactivateUser_inTeam($user_id,$team_id);

    if($inactive_user == 1)
    {
        echo "User is Deactivated Successfully";
    }else{
        echo "Error in Deactivate User";
    }
}else{
    echo "Invalid Password";
}



