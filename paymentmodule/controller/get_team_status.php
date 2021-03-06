<?php

include_once './models/User.php';

//initalize object 
$team = new Team();

//declartion
$response = array();
$team_id = $data['team_id'];

if (isset($data['team_id']) && $data['team_id'] != null &&
        (!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false)) {
     if($team->checkTeam($data['team_id'])){
    $team_status = $team->getPaymentStatus($team_id);
    $response['message'] = 'success';
    $response['status'] = 200;
    $response['data'] = $team_status;
    echo json_encode($response);
}
else{
     $response['message'] = 'Failed , Team Doesnot Exist';
     $response['status'] = 400;
     echo json_encode($response);   
}
} else {
    if ($data['team_id'] == null) {
        $response['message'] = 'Failed , Empty Data Not Applicable';
        $response['status'] = 400;
        echo json_encode($response);
    } else if (filter_var($data['team_id'], FILTER_VALIDATE_INT) === false) {
        $response['message'] = 'failed, Non Vaild Inserted Data';
        $response['status'] = 400;
        echo json_encode($response);
    }
    
    else {
        $response['message'] = 'Unexpected Error while return team Status';
        $response['status'] = 400;
        echo json_encode($response);
    }
}