<?php
include_once './config/config.php';
header("Access-Controll-Allow-Origin: *");   // To Accept Ajax Request
// chek if the request paramaters is valid
if (null !== filter_input(INPUT_GET, 'module')) {
    $module = filter_input(INPUT_GET, 'module') ;
    if (null !== filter_input(INPUT_POST, 'hash') && null !== filter_input(INPUT_POST, 'data')) {
        // get data from Request
        $hashed = filter_input(INPUT_POST, 'hash');
        // get hashed data from reaquest
        $data = json_decode(filter_input(INPUT_POST, 'data'), TRUE);
        // api key that generated  to saasAplication Developper
        $key = $config['key'];
        // add api key to data array
        $data['key'] = $key;
        // chek if data and hash is equevilent
        if (md5(implode("", $data)) == $hashed) {
            // include controller base on equest
            include $module."module/controller/" . $data['action'] . '.php';
        } else {
            header("Bad Request", true, 400);
            $response = array();
            $response['message'] = 'Invalid Request';
            echo json_encode($response);
        }
    } else {
        header("Bad Request", true, 400);
        $response = array();
        $response['message'] = 'Invalid Request';
        echo json_encode($response);
    }
}
?>
