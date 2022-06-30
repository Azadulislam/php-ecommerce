<?php

$title = "Home || Demo Shop";

$asset = "";

$dir = "uploads/";

include("inc/header.php");
$slectImages = $db->rnQuery("SELECT * FROM `images`");
$image = mysqli_fetch_assoc($slectImages);

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        //$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    //whether ip is from the proxy  
    // elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
    //     $ip = $_SERVER['HTTP_CLIENT_IP'];  
    //  }  
//whether ip is from the remote address  
    // else{  
    //         $ip = $_SERVER['REMOTE_ADDR'];  
    //  }  
    //return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$_SERVER['HTTP_X_FORWARDED_FOR']."<br>"; 
// echo 'User Real IP Address - '.$_SERVER['HTTP_CLIENT_IP']."<br>"; 
// echo 'User Real IP Address - '.$_SERVER['REMOTE_ADDR']."<br>"; 

?>

<section id="home">

    <div class="container py-3">

        <div class="row">

            <div class="col-md-3 pr-0 d-xl-block d-none">

                <aside class="sidemenu">

                    <ul class="homesildernav list-unstyled mb-0">

                        <?php

                            $selcategory = $db->rnQuery("SELECT * FROM `category` WHERE `status`='1' LIMIT 0,10");

                            while ($item = mysqli_fetch_assoc($selcategory)) {

                                $cateid = $item['id'];

                                $allSubcategory = $db->rnQuery("SELECT * FROM `sub_category` WHERE `cat`='$cateid' AND `status`='1'");

                                $subCatcount = mysqli_num_rows($allSubcategory);

                                ?>

                                <li class="nvlist"><a href="search.php?category=<?= $cateid ?>&main"><?= $item['name'] ?></a><i class="fas fa-angle-right"></i>

                                    <div class="hobdiv">

                                        <div class="row">

                                            <div class="col-md-8">

                                                <div class="row">

                                                    <?php

                                                        if($subCatcount > 0){

                                                            while($sub = mysqli_fetch_assoc($allSubcategory)){

                                                                $subid = $sub['id'];

                                                                $allbrand = $db->rnQuery("SELECT * FROM `brands` WHERE `sCategory`='$subid' AND `status`='1'");

                                                                $brandcount = mysqli_num_rows($allbrand);

                                                    ?>

                                                    <div class="col-md-4">

                                                        <ul class="list-unstyled hovlist">

                                                            <a href="search.php?category=<?= $cateid ?>&sub" class=" font-weight-bold"><?= $sub['name'] ?></a>

                                                            <?php

                                                                if($brandcount>0){

                                                                    while($branditem = mysqli_fetch_assoc($allbrand)){

                                                                    ?><li><a href="search.php?brand=<?= $branditem['id'] ?>&product-brand"><?= $branditem['name'] ?></a></li><?php

                                                                    }

                                                                }

                                                            ?>

                                                        </ul>

                                                    </div>

                                                    <?php

                                                            }

                                                        }

                                                    ?>

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <img class="img-fluid" src="<?= $dir ?><?= $item['banner'] ?>" alt="category image">

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                <?php

                            }

                        if(mysqli_num_rows($selcategory) >9){

                            ?><li class="text-center"><a href="all_category.php"> More categoris <i class="far fa-plus-square ml-2"></i></a></li><?php

                        }

                        ?>

                        

                    </ul>

                </aside>

            </div>

            <div class="col-xl-9 pl-xl-0  h-100">

                <div class="homeslid">

                    <div class="owl-carousel owl_one owl-theme">

                        <?php

                            $allsliders = $db->getActiveData('slider');

                            foreach($allsliders as $key => $slider){

                               ?> 

                               <div class="item">

                                   <div class="owlimage">

                                       <img class="img-fluid" src="<?= $dir.$slider['image'] ?>" alt="Image">

                                   </div>

                               </div>

                               <?php

                            }

                        ?>

                    </div>

                    <button class="prv d-none d-md-block" id="prv_one"><i class="fas fa-chevron-left"></i></button>

                    <button class="nxt d-none d-md-block" id="nxt_one"><i class="fas fa-chevron-right"></i></i></button>

                </div>

            </div>

        </div>

    </div>

    <!-- <div id="addsec" class="pb-4">

        <div class="container">

            <div class="row">

                <div class="col-md-4 my-3" id="name">

                    <a class="d-block" href="#"><img class="" src="image\banner_1.jpg" alt="Add image"></a>

                </div>

                <div class="col-md-4 my-3">

                    <a class="d-block" href="#"><img class="" src="image\banner_1.jpg" alt="Add image"></a>

                </div>

                <div class="col-md-4 my-3">

                    <a class="d-block" href="#"><img class="" src="image\banner_1.jpg" alt="Add image"></a>

                </div>

            </div>

        </div>

    </div> -->

