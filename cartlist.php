<?php
$title = "Cartlist || Demo Shope";
$asset = "";
$dir = "uploads/";
$autoloc = "";
$adloc = "";
$fnloc = "";
include("inc/header.php");
$user = new classes\User;
if(isset($_GET['remove'])){
    foreach ($_SESSION['cart'] as $key => $value) {
        if($value['id']==$_GET['remove']){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
            echo "<script>window.location.href='cartlist.php'</script>";
        }else{
            echo "<script>window.location.href='cartlist.php'</script>";
        }
    }
}elseif(isset($_GET['removeAll'])){
    unset ($_SESSION["cart"]);
    echo "<script>window.location.href='cartlist.php';</script>";
}
if(isset($_POST['logintobuy'])){
    $login = $user->customerLogin($_POST);
    if($login == 1){
        $loginauth = $user->lauth;
        $date      = date('Y-m-d',time());
        $mdate     = date('D, d M Y H:m:s',strtotime($date. ' + 15 days'));
        echo "<script>document.cookie = 'customer=$loginauth; expires=$mdate UTC; path=/';</script>";
        ?>
            <script>window.location.href="address.php";</script>
        <?php
    }
}
                 
?>        
<section id="cartlist" class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <?php
                    if(isset($user->err)){
                        ?><div class="alert alert-danger text-center"><?= $user->err ?></div><?php
                    }elseif(isset($user->suc)){
                        ?><div class="alert alert-success  text-center"><?= $user->suc ?></div><?php
                    }
                ?>
            </div>
        </div>
        <div id="maindiv" class="row">
            <?php  
            if(isset($_GET['pbuy'])){
                if(isset($_COOKIE['customer'])){
                    echo "<script>window.location.href='address.php'</script>";
                }else{
                    include_once ("templates/_login.php");
                }
            }else{
                include_once ("templates/_cl.php");
            }
        ?>
        </div>
    </div>
</section>
<?php
include("inc/footer.php");
?>