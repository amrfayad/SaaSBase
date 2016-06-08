<?php
include_once './models/User.php';
$user = new User();

$userid=$data['user_id'];

//declartion
$response = array();

if(isset($data['user_id']) && ( !filter_var($data['user_id'], FILTER_VALIDATE_INT) === false))
{
$userProfile=$user->getUserProfile($userid);
$response['message'] = 'success';
$response['status'] = 200;
$response['data']=$userProfile;
echo json_encode($response);
}

else
{
if($data['user_id'] == null)
{
$response['message'] = 'failed, empty data not applicable';
$response['status'] = 400;
echo json_encode($response);
}

else if (filter_var($data['user_id'], FILTER_VALIDATE_INT) === false) {
$response['message'] = 'failed, Non Vaild Inserted Data';
$response['status'] = 400;
echo json_encode($response); 
}

else
{
$response['message'] = 'failed, UnExcepted Error Ocuur';
$response['status'] = 400;
echo json_encode($response);
}

}