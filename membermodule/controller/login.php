<?php
include_once './models/User.php';
$email = $data['email'];
$response = array();
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid Email Address Format';
        $response['status'] = 400;
} else {
    $user = new User();
    $userLoged = $user->login($email);
    if ($userLoged == -1) {
        $response['message'] = 'Invalid Email Address Please Sign up first';
        $response['status'] = 400;
    } else {
        $pass = sha1($data['pass']);
        if ($userLoged['password'] == $pass) {
            $response = array();
            $response['message'] = 'success';
            $response['status'] = 200;
            $response['user_id'] = $userLoged['user_id'];
            $response['user_name'] = $userLoged['user_name'];
        } else {
            $response['message'] = 'Invalid Password Do you Forget passsword ?';
            $response['status'] = 400;
        }
    }
}
echo json_encode($response);
