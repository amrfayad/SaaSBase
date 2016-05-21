<?php
include_once './model/User.php';
#AyaEMahmoud
$user = new User();
$token=$data['token'];
if(isset($token)) {
    $email = $data['email'];
    $password = $data['password'];
    $password_confirmation = $data['password_confirmation'];
    $error_massage = "Expired Token!";
    $error_massage2 = "Invalid Confirmation";
    if ($password == $password_confirmation) {
        $date = strtotime($user->check_token($token));
        $date_now = strtotime(date('Y-m-d H:i:s'));
        $validate_date = $date_now - $date;
        $day = (24 * 60 * 60);
        if ($validate_date <= $day) {
            $returned_result = $user->change_password($email, $password);
            if ($returned_result) {
                print_r("Password Changed Successfully");
            } else {
                print_r("Couldn't Change Password");
            }
        } else {
            print_r($error_massage);
        }
    }
    else{print_r($error_massage);}
}

else {
    $email = $data['email'];
    $old_password = $data['old_password'];
    $password = $data['password'];
    $password_confirmation = $data['password_confirmation'];
    $error_massage2 = "Invalid Confirmation";
    $old_saved_password = $user->check_password($old_password);
    if($old_password==$old_saved_password){
        if($password==$password_confirmation){
            $returned_result = $user->change_password($email, $password);
            if ($returned_result) {
                print_r("Password Changed Successfully");
            } else {
                print_r("Couldn't Change Password");
            }
        }
        else{print_r($error_massage2);}
    }
    else{print_r("Wrong password");}

}

