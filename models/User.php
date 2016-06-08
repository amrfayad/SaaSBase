<?php
/*
  desc users;
  +-----------------------+--------------+------+-----+---------+----------------+
  | Field                 | Type         | Null | Key | Default | Extra          |
  +-----------------------+--------------+------+-----+---------+----------------+
  | user_id               | int(11)      | NO   | PRI | NULL    | auto_increment |
  | user_name             | varchar(45)  | YES  |     | NULL    |                |
  | user_email            | varchar(45)  | YES  |     | NULL    |                |
  | password              | varchar(100) | YES  |     | NULL    |                |
  | reset_password_token  | varchar(100) | YES  |     | NULL    |                |
  | token_expiration_date | time         | YES  |     | NULL    |                |
  | user_profile_info     | longtext     | YES  |     | NULL    |                |
  +-----------------------+--------------+------+-----+---------+----------------+
  7 rows in set (0.01 sec)
 */
include_once 'Database.php';
include_once 'Team.php';
class User {
    function login($email) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error: ' . mysqli_connect_error());
            }
            $query = "select * from users where user_email = '$email'";
            $result = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($result))
            {
                return $row;
            }
            return -1;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return -1;
    }
    function check_mail($email) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error:' . mysqli_connect_error());
            }
            $query = "select user_id from users where user_email='$email'";
            $name = mysqli_fetch_assoc(mysqli_query($connection, $query));
            if ($name) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
#AyaEMahmoud
    function signUp() {

        try {

            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  userCreate');
            }
                $args = func_get_args();
            if (func_num_args() == 4) {
                $query = "insert into users(user_name,user_email,password,user_profile_info)
                 values ('" . $args[0] . "','" . $args[1] . "','" . $args[2] . "','" . $args[3] . "')";
            } else
                $query = "insert into users(user_name,user_email,password) values ('" . $args[0] . "','" . $args[1] . "','" . $args[2] . "')";
            mysqli_query($conection, $query);
        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }
    function admin_id($admin_email) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error:' . mysqli_connect_error());
            }

            $query = "select user_id from users where user_email='$admin_email'";
            $admin_id = mysqli_fetch_assoc(mysqli_query($connection, $query));
            if ($admin_id) {

                return $admin_id['user_id'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
#AyaEMahmoud
    function team_id($admin_id) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error:' . mysqli_connect_error());
            }
            $query = "select team_id from teams where users_user_id='$admin_id'";
            $team_id = mysqli_fetch_assoc(mysqli_query($connection, $query));
            if ($team_id) {
                return $team_id['team_id'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
#AyaEMahmoud
    function invite($email) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error:' . mysqli_connect_error());
            }
            $query = "select user_name from users where user_email='$email'";
            $names = mysqli_query($connection, $query);
            while ($name = mysqli_fetch_assoc($names)) {
                return "Login Form" . $name;
            }
            return "Sign up Form";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    #AyaEMahmoud
    function getUserId($email, $password) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "select user_id from users where user_email='$email' and password='$password'";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                return $row['user_id'];
            }
            return -1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    function CheckMail($email) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection return user id');
            }
            $query = "SELECT * FROM users where user_email='" . $email . "'";
            $result = mysqli_query($conection, $query);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows >= 1) {
                return 1;
            } else {
                return -1;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    function getUserProfile($user_id) {
        try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection  return user id');
            }
            $query = "SELECT user_name , user_email ,user_profile_info  FROM users where user_id='" . $user_id . "'";
            $result = mysqli_query($conection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    function checkTeamAdminPassword($admin_password,$admin_id) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error: ' . mysqli_connect_error());
            }

            $query = "select password from users where password = '$admin_password' and user_id = '$admin_id'";
            $result = mysqli_fetch_assoc(mysqli_query($connection, $query));

            if ($result) {
                return 1;
            }
            else {
                return -1;
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function set_token($email, $date, $token) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "update  users set reset_password_token = '$token'," .
                    " token_expiration_date = '$date'" .
                    "WHERE user_email = '$email'";
            $result = mysqli_query($connection, $query);
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
#AyaEMahmoud
    function check_token($token) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "select token_expiration_date from users WHERE reset_password_token = '$token'";
            $return_expiration_date = mysqli_fetch_assoc(mysqli_query($connection, $query));
            return $return_expiration_date['token_expiration_date'];
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
#AyaEMahmoud
    function get_token($email) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "select reset_password_token from users WHERE user_email = '$email'";
            $return_token = mysqli_fetch_assoc(mysqli_query($connection, $query));
            return $return_token['reset_password_token'];
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }#AyaEMahmoud

    function check_admin($admin_email, $admin_password) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "select user_name from users WHERE user_email= '$admin_email' And password='$admin_password'";
            $return = mysqli_fetch_assoc(mysqli_query($connection, $query));
            if($return)
            {
                return 1;
            }
                
            return -1 ;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
#AyaEMahmoud
    function check_password($email) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "select password from users WHERE user_email = '$email'";
            $query2 = "update  users set reset_password_token = ''" .
                    " WHERE user_email = '$email'";
            $password = mysqli_fetch_assoc(mysqli_query($connection, $query));
            mysqli_query($connection, $query2);
            return $password['password'];
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

#AyaEMahmoud

    function change_password($email, $password) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "update  users set password = '$password'" .
                    " WHERE user_email = '$email'";
            $result = mysqli_query($connection, $query);
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
#AyaEMahmoud

    
    function get_token_expiration_date($email) {
        
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error in connection  return user id');
            }
            $query = "select token_expiration_date from users WHERE user_email = '$email'";
            $return_expiration_date = mysqli_fetch_assoc(mysqli_query($connection, $query));
            return $return_expiration_date['token_expiration_date'];
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function store_invited_users($email,$team_id) {
        try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error:' . mysqli_connect_error());
            }

            $query = "INSERT INTO `invitedUsers` (`user_email`,`teams_team_id`) VALUES ('$email','$team_id')";
            $result =  mysqli_query($connection, $query);
           return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

#AyaEMahmoud



function assignDefaultRole($user_id,$team_id)
{
 try {
            $connection = Database::connect();
            if (!$connection) {
                die('Error:' . mysqli_connect_error());
            }
            $defaultRoleId=1;
            $query = "INSERT INTO role_has_users_in_teams (role_id,users_in_teams_user_id,users_in_teams_team_id)
              VALUES ( $defaultRoleId,$user_id,$team_id)";
            $result =  mysqli_query($connection, $query);
           return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

}


function checkUserExist($user_id)
{

try {
            $conection = Database::connect();
            if (!$conection) {
                die('Error in connection return user id');
            }
            $query = "SELECT * FROM users where user_id= $user_id";
            $result = mysqli_query($conection, $query);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 1) {
                return 1;
            } else {
                return -1;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

}

}
