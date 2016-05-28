<?php
include_once './models/User.php';
#AyaEMahmoud
$email=$data['email'];
$user = new User();
$error_massage="Email Does't Exist!";
$is_email_exists=$user->check_mail($email);
if($is_email_exists){
    $length =16; #Length of generated token
    $token = bin2hex(openssl_random_pseudo_bytes($length)); #Generate token randomly
    $date =  date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))+(24*60*60));
    #Increase date by one day and format it to Y-m-d H:i:s format
    $result = $user->set_token($email,$date,$token); #Insert Token and date in DB
    if($result==1){
        $URL="http://localhost/forgot_password.php?".$token;
    print_r($URL);}
}
else{
    print_r($error_massage);
}
