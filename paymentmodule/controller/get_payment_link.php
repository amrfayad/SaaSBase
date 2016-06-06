<?php

include_once './models/Team.php';

$team = new Team();

$response = array();
$team_id = $data['team_id'];

if (isset($data['team_id']) && $data['team_id'] != null &&
    (!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false)) {
    if($team->checkTeam($data['team_id'])){

        $team_plan = $team->getPlan($team_id);
        $response['message'] = 'success';
        $response['status'] = 200;
        $response['data'] = $team_plan;

        echo "http://sites.fastspring.com/bigprof/product/".$team_plan."?tags=team_id%3D".$team_id;
    }
    else{
        $response['message'] = 'Team Does not Exist';
        $response['status'] = 400;
//        echo json_encode($response);
    }
} else {
    if ($data['team_id'] == null) {
        $response['message'] = 'Failed , Empty Data Not Applicable';
        $response['status'] = 400;
//        echo json_encode($response);
    } else if (filter_var($data['team_id'], FILTER_VALIDATE_INT) === false) {
        $response['message'] = 'Failed, Non Valid Inserted Data';
        $response['status'] = 400;
//        echo json_encode($response);
    }

    else {
        $response['message'] = 'Unexpected Error While getting team Plans';
        $response['status'] = 400;
//        echo json_encode($response);
    }

}
echo json_encode($response);

