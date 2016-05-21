<?php

// Include Requered Models 

include_once './model/User_Team.php';
include_once './model/User.php';
include_once './model/Team.php';
// Featch Post Data 
$team_id = $data['team_id'];
$admin_password = $data['pass'];
$user_id = $data['user_id'];

// get Team Admin ID
$team = new Team();
$admin_id = $team->getTeamAdmin($team_id);

// Cheack Admin Password
$user = new User();
$isAdmin = $user->checkTeamAdminPassword($admin_id, $admin_password);


// if password is correct
if ($isAdmin) {
    $userInTeam = new User_Team();
    $billing_user_id = $userInTeam->get_billing_user($team_id, 1);    // get current billing user
    $userInTeam->assign_role($team_id, $billing_user_id, 2);            // assign current billing user to be team member
    $userInTeam->assign_role($team_id, $user_id , 1);                  // assign billing to new user  
} else {
    
}
?>