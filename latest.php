<?php
$title = "latest product || Demo Shop";
$asset = "";
$dir   = "uploads/";
include("inc/header.php");
?>
<section id="latest">
    <div class="container text-center">
        <h4 class="my-3 page-title"><span>Latest Product</span></h4>
        <div class="row">
            <div class="col-md-3">
                <?php include("inc/sidebar.php") ?>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php 
                        $latest = $db->rnQuery("SELECT * FROM `product` WHERE `latest`=1 ORDER BY `id` DESC");
                        $allpro = mysqli_fetch_all($latest, MYSQLI_ASSOC);
                        shuffle($allpro);
                        foreach($allpro as $item){
                            $discount = $item['discount'];
                            $price = $item['price']/100;
                            $dic_price = number_format($price*$discount,0 , '.', '');
                            $slleprice = $item['price'] - $dic_price;
                    ?>
                    <div class="col-6 col-lg-3 my-2">
                        <?php include ("templates/_product.php"); ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("inc/footer.php");
?>