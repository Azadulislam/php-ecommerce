<?php 
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Headers,Authorization,X-Requested-with");
    include_once ('../php/auto.php');
    $data = json_decode(file_get_contents("php://input"),true);
    if(isset($data['subcatid'],$data['catid'])){
        $cat = $data['catid'];
        $subCat = $data['subcatid'];
        $select = $db->rnQuery("SELECT * FROM `brands` WHERE `status`='1' AND `category`='$cat' AND `sCategory`='$subCat'");
        $result = mysqli_fetch_all($select,MYSQLI_ASSOC);
        echo json_encode($result);
    }
?>