<?php
		header("Access-Controll-Allow-Origin: *");
		if(isset($_POST['data']['action']))
         {
			include 'controller/'.$_POST['data']['action'].'.php';
			 //echo $_POST['data']['action']);
	 	 }
        
?>