<?php
$title = "Profile || Demo supper shope";
$asset = "";
$adloc = "../";
$autoloc = "../";
$fnloc = "../";
$dir = "uploads/";
include("../inc/header.php");
if(isset($_COOKIE['customer'])){
    echo "<script>window.location.href='customer-dashboard'</script>";  
}
if(isset($_COOKIE['vendor']) && $roll=='vendor'){
?>
<?php
    include ('../php/function.php')
        ?>
<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
        <div class="col-lg-3">  
            <?php include ('templates/_sidbar.php') ?>
        </div>
        <div id="maindiv" class="col-lg-9">  
            <div class="content">
                <h5 class="heading mb-0">Profile Information</h5>
                <div class="profilesection pr-3">
                    <div class="row">
                        <div class="col-3">
                            <a href="#"><img class='img-fulid w-100' src="<?= $dir.$usrdata['profile'] ?>" alt=""></a>
                        </div>
                        <div class="col-9">
                            <div class="row mr-0 ml-0">
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>User Name</b></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><?= $usrdata['fname'] ?></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>Display Name</b></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><?= $usrdata['lname'] ?></div>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>Email</b></div>
                                <div class="col-9 border-bottom py-2 pl-0 pr-0"><?= $usrdata['email'] ?></div>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>Country</b></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><?= $usrdata['country'] ?></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>City</b></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><?= $usrdata['city'] ?></div>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>Address 1</b></div>
                                <div class="col-9 border-bottom py-2 pl-0 pr-0"><?= $usrdata['address1'] ?></div>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>Address 2</b></div>
                                <div class="col-9 border-bottom py-2 pl-0 pr-0"><?= $usrdata['address2'] ?></div>
                            </div>
                            <div class="row mr-0 ml-0">
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>State</b></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><?= $usrdata['state'] ?></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><b>Zip</b></div>
                                <div class="col-3 border-bottom py-2 pl-0 pr-0"><?= $usrdata['zip'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 my-3">
                        <div class="product-summuri">
                            <h6>Uploaded product</h6>
                            <div class="icon-count p-3">
                                <h1><span class='icon  mr-5'><i class="fas fa-birthday-cake"></i></span><span class='count'><?= $proRows > 0?  $proRows:0; ?></span></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
}else{
  echo "<script>window.location.href='user-login'</script>";  
}
include("../inc/footer.php");
?>
