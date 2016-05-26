<?php

// incude required model
include_once './models/User.php';
include_once './models/Team.php';
include_once './models/User_Team.php';

// fetch data from Request
$email = $data['email'];
$pass = $data['pass'];
$name = $data['name'];

// intialize objects
$user = new User();
$team = new Team();
$user_in_team = new User_Team();

// check if email is exist
$mailFlag = $user->CheckMail($email);
if ($mailFlag != 1) {
    $user->signUp($name, $email, $pass);
    $user_id = $user->getUserId($email, $pass);

    if ( isset($data['team_id'])) {
         $user_in_team->addUser($user_id,$data['team_id']);
        $response = array();
        $response['message'] = 'You Have Register Succesfully and Added TO Team';
        echo json_encode($response);

    } else {
        $team->createTeam($user_id);
        $response = array();
        $response['message'] = 'You Have Register Successfully';
        echo json_encode($response);
    }
} else {
    header('Mail already exist', true, 403);
    $response = array();
    $response['message'] = 'This Email Is already Exist';
    echo json_encode($response);
}
?>