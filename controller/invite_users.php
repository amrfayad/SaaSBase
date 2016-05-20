<?php

    include_once './model/User.php';
    $admin_email=$_POST['data']['admin_email'];
    $invited_emails = $_POST['data']['invited_emails'];
    $emails = explode("\n", $invited_emails);
    $user = new User();
    $admin_id = $user->admin_id($admin_email);
    $team_id = $user->team_id($admin_id);
    $counter=0;
    $json= array();
    while($counter < count($emails)){
       // echo $emails[$counter];
        #if($emails[$counter]==null){$counter=-1;}
        $is_email_exists = $user->check_mail($emails[$counter]);
        if($is_email_exists==0){
            $json['admin_email']=$admin_email;
//            $json['id']=$admin_id;
            $json['team_id']=$team_id;
            $json['invited_email']=$emails[$counter];
            $json['Status']="Sign up";
            $list_of_invites[]=$json;
        }
        else{
            $json['admin_email']=$admin_email;
//            $json['id']=$admin_id;
            $json['team_id']=$team_id;
            $json['invited_email']=$emails[$counter];
            $json['Status']="Log in";
            $list_of_invites[]=$json;
        }
        $counter++;
}
//$user_invite = $user->invite($email,$admin_id);
print_r($list_of_invites);
?>