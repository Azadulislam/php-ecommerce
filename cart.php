<?php
session_start();
$dir = "uploads/";
$autoloc = "";
$adloc = "";
include "php/auto.php";
if (isset($_POST['plus']) && isset($_POST['pid'])){
    if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $key => $value){
            if($_POST['pid']==$value['id']){
                $upQty = $value['qty']+1;
                $item = array(  
                    'id'     =>$value['id'],
                    'name'   =>$value['name'],
                    'image'  =>$value['image'],
                    'qty'    =>$upQty,
                    'dic'    =>$_POST['discount']*$upQty,
                    'price'  =>$value['price']+$_POST['price'],
                );
                print_r($item);
                $_SESSION['cart'][$key]= $item;
                
            }
        }
    }
}elseif (isset($_POST['min']) && isset($_POST['pid'])){
    foreach ($_SESSION['cart'] as $key => $value){
        if($_POST['pid']==$value['id']){
            if($value['qty']>1){
                $upQty = $value['qty']-1;
                $item = array(  
                    'id'     =>$value['id'],
                    'name'   =>$value['name'],
                    'image'  =>$value['image'],
                    'qty'    =>$upQty,
                    'dic'    =>$_POST['discount']*$upQty,
                    'price'  =>$value['price']-$_POST['price'],
                );
                $_SESSION['cart'][$key]= $item;
            }
        }
    }
}elseif (isset($_POST['clear_all_cart'])){
    $unset = $wishlist->delete_cart();
    echo "Success";
}