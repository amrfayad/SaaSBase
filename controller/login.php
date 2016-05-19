<?php
	include_once './model/User.php';
	$email = $_POST['data']['email'];
	$pass = $_POST['data']['pass'];
	$user = new User();
	$userLoged = $user->login($email,$pass);
        if($userLoged == -1)
        {
                //header('HTTP/ 404 Uesr Not Found');
                header("USer Not Found", true, 404);
                $response = array();
                $response['message'] = 'Invalid Email Or Password';
                echo json_encode($response);
        }
        else
        {
                //header("Status: 200 ");
                header("USer Not Found", true, 200);
                $response = array();
                $response['message'] = 'success';
                echo json_encode($response);
        }
        /*print_r($userLoged);*/
?>