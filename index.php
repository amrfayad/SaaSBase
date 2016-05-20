<?php
header("Access-Controll-Allow-Origin: *");
if(null !== filter_input(INPUT_POST, 'hash') && null !== filter_input(INPUT_POST, 'data'))
{
    $hashed = filter_input(INPUT_POST, 'hash' ) ; 
    $data   = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $key = 'e10adc3949ba59abbe56e057f20f883e';
    $data['key'] = $key;
    if(md5(implode("",$data)) == $hashed)
    {
        include 'controller/' . $data['action'] . '.php';
    }
    else
    {
        header("Bad Request", true, 400 );
		echo 'Test';
    }
}
else
{
        header("Bad Request", true, 400 );
}
?>