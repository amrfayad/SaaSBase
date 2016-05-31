<?php
include_once './models/User.php';
#AyaEMahmoud
$email = $data['email'];
$user = new User();
$response = array();
$error_massage = "Email Does't Exist!";
$is_email_exists = $user->check_mail($email);
if ($is_email_exists) {
    // cheack if Token is generated bfore
    $date = strtotime($user->get_token_expiration_date($email));
    $date_now = strtotime(date('Y-m-d H:i:s'));
    $validate_date = $date_now - $date;
    $day = (24 * 60 * 60);
    if ($validate_date <= $day) {
        $response['message'] = "Token Already Generated!";
        $response['status'] = 401;
    } else {

        $length = 16; #Length of generated token
        $token = bin2hex(openssl_random_pseudo_bytes($length)); #Generate token randomly
        $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')) + (24 * 60 * 60));
        #Increase date by one day and format it to Y-m-d H:i:s format
        $result = $user->set_token($email, $date, $token); #Insert Token and date in DB
        if ($result == 1) {
            $response['message'] = "Token generated Succesfully";
            $response['status'] = 200;
            $response['token'] = $token ;
        }
    }
} else {
    $response['message'] = "Email Does't Exist!";
    $response['status'] = 400;
}
echo json_encode($response);
