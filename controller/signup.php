<?php
include_once './model/User.php';
$email= $data['email'];
$pass = $data['pass'];
$name = $data['name'];
$hash = $_POST['hash'];
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
?>