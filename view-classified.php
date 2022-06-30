<?php
$asset = "";
$adloc = "";
$dir = "uploads/";
include ("inc/header.php");
if(isset($_GET['view'])){
    $id = $_GET['view'];
    foreach($allclassifiedpro as $item){
        if($item['id'] == $id){
            $sellerid = $item['seller'];
            if(is_numeric($sellerid)){
                $seller     = $db->getSingle('user','id',$sellerid);
                $sellerName = $seller['fname'];
            }else{
                $sellerName = $sellerid;
            }
            $catid = $item['category'];
            $subCategory = $db->getSingle('sub_category','id',$catid);
            if($subCategory != false){
                $subCategoryName = $subCategory['name'];
                $catid = $subCategory['cat'];
            }
            $category = $db->getSingle('category','id',$catid);
?>
<section id="product-classifed">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-7">
                <div class="product_content p-4">
                    <h4 class="my-3"><?= $item['name'] ?></h4>
                    <p><a href="#"><?= $category['name'] ?></a> || <a href="#"><?= isset($subCategoryName)?$subCategoryName:'' ?></a></p>
                    <div class="productimage text-center">
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
            </div>
            <div class="col-md-5">
                <div class="seller_info p-4">
                    <form action="" method="post">
                        <h4 class="my-3">Seller information</h4>
                        <p class="mb-2 font-14"><i class="fas fa-user mr-1"></i> Seller: <span><?= $sellerName ?></span></p>
                        <p class="mb-2 font-14"><i class="fas fa-map-marker-alt mr-1"></i> Location: <span><?= $seller['address1'] ?></span></p>
                        <p class="mb-2 font-14"><i class="fas fa-envelope mr-1"></i> Email: <span><?= $seller['email'] ?></span></p>
                        <p class="mb-2 font-14"><i class="fas fa-envelope mr-1"></i> Phone number: <span><?= $seller['ph_num'] ?></span></p>
                        <hr class='my-1 mt-3'>
                        
                        <h5 class="price my-3">Price: &dollar;<?= $item['price'] ?></h5>
                    </form>
                </div> 
                <div class="share_link my-4 p-3">
                    <h5>Share this product</h5>
                    <hr class="my-1">
                    <div class="share_icon my-3">
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="EDWnBb8S"></script>
                        <?php 
                            $url = (isset($_SERVER["HTTPS"])?"https":"http")."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
                        ?>
                        <div class="row align-items-center m-0">
                            <div class="fb-share-button" data-href="<?php echo $url; ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&amp;src=sdkpreparse"  class="fb btn mr-3"><i class="fab fa-facebook-f"></i></a></div>
                            <a traget="_blank" href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>" data-size="small" class="tw btn mr-3"><i class="fab fa-twitter"></i></a>
                            <a class="li"><script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
                            <script type="IN/Share" data-url="<?php echo $url; ?>"></script></a>
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
                        <a class="nav-item nav-link text-uppercase rounded-0 active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Additional specification</a>
                        <a class="nav-item nav-link text-uppercase rounded-0" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">FAQ</a>
                        <a class="nav-item nav-link text-uppercase rounded-0" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Review</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p><span>Name: DSLR Cammera</span></p>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
    <div class="releted-pro">
        <div class="container">
            <h4 class="section-title py-2 roboto-slab"><span>Releted Proudct</span></h4>
            <div class="row">
                <?php for($i=1;$i<=12;$i++){ ?>
                <div class="col-lg-2 col-md-3 col-sm-6 text-center text-sm-left mb-3 px-1">
                    <div class="product-div">
                        <a href="#">
                            <div class="product-img">
                                <img class="img-fluid" src="image/product_180_1_thumb.jpg" alt="Product Image">
                            </div>
                            <h6 class="my-2">Dslr best cammera in 2021</h6>
                            <p class="text-warning rating mb-1 mt-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                            <p class="price">
                                &#36;500
                            </p>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php
        }
    }
}
include ("inc/footer.php");
?>