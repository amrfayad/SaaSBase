<?php

include_once './models/Role.php';

$role_name = $data['role_name'];
$role_obj = new Role();

<<<<<<< HEAD
=======
//declartion
$response = array();

if($role_name != null )
{
if (!preg_match('/[^A-Za-z]/', $role_name))
 {
>>>>>>> e9529a365983c1f1a1c60c328ed46e7a3f4bbcf2
if($role_obj->check_if_role_exist($role_name) == 0){

 $role = $role_obj->addRole($role_name);
    if($role == 1)
    {
       $response['message'] = 'Role inserted Sucessfully';
       $response['status'] = 200;
       echo json_encode($response);
    }
}
else{
    
     $response['message'] = 'Role already Exist';
       $response['status'] = 400;
       echo json_encode($response);
   }

}
else 
{
	 $response['message'] = 'Data Inserted Not Vaild';
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

