<?php
include_once '/var/www/html/SaaSBase/models/User.php';

//initalize object 
$team = new Team();
$user= new User();

//declartion
$response = array();
$team_id=$data['team_id'];

if( isset($data['team_id']) && $data['team_id'] != null && 
	(!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false))
{
	$team_member=$team->getTeamMember($team_id);
	$response['message'] = 'success';
    $response['status'] = 200;
    $response['data']=$team_member;
    echo json_encode($response);

}

else if (isset($data['email'])&& $data['email'] != null &&
	(filter_var($data['email'], FILTER_VALIDATE_EMAIL)=== true))
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

else
{

if ($data['team_id'] == null)
{
$response['message'] = 'failed, empty data not applicable';
$response['status'] = 400;
echo json_encode($response);
}

else if (filter_var( $data['team_id'], FILTER_VALIDATE_INT) === false) {
$response['message'] = 'failed, Non Vaild Inserted Data';
$response['status'] = 400;
echo json_encode($response);
}
}

