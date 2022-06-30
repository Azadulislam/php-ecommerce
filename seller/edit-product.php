<?php
$title = "Profile || Active supper shope";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");

if(isset($_POST['editProduct'])){
    $addpro = $pro->updateProduct($_POST);
}
if(isset($_COOKIE['customer'])){
    echo "<script>window.location.href='customer-dashboard'</script>";
}
if(isset($_COOKIE['vendor'])){
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        if($id==null){
            echo "<script>window.location.href='vendor-product'</script>";
        }else{
        $product = $db->getTableData('product','id',$id);
        $prodcut_item = mysqli_fetch_assoc($product);
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
                        <h5 class="heading mb-0">Edit Product</h5>
                        <?php
                            if(isset($pro->suc)){
                                ?>
                                <div class="alert alert-success text-center mt-2"><?= $pro->suc ?></div>
                                <?php
                            }elseif(isset($pro->err)){
                                ?>
                                <div class="alert alert-warning text-center mt-2"><?= $pro->err ?></div>
                                <?php
                            }
                        ?>
                        <div class="addblog mt-3 col-10 mx-auto p-0">
                            <div class="row m-0 mb-2">
                                <label class="col-3" for="pname">Name</label>
                                <input type="hidden" value="<?= $prodcut_item['id'] ?>" name="id">
                                <div class="col-9"><input type="text" class="form-control" name="pname" value="<?= $prodcut_item['name'] ?>" id="pname" placehoslder="Enter Product Name"></div>
                            </div>
                            <div class="row m-0 mb-3">
                                <label class="col-3" for="prdimage">Image</label>
                                <div class="col-9">
                                    <div class="row ">
                                        <div class="col-4 pr-1">
                                            <input type="file" id="prdimage" name="prdimage" data-height="100" class="dropify" data-default-file="<?= $dir.$prodcut_item['image'] ?>" >
                                            <input type="hidden" value="<?= $prodcut_item['image'] ?>" name="old">
                                        </div>
                                        <div class="col-4 px-1">
                                            <input type="file" name="prdimage2" data-height="100" class="dropify" data-default-file="<?= $dir.$prodcut_item['image2'] ?>" >
                                            <input type="hidden" value="<?= $prodcut_item['image2'] ?>" name="old2">
                                        </div>
                                        <div class="col-4 pl-1">
                                            <input type="file" name="prdimage3" data-height="100" class="dropify" data-default-file="<?= $dir.$prodcut_item['image3'] ?>" >
                                            <input type="hidden" value="<?= $prodcut_item['image3'] ?>" name="old3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 mb-3">
                                <label class="col-3 mr-0" for="prddesc">Product Description</label>
                                <div class="col-9">
                                    <textarea name="prddesc" id="prddesc" class="summernote bg-light"><?= $prodcut_item['pro_desc'] ?></textarea>
                                    <div for="prddesc" class="error"></div>
                                </div>
                            </div>
                            <div class="row m-0  mb-3">
                                <label class="control-label col-3 mr-0" for="category">Category</label>
                                <div class="col-9">
                                    <select class="form-control" name="category" id="category">
                                        <option value="">---Select Category---</option> 
                                        <?php
                                        $selcat = $db->rnQuery("SELECT * FROM `category` WHERE  `status`='1'");
                                        while($cat = mysqli_fetch_assoc($selcat)){
                                            $cId = $cat['id'];
                                            $ssc = $db->rnQuery("SELECT * FROM `sub_category` WHERE `cat`='$cId' AND `status`='1'");
                                            if(mysqli_num_rows($ssc)>0){
                                                while($subCat = mysqli_fetch_assoc($ssc)){
                                                    ?><option value="<?= $subCat['id'] ?>" <?= $prodcut_item['category']==$subCat['id']?'selected':'' ?> ><?= $cat['name'] ?>/<?= $subCat['name'] ?></option><?php
                                                }
                                            }else{
                                                ?><option value="<?= $cat['id'] ?>" <?= $prodcut_item['category']==$cat['id']?'selected':'' ?>><?= $cat['name'] ?></option><?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div for="category" class="error"></div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <label for="quantity" class="control-label col-3">Quantity</label>
                                <div class="col-9 mb-3">
                                    <input type="number" name="quantity" value="<?= $prodcut_item['quantity'] ?>" class="form-control" min='0' placeholder="Quantity">
                                </div>
                            </div>
                            <div class="row m-0 mb-2">
                                <label class="col-3" for="price">Price</label>
                                <div class="col-9 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                    <input type="number" class="form-control" name="price"  value="<?= $prodcut_item['price'] ?>" id="price" min='0' placehoslder="Enter Product price">
                                </div>
                            </div>
                            <div class="row m-0 mb-2">
                                <label class="col-3" for="discount">Discount</label>
                                <div class="col-9 input-group">
                                    <input type="number" class="form-control" name="discount"  value="<?= $prodcut_item['discount'] ?>" id="discount" min='0' placehoslder="Enter Product Discount">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2 mx-0">
                                <label class="col-3">Status</label>
                                <label class="col-4">
                                    <input name="status" type="radio"  value="1" <?= $prodcut_item['status']==1?'checked':'' ?>>
                                    <span class="ml-2">Active</span>
                                </label>
                                <label class="col-5">
                                    <input name="status" type="radio" value="2" <?= $prodcut_item['status']==2?'checked':'' ?>>
                                    <span class="ml-2">Inactive</span>
                                </label>
                                <label for="status" class="error col-12"></label>
                            </div>
                            <div class="row m-0 mb-2">
                                <label class="col-3 mr-0"></label>
                                <div class="col-9">
                                    <button class="btn btn-theme my-2" name="editProduct">Save</button>
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
        }   
            }else{
                echo "<script>window.location.href='vendor-product'</script>";
            }
        }else{
            echo "<script>window.location.href='user-login'</script>";
        }
include("../inc/footer.php");
?>