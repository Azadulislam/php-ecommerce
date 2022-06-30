<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with'");

    $adloc = "../";
    include ("../php/auto.php");
    $blog = new classes\Blog;
    $data = json_decode(file_get_contents("php://input"),true);
    if(isset($data['cStatus'])){
        $id = $data['id'];
        $blog->updateStatus($id);
        if(isset($blog->err)){
            echo $blog->err;
        }

    }
?>