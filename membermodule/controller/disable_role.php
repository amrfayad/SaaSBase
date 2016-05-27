<?php

include_once './models/Role.php';

$role_name = $data['role_name'];

$role_obj = new Role();

if($role_obj->checkOnRole($role_name) == 1){

    $role = $role_obj->disableRole($role_name);
    if($role == 1)
    {
        echo "Role Is Disabled Successfully";
    }
}else{
    echo "Error in Disable Role";
}

