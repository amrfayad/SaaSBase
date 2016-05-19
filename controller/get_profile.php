<?php
include_once './model/User.php';
$user = new User();
$userProfile=$user->getUserProfile(24);
echo json_encode($userProfile);
