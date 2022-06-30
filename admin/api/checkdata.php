<?php
    include ("../php/auto.php");
    $db = new classes\Database;
    $name = $_POST['catname'];
    $chname = $db->rnQuery("SELECT * FROM `category` WHERE `name`='$name'");
    $rows = mysqli_num_rows($chname);
    if($rows > 0){
        echo 'false';
    }else{
        echo 'true';

    }