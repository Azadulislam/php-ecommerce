<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with'");

    $adloc = "../";
    include ("../php/auto.php");
    $data = json_decode(file_get_contents("php://input"),true);
    if(isset($data['id'])){
        $id = $data['id'];
        $products = $db->getTableData('product','category',$id);
        $product = mysqli_fetch_all($products, MYSQLI_ASSOC);
        echo json_encode($product);
    }
?>