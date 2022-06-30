<?php
$title = "Order success || Demo Shop";
$asset = "";
$adloc = "";
$dir = "uploads";

include ("inc/header.php");

    if(isset($_COOKIE['customer'])){
    include ("php/stripe-conf.php");
?>

<section id="buye_product">
    <div class="container py-5">
        <?php if(isset($_GET['order-placed'])){ ?>
        <div class="text-success text-center"><h3>Your order has been placed successfully</h3></div>
        <?php }else{ ?>
        <h5 class="bg-theme text-white text-center font-weight-normal py-2">Order</h5>
        <div class="border p-3">
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="sheeping pb-2 text-success">
                        <?php 
                            if(isset($_GET['order-success'] )){
                                if($email = $_GET['order-success']){
                        ?>
                        <p class="mb-0">Hi <b><?= $name ?>,</b></p>
                        <p class="mv-0">Your order hase been plesed successfully</p>
                        <p class="mv-0 text-dark">To see your order click <a href="order-list">Here</a></p>
                        <?php
                                }
                            }elseif($_GET['order-error']){
                        ?>
                        <p clas="text-danger">Somthing Wrong conatact with administrator</p>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        
    </div>
</section>
<?php 
    }else{
        echo "<script>window.location.href='cartlist.php'</script>";
    }

include ("inc/footer.php");
?>