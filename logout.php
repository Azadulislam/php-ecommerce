<?php
    $loc = "";
    include("php/auto.php");
    $usr = new classes\Userc;

    if(isset($_GET['logout'])){
        $usr->logoutUsr($_GET);
    }
?>