</section>

<!--=================== banner section end =========================-->

<!--=================== Deal proudct start =========================-->

<section id="dealProduct" class="py-4">

    <div class="container">

        <h4 class="title mb-4">

            <span>Todays Deal Products</span>

        </h4>

        <div class="row">

            <div class="col-md-12">

                <div class="owl-carousel owl_tow owl-theme">

                    <?php 

                        foreach($allpro as $item){
                            $slleprice = $control->selPrice($item['discount'],$item['price']);
                    ?>

                    <div class="item">

                        <div class="product">

                            <form action="" method="post">

                                <div class="leftbtn">

                                    <a class="btn rounded-0 leftbtn-item" data-toggle="tooltip" data-placement="right" title="Quike View" href="view-product.php?view=<?= $item['id'] ?>"><i class="fas fa-eye"></i></a>

                                    <!-- <a class="btn rounded-0 leftbtn-item" data-toggle="tooltip" data-placement="right" title="Add To Wishlist" href="#"><i class="fas fa-heart"></i></a>

                                    <a class="btn rounded-0 leftbtn-item" data-toggle="tooltip" data-placement="right" title="Compare" href="#"><i class="fas fa-exchange-alt"></i></a> -->

                                </div>

                                <div class="imagediv">

                                    <img class="img" src="<?= $dir.$item['image'] ?>" alt="Procudt image">

                                </div>

                                <div class="prdct-desc">

                                    <p class="prdct-name text-capitalize">

                                    <a class="text-dark" href="view-product.php?view=<?= $item['id'] ?>"><?= $item['name'] ?></a>

                                    </p>

                                    <div class="reting">

                                    <?php
                                        $id = $item['id'];
                                        $avg = $control->avarage($id);
                                        include ("./templates/_rating.php");
                                    ?>

                                    </div>

                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">

                                    <input type="hidden" name="name" value="<?= $item['name'] ?>">

                                    <input type="hidden" name="image" value="<?= $item['image'] ?>">

                                    <input type="hidden" name="price" value="<?= $item['price'] ?>">

                                    <input type="hidden" name="proQuantity" value="<?= $item['quantity'] ?>">
                                    <input type="hidden" name="discount" value="<?= $control->disP ?>">

                                    <input type="hidden" name="secid" value="#dealProduct">

                                    <p class="prc">
                                    <?php
                                    if($item['discount']!=0){ ?><span class="dic mr-2">&dollar;<?= $item['price'] ?></span><?php } ?><span class="reg">&dollar;<?= $slleprice ?></span></p>

                                    <button class="addtocart btn btn-block text-capitalize rounded-0" name="addToCart" type="submit"><i class="fas fa-shopping-cart mr-2"></i>  Add to cart </submit>

                                </div>

                            </form>

                        </div>

                    </div>

                    <?php

                        }

                    ?>

                </div>

                <button class="prv-tow d-none d-md-block">&lt;</button>

                <button class="nxt-tow d-none d-md-block">&gt;</button>

            </div>

        </div>

    </div>

</section>

<!--=================== Deal proudct end =========================-->

<!--=================== featured proudct start =========================-->

