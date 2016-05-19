<?php
		header("Access-Controll-Allow-Origin: *");
		/*$hash = $_POST['hash'];
        $data = $_POST['data'];
        $key = "1234";
        $test = $data['action'].''.$data['email'].''.$data['pass'].''.$key;
        $mydata = md5($test);*/
        /*if($hash == $mydata)
        {
         if(isset($data['action']))
         {
			include 'controller/'.$data['action'].'.php';
	 	 }
        }*/
		if(isset($_POST['data']['action']))
         {
			include 'controller/'.$_POST['data']['action'].'.php';
			 //echo $_POST['data']['action']);
	 	 }
        
?>