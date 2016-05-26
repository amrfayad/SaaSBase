<?php

<<<<<<< HEAD:membermodule/controller/accept_invitation.php
include_once './models/User.php';
include_once './models/User_Team.php';
=======
include_once './model/User.php';
include_once './model/User_Team.php';
>>>>>>> f9b1e76639cc9a2810612db3b4b4b7fdfc89ab1f:controller/accept_invitation.php
$user_email = $data['email'];
$user_password = $data['pass'];
$team_id = $data['team_id'];

//get user id
$user = new User();
$user_id = $user->getUserId($user_email,$user_password);

//check on email and password if not valid

if($user_id == -1)
{
    echo "Invalid Email or Password";
}else{
    $user_team = new User_Team();
    if($user_team->accept_invitation($user_id,$team_id) == 1)
    {
        echo "Thank You For Accept The Invitation";
    }
}