<section id="feturedPrdct" class="py-4">

    <div class="container">

        <h4 class="title mb-4">

            <span>latest featured Products</span>

        </h4>

        <div class="row prdct-slid">

            <div class="col-md-12">

                <div class="owl-carousel owl_three owl-theme">

                    <?php 

                        shuffle($allpro);

                        foreach( $allpro as $featureditem ){

                            $sellerid = $featureditem['seller'];

                            if(is_numeric($sellerid)){

                                $seller     = $db->getSingle('user','id',$sellerid);

                                $sellerName = $seller['lname'];

                            }else{

                                $sellerName = $sellerid;

                            }

                            $selprice = $control->selPrice($featureditem['discount'],$featureditem['price']);

                    ?>

                    <div class="item">

                        <div class="product">

                            <form action="" method="post">

                                <div class="prdimg">

                                    <?php if($featureditem['quantity'] > 0){ ?>

                                    <div class="cond bg-success">

                                        Avilable

                                    </div>

                                    <?php }else{ ?>

                                    <div class="cond bg-danger">

                                        out of stock

                                    </div>

                                    <?php } ?>

                                    <div class="view">

                                        <a href="view-product.php?view=<?= $featureditem['id'] ?>">

                                            <span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span>

                                        </a>

                                    </div>

                                    <div class="imagediv">

                                        <img class="img" src="<?= $dir.$featureditem['image'] ?>" alt="Procudt image">

                                    </div>

                                </div>

                                <div class="prdct-desc text-center">

                                    <p class="prdct-name text-capitalize">

                                        <a class="text-dark" href="view-product.php?view=<?= $featureditem['id'] ?>"><?= $featureditem['name'] ?></a>

                                    </p>

                                    <div class="reting">

                                    <?php
                                        $id = $featureditem['id'];
                                        $avg = $control->avarage($id);
                                        include ("./templates/_rating.php");
                                    ?>

                                    </div>

                                    <input type="hidden" name="id" value="<?= $featureditem['id'] ?>">

                                    <input type="hidden" name="name" value="<?= $featureditem['name'] ?>">

                                    <input type="hidden" name="image" value="<?= $featureditem['image'] ?>">

                                    <input type="hidden" name="price" value="<?= $featureditem['price'] ?>">

                                    <input type="hidden" name="proQuantity" value="<?= $featureditem['quantity'] ?>">
                                    <input type="hidden" name="discount" value="<?= $control->disP ?>">

                                    <input type="hidden" name="secid" value="#feturedPrdct">

                                    <p class="prc mb-0"><span class="dic mr-2">

                                        <?php if($featureditem['discount']!=0){ ?>&dollar;<?= $featureditem['price'] ?><?php } ?></span><span class="reg">&dollar;<?= $selprice ?></span>

                                    </p>

                                    <a class="shopname text-capitalize d-block"><?= $sellerName ?></a>

                                    <div class="footbtn py-2">

                                        <!-- <span class="compare footbtn-item" data-toggle="tooltip" title="Compare" title="Compare"><strong><i class="fas fa-exchange-alt"></i></strong></span> -->

                                        <!-- <span class="addwish footbtn-item" data-toggle="tooltip" title="Add to wishlist" title="Add to wishlist"><strong><i class="fas fa-heart"></i></strong></span> -->

                                        <button class="addcart footbtn-item" type="submit" name="addToCart" data-toggle="tooltip" title="Add to cart" title="Add to cart"><strong><i class="fas fa-shopping-cart"></i></strong></i></button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                    <?php



                        }

                    ?>

                </div>

                <button class="prv-three d-none d-md-block">&lt;</button>

                <button class="nxt-three d-none d-md-block">&gt;</button>

            </div>

        </div>

    </div>

</section>

<!--=================== featured proudct start =========================-->

<!--=================== bundel proudct start =========================-->

