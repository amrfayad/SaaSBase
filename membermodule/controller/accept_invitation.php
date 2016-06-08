<?php

include_once './models/User.php';
include_once './models/User_Team.php';
$user_email = $data['email'];
$user_password = $data['pass'];
$team_id = $data['team_id'];

//get user id
$user = new User();
$user_team = new User_Team();

$user_id = $user->getUserId($user_email,$user_password);

//check on email and password if not valid
if($user_id == -1)
{
    echo "Invalid Email or Password";
}else{
    $logedUser = $user_team->accept_invitation($user_id,$team_id);
}


