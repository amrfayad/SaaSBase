<?php

include_once './model/User_Team.php';
$userInTeam = new User_Team();
$billing_user_id = $userInTeam->get_billing_user($team_id, $billing_role_id)


?>