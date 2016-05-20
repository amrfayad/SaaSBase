<?php

include_once './model/User.php';
include_once './model/User_Team.php';
$user_email = $_POST['data']['email'];
$user_password = $_POST['data']['pass'];
$team_id = $_POST['data']['team_id'];

//get user id
$user = new User();
$user_id = $user->getUserId($user_email,$user_password);

//check on email and password if not valid

if($user_id == -1)
{
    echo "Invalid Email or Password";
}else{
    $user_team = new User_Team();
    $logedUser = $user_team->accept_invitation($user_id,$team_id);
}


