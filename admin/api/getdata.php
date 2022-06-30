<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin:*");
    include ('../php/auto.php');

    $db= new classes\Database();
    $data = $db->selectall("SELECT * FROM `category`");
    if(isset($db->err)){
        echo json_encode(array('message'=>$db->err,'status'=>false));
    }else{
        echo json_encode($data);
    }

?>