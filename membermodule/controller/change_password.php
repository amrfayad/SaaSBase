<?php
include_once './models/User.php';
#AyaEMahmoud
$user = new User();

//declartion
$response = array();
if($data['email'] !=null && $data['password'] != null)
{
    //check mail vaildation
if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
    $response['message'] = 'Invalid Mail Format';
    $response['status'] = 400;
    echo json_encode($response);

}
else{
if(isset($data['token'])) {
    $token=$data['token'];
    $email = $data['email'];
    $password =sha1($data['password']);
    $date = strtotime($user->check_token($token));
    $date_now = strtotime(date('Y-m-d H:i:s'));
    $validate_date = $date_now - $date;
     $day = (24 * 60 * 60);
    if ($validate_date <= $day) {
        $returned_result = $user->change_password($email, $password);
        if ($returned_result) {
                $response['message'] = 'Password Changed Successfully ?';
                $response['status'] = 200;
         } else {
             $response['message'] = 'Password Canot Be Changed  ?';
             $response['status'] = 400;
        }
    } else {
            $response['message'] = 'Token has been expired';
            $response['status'] = 400;
    }
        echo json_encode($response);   
}
else {
    $email = $data['email'];
    $old_password = sha1($data['old_password']);
    $password = sha1($data['password']);
    $old_saved_password = $user->check_password($email);
    if($old_password==$old_saved_password)
        {
            $returned_result = $user->change_password($email, $password);
            if ($returned_result) {
                $response['message'] = 'Password Changed Successfully';
                $response['status'] = 200;
            } else {
                $response['message'] = 'Password Canot Be Changed ';
                $response['status'] = 400;
            }
    }
    else{
         $response['message'] = 'Wrong Password ';
         $response['status'] = 400;
    }
}
echo json_encode($response);
}
}

else
{
    if($data['email']==null)
    {
       $response['message'] = 'Email cannot be empty ';
       $response['status'] = 400; 
       echo json_encode($response);
    }

    else if($data['password'] != null)
    {
     $response['message'] = 'password cannot be empty ';
    $response['status'] = 400; 
    echo json_encode($response);   
    }
}