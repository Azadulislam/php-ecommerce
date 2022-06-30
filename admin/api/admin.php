<?php
    header("Content-Type:Aplication/json");
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Method,Content-Type,Authorization,X-Requested-With");
    $data = json_decode(file_get_contents("php://input"),true);
    include_once ("../php/auto.php");
    $admin = new classes\Admin;

    if(isset($data['admin_login'])){
        $login = $admin->login($data);
        if($login == 1){
            echo json_encode(array('res'=>$login,'user'=>$data['username'],'status'=>true)) ;
        }else{
            echo json_encode(array('res'=>$login,'status'=>false)) ;
        }
    }
?>