<section id="bundleprd" class="py-4">

    <div class="container">

        <h4 class="title mb-4">

            <span>Bundled Products</span>

        </h4>

        <div class="row prdct-slid">

            <div class="col-md-12">

                <div class="owl-carousel owl_four owl-theme">

                    <?php 

                        shuffle($allpro);

                        foreach( $allpro as $featureditem ){

                            $sellerid = $featureditem['seller'];

                            if(is_numeric($sellerid)){

                                $seller     = $db->getSingle('user','id',$sellerid);

                                $sellerName = $seller['lname'];

                            }else{

                                $sellerName = $sellerid;

                            }

                            $slleprice = $control->selPrice($featureditem['discount'],$featureditem['price']);

                    ?>

                    <div class="item">

                        <form action="" method="post">

                            <div class="product">

                                <div class="prdimg">

                                    <?php if($featureditem['discount'] > 0){ ?>

                                    <div class="cond bg-success">

                                        Discount <?= $featureditem['discount'] ?>%

                                    </div>

                                    <?php }elseif($featureditem['quantity'] > 0){ ?>

                                    <div class="cond bg-success">

                                        Avilable

                                    </div>

                                    <?php }elseif($featureditem['quantity'] == 0){ ?>

                                    <div class="cond bg-danger">

                                        Out of stock

                                    </div>

                                    <?php } ?>

                                    <div class="view"></div>

                                    <div class="imgmdlbtn">

                                        <a href="view-product.php?view=<?= $featureditem['id'] ?>">

                                            <span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span>

                                        </a>

                                        <!-- <span data-toggle="tooltip" title="Compare"><i class="fas fa-exchange-alt d-block"></i></span>

                                        <span data-toggle="tooltip" title="Add to wishlist"><i class="fas fa-heart d-block"></i></span> -->

                                    </div>

                                    <div class="imagediv">

                                    <img class="img" src="<?= $dir ?><?= $featureditem['image']??"default.jpg" ?>" alt="Procudt image">

                                    </div>

                                </div>

                                <div class="prdct-desc text-center">

                                    <p class="prdct-name text-capitalize">

                                    <a class="text-dark" href="view-product.php?view=<?= $featureditem['id'] ?>"><?= $featureditem['name'] ?></a>

                                    </p>

                                    <div class="reting">

                                    <?php
                                        $id = $featureditem['id'];
                                        $avg = $control->avarage($id);
                                        include ("./templates/_rating.php");
                                    ?>

                                    </div>

                                    <p class="prc mb-0">

                                        <span class="dic mr-2"><?php if($featureditem['discount']!=0){ ?>&dollar;<?= $featureditem['price'] ?><?php } ?></span>

                                        <span class="reg">&dollar;<?= $slleprice ?></span>

                                    </p>

                                    <input type="hidden" name="id" value="<?= $featureditem['id'] ?>">

                                    <input type="hidden" name="name" value="<?= $featureditem['name'] ?>">

                                    <input type="hidden" name="image" value="<?= $featureditem['image'] ?>">

                                    <input type="hidden" name="price" value="<?= $featureditem['price'] ?>">

                                    <input type="hidden" name="proQuantity" value="<?= $featureditem['quantity'] ?>">
                                    <input type="hidden" name="discount" value="<?= $control->disP ?>">

                                    <input type="hidden" name="secid" value="#bundleprd">

                                    <a  class="shopname py-1 text-capitalize d-block"><?= $sellerName ?></a>

                                    <div class="footbtn">

                                        <button type="submit" name="addToCart" class="btn btn-block btn-theme rounded-0" data-toggle="tooltip" title="Add to card" href="#"><i class="fas fa-shopping-cart"></i></button>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                    <?php

                        }

                    ?>

                </div>

                <button class="prv-four d-none d-md-block">&lt;</button>

                <button class="nxt-four d-none d-md-block">&gt;</button>

            </div>

        </div>

    </div>

</section>

<!--=================== bundel proudct end =========================-->

<!--=================== classified product start =========================-->

<section id="classifiedprd" class="py-4">

    <div class="container">

        <h4 class="title mb-4">

            <span>classified product</span>

        </h4>

        <div class="row prdct-slid">

            <div class="col-md-12">

                <div class="owl-carousel owl_five owl-theme">

                        <?php

                            foreach($allclassifiedpro as $key => $value){

                        ?>

                    <div class="item">

                        <div class="product">

                            <div class="prdimg">

                                <div class="view"></div>

                                <div class="imgmdlbtn">

                                    <a href="view-classified.php?view=<?= $value['id'] ?>&classifed"><span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span></a>

                                </div>

                                <img class="img" src="<?= $dir.$value['image'] ?>" alt="Procudt image">

                            </div>

                            <div class="prdct-desc text-center">

                                <p class="prdct-name text-capitalize py-1">

                                    <?= $value['name'] ?>

                                </p>

                                <p class="prc m-0 py-1"><span class="reg">&dollar;<?= $value['price'] ?></span></p>

                                <p href="#" class="shopname py-1 text-capitalize d-block">seller: <?php $seller = $db->getSingle('user','id', $value['seller']); echo $seller['fname'] ?></p>

                            </div>

                        </div>

                    </div>

                    <?php } ?>



                </div>

                <button class="prv-five d-none d-md-block">&lt;</button>

                <button class="nxt-five d-none d-md-block">&gt;</button>

            </div>

        </div>

    </div>

</section>

<!--=================== classified product end =========================-->

<!---================vendors==========-->

<section id="vendor" style="background-image: url('<?= $dir ?><?= $image['vendor_bg'] ?>');background-size:cover; background-position: center;">

    <div class="container">

        <h5 class="title text-uppercase">

            <span>

                OUr vendor

            </span>

        </h5>

        <div class="row">

            <div class="col-md-12 my-3">

                <div class="owl-carousel owl_six owl-theme">

                    <!--at lest 2 item must be inter here --->

                    <?php

                        

                        foreach($vendor as $key => $item){

                    ?> 

                    <div class="item">

                        <div class="vendor-img">

                            <a href="javascript:"><img class="" src="<?= $dir ?><?= empty($item['profile'])?'default.jpg':$item['profile'] ?>" alt="Vendor Photo"></a>

                        </div>

                    </div>

                    <?php

                        }

                    ?>

                </div>

                <button class="nxt_six d-none d-md-block" href="#"><i class="fas fa-angle-right"></i></button>

                <button class="prv_six d-none d-md-block" href="#"><i class="fas fa-angle-left"></i></button>

            </div>

        </div>

    </div>

