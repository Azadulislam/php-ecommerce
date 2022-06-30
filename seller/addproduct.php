<?php
$title = "Profile || Active supper shope";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");

if(isset($_POST['addblog'])){
    $addpro = $pro->addProduct($_POST);
}
if(isset($_COOKIE['customer'])){
    echo "<script>window.location.href='customer-dashboard'</script>";
}
if(isset($_COOKIE['vendor'])){
    include ('../php/function.php');
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
                        <h5 class="heading mb-0">Add Product</h5>
                        <div class="addblog mt-3 col-10 mx-auto p-0">
                            <div class="col-12">
                                <?php
                                    if(isset($pro->suc)){
                                        ?>
                                        <div class="alert alert-success text-center p-2 mt-2"><?= $pro->suc ?></div>
                                        <?php
                                    }elseif(isset($pro->err)){
                                        ?>
                                        <div class="alert alert-warning text-center p-2 mt-2"><?= $pro->err ?></div>
                                        <?php
                                    }elseif(isset($_GET['deleted'])){
                                        ?>
                                        <div class="alert alert-warning text-center p-2 mt-2">Data delete successfull</div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="row m-0 mb-2">
                                <label class="col-3" for="pname">Name</label>
                                <input type="hidden" name="seller" value="<?= $usrdata['id'] ?>">
                                <div class="col-9"><input type="text" class="form-control" name="pname" id="pname" placehoslder="Enter Product Name"></div>
                            </div>
                            <div class="row m-0 mb-3">
                                <label class="col-3" for="prdimage">Image</label>
                                <div class="col-9">
                                    <div class="row ">
                                        <div class="col-4 pr-1">
                                            <input type="file" id="prdimage" name="prdimage" data-height="100" class="dropify" data-default-file="<?= $dir ?>default.jpg" >
                                        </div>
                                        <div class="col-4 px-1">
                                            <input type="file" name="prdimage2" data-height="100" class="dropify" data-default-file="<?= $dir ?>default.jpg" >
                                        </div>
                                        <div class="col-4 pl-1">
                                            <input type="file" name="prdimage3" data-height="100" class="dropify" data-default-file="<?= $dir ?>default.jpg" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 mb-3">
                                <label class="col-3 mr-0" for="prddesc">Product Description</label>
                                <div class="col-9">
                                    <textarea name="prddesc" id="prddesc" class="summernote bg-light"></textarea>
                                    <div for="prddesc" class="error"></div>
                                </div>
                            </div>
                            <div class="row m-0  mb-3">
                                <label class="control-label col-3 mr-0" for="category">Category</label>
                                <div class="col-9">
                                    <select class="form-control" name="category" data-get="sub_category" data-target="#subCategory" id="category">
                                        <option value="">---Select Category---</option> 
                                        <?php
                                        $selcat = $db->rnQuery("SELECT * FROM `category` WHERE `status`='1'");
                                        while($cat = mysqli_fetch_assoc($selcat)){
                                            ?><option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option><?php
                                        }
                                        ?>
                                    </select>
                                    <div for="category" class="error"></div>
                                </div>
                            </div>
                            <div class="row m-0 mb-3">
                                <label class="control-label col-3" for="subCategory">Sub Category</label>
                                <div class="col-9">
                                    <select class="form-control" name="subCategory" id="subCategory">
                                        <option value="">---Select Subcategory---</option>
                                    </select>
                                    <small for="subCategory" class="error"></small>
                                </div>
                            </div>
                            <div class="row m-0  mb-3">
                                <label class="control-label col-3 mr-0" for="brand">Brand</label>
                                <div class="col-9">
                                    <select class="form-control" name="brand" id="brand">
                                        <option value="">---Select Brand---</option> 
                                        <?php
                                        $selcat = $db->rnQuery("SELECT * FROM `brands` WHERE `status`='1'");
                                        while($item = mysqli_fetch_assoc($selcat)){
                                            ?><option value="<?= $item['id'] ?>"><?= $item['name'] ?></option><?php
                                        }
                                        ?>
                                    </select> 
                                    <div for="category" class="error"></div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <label for="quantity" class="control-label col-3">Quantity</label>
                                <div class="col-9 mb-3">
                                    <input type="number" name="quantity" class="form-control" min='0' placeholder="Quantity">
                                </div>
                            </div>
                            <div class="row m-0 mb-2">
                                <label class="col-3" for="price">Price</label>
                                    <div class="col-9 input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                        </div>
                                    <input type="number" class="form-control" name="price" id="price" min='0' placehoslder="Enter Product price">
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
                                <label for="status" class="error col-12"></label>
                            </div>
                            <div class="row m-0 mb-2">
                                <label class="col-3 mr-0"></label>
                                <div class="col-9">
                                    <button class="btn btn-theme my-2" name="addblog">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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