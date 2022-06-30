<div class="featured-sidebar">
    <h5 class="py-2 text-uppercase">advence search</h5>
    <div class="sidbar_con px-3 pb-2">
        <form action="" id="searchSidbar" method="POST">
            <select name="cat" id="select_category" data-get='sub_category' data-target="#subCat" class="picker">
                <option value="">All Category</option>
                <?php
                foreach ($allcategory as $key => $item) {
                    $id = $item['id'];
                    ?>
                    <option value="<?= $id ?>" <?php if(isset($_GET['category'])){ if($_GET['category'] == $id){ echo "selected"; }}  ?>><?= $item['name'] ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="subcat" id="subCat" data-dif="single" class="picker">
                <option value="">Sub category</option>
            </select>
            <select name="brands" id="seletbrnd" class="picker">
                <option value="">All Brand</option>
                <?php 
                    $allbrand      = $db->getActiveData('brands');
                    foreach ($allbrand as $key => $item) {
                        ?><option value="<?= $item['id'] ?>"><?= $item['name'] ?></option><?php
                    }
                ?>
            </select>
            <div class="pricerang">
                <div id="slider-range"></div>
                <p class="">
                    <i class="fas fa-dollar-sign"></i><input type="text" class="minimum" id="amount_mn" style="border:0; color:#f6931f; font-weight:bold;" readonly><span>-</span>
                    <i class="fas fa-dollar-sign"></i><input type="text" class="maximum" id="amount_mx" style="border:0; color:#f6931f; font-weight:bold;" readonly>
                </p>
            </div>
            <input type="text" class="src-imp-text" placeholder="What Are You Looking For?">
        </form>
        <button type="submit" class="src-btn"><i class="fas fa-search"></i> SEARCH</button>
    </div>
    <div class="productsumuri my-3">
        <ul class="nav nav-tabs nav-justifyed" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-uppercase" id="popular" data-toggle="tab" href="#populardiv" role="tab" aria-controls="home" aria-selected="true">Popular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-uppercase" id="ltst" data-toggle="tab" href="#latstdiv" role="tab" aria-controls="profile" aria-selected="false">Latest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-uppercase" id="deals" data-toggle="tab" href="#dealsdiv" role="tab" aria-controls="profile" aria-selected="false">deals</a>
            </li>
        </ul>
        <div class="tab-content bg-white p-2" id="myTabContent">
            <div class="tab-pane fade show active" id="populardiv" role="tabpanel" aria-labelledby="popular">
                <?php 
                    $runquery = $db->rnQuery("SELECT * FROM `product` WHERE `status`=1 ORDER BY `id` DESC LIMIT 0,4");
                    $puler = mysqli_fetch_all($runquery , MYSQLI_ASSOC);
                    shuffle($puler);
                    foreach($puler as $key => $itm){
                        $selprice = $control->selPrice($itm['discount'],$itm['price']);
                        $id = $itm['id'];
                    ?>
                        <div class="row m-0 py-2 productsumuri-div">
                            <div class="col-3 p-1">
                                <a href="view-product.php?view=<?= $id ?>&product">
                                    <div class="img-overly"><i class="far fa-eye"></i></div>
                                    <img class="img-fluid" src="<?= $dir ?><?= $itm['image']??'default.jpg' ?>">
                                </a>
                            </div>
                            <div class="col-9">
                                <a class="" href="view-product.php?view=<?= $id ?>&product">
                                    <p class="prdct-name"><?= $itm['name'] ?></p>
                                </a>
                                <div class="reting text-warning">
                                    <?php
                                        $avg = $control->avarage($id);
                                        include ("./templates/_rating.php");
                                    ?>
                                </div>
                                <p class="prc">
                                    <?php if($itm['discount']!=0){ ?><span class="reg mr-2">&dollar;<?= $itm['price'] ?></span><?php } ?>
                                    <span class="dic">&dollar;<?= $selprice ?></span>
                                </p>
                            </div>
                        </div>
                    <?PHP    
                    }
                ?>
            </div>
            <div class="tab-pane fade" id="latstdiv" role="tabpanel" aria-labelledby="ltst">
                <?php 
                    $runquery = $db->rnQuery("SELECT * FROM `product` WHERE `latest`=1 ORDER BY `id` DESC LIMIT 0,4");
                    while($item = mysqli_fetch_assoc($runquery)){
                        $selprice = $control->selPrice($item['discount'],$item['price']);
                        $id = $item['id'];
                    ?>
                        <div class="row m-0 py-2 productsumuri-div">
                            <div class="col-3 p-1">
                                <a href="view-product.php?view=<?= $item['id'] ?>&product">
                                    <div class="img-overly"><i class="far fa-eye"></i></div>
                                    <img class="img-fluid" src="<?= $dir ?><?= $item['image']??'default.jpg' ?>">
                                </a>
                            </div>
                            <div class="col-9">
                                <a class="" href="view-product.php?view=<?= $item['id'] ?>&product">
                                    <p class="prdct-name"><?= $item['name'] ?></p>
                                </a>
                                <div class="reting text-warnig">
                                    <?php
                                        $avg = $control->avarage($id);
                                        include ("./templates/_rating.php");
                                    ?>
                                </div>
                                <p class="prc">
                                    <?php if($itm['discount']!=0){ ?><span class="reg mr-2">&dollar;<?= $itm['price'] ?></span><?php } ?>
                                    <span class="dic">&dollar;<?= $selprice ?></span>
                                </p>
                            </div>
                        </div>
                    <?PHP    
                    }
                ?>
            </div>
            <div class="tab-pane fade" id="dealsdiv" role="tabpanel" aria-labelledby="deals">
                <?php 
                    $runquery = $db->rnQuery("SELECT * FROM `product` WHERE `deal`=1 ORDER BY `id` DESC LIMIT 0,4");
                    while($item = mysqli_fetch_assoc($runquery)){
                        $selprice = $control->selPrice($item['discount'],$item['price']);
                        $id = $item['id'];
                    ?>
                        <div class="row m-0 py-2 productsumuri-div">
                            <div class="col-3 p-1">
                                <a href="view-product.php?view=<?= $item['id'] ?>&product">
                                    <div class="img-overly"><i class="far fa-eye"></i></div>
                                    <img class="img-fluid" src="<?= $dir ?><?= $item['image']??'default.jpg' ?>">
                                </a>
                            </div>
                            <div class="col-9">
                                <a class="" href="view-product.php?view=<?= $item['id'] ?>&product">
                                    <p class="prdct-name"><?= $item['name'] ?></p>
                                </a>
                                <div class="reting text-warning">
                                    <?php
                                        $avg = $control->avarage($id);
                                        include ("./templates/_rating.php");
                                    ?>
                                </div>
                                <p class="prc">
                                    <?php if($itm['discount']!=0){ ?><span class="reg mr-2">&dollar;<?= $itm['price'] ?></span><?php } ?>
                                    <span class="dic">&dollar;<?= $selprice ?></span>
                                </p>
                            </div>
                        </div>
                    <?PHP    
                    }
                ?>
            </div>
        </div>
    </div>
</div>