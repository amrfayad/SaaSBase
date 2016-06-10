<?php
include_once 'Database.php';
/*


 desc subscribtions;
+-----------+-------------+------+-----+---------+----------------+
| Field     | Type        | Null | Key | Default | Extra          |
+-----------+-------------+------+-----+---------+----------------+
| subscr_id | int(11)     | NO   | PRI | NULL    | auto_increment |
| name      | varchar(45) | YES  |     | NULL    |                |
+-----------+-------------+------+-----+---------+----------------+

*/
class Plan{

function getPlanId($plan_name)
{

try {
$connection = Database::connect();
if (!$connection) {
die('Error:' . mysqli_connect_error());
}
$query = "select subscr_id  from  subscribtions where name =$plan_name";
$result = mysqli_fetch_assoc(mysqli_query($connection, $query));
if ($result) {
return $result['subscr_id'];
} 
}
catch (Exception $e)
{ echo $e->getMessage(); }
}


function checkPlanExist($plan_id)
{

try {
$connection = Database::connect();
if (!$connection) {
die('Error:' . mysqli_connect_error());
}
$query = "select *  from  subscribtions where subscr_id =$plan_id";
$result = mysqli_fetch_assoc(mysqli_query($connection, $query));
if ($result) {
return 1;
} 
 else 
 {
 	return -1;
 }
}
catch (Exception $e)
{ echo $e->getMessage(); }

}

}