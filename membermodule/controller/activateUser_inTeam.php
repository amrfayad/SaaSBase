<?php

include_once './models/User_Team.php';
include_once './models/User.php';


$user_id = $data['user_id'];
$team_id = $data['team_id'];
$admin_id = $data['admin_id'];
$admin_password = sha1($data['password']);

$admin_obj = new User();
$user_obj = new User_Team();

$result = $admin_obj->checkTeamAdminPassword($admin_password,$admin_id);

if($result == 1)
{
    $active_user = $user_obj->activateUser_inTeam($team_id,$user_id);

    if($active_user == 1)
    {
        echo "User is Activated Successfully";
        return 1 ;
    }else{
        echo "Error in Activate User";
        return -1 ;
    }
}else{
    echo "Invalid Password";
}



