<?php

include_once './models/User.php';

$user= new User();

//declartion
$response = array();



$user_email= $data['user_email'];

if(isset($data['user_email']) && (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL) === false) )
{
	 if($user->CheckMail($user_email)==1)
	 {

    $result=$user->getTeamsInvitedIn($user_email);
    $response['message'] = 'success';
    $response['status'] = 200;
    $response['data']=$result;
         //var_dump($response['data']); exit;
    echo json_encode($response);
}

else 
 {
   $response['message'] = 'failed, Inserted Email Doesnot exist';
    $response['status'] = 400;
    echo json_encode($response);	
}
}

else
{
	if((filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false))
	{
      $response['message'] = 'failed, Error in Email Format';
      $response['status'] = 400;
      echo json_encode($response);
	}
	else{
	$response['message'] = 'failed, Empty data not applicable';
    $response['status'] = 400;
    echo json_encode($response);
}
}