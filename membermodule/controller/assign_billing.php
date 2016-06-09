<?php

// Include Requered Models 

include_once './models/User_Team.php';
include_once './models/User.php';
include_once './models/Team.php';
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
	if(!(filter_var($data['user_id'], FILTER_VALIDATE_INT)=== false) && 
		!(filter_var($data['team_id'], FILTER_VALIDATE_INT)=== false))
	{

    $roleId=role->getRoleId();
    $admin_id = $team->getTeamAdmin($team_id);
    $isAdmin = $user->checkTeamAdminPassword($admin_id, $admin_password);
  if ($isAdmin) {

	   // get current billing user
    $billing_user_id = $userInTeam->get_billing_user($team_id, 1); 
           if($billing_user_id != null)
           {
          // assign previous billing user to be normal member
            $user->assignDefaultRole($billing_user_id,$team_id);
             }
              // assign billing to new user            
            $userInTeam->assign_role($team_id, $user_id ,$roleId);      
        
                   
} else {

     $response['message'] = 'failed,  admin password not correct ';
     $response['status'] = 400;
     echo json_encode($response);
 }
}

  else 
  {
  	if((filter_var($data['user_id'], FILTER_VALIDATE_INT)=== false))
  	{
  	 $response['message'] = 'failed,  Inserted Data in user id not applicable ';
     $response['status'] = 400;
     echo json_encode($response);
  	}

  	else if((filter_var($data['team_id'], FILTER_VALIDATE_INT)=== false))
  	{
  	 $response['message'] = 'failed,  Inserted Data in user id not applicable ';
     $response['status'] = 400;
     echo json_encode($response);
  	}
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