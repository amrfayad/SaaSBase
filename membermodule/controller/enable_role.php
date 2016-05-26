<?php

include_once './models/Role.php';

$role_name = $data['role_name'];

$role_obj = new Role();

if($role_obj->check_if_role_exist($role_name) == 1){

    if($role_obj->check_on_status($role_name) == 1)
    {
        echo 'Role Is Already Enabled';
    }else{

        $role = $role_obj->enableRole($role_name);
        if($role == 1)
        {
            echo "Role Is Enabled Successfully";
        }
    }

}else{
    echo "Error in Enable Role";
}