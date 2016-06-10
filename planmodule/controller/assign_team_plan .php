<?php
include_once './models/Team.php';

//initalize object 
$team = new Team();
$plan = new Plan();

//declartion
$response = array();

if( isset($data['team_id']) && isset($data['subscr_id']))
{
	if((!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false) && 
		(!filter_var($data['subscr_id'], FILTER_VALIDATE_INT) === false) )
		{
	$team_id=$data['team_id'];
	$plan_id=$data['subscr_id'];
	  // check Team Exist
	  if($team->checkTeam($team_id) == 1)
	  {
	  	if($plan->checkPlanExist($plan_id) == 1)
	  	{
	  	//asign Team Plan
	$team->asignPlan($team_id,$plan_id);
	$response['message'] = 'success';
    $response['status'] = 200;
    echo json_encode($response);
}
else 
{
    
 $response['message'] = 'failed, Plan Try To assign Team To Doesnot Exist';
$response['status'] = 400;
echo json_encode($response);
}
}

else 
{
$response['message'] = 'failed, Team Doesnot Exist';
$response['status'] = 400;
echo json_encode($response);	
}
}
else{
	if(filter_var($data['team_id'], FILTER_VALIDATE_INT) === false)
	{ 
$response['message'] = 'failed, Non Vaild Inserted Data for Team ID';
$response['status'] = 400;
echo json_encode($response);
}
else if ((filter_var($data['subscr_id'], FILTER_VALIDATE_INT) === false) )
{
  $response['message'] = 'failed, Non Vaild Inserted Data for subscr ID ' ;
$response['status'] = 400;
echo json_encode($response);	
}
}
}

else
{
	if($data['team_id'] ==null)
	{
$response['message'] = 'failed,  Team ID empty not applicable';
$response['status'] = 400;
echo json_encode($response);
}

	if($data['subscr_id'] ==null)
	{
$response['message'] = 'failed,  Plan ID empty not applicable';
$response['status'] = 400;
echo json_encode($response);
}
}




