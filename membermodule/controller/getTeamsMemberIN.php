<?php

include_once './models/User.php';

$user= new User();

//declartion
$response = array();



$user_id= $data['user_id'];

if(isset($data['user_id']) && (!filter_var($data['user_email'], FILTER_VALIDATE_INT) === false) )
{
	 

    $result=$user->getTeamsMemberIn($user_id);
    $response['message'] = 'success';
    $response['status'] = 200;
    $response['data']=$result;
    echo json_encode($response);
}


else
{
	if((filter_var($data['id'], FILTER_VALIDATE_INT) === false))
	{
      $response['message'] = 'failed, Non vailed inserted Data';
      $response['status'] = 400;
      echo json_encode($response);
	}
	else{
	$response['message'] = 'failed, Empty data not applicable';
    $response['status'] = 400;
    echo json_encode($response);
}
}