</section>

<!---================vendors end==========-->

<!---=============womenfashion start================-->

<?php foreach($allcategory as $category){ 

    if(strtolower($category['name'])==strtolower('women fashion')){

        $categoryid = $category['id'];

    ?>

<section id="womenfashion">

    <div class="container">

        <div class="row mx-0 py-4">

            <div class="col-md-3 px-0">

                <div class="womenfashion_img py-5" style="background-image:url(<?= $dir.$category['banner'] ?>)">

                    <div class="women_fashion_title text-center my-5 py-5">

                        <h5 class="text-uppercase text-light"><?= $category['name'] ?></h5>

                        <a class="btn btn-light rounded-0 text-capitalize" href="search.php?category=<?= $category['id']; ?>&main">Browse all</a>

                    </div>

                </div>

            </div>

            <div class="col-md-9 px-0">

                <div class="womenfashion-content">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item">

                            <a class="nav-link active text-uppercase" id="beautyhelth" data-toggle="tab" href="#beauty" role="tab" aria-controls="home" aria-selected="true">beauty &amp; helth</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link text-uppercase" id="womenshoe" data-toggle="tab" href="#womensShoe" role="tab" aria-controls="profile" aria-selected="false">women's shoe</a>

                        </li>

                    </ul>

                    <div class="tab-content bg-white p-2" id="myTabContent">

                        <div class="tab-pane fade show active" id="beauty" role="tabpanel" aria-labelledby="beautyhelth">

                            <div class="owl-carousel owl_svn owl-theme">

                                <!--at lest 2 item must be inter here --->

                                <?php

                                    $key = "beauty";

                                    $beauty = $db->rnQuery("SELECT * FROM `sub_category` WHERE `name` LIKE '%$key%'");

                                    $beautyitem = mysqli_fetch_assoc($beauty);;

                                    $subid = $beautyitem['id'];

                                    $product = $db->getTableData('product','subCategory',$subid);

                                    foreach($product as $item){

                                        $selprice = $control->selPrice($item['discount'],$item['price']);



                                        if(is_numeric($sellerid)){

                                            $seller     = $db->getSingle('user','id',$sellerid);

                                            $sellerName = $seller['lname'];

                                        }else{

                                            $sellerName = $sellerid;

                                        }

                                ?>

                                <div class="item">

                                    <form action="" method="post">

                                        <div class="product">

                                            <div class="prdimg">

                                                <?php  

                                                    if($item['quantity'] == 0){

                                                ?>

                                                <div class="cond bg-danger">

                                                    out of stock

                                                </div>

                                                <?php }elseif($item['quantity'] > 0){ ?>

                                                <div class="cond bg-success">

                                                    Avilable

                                                </div>

                                                <?php } ?>

                                                <div class="view"></div>

                                                <div class="imgmdlbtn">

                                                    <a href="view-product.php?view=<?= $item['id'] ?>"><span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span></a>

                                                    <!-- <span data-toggle="tooltip" title="Compare"><i class="fas fa-exchange-alt d-block"></i></span>

                                                    <span data-toggle="tooltip" title="Add to wishlist"><i class="fas fa-heart d-block"></i></span> -->

                                                </div>

                                                <a href="view-product.php?view=<?= $item['id'] ?>"> <img class="img" src="<?= $dir ?><?= $item['image']??'default.jpg' ?>" alt="Procudt image"></a>

                                            </div>

                                            <div class="prdct-desc text-center">

                                                <p class="prdct-name text-capitalize">

                                                <a class="text-dark" href="view-product.php?view=<?= $item['id'] ?>"><?= $item['name'] ?></a>

                                                </p>

                                                <div class="reting">

                                                <?php
                                                    $id = $item['id'];
                                                    $avg = $control->avarage($id);
                                                    include ("./templates/_rating.php");
                                                ?>

                                                </div>

                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">

                                                <input type="hidden" name="name" value="<?= $item['name'] ?>">

                                                <input type="hidden" name="image" value="<?= $item['image'] ?>">

                                                <input type="hidden" name="price" value="<?= $item['price'] ?>">

                                                <input type="hidden" name="secid" value="#womenfashion">

                                                <input type="hidden" name="proQuantity" value="<?= $item['quantity'] ?>">
                                                <input type="hidden" name="discount" value="<?= $control->disP ?>">

                                                <p class="prc mb-0"><?php if($item['discount']!=0){ ?><span class="dic mr-2">&dollar;<?= $item['price'] ?></span><?php } ?><span class="reg">&dollar;<?= $selprice ?></span></p>

                                                <a href="javascript:" class="shopname py-1 text-capitalize d-block"><?= $sellerName ?></a>

                                                <div class="footbtn">

                                                    <button type="submit" name="addToCart" class="btn btn-theme btn-block rounded-0" data-toggle="tooltip" title="Add to card" href="#"><i class="fas fa-shopping-cart"></i></button>

                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                                <?php

                                      }

                                ?>

                            </div>

                        </div>

                        <div class="tab-pane fade" id="womensShoe" role="tabpanel" aria-labelledby="womenshoe">

                            <div class="owl-carousel owl_svn owl-theme">

                                <!--at lest 2 item must be inter here --->

                                <?php

                                    $key = "Women\'s shoe";

                                    $shoe = $db->rnQuery("SELECT * FROM `sub_category` WHERE `name` LIKE '%$key%'");

                                    $womshoe = mysqli_fetch_assoc($shoe);;

                                    $subid = $womshoe['id'];

                                    $productShoe = $db->getTableData('product','subCategory',$subid);

                                    foreach($productShoe as $key=>$item){

                                        $selprice = $control->selPrice($item['discount'],$item['price']);
                                        $sellerid  = $item['seller'];

                                        if(is_numeric($sellerid)){

                                            $seller     = $db->getSingle('user','id',$sellerid);

                                            $sellerName = $seller['lname'];

                                        }else{

                                            $sellerName = $sellerid;

                                        }

                                ?>

                                <div class="item">

                                    <form action="" method="post">

                                        <div class="product">

                                            <div class="prdimg">

                                                <?php  

                                                    if($item['quantity'] == 0){

                                                ?>

                                                <div class="cond bg-danger">

                                                    out of stock

                                                </div>

                                                <?php }elseif($item['quantity'] > 0){ ?>

                                                <div class="cond bg-success">

                                                    Avilable

                                                </div>

                                                <?php } ?>

                                                <div class="view"></div>

                                                <div class="imgmdlbtn">

                                                    <a href="view-product.php?view=<?= $item['id'] ?>"><span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span></a>

                                                    <!-- <span data-toggle="tooltip" title="Compare"><i class="fas fa-exchange-alt d-block"></i></span>

                                                    <span data-toggle="tooltip" title="Add to wishlist"><i class="fas fa-heart d-block"></i></span> -->

                                                </div>

                                                <img class="img-" src="<?= $dir ?><?= $item['image']??'default.jpg' ?>" alt="Procudt image">

                                            </div>

                                            <div class="prdct-desc text-center">

                                                <p class="prdct-name text-capitalize">

                                                    <a class="text-dark" href="view-product.php?view=<?= $item['id'] ?>"><?= $item['name'] ?></a>

                                                </p>

                                                <div class="reting">

                                                <?php
                                                    $id = $item['id'];
                                                    $avg = $control->avarage($id);
                                                    include ("./templates/_rating.php");
                                                ?>

                                                </div>

                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">

                                                <input type="hidden" name="name" value="<?= $item['name'] ?>">

                                                <input type="hidden" name="image" value="<?= $item['image'] ?>">

                                                <input type="hidden" name="price" value="<?= $item['price'] ?>">

                                                <input type="hidden" name="secid" value="#womenfashion">

                                                <input type="hidden" name="proQuantity" value="<?= $item['quantity'] ?>">
                                                <input type="hidden" name="discount" value="<?= $control->disP ?>">

                                                <p class="prc mb-0"><?php if($item['discount']!=0){ ?><span class="dic mr-2">&dollar;<?= $item['price'] ?></span><?php } ?><span class="reg">&dollar;<?= $item['price'] ?></span></p>

                                                <a href="javascript:" class="shopname py-1 text-capitalize d-block"><?= $sellerName ?></a>

                                                <div class="footbtn">

                                                    <button type="submit" name="addToCart" class="btn btn-theme btn-block rounded-0" data-toggle="tooltip" title="Add to card"><i class="fas fa-shopping-cart"></i></button>

                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                                <?php

                                    }

                                ?>

                            </div>

                        </div>

                        <button class="prv_svn d-none d-md-block" href="#">&lt;</button>

                        <button class="nxt_svn d-none d-md-block" href="#">&gt;</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php } } ?>

