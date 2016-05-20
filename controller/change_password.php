<?php

include_once './model/User.php';
$email=$_POST['data']['email'];
$user = new User();
$is_email_exists=$user->check_mail($email);
if(!$is_email_exists){ }