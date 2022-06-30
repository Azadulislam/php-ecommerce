<?php
    $title = "Edit Product || Azad demo shop";
    include_once ("inc/header.php");
    $pro = new classes\Product;
    if(isset($_POST['updatepro'])){
        $ins = $pro->updateProduct($_POST);
    }
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        if(!empty($id)){
        $product = $db->selectSingle("SELECT * FROM `product` WHERE `id`='$id'");
        $catid   = $product['category'];
        if($product == false){
            echo "<script>window.location.href='manage_product.php'</script>";
        }
    
    $dir = "../uploads/";
?>
        
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Product</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Edit Product form</h4>
                            </div>
                            <div class="card-body">
                            <div class="col-md-12 text-right"><a class="btn btn-info mr-2" href="manage_product.php">back</a></div>
                                <form action="" method="POST" id="updateProductForm" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div  class="col-md-8 col-sm-10 p-t-20 mx-auto">
                                            <div class="col-12">
                                                <?php
                                                    if(isset($pro->suc)){
                                                        ?>
                                                        <div class="alert alert-success text-center"><?= $pro->suc ?></div>
                                                        <?php
                                                    }elseif(isset($pro->err)){
                                                        ?>
                                                        <div class="alert alert-warning text-center"><?= $pro->err ?></div>
                                                        <?php
                                                    }
                                                ?>
                                                <div class="form-group mb-3">
                                                    <label for="pname" class="control-label">Product Name</label>
                                                    <input type="text" name="pname" id="pname" class="form-control" value="<?= $product['name'] ?>" placeholder="Product name">
                                                    <input type="hidden" value="<?= $product['id'] ?>" name="id">
                                                    <input type="hidden" value="<?= $product['image'] ?>" name="old">
                                                    <input type="hidden" value="<?= $product['image2'] ?>" name="old2">
                                                    <input type="hidden" value="<?= $product['image3'] ?>" name="old3">
                                                </div>
                                            </div>
                                            
                                            <!--/span-->
                                            <div class="col-12 ">
                                                <label for="prddesc">Product Description</label>
                                                <textarea name="prddesc" id="prddesc" class="summernote" cols="20" rows="5"><?= $product['pro_desc'] ?></textarea>
                                                <label for="prddesc" class="error"></label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group my-3">
                                                    <label class="control-label" for="category">Category</label>
                                                    <select class="form-control" name="category" data-get='subcategory' data-target='#subCategory'>
                                                        <option value="">---Select Category---</option> 
                                                        <?php
                                                        $selcat = $db->rnQuery("SELECT * FROM `category` WHERE `status`='1'");
                                                        while($cat = mysqli_fetch_assoc($selcat)){
                                                            $cId = $cat['id'];
                                                            ?><option value="<?= $cat['id'] ?>" <?= $product['category']==$cat['id']?'selected':'' ?>><?= $cat['name'] ?></option><?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="category" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group  mb-1">
                                                    <label for="subCategory"> Sub Category</label>
                                                    <select class="form-control" id="subCategory" name="subCategory">
                                                        <option value=""> --Select Sub category-- </option>
                                                        <?php
                                                        $select = $db->rnQuery("SELECT * FROM `sub_category` WHERE `status`='1' AND `cat`='$catid'");
                                                        foreach($select as $item){
                                                            ?><option value="<?= $item['id'] ?>" <?= $product['subCategory']==$item['id']?'selected':'' ?>><?= $item['name'] ?></option><?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group my-3">
                                                    <label class="control-label" for="brand">Brand</label>
                                                    <select class="form-control" name="brand" id="brand">
                                                        <option value="">---Select Brand---</option> 
                                                        <?php
                                                        $selcat = $db->getActiveData('brands');
                                                        foreach($selcat as $item){
                                                            ?><option value="<?= $item['id'] ?>" <?= $item['id']==$product['brand']?'selected':'' ?>><?= $item['name'] ?></option><?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="price">Price</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class='fa fa-dollar-sign'></i></div>
                                                        <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>" placeholder="Enter product price">
                                                    </div>
                                                    <p for="price" class="error"></p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="discount">Discount</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="discount" min="0" max="100" value="<?= $product['discount'] ?>" placeholder="Enter product discount">
                                                        <div class="input-group-addon"><i class="fas fa-percent"></i></div>
                                                    </div>
                                                    <p for="discount" class="error"></p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="quantity" class="control-label">Quantity</label>
                                                    <input type="number" name="quantity" class="form-control" value="<?= $product['quantity'] ?>" placeholder="Quantity">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="row m-0 mt-1">
                                                <div class="col-12"><h5>Product image</h5></div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <input type="file" name="prdimage" id="prdimage" data-height="150" class="dropify" data-default-file="<?= $dir.$product['image'] ?>" />
                                                        <small>This is primary image <span class="text-danger">*</span></small>
                                                        <p class='mb-0'><label for="prdimage" class="error"></label></p>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <input type="file" name="prdimage2" id="prdimage2" data-height="150" class="dropify" data-default-file="<?= $dir.$product['image2'] ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <input type="file" name="prdimage3" id="prdimage3" data-height="150" class="dropify" data-default-file="<?= $dir.$product['image3'] ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12"><label for="status" class="error"></label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-center ">
                                        <button type="submit" class="btn btn-success" name="updatepro"> Published </button>
                                    </div>
                                </form>
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