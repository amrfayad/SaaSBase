<?php

include_once './models/User_Team.php';
include_once './models/User.php';


$user_id = $data['user_id'];
$team_id = $data['team_id'];
$admin_id = $data['admin_id'];
$admin_password = sha1($data['password']);

$admin_obj = new User();
$user_obj = new User_Team();

$response = array();


if($user_id != null && $team_id !=null && $admin_password != null && $admin_id != null)

    {
        if (!filter_var($user_id, FILTER_VALIDATE_INT) === false)
        {
            if($admin_obj->checkTeamAdminPassword($admin_password,$admin_id) == 1)
            {
                   
                $checkUserExist= $admin_obj->checkUserExist($user_id);
                 if($checkUserExist == 1)
                    {
                        if($user_obj->getUserStatus($user_id,$team_id) == 1)
                            {
                                $response['message'] = 'User is already activated';
                                $response['status'] = 200;
                                echo json_encode($response);
                            }
                        else{
                                $active_user = $user_obj->activateUser_inTeam($user_id,$team_id);
                                $response['message'] = 'User is activated succesfully';
                                $response['status'] = 200;
                                echo json_encode($response);
                            }
                    }
                    else
                    {

                      $response['message'] = 'User is Not Exist';
                      $response['status'] = 400;
                      echo json_encode($response);
                    }
            }
            else{
                $response['message'] = 'Invaild Password';
                $response['status'] = 400;
                echo json_encode($response);
            }
        }
        else
        {
            $response['message'] = 'user id only be integer value';
            $response['status'] = 400;
            echo json_encode($response);
        }
    }
    else {
        if ($user_id == null) {
            $response['message'] = 'user id cannot be empty';
            $response['status'] = 400;
            echo json_encode($response);
        } else if ($team_id == null) {
            $response['message'] = 'team_id cannot be empty';
            $response['status'] = 400;
            echo json_encode($response);
        } else if ($admin_password == null) {
            $response['message'] = 'admin password cannot be empty';
            $response['status'] = 400;
            echo json_encode($response);
        }
    }

 


