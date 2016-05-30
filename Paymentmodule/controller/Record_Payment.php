<?php

include_once '/var/www/html/SaaSBase/models/User.php';

//initalize object 
$team = new Team();

//declartion
$response = array();
$team_id = $data['team_id'];
$plan_id = $data['subscr_id'];

if (isset($data['team_id']) && isset($data['subscr_id'])) {
    if ($data['team_id'] != null & $data['subscr_id'] != null) {
        if ((!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false) && (!filter_var($data['subscr_id'], FILTER_VALIDATE_INT) === false)) {
            $team_status = $team->asignPlan($team_id,$plan_id);
            $response['message'] = 'success';
            $response['status'] = 200;
            $response['data'] = $team_status;
            echo json_encode($response);
        } else {
            $response['message'] = 'failed, Non Vaild Inserted Data';
            $response['status'] = 400;
            echo json_encode($response);
        }
    } else {
        $response['message'] = 'Failed , Empty Data Not Applicable';
        $response['status'] = 400;
        echo json_encode($response);
    }
} else {

    $response['message'] = 'Unexpected Error while return team Status';
    $response['status'] = 400;
    echo json_encode($response);
}


