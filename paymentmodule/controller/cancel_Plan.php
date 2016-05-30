<?php

include_once '/var/www/html/SaaSBase/models/User.php';

//initalize object 
$team = new Team();

//declartion
$response = array();
$team_id = $data['team_id'];

if (isset($data['team_id']) && $data['team_id'] != null &&
        (!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false)) {
    $team_status = $team->cancelPlan($team_id);
    $response['message'] = 'success';
    $response['status'] = 200;
    $response['data'] = $team_status;
    echo json_encode($response);
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
        $response['message'] = 'Unexpected Error While geeting team Plans';
        $response['status'] = 400;
        echo json_encode($response);
    }
}