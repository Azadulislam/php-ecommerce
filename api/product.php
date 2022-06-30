<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-headers: Access-Control-Allow-headers, Content-Type, Access-Control-Allow-Methons, Authorization, X-Requested-with');
    $loc = "../";
    $adloc = "../";
    include ("../php/auto.php");
    $data = json_decode(file_get_contents("php://input"),true);
    $pro = new classes\Product;
    if(isset($data['cstatus'])){
        $id = $data['id'];
        $uppro = $pro->updateStatus($id);
    }

?>