<?php 
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Headers,Authorization,X-Requested-with");
    $adloc = "../";
    include_once ('../php/auto.php');
    $blog = new classes\Blog;
    $data = json_decode(file_get_contents("php://input"),true);
    // echo $data['id'];
    if(isset($data['id'])){
        $category = $blog->geteditabledata($data);
        print_r(json_encode($category)) ;
    }elseif(isset($data['catid'])){
        $id = $data['catid'];
        $sCategory = $db->rnQuery("SELECT * FROM `sub_category` WHERE `cat`='$id' AND `status`='1'");
        if($sCategory == true){
            $array = mysqli_fetch_all($sCategory,MYSQLI_ASSOC);
            echo json_encode($array);
        }else{
            $array[0] = array("id"=>"0","name"=>"No sub category");
            echo json_encode($array);
        }
    }
?>