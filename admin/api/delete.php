<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin:*");    
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With");
    include ("php/Database.php");
    
    $input = json_decode(file_get_contents("php://input"),true);
    $s_id = $input['obj'];
    $db= new classes\Database();
    $insdata = $db->insert("DELETE FROM `user` WHERE `id`='{$s_id}'");
    if($insdata == true){
        echo json_encode(array('message'=>'Deleted','status'=>true));
    }else{
        echo json_encode(array('message'=>'notDeleted','status'=>false));

    };

?>