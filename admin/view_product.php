<?php
    $title = "View Product || Azad demo shop";
    include_once ("inc/header.php");
    $pro = new classes\Product;
    if(isset($_GET['view'])){
        $id = $_GET['view'];
        if(!empty($id)){
        $product = $db->selectSingle("SELECT * FROM `product` WHERE `id`='$id'");
        if($product == false){
            echo "<script>window.location.href='manage_product.php'</script>";
        }
    
    $dir = "../uploads/";
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Product details</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">View Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 text-right"><a class="btn btn-info mr-2" href="manage_product.php">back</a><a href="editproduct.php?edit=<?= $product['id'] ?>" class="btn btn-outline-info"><i class="fas fa-edit"></i> Edit</a></div>
                                <div class="col-md-8 mx-auto">
                                    <div class="row">
                                        <div class="col-md-12"><img id="showimage" class="img-fluid" src="<?= $dir.$product['image'] ?>" alt="Product image"></div>
                                    </div>
                                    <div class="image_gallery">
                                        <div class="row m-0">
                                            <div class="col-sm-3 m-2 p-0"><img class="img-fluid" id="proimage" src="<?= $dir.$product['image'] ?>" alt="Product image"></div>
                                            <div class="col-sm-3 m-2 p-0"><?php if($product['image2'] != 'default.jpg'){?><img class="img-fluid" id="proimage" src="<?= $dir.$product['image2'] ?>" alt="Product image"><?php } ?></div>
                                            <div class="col-sm-3 m-2 p-0"><?php if($product['image3'] != 'default.jpg'){?><img class="img-fluid" id="proimage" src="<?= $dir.$product['image3'] ?>" alt="Product image"><?php } ?></div>
                                        </div>
                                    </div>
                                    <h2 class="my-3"><?= $product['name'] ?></h2>
                                    <p><?= $product['pro_desc'] ?></p>
                                    <div class="row">
                                        <div class="col-md-3"><b>Price</b></div>
                                        <div class="col-md-7">: $<?= $product['price']?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Discount</b></div>
                                        <div class="col-md-7">: <?= $product['discount']=='0'?'No discount':$product['discount'].'%'?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Category</b></div>
                                        <div class="col-md-7">: <?php
                                                        $catid = $product['category'];
                                                        $selcat = $db->selectSingle("SELECT * FROM `sub_category` WHERE `id`='$catid'");
                                                            $cId = $selcat['cat'];
                                                            $ssc = $db->selectSingle("SELECT * FROM `category` WHERE `id`='$cId'");
                                                            if($ssc==false){
                                                                echo $ssc['name'];
                                                            }else{
                                                                echo $ssc['name'] ."/". $selcat['name'] ;
                                                            }
                                                        ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Quantity</b></div>
                                        <div class="col-md-7">: <?= $product['quantity']=='0'?'Out of Stock':$product['quantity']?> pic(s)</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Slug</b></div>
                                        <div class="col-md-7">: <?= $product['slug']?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 "><b>Seller</b></div>
                                        <?php 
                                            if(is_numeric($product['seller'] )){
                                                $sellerid = $product['seller'];
                                                $select  = $db->getTableData('user','id',$sellerid);
                                                $sellers = mysqli_fetch_assoc($select);
                                                $seller  = $sellers['fname'];
                                            }else{
                                                $seller = $product['seller'];
                                            }
                                        ?>
                                        <div class="col-md-7">: <?= $seller ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Sel</b></div>
                                        <div class="col-md-7">: <?= $product['sel']?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Status</b></div>
                                        <div class="col-md-7">: <?= $product['status']==1?'Active':'Inactive' ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Time</b></div>
                                        <div class="col-md-7">: <?= $product['time']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }else{
                    echo "<script>window.location.href='manage_product.php'</script>";
                }
            }else{
                echo "<script>window.location.href='manage_product.php'</script>";
            }
                    include_once ("inc/footer.php");
                ?>