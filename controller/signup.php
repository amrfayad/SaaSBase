<?php

include_once './model/User.php';
include_once './model/Team.php';
include_once './model/User_Team.php';

$email = $data['email'];
$pass = $data['pass'];
$name = $data['name'];
$user = new User();
$team = new Team();
$user_in_team = new User_Team();
$mailFlag = $user->CheckMail($email);
if ($mailFlag != 1) {

    $registerUser = $user->signUp($name, $email, $pass);
    $user_id = $user->getUserId($email, $pass);

    if ( isset($data['team_id'])) {
         $user_inTeam = $user_in_team->addUser($user_id,$data['team_id']);
    } else {
        $newTeam = $team->createTeam($user_id);
    }
} else {
    header('Mail already exist', true, 403);
    echo "mail already Exist";
}
?>