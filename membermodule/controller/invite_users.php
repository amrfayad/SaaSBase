<?php
#AyaEMahmoud
    include_once './models/User.php';
    $admin_email=$data['admin_email'];
    $admin_password=sha1($data['admin_password']);
    $invited_emails = $data['invited_emails'];
    $emails = explode("\n", $invited_emails);
    $user = new User();
    $response =array();
    $list_of_invites = array();
    $is_admin=$user->check_admin($admin_email,$admin_password);
    if($is_admin == 1)
    {
        
        $admin_id = $user->admin_id($admin_email);
        $team_id = $user->team_id($admin_id);
        $response['admin_eamil'] = $admin_email ;
        $response['team_id'] = $team_id ;
        
        $counter=0;
        $json= array();
        while($counter < count($emails))
        {
            $is_email_exists = $user->check_mail($emails[$counter]);
            $user->store_invited_users($emails[$counter],$team_id);
                if($is_email_exists==0){
                    $json['invited_email']=$emails[$counter];
                    $json['url']="signup";
                    $list_of_invites['signup'][]=$json;
                }
                else{
                    $json['invited_email']=$emails[$counter];
                    $json['url']="login";
                    $list_of_invites['login'][]=$json;
                }
                $counter++;
         }
         $response['status'] = 200;
         $response['emails'] = $list_of_invites;
     }
    else
    {
        $response['status'] = 400;
        $response['message'] = "Invalid Admin Information";
    }
    echo json_encode($response);
