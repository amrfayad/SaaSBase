<?php

/*
  invitedUsers;
  +---------------+-------------+------+-----+---------+----------------+
  | Field         | Type        | Null | Key | Default | Extra          |
  +---------------+-------------+------+-----+---------+----------------+
  | id            | int(11)     | NO   | PRI | NULL    | auto_increment |
  | user_email    | varchar(45) | YES  |     | NULL    |                |
  | teams_team_id | int(11)     | NO   | MUL | NULL    |                |
  +---------------+-------------+------+-----+---------+----------------+

 *  */

include_once 'Database.php';
class InvitedUSer{

function CheckInvation($team_id, $email)
{

try {
$connection = Database::connect();
if (!$connection) {
die('Error:' . mysqli_connect_error());
}
$query = "select * from  invitedUsers where user_email='$email' and teams_team_id = '$team_id'";
$result = mysqli_fetch_assoc(mysqli_query($connection, $query));
if ($result) {
return 1;
} else {
return 0;
}
}
catch (Exception $e)
{ echo $e->getMessage(); }
}


function removeInvation($team_id,$email)
{
	try {
$connection = Database::connect();
if (!$connection) {
die('Error:' . mysqli_connect_error());
}
$query = "delete from invitedUsers where user_email='$email' and teams_team_id = '$team_id'";
mysqli_query($connection, $query);
}
catch (Exception $e)
{ echo $e->getMessage(); }
}

}
