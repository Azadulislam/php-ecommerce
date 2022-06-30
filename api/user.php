<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-headers: Access-Control-Allow-headers, Content-Type, Access-Control-Allow-Methons, Authorization, X-Requested-with');
    $loc = "../";
    $adloc = "../";
    include ("../php/auto.php");
    $data = json_decode(file_get_contents("php://input"),true);
    $usr = new classes\Userc;
    if(isset($data['registration'])){
        $insusr = $usr->insUsr($data);
        if(isset($usr->err)){
            echo ($usr->err);
        }
    }elseif(isset($data['login'])){
        $usr->login($data);
        if(isset($usr->err)){
            echo $usr->err;
        }
    }elseif(isset($data['send'])){
        $login = $usr->sendEmail($data);
        if(isset($usr->err)){
            echo $usr->err;
        }
    }elseif(isset($data['resetpwd'])){
        $login = $usr->changPassword($data);
        if(isset($usr->err)){
            echo $usr->err;
        }
        if(isset($usr->suc)){
            echo $usr->suc;
        }
    }

?>