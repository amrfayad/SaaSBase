<?php

include_once './models/User.php';
include_once './models/Plan.php';


//initalize object 
$team = new Team();
$plan = new Plan();
$invoice=new Invoices();

//declartion
$response = array();
$team_id = $data['team_id'];
$plan_name = $data['plan_name'];

if (isset($data['team_id']) && isset($data['plan_name'])) {
    if ($data['team_id'] != null && $data['plan_name'] != null) {
        if ((!filter_var($data['team_id'], FILTER_VALIDATE_INT) === false))
          {
            if($team->checkTeam($data['team_id'])){
                if($plan->getPlanId($data['plan_name']))
                {
            $plan_id=$plan->getPlanId($data['plan_name']);
            $team->asignPlan($team_id,$plan_id);
            //check other_info exist
            if(isset($data['other_information']))
            {
                    //get other information data 
                    $other_info=$data['other_information'];
                    //Register History of invoices for team
                    $invoice->addPayment($plan_name,$team_id,$other_info);
            }
            else
            {
                    $invoice->addPayment($plan_name,$team_id);

            }

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


