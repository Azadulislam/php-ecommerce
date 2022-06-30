<?php
$title = "Payment || Demo Shop";
$asset = "";
$adloc = "";
$dir = "uploads";

include ("inc/header.php");
if(isset($_GET['order'])){
    $orderid = $_GET['order'];
    if(isset($_COOKIE['customer'])){
    $selectpr = $db->rnQuery("SELECT * FROM `order_details` WHERE `order_id`='$orderid'");
    if(mysqli_num_rows($selectpr)>0){
    $dic     = 0;
    $total   = 0;
    while ($product = mysqli_fetch_assoc($selectpr)) {
        $dic   += $product['discount']; 
        $total += $product['price'];
    }
    $cartamount = ($total-$dic)*100;
    global $cartamount;
    include ("php/stripe-conf.php");
?>

<section id="buye_product">
    <div class="container py-5">
        <?php if(isset($_GET['order-placed'])){ ?>
        <div class="text-success text-center"><h3>Your order has been placed successfully</h3></div>
        <?php }else{ ?>
        <h5 class="bg-theme text-white text-center font-weight-normal py-2">Payement with</h5>
        <div class="border p-3">
            <div class="row">
                <div class="col-sm-6 border-right">
                    <?php
                    if(isset($order->err)){
                        ?><div class="alert alert-warning"><?= $order->err ?></div><?php
                    }
                    ?>
                    <div class="sheeping pb-2">
                        <form action="php/pay_submit.php" class="mr-auto" method="post">
                            <input type="hidden" name="order_id" value="<?= $orderid ?>">
                            <script <?= isset($_COOKIE['customer'])?'data-email="'.$email.'"':'' ?> src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                            data-key="<?php echo $publishkey; ?>"
                            data-amount="<?php echo $cartamount; ?>" 
                            data-name = "<?= $name ?>"
                            data-description = "Payment for product";
                            data-image="https://www.humanrightslogo.net/sites/default/files/HRLogoCMYKsmallRGB.png"
                            data-currency="usd"></script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        
    </div>
</section>
<?php 
    }else{
        echo "<script>window.location.href='cartlist.php?no-product'</script>";
    }
    }else{
        echo "<script>window.location.href='cartlist.php?no-user'</script>";
    }
}else{
    echo "<script>window.location.href='address.php'</script>";
}
include ("inc/footer.php");
?>