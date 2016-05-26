<?php
include_once './models/User.php';
$user_id=$data['user_id'];
$user = new User();
$userProfile=$user->getUserProfile($user_id);
echo json_encode($userProfile);
