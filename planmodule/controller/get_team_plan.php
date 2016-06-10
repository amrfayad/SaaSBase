<?php
include_once './models/Team.php';

//initalize object 
$team = new Team();

//declartion
$response = array();

if( isset($data['team_id']))
{
	if((!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false))
		{
	$team_id=$data['team_id'];
	  // check Team Exist
	  if($team->checkTeam($team_id) == 1)
	  {
	  	//get Team Plan
	$team_plan=$team->getPlan($team_id);
	$response['message'] = 'success';
    $response['status'] = 200;
    $response['data']=$team_plan;
    echo json_encode($response);
}

else 
{
$response['message'] = 'failed, Team Doesnot Exist';
$response['status'] = 400;
echo json_encode($response);	
}
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




