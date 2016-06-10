<?php

// Include Requered Models 

include_once './models/User_Team.php';
include_once './models/User.php';
include_once './models/Team.php';
include_once './models/Role.php';

// Featch Post Data 
$team_id = $data['team_id'];
$admin_password = sha1($data['pass']);
$user_id = $data['user_id'];

$team = new Team();
$userInTeam = new User_Team();
$user = new User();
$role = new Role();


$response = array();
if(isset($data['team_id']) && isset($data['pass']) && isset($data['user_id']))
{
    //echo $roleId; exit; 2
    $admin_id = $team->getTeamAdmin($team_id);
    //echo $admin_id; exit; 9
    $isAdmin = $user->checkTeamAdminPassword($admin_id, $admin_password);
  if ($isAdmin) {

	         // get current billing user
           $billing_user_id = $userInTeam->get_billing_user($team_id, $roleId); 
          // echo $billing_user_id; exit;   8
           if($billing_user_id != null)
           {

          // assign previous billing user to be normal member
            $role_name="normal";
            $roleId=$role->getRoleId($role_name);
            $userInTeam->assign_role($team_id,$billing_user_id,$roleId);
          }
              //check user already exist in This Team
              $checkUSer=$user->checkUserInTeam($user_id,$team_id);
                 if($checkUSer == 1)
                 { 
                          
                // assign billing to new user  
              $role_name="billing";
              $roleId=$role->getRoleId($role_name);   
              $userInTeam->assign_role($team_id, $user_id ,$roleId); 
              $response['message'] = 'Success';
              $response['status'] = 200;
              echo json_encode($response);

            }
            else 
            {
              $response['message'] = 'failed, user try to assign billing Not Exist ';
              $response['status'] = 400;
              echo json_encode($response);
            }   
        
                   
} else {

     $response['message'] = 'failed,  admin password not correct ';
     $response['status'] = 400;
     echo json_encode($response);
 }
}
else
{
	if($team_id == null)
	{
     $response['message'] = 'failed,  team id empty data not applicable ';
     $response['status'] = 400;
     echo json_encode($response);
	}

	else if($user_id == null)
	{
     $response['message'] = 'failed, user id empty data not applicable';
     $response['status'] = 400;
     echo json_encode($response);
	}

else if( $admin_password == null)
	{
     $response['message'] = 'failed, admin password empty data not applicable';
     $response['status'] = 400;
     echo json_encode($response);
	}
}
?>