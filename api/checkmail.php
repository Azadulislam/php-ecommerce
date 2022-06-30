<?php
    
    $adloc = "../";
    $autoloc = "../";
    include ("../php/auto.php");
    $db = new classes\Database;
    $email = $_REQUEST['email'];
    $query = "SELECT * FROM `user` WHERE `email`='$email'";
    $chkmail = $db->rnQuery($query);
    $rows = mysqli_num_rows($chkmail);
    if( $rows == 0){
        echo 'true';
    }else{
        echo "false";
    }
?>