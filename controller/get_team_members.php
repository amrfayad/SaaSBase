<?php
include_once '../model/User.php';
$team = new Team();
$team_id=$team->getTeams(8);
echo json_encode($team_id);
$team_member=$team->getTeamMember($team_id['team_id']);
echo json_encode($team_member);
