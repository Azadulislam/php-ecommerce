<?php
$title = "Review || Demo Shop";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");
if(isset($_COOKIE['vendor'])){
    echo "<script>window.location.href='vendor-dashboard'</script>";
}

if(isset($_COOKIE['customer'])){
    //include ('../php/function.php');
    if(isset($_GET['p'],$_GET['order'])){
        $pid = $_GET['p'];
?>

<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">  
                <?php include ('templates/_sidbar.php') ?>
            </div>
            <div id="maindiv" class="col-lg-9">  
                <div class="content">
                    <h6 class="heading mb-0">Write Your review</h6>
                    <div class="rate-review bg-white border p-3">
                        <div class="row m-0">
                            <div class="col-6 p-0">
                                <?php
                                    $productSel = $db->rnQuery("SELECT * FROM `product` WHERE `id`='$pid'");
                                    $product    = mysqli_fetch_assoc($productSel);
                                ?>
                                <div class="row m-0">
                                    <div class="col-2 p-0"><img class="img-fluid" src="<?= $dir.$product['image'] ?>" alt=""></div>
                                    <div class="col-10 my-auto"><?= $product['name'] ?></div>
                                </div>
                                <div class="row m-0 pt-3">
                                    <div class="col-3 p-0"><h6>Review:</h6></div>
                                    <div class="col-9 p-0">
                                        <div class="rating-star mb-4">
                                            <i class="fas fa-star fa-2x rat" data-index="0"></i>
                                            <i class="fas fa-star fa-2x rat" data-index="1"></i>
                                            <i class="fas fa-star fa-2x rat" data-index="2"></i>
                                            <i class="fas fa-star fa-2x rat" data-index="3"></i>
                                            <i class="fas fa-star fa-2x rat" data-index="4"></i>
                                        </div>
                                        <div class="review-text">
                                            <textarea name="review" class="form-control" cols="30" rows="10" placeholder="Enter your comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 p-0">
                                <?php
                                    $sellerid   = $product['seller'];
                                    $hid        = 0;
                                    if(is_numeric($sellerid) && $hid != 0){
                                        $sellerSel = $db->rnQuery("SELECT * FROM `user` WHERE `id`='$sellerid'");
                                        $seller    = mysqli_fetch_assoc($sellerSel);
                                        ?>
                                        <div class="row m-0">
                                            <div class="col-2 p-0"><img class="img-fluid" src=" <?= $dir.$seller['porfile'] ?>" alt=""></div>
                                            <div class="col-10 my-auto"><?= $seller['lname'] ?></div>
                                        </div>
                                        <!-- <div class="row m-0 pt-3 pl-2">
                                            <div class="col-3 p-0"><h6>Review:</h6></div>
                                            <div class="col-9 p-0">
                                                <div class="rating-star mb-4">
                                                    <i class="fas fa-star fa-2x sel-rat" data-index="0"></i>
                                                    <i class="fas fa-star fa-2x sel-rat" data-index="1"></i>
                                                    <i class="fas fa-star fa-2x sel-rat" data-index="2"></i>
                                                    <i class="fas fa-star fa-2x sel-rat" data-index="3"></i>
                                                    <i class="fas fa-star fa-2x sel-rat" data-index="4"></i>
                                                </div>
                                                <div class="review-text">
                                                    <textarea name="seller-review" id="comment" class="form-control" cols="30" rows="10" placeholder="Enter your comment"></textarea>
                                                </div>
                                            </div>
                                        </div> -->
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="text-center py-2">
                            <button type="submit" name="save_review" class="btn btn-sm btn-success">Save review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        //rating('.sel-rat','seller_rating');
        rating('.rat','product_rating');
        function rating(classes,indexes) { 
            resetStarColor();
            var ratedIndex = -1;
            remindRated();
            $(classes).mouseover(function () { 
                resetStarColor();
                var currIndex = parseInt($(this).data("index"));
                for(i=0;i<=currIndex; i++){
                    setStar(currIndex);
                }
            });
            $(classes).click(function () { 
                ratedIndex = parseInt($(this).data('index'));
                localStorage.setItem(indexes,ratedIndex);
            });
            $(classes).mouseleave(function () { 
                resetStarColor();
                if(ratedIndex != -1){
                    setStar(ratedIndex);
                }
                remindRated();
            });
            function setStar(max) { 
                for(i=0;i<=max; i++){
                    $(classes+':eq('+i+')').css('color', '#ffc107');
                }
            }
            function resetStarColor() { 
                $(classes).css('color','#888');
            };
            function remindRated() { 

                if(localStorage.getItem(indexes) != null){
                    setStar(parseInt(localStorage.getItem(indexes)));
                }
            }
        }

        $('[name="save_review"]').click(function (e) { 
            e.preventDefault();
            var rating = localStorage.getItem('product_rating');
            if(rating == null){
                rating = 0;
            }else{
                rating = parseInt(rating)+1;
            }
            var uid    = <?= $usrid ?>;
            var pid    = <?= $pid ?>;
            var url    = "<?= URL ?>";
            var order  = "<?= $_GET['order'] ?>";
            var comm   = $('[name="review"]').val();
            $.ajax({
                type: "POST",
                url:  url+"api/review.php",
                data: {
                    user    : uid,
                    product : pid,
                    rating  : rating,
                    comment : comm,
                    order : order,
                    action  : 'saveReview'
                },
                dataType: "Json",
                success: function (response) {
                    window.location.href = url+'order-list';
                },
                error: function (err) { 
                    console.log(err);
                }
            });
        });

    });
</script>
<?php
    }else{
        echo "<script>window.location.href='order-list'</script>";
    }
}else{
    echo "<script>window.location.href='user-login'</script>";
}
include("../inc/footer.php");
?>