<?php

// incude required model
include_once './models/User.php';
include_once './models/Team.php';
include_once './models/User_Team.php';
include_once './models/InvitedUser.php';

// fetch data from Request
$email = $data['email'];
$pass = sha1($data['pass']);
$name = $data['name'];
$userProfile = $data['profile'];

// intialize objects
$user = new User();
$team = new Team();
$inviite = new InvitedUSer();
$user_in_team = new User_Team();

//check mail vaildation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invaild Email Format";
} else {
// check if email is exist
    $mailFlag = $user->CheckMail($email);
    if ($mailFlag != 1) {
        //check for team_id parameter existence
        if (isset($data['team_id'])) {
            //check if team and email already in invited user or not 
            $checkFlag = $inviite->CheckInvation($data['team_id'], $email);
            if ($checkFlag == 1) {
                //check for user profile exist to call overload function 
                if (isset($data['profile'])) {
                    $user->signUp($name, $email, $pass, $userProfile);
                } else {
                    $user->signUp($name, $email, $pass);
                }
                $user_id = $user->getUserId($email, $pass);
                $user_in_team->addUser($user_id, $data['team_id']);
                $response = array();
                $response['message'] = 'You Have Register Succesfully and Added TO Team';
                echo json_encode($response);
            } else {
                $response = array();
                $response['message'] = 'Error in assigning to Team';
                echo json_encode($response);
            }
        }
        // if not team_id exist
        else {

            if (isset($data['profile'])) {
                $user->signUp($name, $email, $pass, $userProfile);
            } else {
                $user->signUp($name, $email, $pass);
            }
            $user_id = $user->getUserId($email, $pass);
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
}
?>