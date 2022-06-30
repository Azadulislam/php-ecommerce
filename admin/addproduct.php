<?php

    $title = "Add Products || Demo shop";

    include_once ("inc/header.php");

    $pro = new classes\Product;

    if(isset($_POST['publishPro'])){

        $ins = $pro->addProduct($_POST);

    }

    $dir = "../uploads/";

?>

                <!-- Bread crumb and right sidebar toggle -->

                <div class="row page-titles">

                    <div class="col-md-5 col-8 align-self-center">

                        <h3 class="text-themecolor">Products</h3>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card card-outline-info">

                            <div class="card-header">

                                <h4 class="m-b-0 text-white mess">Add Product form</h4>

                            </div>

                            <div class="card-body">

                                <form action="" method="POST" id="productForm" enctype="multipart/form-data">

                                    <div class="form-body">

                                        <div  class="col-md-8 col-sm-10 p-t-20 mx-auto">

                                            <?php

                                                if(isset($pro->suc)){

                                                    ?>

                                                    <div class="alert alert-success text-center"><?= $pro->suc ?></div>

                                                    <?php

                                                }elseif(isset($pro->err)){

                                                    ?>

                                                    <div class="alert alert-warning text-center"><?= $pro->err ?></div>

                                                    <?php

                                                }elseif(isset($_GET['deleted'])){

                                                    ?>

                                                    <div class="alert alert-warning text-center">Data delete successfull</div>

                                                    <?php

                                                }

                                            ?>

                                            <div class="col-12">

                                                <div class="form-group mb-2">

                                                    <label for="pname" class="control-label">Product Name</label>

                                                    <input type="text" name="pname" id="pname" class="form-control" placeholder="Product name">

                                                    <input type="hidden" name="seller" value="<?= WON ?>">

                                                </div>

                                            </div>

                                            

                                            <!--/span-->

                                            <div class="col-12 ">

                                                <label for="prddesc">Product Description</label>

                                                <textarea name="prddesc" id="prddesc" class="summernote" cols="20" rows="5" data-placeholder="Enter product description" ></textarea>

                                                <label for="prddesc" id="prddesc-error" class="error"></label>

                                            </div>

                                            <div class="col-12">

                                                <div class="form-group mb-2">

                                                    <label class="control-label" for="category">Category</label>

                                                    <select class="form-control" name="category" data-get='subcategory' data-target='#subCategory'>

                                                        <option value="">---Select Category---</option> 

                                                        <?php

                                                        $selcat = $db->rnQuery("SELECT * FROM `category` WHERE `status`='1'");

                                                        while($cat = mysqli_fetch_assoc($selcat)){

                                                            ?><option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option><?php

                                                        }

                                                        ?>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="form-group my-2">

                                                    <label class="control-label" for="subCategory">Sub Category</label>

                                                    <select class="form-control" data-get="brand" data-target="#brand" name="subCategory" id="subCategory">

                                                        <option value="">--Select sub category--</option>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="form-group my-2">

                                                    <label class="control-label" for="brand">Brand</label>

                                                    <select class="form-control" name="brand" id="brand">

                                                        <option value="">---Select Brand---</option>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="form-group mb-2">

                                                    <label for="quantity" class="control-label">Quantity</label>

                                                    <input type="number" name="quantity" class="form-control" placeholder="Quantity">

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="form-group mb-3">

                                                    <label for="price">Price</label>

                                                    <div class="input-group">

                                                        <div class="input-group-addon"><i class='fa fa-dollar-sign'></i></div>

                                                        <input type="number" class="form-control" name="price" placeholder="Enter product price">

                                                    </div>

                                                    <label id="price-error" for="price" class="error"></label>

                                                </div>

                                            </div>

                                            <!--/span-->

                                            <div class="row m-0 mt-3">

                                                <div class="col-12"><h5>Product image</h5></div>

                                                <div class="col-4">

                                                    <div class="form-group mb-2">

                                                        <input type="file" name="prdimage" id="prdimage" data-height="150" class="dropify" data-default-file="<?= $dir ?>default.jpg" />

                                                        <small>This is primary image <span class="text-danger">*</span></small>

                                                    </div>

                                                </div>

                                                <div class="col-4">

                                                    <div class="form-group mb-2">

                                                        <input type="file" name="prdimage2" id="prdimage2" data-height="150" class="dropify" data-default-file="<?= $dir ?>default.jpg" />

                                                    </div>

                                                </div>

                                                <div class="col-4">

                                                    <div class="form-group mb-2">

                                                        <input type="file" name="prdimage3" id="prdimage3" data-height="150" class="dropify" data-default-file="<?= $dir ?>default.jpg" />

                                                    </div>

                                                </div>

                                                <div class="px-3"><label id="prdimage-error" for="prdimage" class="error"></label></div>

                                            </div>

                                            <div class="col-12 ">

                                                <div class="form-group mb-2">

                                                    <label class="control-label">Status</label>

                                                    <div class="form-check mb-2">

                                                        <label class="custom-control custom-radio">

                                                            <input id="status" name="status" type="radio"  value="1"  class="custom-control-input">

                                                            <span class="custom-control-indicator"></span>

                                                            <span class="custom-control-description">Active</span>

                                                        </label>

                                                        <label class="custom-control custom-radio">

                                                            <input id="status" name="status" type="radio" value="2" class="custom-control-input">

                                                            <span class="custom-control-indicator"></span>

                                                            <span class="custom-control-description">Inactive</span>

                                                        </label>

                                                    </div>

                                                    <label id="status-error" for="status" class="error"></label>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-actions text-center ">

                                        <button type="submit" class="btn btn-success" name="publishPro"> Published </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

                <?php



                    include_once ("inc/footer.php");

                ?>