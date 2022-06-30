<?php
$title = "Product || Demo supper shope";
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
    include ('../php/function.php');
    if(isset($_POST['addproduct'])){
        $pro->addclassified($_POST);
    }
?>
<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
        <div class="col-lg-3">  
            <?php include ('templates/_sidbar.php') ?>
        </div>
        <div id="maindiv" class="col-lg-9"> 
            <div class="content ">
                <form action="" method="post" enctype="multipart/form-data">
                    <h6 class="heading mb-0">Add Product</h6>
                    <div class="addblog mt-3 col-10 mx-auto p-0">
                        <?php
                            if(isset($pro->suc)){
                                ?>
                                <div class="alert alert-success text-center p-2 mt-2"><?= $pro->suc ?></div>
                                <?php
                            }elseif(isset($pro->err)){
                                ?>
                                <div class="alert alert-warning text-center p-2 mt-2"><?= $pro->err ?></div>
                                <?php
                            }
                        ?>
                        <div class="row m-0 mb-2">
                            <label class="col-3" for="name">Name</label>
                            <input type="hidden" name="seler" value="<?= $usrdata['id'] ?>">
                            <div class="col-9"><input type="text" class="form-control" name="name" id="name" placehoslder="Enter Product Name"></div>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3" for="image">Image</label>
                            <div class="col-9">
                                <div class="row ">
                                    <div class="col-4 pr-1">
                                        <input type="file" id="image" name="image" data-height="100" class="dropify" data-default-file="<?= $dir ?>default.jpg" >
                                    </div>
                                    <div class="col-4 px-1">
                                        <input type="file" name="image2" data-height="100" class="dropify" data-default-file="<?= $dir ?>default.jpg" >
                                    </div>
                                    <div class="col-4 pl-1">
                                        <input type="file" name="image3" data-height="100" class="dropify" data-default-file="<?= $dir ?>default.jpg" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3 mr-0" for="description">Product Description</label>
                            <div class="col-9">
                                <textarea name="description" id="description" class="summernote bg-light"></textarea>
                                <p for="description" class="error"></p>
                            </div>
                        </div>
                        <div class="row m-0  mb-3">
                            <label class="control-label col-3 mr-0" for="category">Category</label>
                            <div class="col-9">
                                <select class="form-control" name="category" id="category">
                                    <option value="">---Select Category---</option> 
                                    <?php
                                    $selcat = $db->rnQuery("SELECT * FROM `category` WHERE `status`='1'");
                                    while($cat = mysqli_fetch_assoc($selcat)){
                                        $cId = $cat['id'];
                                        $ssc = $db->rnQuery("SELECT * FROM `sub_category` WHERE `cat`='$cId'");
                                        if(mysqli_num_rows($ssc)>0){
                                            while($subCat = mysqli_fetch_assoc($ssc)){
                                                ?><option value="<?= $subCat['id'] ?>"><?= $cat['name'] ?>/<?= $subCat['name'] ?></option><?php
                                            }
                                        }else{
                                            ?><option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option><?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div for="category" class="error"></div>
                            </div>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3" for="price">Price</label>
                                <div class="col-9 input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                <input type="number" class="form-control" name="price" id="price" placehoslder="Enter Product price">
                            </div>
                        </div>
                        <div class="row my-2 mx-0">
                            <label class="col-3">Status</label>
                            <label class="col-2">
                                <input name="status" type="radio"  value="1"  class="">
                                <span class="ml-2">Active</span>
                            </label>
                            <label class="col-7">
                                <input name="status" type="radio" value="2" class="">
                                <span class="ml-2">Inactive</span>
                            </label>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3 mr-0"></label>
                            <div class="col-9">
                                <button class="btn btn-theme my-2" name="addproduct">Add</button>
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