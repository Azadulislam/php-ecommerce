<?php

$title = "Product";
$asset = "";
$adloc = "";
$dir = "uploads/";
include ("inc/header.php");
if(isset($_GET['view'])){
    $id = $_GET['view'];
    foreach($allpro as $item){
        if($item['id'] == $id){
            $sellerid   = $item['seller'];
            if(is_numeric($sellerid)){
                $seller     = $db->getSingle('user','id',$sellerid);
                $sellerName = $seller['fname'];
            }else{
                $sellerName = $sellerid;
            }


            $discount = $item['discount'];
            $price = $item['price']/100;
            $dic_price = number_format($price*$discount,0 , '.', '');
            $slleprice = $item['price'] - $dic_price;


            $scatid = $item['subCategory'];
            $subCategory = $db->getSingle('sub_category','id',$scatid);
            if($subCategory != false){
                $subCategoryName = $subCategory['name'];
                $subid           = $subCategory['id'];
            }
            $catid = $item['category'];
            $category = $db->getSingle('category','id',$catid);
            $brand = $db->getSingle('brands','id',$item['brand']);

            
            $pro  = $item['id'];
            $user = 0;
            if(isset($usrid)){
                $user = $usrid;
            }
            $sel = $db->rnQuery("SELECT * FROM `view` WHERE `ip_addr`='$ip' AND `product`='$pro'");
            if(mysqli_num_rows($sel) == 0){
                $ins = $db->rnQuery("INSERT INTO `view`(`user`,`ip_addr`,`product`) VALUES ('$user','$ip','$pro')");
                $upViews = 0;
                $upViews = $upViews+1; 
                $up  = $db->updateData('product','views',$upViews,$pro);
            };
            $order = $db->rnQuery("SELECT * FROM `order_details` WHERE `product`='$id'");
            $reviews = $db->rnQuery("SELECT * FROM `review` WHERE `product`='$id' ");
            $oRows    = mysqli_num_rows($order);
            $avg = $control->avarage($id);
?>
<section id="product">
    <div class="container pt-3 pb-5">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="product_dtl p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="productimage text-center    ">
                                <img class="img-fluid" id="imgshow" src="<?= $dir.$item['image'] ?>" alt="Product image">
                            </div>
                            <div class="gallery row m-0 my-3">
                                <div class="gallery_item col-3 px-0 pr-1 pl-0">
                                    <img class='img-fluid' data-target="#imgshow" src="<?= $dir.$item['image'] ?>" alt="Product image">
                                </div>
                                <?php if($item['image2']!='default.jpg'){ ?>
                                <div class="gallery_item col-3 px-0 pr-1 pl-0">
                                    <img class='img-fluid' data-target="#imgshow" src="<?= $dir.$item['image2'] ?>" alt="Product image">
                                </div>
                                <?php }if($item['image3']!='default.jpg'){ ?>
                                <div class="gallery_item col-3 px-0 pr-1 pl-0">
                                    <img class='img-fluid' data-target="#imgshow" src="<?= $dir.$item['image3'] ?>" alt="Product image">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="details">
                                <form action="" method="post">
                                    <h4 class="name text-capitalize  px-3"><?= $item['name'] ?></h4>
                                    <p class="cat px-3">
                                        <?php if($category != false){ ?>
                                        <a href="search.php?category=<?= $category['id'] ?>&main"><?= $category['name'] ?></a>
                                        <?php } if(isset($subCategoryName)){ ?>
                                            || <a href="search.php?category=<?= $subid ?>&sub"><?= $subCategoryName ?> </a>
                                        <?php } if($brand != false){?>
                                            || <a href="search.php?brand=<?= $brand['id'] ?>"> <?= $brand['name'] ?> </a>
                                        <?php } ?>
                                    </p>
                                    <p class="px-3 mb-0">By <?= $sellerName ?></p>
                                    <p class="m-0  px-3">
                                        <?php include("./templates/_rating.php") ;?>
                                        <span><?= round($avg,2)."/5"."&nbsp; &nbsp; | ".$control->reviewRows ?> review(s) | <?= $oRows ?> Order</span>
                                    </p>
                                    <hr class='my-1'>
                                    
                                    <h4 class="price mt-2 px-3">Price: <?php if($item['discount']!=0){ ?><span class="dic mr-2 text-danger">&dollar;<?= $item['price'] ?></span><?php } ?>  &#36;<?= $slleprice ?></h4>
                                    <div class="menu-bg py-3 px-3">
                                        <!-- <p class="mb-3">Color:</p>
                                        <div class="color row m-0">
                                            <div class="color-item mr-3">
                                                <label class="color-select active" data-target="#red" style="background: #ff0000" for="red">
                                                    <input type="radio" value="#ff0000" id="red" name="color" checked>
                                                </label>
                                            </div>
                                            <div class="color-item mr-3">
                                                <label class="color-select " data-target="#black" style="background: #000000" for="black">
                                                    <input type="radio" id="black" value="#000000" name="color">
                                                </label>
                                            </div>
                                            <div class="color-item mr-3">
                                                <label class="color-select" data-target="#blue" style="background: #0000ff" for="blue">
                                                    <input type="radio" id="blue" value="#0000ff" name="color">
                                                </label>
                                            </div>
                                        </div> -->
                                        <div class="quantity input-group my-2">
                                            <span data-target="#quantity" class="input-group-text plus btn btn-theme"><i class="fas fa-plus"></i></span>
                                            <input type="number" id="quantity" class="form-control" value="1" min="1" max="<?= $item['quantity'] ?>" name="quantity">
                                            <span data-target="#quantity" class="input-group-text minus btn btn-theme"><i class="fas fa-minus"></i></span>
                                            <?php if($item['quantity']>0){ ?>
                                            <h4 class='text-success d-inline-block pl-3'> <?= $item['quantity'] ?> pc avilable</h4>
                                            <?php }else{ ?>
                                            <h4 class='text-danger d-inline-block pl-3'> Out Of Stock</h4>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row my-4  px-3">
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <input type="hidden" name="name" value="<?= $item['name'] ?>">
                                        <input type="hidden" name="image" value="<?= $item['image'] ?>">
                                        <input type="hidden" name="price" value="<?= $item['price'] ?>">
                                        <input type="hidden" name="proQuantity" value="<?= $item['quantity'] ?>">
                                        <input type="hidden" name="discount" value="<?= $item['discount'] ?>">
                                        <div class="col-4">
                                            <button type="submit" name="addToCart" class="btn btn-warning btn-block" >Add to cart</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" name="buye" class="btn btn-theme btn-block" >Buy</a>
                                        </div>
                                    </div>
                                </form>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description-section py-5">
        <div class="container">
            <div class="description-teb border">
                <nav>
                    <div class="nav nav-tabs bg-theme text-white" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link rounded-0 active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Full specification</a>
                        <a class="nav-item nav-link rounded-0" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">FAQ</a>
                        <a class="nav-item nav-link rounded-0" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-contact" aria-selected="false">Review</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p><span>Name: DSLR Cammera</span></p>
                        <P><?= $item['pro_desc'] ?></P>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <P class="p-3">Working with this</P>
                    </div>
                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                        <div class="row mx-0">
                            <div class="col-12 px-0">
                                <div class="card">
                                    <h6 class="card-header">Prodcut review</h6>
                                    <div class="card-body py-0">
                                    <?php
                                        while($review = mysqli_fetch_assoc($reviews)){
                                            $customerid = $review['user'];
                                            $customer = $db->rnQuery("SELECT * FROM `user` WHERE `id`='$id'");
                                            $customerdtl = mysqli_fetch_assoc($customer);
                                        ?>
                                        <div class="review-div py-3">
                                            <p class="card-title mb-0">
                                                By <span class="font-weight-bold"><?= $customerdtl['fname']." ".$customerdtl['lname'] ?></span>
                                                <span class="time">
                                                    &nbsp; &nbsp; At <?= date("d M Y h:s a",strtotime($review['time'])) ?>
                                                </span>
                                            </p>
                                            <p class="card-title mb-0">
                                                <span class=" rating">
                                                    <?php
                                                        $rating = $review['rating'];
                                                        for($i=0; $i < $rating ; $i++){
                                                            echo '<i class="fas fa-star text-warning"></i>';
                                                        }
                                                        $emp = 5 - $rating;
                                                        for($i2=0; $i2 < $emp ; $i2++){
                                                            echo '<i class="far fa-star text-warning"></i>';
                                                        }
                                                        echo "&nbsp; &nbsp; ".$rating."/5";
                                                    ?>
                                                </span>
                                            </p>
                                            <p class="card-text"><?= $review['comment'] ?></p>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="releted-pro">
        <div class="container">
            <h4 class="section-title py-2 roboto-slab"><span>Releted Proudct</span></h4>
            <div class="row">
                <?php
                    $select = $db->getTableData('product','category',$catid);
                    if(mysqli_num_rows($select)>0){
                        while($item = mysqli_fetch_assoc($select)){
                            $discount = $item['discount'];
                            $price = $item['price']/100;
                            $dic_price = number_format($price*$discount,0 , '.', '');
                            $slleprice = $item['price'] - $dic_price;
                            if($item['id'] != $id){
                            ?>
                            <div class="col-lg-2 col-md-3 col-sm-6 text-center text-sm-left mb-3 px-1">
                                <div class="product-div">
                                    <a href="view-product.php?view=<?= $item['id'] ?>">
                                        <div class="product-img">
                                            <img class="img-fluid" src="<?= $dir ?><?= $item['image']??"default.jpg" ?>" alt="Product Image">
                                        </div>
                                        <h6 class="my-2"><?= $item['name'] ?></h6>
                                        <p class="text-warning rating mb-1 mt-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </p>
                                        <p class="price">
                                            <?php if($item['discount']!=0){ ?><span class="dic mr-2 text-danger">&dollar;<?= $item['price'] ?></span><?php } ?>  &#36;<?= $slleprice ?>
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <?php 
                            }
                        }
                    }else{
                        echo "<h4>Nothing avilable</h4>";
                    }
                ?>
            </div>
        </div>
    </div>
</section>
    <script>
        $(document).ready(function () {
            $("label.color-select").click(function (e) {
                $("label.color-select").removeClass('active');
                $(this).addClass('active');
                var colorinput = $(this).data('target');
                var check = $('input:checked').val();
                console.log(check);
            });
            $('span.input-group-text.plus').click(function (e) { 
                e.preventDefault();
                var input    = $(this).data('target');
                var quantity = $(input).val();
                var max = $(input).attr('max');
                if(max == 0){
                    return;
                }else if(max == quantity){
                    return;
                    
                }else{
                    var upQuantity = ++quantity;
                    $(input).val(upQuantity);
                }
            });
            $('span.input-group-text.minus').click(function (e) { 
                e.preventDefault();
                var input    = $(this).data('target');
                var quantity = $(input).val();
                if(quantity > 1){
                    var upQuantity = --quantity;
                    $(input).val(upQuantity);
                }
            });
            $('.gallery_item .img-fluid').click(function (e) { 
                e.preventDefault();
                var img = $(this).attr('src');
                var show = $(this).data('target');
                $(show).attr('src',img)
            });

        });
        
    </script>
<?php
        }
    }
}
include ("inc/footer.php");
?>