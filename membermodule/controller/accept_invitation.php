<?php

include_once './models/User.php';
include_once './models/User_Team.php';

$user_email = $data['email'];
$user_password = sha1($data['pass']);
$team_id = $data['team_id'];

//declaration section
$user = new User();
$user_team = new User_Team();
$invite_user=new InvitedUSer();

//declartion response
$response = array();

if($user_email != null && $user_password !=null && $team_id != null)
{
   

if((filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false))
	{
      $response['message'] = 'failed, Error in Email Format';
      $response['status'] = 400;
      echo json_encode($response);
	}
else 
{

if((filter_var($data['team_id'], FILTER_VALIDATE_INT) === false))
{
 $response['message'] = 'failed, Team id only integer value';
 $response['status'] = 400;
 echo json_encode($response)	
}
else{
$user_id = $user->getUserId($user_email,$user_password);
if($user_id == -1)
{
    $response['message'] = 'failed, Invaild Email or password';
    $response['status'] = 400;
    echo json_encode($response);
}else{
    
    //check invation already Exist for this user
    if($invite_user->CheckInvation($team_id,$user_name) == 1)
    {
    $user_team->accept_invitation($user_id,$team_id);
    $invite_user->removeInvation($team_id,$user_email);
}
else
{
   $response['message'] = 'failed, Invation not Exist';
    $response['status'] = 400;
    echo json_encode($response); 
}

}
}
}
}
else
{
	if($user_email == null )
	{
    $response['message'] = 'failed, Email cannot be Empty';
    $response['status'] = 400;
    echo json_encode($response);
	}


else if($team_id == null )
	{
    $response['message'] = 'failed, Team cannot be Empty';
    $response['status'] = 400;
    echo json_encode($response);
	}

	if($user_password == null )
	{
    $response['message'] = 'failed, Email cannot be Empty';
    $response['status'] = 400;
    echo json_encode($response);
	}

}


