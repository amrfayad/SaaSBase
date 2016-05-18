<?php
	include_once './model/User.php';
	$email = $_POST['data']['email'];
	$pass = $_POST['data']['pass'];
	$user = new User();
	$userLoged = $user->login($email,$pass);
	print_r($userLoged);
?>