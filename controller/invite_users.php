<?php
#AyaEMahmoud
    include_once './model/User.php';
    $admin_email=$data['admin_email'];
    $invited_emails = $data['invited_emails'];
    $emails = explode("\n", $invited_emails);
    $user = new User();
    $admin_id = $user->admin_id($admin_email);
    $team_id = $user->team_id($admin_id);
    $counter=0;
    $json= array();
    while($counter < count($emails)){
       $is_email_exists = $user->check_mail($emails[$counter]);
        if($is_email_exists==0){
            $json['admin_email']=$admin_email;
            $json['team_id']=$team_id;
            $json['invited_email']=$emails[$counter];
            $json['Status']="Sign up";
            $list_of_invites['signup'][]=$json;
        }
        else{
            $json['admin_email']=$admin_email;
            $json['team_id']=$team_id;
            $json['invited_email']=$emails[$counter];
            $json['Status']="Log in";
            $list_of_invites['login'][]=$json;
        }
        $counter++;
}
    echo json_encode($list_of_invites);
?>