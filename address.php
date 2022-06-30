<?php
$title = "Address book || Demo Shop";
$asset = "";
$adloc = "";
$dir = "uploads";

include ("inc/header.php");
if(isset($_POST['procced'])){
    $addorder = $order->addOrder($_POST,$_SESSION['cart']);
    if($addorder == 1){
        unset($_SESSION['cart']);
        echo "<script>window.location.href='payment.php?order=".$order->orderid."'</script>";
    }
}
if(!empty($_SESSION['cart'])){
if(isset($_COOKIE['customer'])){
    $cartamount = 0;
    $total      = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $total += $value['price'];
        $cartamount = $total*100;
        global $cartamount;
    }
?>

<section id="buye_product">
    <div class="container py-5">
        <h5 class="bg-theme text-white text-center py-2">Address book </h5>
        <form class="border p-3" action="" method="POST">
            <div class="row">
                <div class="col-sm-6 border-right">
                    <?php
                        if(isset($order->err)){
                            
                            ?><div class="alert alert-warning"><?= $order->err ?></div><?php
                        }
                    ?>
                    <div class="sheeping pb-2">
                        <h5>Shepping address</h5>
                        <label for="phone">Phone number</label>
                        <input type="number" class="form-control py-1 px-2 mb-1" id="phone" name="phone" placeholder="Enter your Phone number" required>
                        <label for="district">District</label>
                        <select class="form-control py-1 px-2 mb-1" name="district" id="district" required>
                            <option value="">--Select District--</option>
                            <?php 
                                foreach($alldistrict as $distric){
                            ?>
                            <option value="<?= $distric['id'] ?>"><?= $distric['name'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="postCode">Post code</label>
                        <input type="text" class="form-control py-1 px-2 mb-1" id="postCode" name="postCode" placeholder="Enter post code"  required>
                        <label for="address">Address</label>
                        <input type="text" class="form-control py-1 px-2 mb-1" id="address" name="address" placeholder="Enter sheeping address" required>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center">
                <input type="hidden" name="user" value="<?= $usrdata['id'] ?>">
                <button type="submit" name="procced" class="btn btn-theme my-3">Procced to pay</button>
            </div>
        </form>
    </div>
</section>
<?php 
}else{
    echo "<script>window.location.href='cartlist.php'</script>";
}
}else{
    echo "<script>window.location.href='cartlist.php'</script>";
}
include ("inc/footer.php");
?>