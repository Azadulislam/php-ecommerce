<?php
    $loc = "../";
    $adloc = "../";
    include ("../php/auto.php");
    if(isset($_POST['action'])){
        if($_POST['action'] == 'saveReview'){
            $save = $review->addNew($_POST);
            if($save == 1){
                exit(json_encode(array('status'=>1)));
            }
        }
    }
?>