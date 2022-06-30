<?php
    include ("../php/auto.php");
    $cat = new classes\Category;
    $name = htmlentities($_REQUEST['catname']);
    $chname = $cat->checkSubName($name);
    if($chname == true){
        echo "false";
    }else{
        echo "true";
    }