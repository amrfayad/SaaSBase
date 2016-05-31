<?php

include_once '/var/www/html/SaaSBase/models/User.php';
include_once '/var/www/html/SaaSBase/models/Plan.php';


//initalize object 
$team = new Team();
$plan = new Plan();

//declartion
$response = array();
$team_id = $data['team_id'];
$plan_id = $data['plan_id'];

if (isset($data['team_id']) && isset($data['plan_id'])) {
    if ($data['team_id'] != null && $data['plan_id'] != null) {
        if ((!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false)
         && (!filter_var($data['plan_id'], FILTER_VALIDATE_INT) === false))
          {
            if($team->checkTeam($data['team_id'])){
                if($plan->checkPlan($data['plan_id']))
                {
            $team->asignPlan($team_id,$plan_id);
            $response['message'] = 'success';
            $response['status'] = 200;
            echo json_encode($response);
        }
        else
        {

         $response['message'] = 'Failed , Plan Doesnot Exist';
         $response['status'] = 400;
         echo json_encode($response);   
        }
        }
        else{
     $response['message'] = 'Failed , Team Doesnot Exist';
     $response['status'] = 400;
     echo json_encode($response);   
         }
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


