<?php
    include ("../php/auto.php");
    $pro = new classes\Product;
    $name = $_POST['pname'];
    $chnm = $pro->checkName($name);
    if($chnm == true){
        echo 'false';
    }else{
        echo 'true';

    }