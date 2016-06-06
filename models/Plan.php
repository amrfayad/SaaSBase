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

}