<?php
$title = "Featured products ||Demo Shop";
$asset = "";
$dir = "uploads/";
include("inc/header.php");
?>
<section id="featuredpro">
    <div class="container text-center">
        <h4 class="my-3 page-title"><span>Featured Products</span></h4>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block">
                <?php include("inc/sidebar.php") ?>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="row page_product">
                    <?php 
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