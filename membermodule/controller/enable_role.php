<?php

include_once './models/Role.php';

$role_name = $data['role_name'];
$role_obj = new Role();

if($role_name != null )
{
if($role_obj->check_if_role_exist($role_name) == 1){

if($role_obj->check_on_status($role_name) == 1)
      {
       $response['message'] = 'Role already enabled';
       $response['status'] = 200;
       echo json_encode($response); 
      }
  else
  {
    $role = $role_obj->enableRole($role_name);
    if($role == 1)
    {  $response['message'] = 'Role enabled Sucessfully';
       $response['status'] = 200;
       echo json_encode($response);
     }
else{
      $response['message'] = 'Erorr in disable role';
      $response['status'] = 400;
      echo json_encode($response);
    }
  }
}
else 
{
	 $response['message'] = 'Role Doenot Exist';
       $response['status'] = 400;
       echo json_encode($response);
}
}
else
{
$response['message'] = 'failed, empty Data not applicable';
$response['status'] = 400;
echo json_encode($response);
}