<!---=============womenfashion end================-->

<!---=============blog start================-->

<section id="blog" style="background: url('<?= $dir ?><?= $image['blog_bg']??'default.php'; ?>') ;background-size:cover;background-position:center;">

    <div class="container">

        <h5 class="title text-uppercase">

            <span>

                latest blog

            </span>

        </h5>

        <div class="row">

            <?php

                $allblogs = $db->rnQuery("SELECT * FROM `blogs` WHERE `status`='1' LIMIT 0,4");

                foreach($allblogs as $item){

            ?>

            <div class="col-lg-3 col-6 my-3">

                <div class="blog-content">

                    <a class="blog-link" href="view-blog.php?view=<?= $item['id'] ?>&blog">

                    <img class="img" src="<?= $dir.$item['image'] ?>" alt="">

                    </a>

                    <div class="blog-text">

                        <a href="view-blog.php?view=<?= $item['id'] ?>&blog" class="name"><?= substr($item['title'],0,100)?></a>

                        <?php

                            if(is_numeric($item['bloger'])){

                                $blogerid = $item['bloger'];

                                $select  = $db->getTableData('user','id',$blogerid);

                                $blogers = mysqli_fetch_assoc($select);

                                $bloger  = $blogers['fname'];

                            }else{

                                $bloger = $item['bloger'];

                            }

                        ?>

                        <p class="woner"><?= $bloger ?></p>

                    </div>

                </div>

            </div>

            <?php

                }

            ?>

        </div>

    </div>

