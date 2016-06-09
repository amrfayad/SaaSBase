<?php

include_once 'Database.php';

class Role
{
    function check_if_role_exist($role_name)
    {
        $connection = Database::connect();
        if(!$connection){
            die('Error In Db Connection: ' . mysqli_connect_error());
        }

        $query = "SELECT role_name FROM role WHERE role_name = '$role_name'";
        $result = mysqli_query($connection,$query);
        while($role = mysqli_fetch_assoc($result))
        {
            if($role['role_name'] != NULL)
            {
                return 1 ;
            }else{
                return 0 ;
            }
        }

    }

    function check_on_status($role_name)
    {
        $connection = Database::connect();
        if(!$connection){
            die('Error In Db Connection: ' . mysqli_connect_error());
        }

        $query = "SELECT role_status FROM role WHERE role_name = '$role_name'";
        $result = mysqli_query($connection,$query);
        while($role = mysqli_fetch_assoc($result))
        {
            if($role['role_status'] == 1)
            {
                return 1;
            }else{
                return 0;
            }
        }
    }


    function addRole($role_name)
    {
        try
        {
            $connection = Database::connect();
            if(!$connection){
                die('Error In Db Connection: ' . mysqli_connect_error());
            }

                //insert into role table
                $query = "INSERT INTO role(role_name,role_status) VALUES ('$role_name',1)";
                $result = mysqli_query($connection,$query);
                if($result != NULL){
                    return 1;
                }else{
                    return 0 ;
                }
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

        return -1 ;
    }

    function disableRole($role_name)
    {
        try{
            $connection = Database::connect();
            if(!$connection){
                die('Error In Db Connection: ' .mysqli_connect_error());
            }

            $query = "UPDATE `role` SET `role_status`= 0 WHERE `role_name`= '$role_name'";
            $result = mysqli_query($connection,$query);
            if($result != NULL){
                return 1 ;
            }else{
                return 0 ;
            }
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
        return -1 ;
    }

    function enableRole($role_name)
    {
        try{
            $connection = Database::connect();
            if(!$connection){
                die('Error In Db Connection: ' .mysqli_connect_error());
            }

            $query = "UPDATE `role` SET `role_status`= 1 WHERE `role_name`= '$role_name'";
            $result = mysqli_query($connection,$query);
            if($result != NULL){
                return 1 ;
            }else{
                return 0 ;
            }
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
        return -1 ;
    }


    function getRoleId($role_name)
    {

     try
        {
            $connection = Database::connect();
            if(!$connection){
                die('Error In Db Connection: ' . mysqli_connect_error());
            }

                $query = "SELECT * FROM role WHERE role_name = '$role_name'";
                $result = mysqli_query($connection,$query);
                $role = mysqli_fetch_assoc($result);
                return $role['role_id'];
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

    }

}