<?php

/*
desc invoices;
+-------------------+-------------+------+-----+---------+-------+
| Field             | Type        | Null | Key | Default | Extra |
+-------------------+-------------+------+-----+---------+-------+
| invoice_id        | int(11)     | NO   | PRI | NULL    |       |
| subscr_name       | varchar(45) | YES  |     | NULL    |       |
| other_information | longtext    | YES  |     | NULL    |       |
| teams_team_id     | int(11)     | NO   | PRI | NULL    |       |
+-------------------+-------------+------+-----+---------+-------+
4 rows in set (0.00 sec)

 * 
 *  */
include_once 'Database.php';
class Invoices{
    
    function getAllInvoices($team_id)
    {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: in connection Team');
            }
            $query = "select subscr_name, other_information from invoices where teams_team_id= $team_id";
            $result = mysqli_query($conection, $query);
            $a = array();
            while ($row = mysqli_fetch_assoc($result)) {
                  $a[] = $row;
                  
            }
            return $a;
             
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    function addPayment($subscrName,$team_id,$others)
    {
        
        
     try {

            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  userCreate');
            }
                $args = func_get_args();
            if (func_num_args() == 3) {
                $query = "insert into invoices (subscr_name ,teams_team_id,other_information)
                 values ('" . $args[0] . "'," . $args[1] . ",'" . $args[2] . "')";
            } else
            $query = "insert into invoices (subscr_name ,teams_team_id)
                 values ('" . $args[0] . "'," . $args[1] . ")";
            mysqli_query($conection, $query);
        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }
    
    
    }
    

