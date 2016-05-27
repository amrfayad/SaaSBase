<?php
include_once './models/User.php';
$user = new User();
$userProfile=$user->getUserProfile(24);
echo json_encode($userProfile);
