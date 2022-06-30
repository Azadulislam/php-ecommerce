<?php
    $id = $logindata['id'];
    $product = $db->getTableData('product','seller',$usrdata['id']);
    $proRows = mysqli_num_rows($product);

    $classicproduct = $db->getTableData('classicproduct','seller',$usrdata['id']);
    $clssProRows = mysqli_num_rows($classicproduct);

    // $cart = $db->getTableData('cart','user',$usrdata['id']);
    // $cartcount = mysqli_num_rows($cart);


    

    $blogs = $db->getTableData('blogs','bloger',$usrdata['id']);
    $blogcount = mysqli_num_rows($blogs);


    $allorders = $db->getTableData('orders','user_id',$usrdata['id']);


    


    
    //$blogcount = mysqli_num_rows($blogs);



    


    $alldistrict = $db->getActiveData('district');
    $countdistrict = count($alldistrict);