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

//declartion
$response = array();

// intialize objects
$user = new User();
$team = new Team();
$inviite = new InvitedUSer();
$user_in_team = new User_Team();

//check mail vaildation
if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
    $response['message'] = 'Invalid Mail Format';
    $response['status'] = 400;
    echo json_encode($response);

} else {

    if( $pass != null && $name !=null)
    {
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
                    $userProfile = $data['profile'];               //check user data
                    $user->signUp($name, $email, $pass, $userProfile);
                } else {
                    $user->signUp($name, $email, $pass);
                }
                $user_id = $user->getUserId($email, $pass);
                $user_in_team->addUser($user_id, $data['team_id']);
                $user->assignDefaultRole($user_id,$data['team_id']);
                $inviite->removeInvation($data['team_id'], $email);
                $response['message'] = 'You Have Register Succesfully and Added TO Team';
                $response['status'] = 200;
                echo json_encode($response);
            } else {
                $response['message'] = 'Error when assigning to Team,you not have inventaion ';
                $response['status'] = 400;
                echo json_encode($response);
            }
        }
        // if not team_id exist
        else {

            if (isset($data['profile'])) {
                $userProfile = $data['profile'];       
                $user->signUp($name, $email, $pass, $userProfile);
            } else {
                $user->signUp($name, $email, $pass);
            }
            $user_id = $user->getUserId($email, $pass);
            $team->createTeam($user_id);
            $response['message'] = 'You Have Register Successfully';
            $response['status'] = 200;
            echo json_encode($response);
        }
    } else {
        $response['message'] = 'This Email Is already Exist';
        $response['status'] = 400;
        echo json_encode($response);
    }
}
else 
{
   if($email == null)
   {
     $response['message'] = 'Mail cannot be empty';
        $response['status'] = 400;
        echo json_encode($response);
   }
 else if ($pass != null)
    {
     $response['message'] = 'password cannot be empty';
        $response['status'] = 400;
        echo json_encode($response);
   }

    else if ($name != null)
    {
     $response['message'] = 'Name cannot be empty';
        $response['status'] = 400;
        echo json_encode($response);
   }

}
}
?>