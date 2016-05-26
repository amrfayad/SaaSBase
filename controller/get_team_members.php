<?php
include_once './model/User.php';
$team = new Team();
if(isset($data['team_id']))
{

	$team_id=$data['team_id'];
	$team_member=$team->getTeamMember($team_id);
	echo json_encode($team_member);

}
else if (isset($data['email']))
{
	$email=$data['email'];
	$admin_id=$team->getAdminId($email);
	$team_id=$team->getTeams($admin_id);
	$team_member=$team->getTeamMember($team_id);
	echo json_encode($team_member);



}

