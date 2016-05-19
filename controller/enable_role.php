<?php

include_once './model/Role.php';

$role_name = $_POST['data']['role_name'];

$role_obj = new Role();

if($role_obj->checkOnRole($role_name) == 1){

    $role = $role_obj->enableRole($role_name);
    if($role == 1)
    {
        echo "Role Is Enabled Successfully";
    }
}else{
    echo "Error in Enable Role";
}