</section>

<!---=============blog start================-->

<!---=============resume section start================-->
<?php
    $sel = $db->rnQuery("SELECT * FROM `view` WHERE `ip_addr`='$ip' ORDER BY `id` DESC LIMIT 0,4");
    if($sel == true){
        $row = mysqli_num_rows($sel);
    }
?>
<section id="resumeSec" class="py-4">

    <div class="container">

        <div class="d-none d-lg-block">

            <div class="row resme-con">
                <?php
                if($sel == true){
                    if($row>0){
                ?>
                <div class="col-sm-4">
                    <div class="ltprdct">
                        <h5 class="ltp-title">
                            <span>recently viewed</span>
                        </h5>

                        <?php
                        while($views = mysqli_fetch_assoc($sel)){

                            $proid = $views['product'];

                            $item   = $db->getSingle('product','id',$proid);

                            $catid = $item['category'];


                            $selprice = $control->selPrice($item['discount'],$item['price']);

                            

                            $category = $db->getSingle('category','id',$catid);

                            if($pro == true){

                            ?>

                            <div class="col-12 ltp-con my-4">

                                <div class="row">

                                    <div class="col-3 p-0 ltp-img">

                                        <a href="view-product.php?view=<?= $item['id'] ?>"><img class="img-fluid" src="<?= $dir ?><?= $item['image']??'default.jpg' ?>"></a>

                                    </div>

                                    <div class="col-9 ltp-desc">

                                        <a href="view-product.php?view=<?= $item['id'] ?>">

                                            <p class="prdct-name"><?= $item['name'] ?></p>

                                        </a>

                                        <a href="search.php?category=<?= $category['id'] ?>&main">

                                            <p class="category"><?= $category['name'] ?></p>

                                        </a>

                                        <div class="reting text-warning">

                                            <?php
                                                $id = $item['id'];
                                                $avg = $control->avarage($id);
                                                include ("./templates/_rating.php");
                                            ?>

                                        </div>

                                        <p class="prc">

                                            <span class="dic mr-2"><?php if($item['discount']!=0){ ?>&dollar;<?= $item['price'] ?><?php } ?></span><span class="reg">&dollar;<?= $selprice ?></span>

                                        </p>

                                    </div>

                                </div>

                            </div>

                            <?php

                            }

                        } 
                        ?>

                    </div>

                </div>
                <?php 
                    }
                }
                ?>
                <div class="<?= $row > 0?'col-sm-4':'col-sm-6' ?>">

                    <div class="ltprdct">

                        <h5 class="ltp-title">

                            <span>most viewed</span>

                        </h5>

                        <?php

                            $sel = $db->rnQuery("SELECT * FROM `product` ORDER BY `views` DESC LIMIT 0,4");

                            if($sel == true){

                                if(mysqli_num_rows($sel)>0){
                                    $items = mysqli_fetch_all($sel, MYSQLI_ASSOC);
                                    shuffle($items);
                                    foreach($items as $key => $item){
                                        $catid = $item['category'];
                                        $selprice = $control->selPrice($item['discount'],$item['price']);
                                        $category = $db->getSingle('category','id',$catid);
                                        if($pro == true){
                                        ?>
                                        <div class="col-12 ltp-con my-4">
                                            <div class="row">
                                                <div class="col-3 p-0 ltp-img">
                                                    <a href="view-product.php?view=<?= $item['id'] ?>"><img class="img-fluid" src="<?= $dir ?><?= $item['image']??'default.jpg' ?>"></a>
                                                </div>
                                                <div class="col-9 ltp-desc">
                                                    <a href="view-product.php?view=<?= $item['id'] ?>">
                                                        <p class="prdct-name"><?= $item['name'] ?></p>
                                                    </a>
                                                    <a href="search.php?category=<?= $category['id'] ?>&main">
                                                        <p class="category"><?= $category['name'] ?></p>
                                                    </a>
                                                    <div class="reting text-warning">
                                                    <?php
                                                        $id = $item['id'];
                                                        $avg = $control->avarage($id);
                                                        include ("./templates/_rating.php");
                                                    ?>
                                                    </div>
                                                    <p class="prc">
                                                        <span class="dic mr-2"><?php if($item['discount']!=0){ ?>&dollar;<?= $item['price'] ?><?php } ?></span><span class="reg">&dollar;<?= $selprice ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="<?= $row > 0?'col-sm-4':'col-sm-6' ?>">
                    <div class="ltprdct">
                        <h5 class="ltp-title">
                            <span>latest product</span>
                        </h5>
                        <?php
                            $sel = $db->rnQuery("SELECT * FROM `product` ORDER BY `views` ASC LIMIT 0,4");
                            if($sel == true){
                                if(mysqli_num_rows($sel)>0){
                                    $items = mysqli_fetch_all($sel, MYSQLI_ASSOC);
                                    shuffle($items);
                                    foreach($items as $key => $item){
                                        $catid = $item['category'];
                                        $selprice = $control->selPrice($item['discount'],$item['price']);
                                        $category = $db->getSingle('category','id',$catid);
                                        if($pro == true){
                                        ?>
                                        <div class="col-12 ltp-con my-4">
                                            <div class="row">
                                                <div class="col-3 p-0 ltp-img">
                                                    <a href="view-product.php?view=<?= $item['id'] ?>"><img class="img-fluid" src="<?= $dir ?><?= $item['image']??'default.jpg' ?>"></a>
                                                </div>
                                                <div class="col-9 ltp-desc">
                                                    <a href="view-product.php?view=<?= $item['id'] ?>">
                                                        <p class="prdct-name"><?= $item['name'] ?></p>
                                                    </a>
                                                        <a href="search.php?category=<?= $category['id'] ?>&main">
                                                        <p class="category"><?= $category['name'] ?></p>
                                                    </a>
                                                    <div class="reting text-warning">
                                                    <?php
                                                        $id = $item['id'];
                                                        $avg = $control->avarage($id);
                                                        include ("./templates/_rating.php");
                                                    ?>
                                                    </div>
                                                    <p class="prc">
                                                        <span class="dic mr-2"><?php if($item['discount']!=0){ ?>&dollar;<?= $item['price'] ?><?php } ?></span><span class="reg">&dollar;<?= $selprice ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="title text-uppercase">
            <span>
                Our Available Brands
            </span>
        </h5>
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="owl-carousel owl_eight owl-theme">
                    <!--at lest 2 item must be inter here --->
                    <?php
                        $brand = $db->getActiveData('brands');
                        foreach($brand as $key => $item){
                    ?> 
                    <div class="item">
                        <div class="brand-logo">
                            <a href="javascript:"><img class="" src="<?= $dir ?><?= empty($item['logo'])?'default.jpg':$item['logo'] ?>" alt="Vendor Photo"></a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <button class="nxt_eight d-none d-md-block" href="#"><i class="fas fa-angle-right"></i></button>
                <button class="prv_eight d-none d-md-block" href="#"><i class="fas fa-angle-left"></i></button>
            </div>
        </div>
    </div>
</section>
<!---=============resume section end================-->

<?php
include("inc/footer.php");
?>