<?php
include_once './models/User.php';
include_once './models/Team.php';

//initalize object 
$team = new Team();
$user= new User();

//declartion
$response = array();

if( isset($data['team_id']))
{
	if((!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false))
		{
	$team_id=$data['team_id'];
	$team_member=$team->getTeamMember($team_id);
	$response['message'] = 'success';
    $response['status'] = 200;
    $response['data']=$team_member;
    echo json_encode($response);
}
else{
$response['message'] = 'failed, Non Vaild Inserted Data';
$response['status'] = 400;
echo json_encode($response);
}
}



else if (isset($data['email']))
{
	if(!(filter_var($data['email'], FILTER_VALIDATE_EMAIL)=== false))
		{
	$email=$data['email'];
	$admin_id=$user->admin_id($email);
	$team_id=$team->getTeams($admin_id);
	$team_member=$team->getTeamMember($team_id);
	$response['message'] = 'success';
    $response['status'] = 200;
    $response['data']=$team_member;
    echo json_encode($response);
}
else{
$response['message'] = 'failed, Non Vaild Inserted Data';
$response['status'] = 400;
echo json_encode($response);
}
	
}


else
{
$response['message'] = 'failed, empty data not applicable';
$response['status'] = 400;
echo json_encode($response);
}




