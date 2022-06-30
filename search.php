<?php
$title = "Search || Demo Shop";
$adloc = "";
$autoloc = "";
$asset = "";
$dir = "uploads/";
include("inc/header.php");
?>
<section id="categrory_page">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block ">
                <div class="category_sidbar">
                    <h6 class="sidebar_ttl">ALL PRODUCTS</h6>
                    <ul class="list-unstyled">
                    <?php
                        foreach ($allcategory as $key => $item) {
                            $id = $item['id'];
                            $allSubcategory = $db->getTableData('sub_category','cat',$id);
                            $subCatcount = mysqli_num_rows($allSubcategory);
                            ?>
                            <li class="list">
                                <a href="javascript:" data-category="<?= $id ?>" class="sidmenu_link" data-target="#submenu<?= $id ?>"><?= $item['name'] ?>
                                    <span class="dropdown_arrow"><i class="far fa-caret-square-down"></span></i>
                                </a>
                                <ul class="submenu" id="submenu<?= $id ?>">
                                    <?php  
                                        foreach($allSubcategory as $subCategory){
                                            $subCatid = $subCategory['id'];
                                            $allproduct = $db->getTableData('product','category',$subCatid);
                                            $productCount = mysqli_num_rows($allproduct);
                                    ?>
                                    <li id="subcat"> 
                                        <label for="hidencheck<?= $subCatid ?>" class="catcheck_one">
                                            <input type="checkbox" class="sidemenu_subcategory check<?= $id ?> mr-2" id="hidencheck<?= $subCatid ?>" value="<?= $subCatid ?>">
                                            <?= $subCategory['name'] ?>
                                            <div class="p_count"><span><?= $productCount ?></span></div>
                                        </label>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php
                        }
                    ?>
                    </ul>
                </div>
                <div class="price_div">
                    <p class="div_ttl">Price</p>
                    <div class="prc_slide">
                        <div id="slider-range2"></div>
                        <p class="">
                            <i class="fas fa-dollar-sign"></i><input type="text" class="minimum" id="amount_min" style="border:0; color:#f6931f; font-weight:bold;" readonly><span>-</span>
                            <i class="fas fa-dollar-sign"></i><input type="text" class="maximum" id="amount_max" style="border:0; color:#f6931f; font-weight:bold;" readonly>
                        </p>
                    </div>
                </div>
                <div class="productsumuri my-3">
                    <ul class="nav nav-tabs nav-justifyed" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="popular" data-toggle="tab" href="#populardiv" role="tab" aria-controls="home" aria-selected="true">Popular</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="latest" data-toggle="tab" href="#latstdiv" role="tab" aria-controls="profile" aria-selected="false">Latest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="deals" data-toggle="tab" href="#dealsdiv" role="tab" aria-controls="profile" aria-selected="false">deals</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-white p-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="populardiv" role="tabpanel" aria-labelledby="popular">
                            <?php 
                                $runquery = $db->rnQuery("SELECT * FROM `product` WHERE `status`=1 ORDER BY `id` DESC LIMIT 0,4");
                                $blog = mysqli_fetch_all($runquery , MYSQLI_ASSOC);
                                shuffle($blog);
                                foreach($blog as $key => $item){
                                    $selprice = $control->selPrice($item['discount'],$item['price']);
                                include('templates/_sidbar_product.php');
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="latstdiv" role="tabpanel" aria-labelledby="latest">
                            <?php 
                                $runquery = $db->rnQuery("SELECT * FROM `product` WHERE `status`=1 AND `latest`='1' ORDER BY `id` DESC");
                                $blog = mysqli_fetch_all($runquery , MYSQLI_ASSOC);
                                shuffle($blog);
                                foreach($blog as $key => $item){
                                    $selprice = $control->selPrice($item['discount'],$item['price']);
                                include('templates/_sidbar_product.php');
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="dealsdiv" role="tabpanel" aria-labelledby="deals">
                            <?php 
                                $runquery = $db->rnQuery("SELECT * FROM `product` WHERE `status`=1 AND `deal`='1' ORDER BY `id` DESC");
                                $blog = mysqli_fetch_all($runquery , MYSQLI_ASSOC);
                                shuffle($blog);
                                foreach($blog as $key => $item){
                                    $selprice = $control->selPrice($item['discount'],$item['price']);
                                include('templates/_sidbar_product.php');
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div id="category_contnet">
                    <div class="srcbar clearfix">
                        <form action="" id="searchtopfrom" method="GET">
                            <select name="orderby" class="selectpicker src-input">
                                <option value="">short by</option> 
                                <option value="asc">Price low to heigh</option>
                                <option value="desc">Price heigh to low</option>
                            </select>
                            <select name="brandby" class="selectpicker src-input" data-live-search="true">
                                <option value="">All brand</option>
                                <?php 
                                    $allbrand      = $db->getActiveData('brands');
                                    foreach ($allbrand as $key => $item) {
                                        ?><option value="<?= $item['id'] ?>"><?= $item['name'] ?></option><?php
                                    }
                                ?>
                            </select>
                            <select name="vendoresrc" class="selectpicker src-input" data-live-search="true">
                                <option value="">Allvendors</option>
                                <?php
                                    foreach($vendor as $key => $item){
                                ?> 
                                <option value="<?= $item['id'] ?>"><?= $item['lname'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="srcTExtdiv d-none d-md-block">
                                <input type="text" name="srctext" placeholder="Search" class="src_input srctext">
                                <button class="srcbtn"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="product_content row">
                        <?php
                            if(isset($_GET['search']) && isset($_GET['type']) && isset($_GET['category'])){
                                $src  = $db->convert($_GET['search']);
                                $categorysrc = $_GET['category']; 
                                $type = strtolower($_GET['type']);
                                if( $type == 'product'){
                                    if(!empty($src) && empty($categorysrc)){
                                        $query = "SELECT * FROM `product` WHERE `name` LIKE '%$src%' AND `status`='1'";
                                    }elseif(empty($src) && !empty($categorysrc)){
                                        $query = "SELECT * FROM `product` WHERE `category`='$categorysrc'";
                                    }elseif((!empty($src) && !empty($categorysrc))){
                                        $query = "SELECT * FROM `product` WHERE `name` LIKE '%$src%' AND `category`='$categorysrc' AND `status`='1'";
                                    }elseif(empty($src) && empty($categorysrc)){
                                        $query = "SELECT * FROM `product` WHERE `status`='1'";
                                    }
                                }elseif( $type == 'vendor'){
                                    echo "<script>window.location.href='all_vendors.php?serach=".$src."&type=vendor'</script>";
                                }
                                $select = $db->rnQuery($query);
                                if($select == true){
                                    if(mysqli_num_rows($select) > 0){
                                        while($item = mysqli_fetch_assoc($select)){
                                            $discount = $item['discount'];
                                            $price = $item['price']/100;
                                            $dic_price = number_format($price*$discount,0 , '.', '');
                                            $slleprice = $item['price'] - $dic_price;
                                            ?>
                                            <div class="col-md-3 col-6 mt-2">
                                                <?php include ("templates/_product.php"); ?>
                                            </div>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <div class="col-12 text-center"><h4>No data found</h4></div>
                                        <?php
                                    }
                                }
                            }elseif(isset($_GET['category']) && isset($_GET['main'])){
                                $catid = $_GET['category'];
                                $products = $db->getTableData('product','category',$catid);
                                while($item = mysqli_fetch_assoc($products)){
                                    $discount = $item['discount'];
                                    $price = $item['price']/100;
                                    $dic_price = number_format($price*$discount,0 , '.', '');
                                    $slleprice = $item['price'] - $dic_price;
                                    ?>
                                    <div class="col-md-3 col-6 mt-2">
                                        <?php include ("templates/_product.php"); ?>
                                    </div>
                                    <?php
                                }
                            }elseif(isset($_GET['category']) && isset($_GET['sub'])){
                                $catid = $_GET['category'];
                                $products = $db->getTableData('product','subCategory',$catid);
                                while($item = mysqli_fetch_assoc($products)){
                                    $discount = $item['discount'];
                                    $price = $item['price']/100;
                                    $dic_price = number_format($price*$discount,0 , '.', '');
                                    $slleprice = $item['price'] - $dic_price;
                                    ?>
                                    <div class="col-md-3 col-6 mt-2">
                                        <?php include ("templates/_product.php"); ?>
                                    </div>
                                    <?php
                                }
                            }elseif(isset($_GET['brand'])){
                                $catid = $_GET['brand'];
                                $products = $db->getTableData('product','brand',$catid);
                                while($item = mysqli_fetch_assoc($products)){
                                    $discount = $item['discount'];
                                    $price = $item['price']/100;
                                    $dic_price = number_format($price*$discount,0 , '.', '');
                                    $slleprice = $item['price'] - $dic_price;
                                    ?>
                                    <div class="col-md-3 col-6 mt-2">
                                        <?php include ("templates/_product.php"); ?>
                                    </div>
                                    <?php
                                }
                            }elseif(isset($_GET['brand']) && isset($_GET['product-brand'])){
                                $brid = $_GET['brand'];
                                $products = $db->getTableData('product','brand',$brid);
                                while($item = mysqli_fetch_assoc($products)){
                                    $discount = $item['discount'];
                                    $price = $item['price']/100;
                                    $dic_price = number_format($price*$discount,0 , '.', '');
                                    $slleprice = $item['price'] - $dic_price;
                                    ?>
                                    <div class="col-md-3 col-6 mt-2">
                                        <?php include ("templates/_product.php"); ?>
                                    </div>
                                    <?php
                                }
                            }else{
                                $query = "SELECT * FROM `product` WHERE `status`='1'";
                                $select = $db->rnQuery($query);
                                if($select == true){
                                    if(mysqli_num_rows($select) > 0){
                                        while($item = mysqli_fetch_assoc($select)){
                                            $discount = $item['discount'];
                                            $price = $item['price']/100;
                                            $dic_price = number_format($price*$discount,0 , '.', '');
                                            $slleprice = $item['price'] - $dic_price;
                                            ?>
                                            <div class="col-md-3 col-6 mt-2">
                                                <?php include ("templates/_product.php"); ?>
                                            </div>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <div class="col-12 text-center"><h4>No data found</h4></div>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("inc/footer.php");
?>



<!-- <i class="far fa-caret-square-up d-hidden"></i> -->