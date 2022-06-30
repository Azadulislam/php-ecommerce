<?php
$title = "Profile || Demo supper shope";
$asset = "";
$adloc = "../";
$autoloc = "../";
$fnloc = "../";
$dir = "uploads/";
include("../inc/header.php");
if(isset($_POST['saveProfile'])){
    $usr->updateCustomer($_POST);
}
if(isset($_COOKIE['vendor'])){
    echo "<script>window.location.href='vendor-dashboard'</script>";  
}
if(isset($_COOKIE['customer']) && $roll=='customer'){
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
                <form action="" method="post" enctype="multipart/form-data">
                    <h6 class="heading mb-2">Profile Information</h6>
                    <?php
                        if(isset($usr->suc)){
                            ?>
                            <div class="alert alert-success text-center"><?= $usr->suc ?></div>
                            <?php
                        }elseif(isset($v->err)){
                            ?>
                            <div class="alert alert-warning text-center"><?= $usr->err ?></div>
                            <?php
                        }elseif(isset($_GET['success'])){
                            ?>
                            <div class="alert alert-success text-center">Updated successfully</div>
                            <?php
                        }
                    ?>
                    <div class="editsection pr-3">
                        <div class="row">
                            <div class="col-3">
                                <input type="file" id="profilepic" name="profilepic" data-height="100" class="dropify" data-default-file="<?= $dir.$usrdata['profile'] ?>" >
                                <input type="hidden" name="oldpic" value="<?= $usrdata['profile'] ?>">
                            </div>
                            <div class="col-9">
                                <div class="row mr-0 ml-0">
                                    <div class="col-3 py-2 pl-0 pr-0"><b>User Name</b></div>
                                    <div class="col-3 py-2 pl-0"><input type="text" name="fname" class="w-100" value="<?= $usrdata['fname'] ?>"></div>
                                    <input type="hidden" name="id" value="<?= $usrdata['id'] ?>">
                                    <div class="col-3 py-2 pr-0"><b>Display Name</b></div>
                                    <div class="col-3 py-2 pl-0 "><input type="text" name="lname" class="w-100" value="<?= $usrdata['lname'] ?>"></div>
                                </div>
                                <div class="row mr-0 ml-0">
                                    <div class="col-3 py-2 pl-0 pr-0"><b>Country</b></div>
                                    <div class="col-3 py-2 pl-0 "><input type="text" name="cntry" class="w-100" value="<?= $usrdata['country'] ?>"></div>
                                    <div class="col-3 py-2 pr-0"><b>City</b></div>
                                    <div class="col-3 py-2 pl-0 "><input type="text" name="city" class="w-100" value="<?= $usrdata['city'] ?>"></div>
                                </div>
                                <div class="row mr-0 ml-0">
                                    <div class="col-3 py-2 pr-0 pl-0"><b>Phone number</b></div>
                                    <div class="col-3 py-2 pl-0 "><input type="text" name="phnum" class="w-100" value="<?= $usrdata['ph_num'] ?>"></div>
                                    <div class="col-3 py-2 pr-0 pr-0"><b>State</b></div>
                                    <div class="col-3 py-2 pl-0 "><input type="text" name="state" class="w-100" value="<?= $usrdata['state'] ?>"></div>
                                </div>
                                <div class="row mr-0 ml-0">
                                    <div class="col-3 py-2 pl-0 pr-0"><b>Address 1</b></div>
                                    <div class="col-9 py-2 pl-0 "><input type="text" name="add1" class="w-100" value="<?= $usrdata['address1'] ?>"></div>
                                </div>
                                <div class="row mr-0 ml-0">
                                    <div class="col-3 py-2 pl-0 pr-0"><b>Address 2</b></div>
                                    <div class="col-9 py-2 pl-0 "><input type="text" name="add2" class="w-100" value="<?= $usrdata['address2'] ?>"></div>
                                </div>
                                <div class="row mr-0 ml-0">
                                    <div class="col-3 py-2 pr-0"><b>Zip</b></div>
                                    <div class="col-3 py-2 pl-0 "><input type="text" name="zip" class="w-100" value="<?= $usrdata['zip'] ?>"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <button type="submit" name="saveProfile" class="btn btn-theme"><i class="fas fa-check"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        // Basic
                        $('.dropify').dropify();
                    });
                    jQuery(document).ready(function() {

                    $('.summernote').summernote({
                        height: 150, // set editor height
                        minHeight: 100, // set minimum height of editor
                        maxHeight: 200, // set maximum height of editor
                        focus: false, // set focus to editable area after initializing summernote
                        placeholder: "Enter product description"
                    });

                    $('.inline-editor').summernote({
                        airMode: true
                    });

                    });

                    window.edit = function() {
                        $(".click2edit").summernote()
                    },
                    window.save = function() {
                        $(".click2edit").summernote('destroy');
                    }
                </script>
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
