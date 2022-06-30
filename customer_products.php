<?php
$title   = "Customer products || Demo Shop";
$asset   = "";
$adloc   = "";
$autoloc = "";
$dir     = "uploads/";
include("inc/header.php");
?>
<section id="customerpro">
    <div class="container text-center">
        <h4 class="my-3 page-title"><span>classified products</span></h4>
        <div class="row my-4">
            <div class="col-md-3">
                <?php include("inc/sidebar.php") ?>
            </div>
            <div class="col-md-9 ">
                <div class="row mb-5">
                    <?php 
                        foreach($allclassifiedpro as $item){
                            $sellerid = $item['seller'];
                            $seller     = $db->getSingle('user','id',$sellerid);
                            $sellerName = $seller['fname'];
                    ?>
                    <div class="col-md-3">
                        <div class="product">
                            <a href="view-classified.php?view=<?= $item['id'] ?>&classified">
                                <div class="prdimg">
                                    <div class="view"></div>
                                    <div class="imgmdlbtn">
                                        <span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span>
                                    </div>
                                    <img class="img-fluid" src="<?= $dir.$item['image'] ?>" alt="Procudt image">
                                </div>
                            </a>
                            <div class="prdct-desc text-center">
                                <p class="prdct-name text-capitalize">
                                    <?= $item['name'] ?>
                                </p>
                                <p class="prc m-0"><span class="reg">&dollar;<?= $item['price'] ?></span></p>
                                <p href="#" class="shopname py-1 text-capitalize d-block">seller: <?= $sellerName ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <hr>
                <div class="col-12">
                    <div class="pagetooter">
                        <ul class="pgntn">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("inc/footer.php");
?>