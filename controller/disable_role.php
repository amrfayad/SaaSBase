<?php

include_once './model/Role.php';

$role_name = $data['role_name'];

$role_obj = new Role();

if($role_obj->check_if_role_exist($role_name) == 1){

    if($role_obj->check_on_status($role_name) == 0)
    {
        echo "Role Is Already Disabled";
    }else{

        $role = $role_obj->disableRole($role_name);
        if($role == 1)
        {
            echo "Role Is Disabled Successfully";
        }
    }

}else{
    echo "Error in Disable Role";
}

