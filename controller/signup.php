<?php

include_once './model/User.php';
$email= $_POST['data']['email'];
$pass = $_POST['data']['pass'];
$name = $_POST['data']['name'];
$hash = $_POST['hash'];
$key = "1234";
$data = $name . $email . $pass . $key;
//var_dump($data); exit;
$hashed = md5($data);
if ($hash === $hashed) {
    $user = new User();
    $team = new Team();
    $mailFlag=$user->CheckMail($email);
    if($mailFlag != 1)
    {
    $registerUser = $user->signUp($name, $email, $pass);
    $user_id=$user->getUserId($email, $pass);
    $newTeam=$team->createTeam($user_id);
    }
    else 
    {
        header('Mail already exist',true,403);
        echo "mail already Exist";
    }
} else {
    header('Data Not accepted',true,406);
    echo "error , unaccurate data";
}
?>