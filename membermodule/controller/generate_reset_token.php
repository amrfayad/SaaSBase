<?php
include_once './models/User.php';
#AyaEMahmoud
$email=$data['email'];
$user = new User();
$error_massage="Email Does't Exist!";
$is_email_exists=$user->check_mail($email);
if($is_email_exists){
    $is_token_set=$user->get_token($email);
    if($is_token_set){
        $token=$is_token_set;
        $is_token_valid=strtotime($user->check_token($token));
        $date_now = strtotime(date('Y-m-d H:i:s'));
        $validate_date = $date_now - $is_token_valid;
        $day = (24 * 60 * 60);
        if ($validate_date > $day) {
            $length = 12; #Length of generated token
            $token = bin2hex(openssl_random_pseudo_bytes($length)); #Generate token randomly
            $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')) + (24 * 60 * 60));
            #Increase date by one day and format it to Y-m-d H:i:s format
            $result = $user->set_token($email, $date, $token); #Insert Token and date in DB
            if ($result == 1) {
                $URL = "http://localhost/forgot_password.php?" . $token;
                print_r($URL);
            }
        }
        else{print_r("Your Token is valid, Can't reset it");
             print_r($is_token_set);}
    }
}
else{
    print_r($error_massage);
}
