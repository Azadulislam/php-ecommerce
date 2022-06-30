<?php 
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Headers,Authorization,X-Requested-with");
    include_once ('../php/auto.php');
    $data = json_decode(file_get_contents("php://input"),true);
    if(isset($data['id'],$data['action'])){
        $update = $product->updateRollStatus($data);
        if($update == 1){
            $res = array('mess'=>"Updated successfully",'status'=>'1');
        }else{
            $res = array('mess'=>"Someting wrong",'status'=>'0');

        }
        echo json_encode($res);
    }
?>