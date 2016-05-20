<?php

include_once './model/User_Team.php';
include_once './model/User.php';


$user_id = $_POST['data']['user_id'];
$team_id = $_POST['data']['team_id'];

$admin_id = $_POST['data']['admin_id'];
$admin_password = $_POST['data']['password'];

$admin_obj = new User();

if($admin_obj->checkTeamAdminPassword($admin_id,$admin_password) == 1)
{
    $user_obj = new User_Team();
    $active_user = $user_obj->activateUser_inTeam($user_id,$team_id);

    if($active_user == 1)
    {
        echo "User is Activated Successfully";
    }else{
        echo "Error in Activate User";
    }
}else{
    echo "Invalid Password";
}



