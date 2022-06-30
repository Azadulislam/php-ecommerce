<?php
    ob_start();
    $title = "Add Selles || Demo Shop";
    include_once ("inc/header.php");
    $pro = new classes\Product;
    if(isset($_GET['delete'])){
        // $delid = $_GET['delete'];
        // $delet = $pro->deleteProduct($delid);
    }elseif(isset($_GET['status'])){
        // $id = $_GET['status'];
        // $updeal = $pro->updateStatus($id);
    };
    $dir = "../uploads/";
    
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Selles</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Add Selles form  <a class="float-right text-white" href="selles.php">Back</a></h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" id="categoryform">
                                    <div class="form-body ">
                                        <div class="col-md-6 mx-auto p-t-20">
                                            <?php
                                                if(isset($cat->succ)){
                                                    ?>
                                                    <div class="alert alert-success text-center"><?= $cat->succ ?></div>
                                                    <?php
                                                }elseif(isset($cat->err)){
                                                    ?>
                                                    <div class="alert alert-warning text-center"><?= $cat->err ?></div>
                                                    <?php
                                                }elseif(isset($_GET['deleted'])){
                                                    ?>
                                                    <div class="alert alert-warning text-center">Data delete successfull</div>
                                                    <?php
                                                }
                                            ?>
                                            <div class="col-12">
                                                <div class="form-group  mb-1">
                                                    <label for="product" class="control-label">Product</label>
                                                    <select name="product" id="product" class="selectpicker form-control" data-live-search="true">
                                                        <option value="">---Select Product---</option>
                                                        <?php
                                                            $product = $db->rnQuery("SELECT * FROM `product` ");
                                                            $i=1;
                                                            while($productitem = mysqli_fetch_array($product)){
                                                                ?>
                                                                <option value=""><?= $productitem['name'] ?></option>
                                                                <?php
                                                                $i++;
                                                            }
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group  mb-1 img">
                                                    <img src="<?= $dir ?>" class="img-fluid" alt="Product">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group  mb-1">
                                                    <label for="count">Count</label>
                                                    <input type="number" name="count" id="count" class="form-control" placeholder="Product"/>
                                                    <?php if(isset($_COOKIE['admin'])){ ?>
                                                        <?php } ?>
                                                        <input type="hidden" name="saler" value="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-12">
                                                <div class="row pb-2">
                                                    <label class="col-4" for="">Price</label>
                                                    <div class="col-8"><span>$</span><span class="amount">20</span></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-1">
                                                    <label for="selectBuyer" class="control-label">Buyer</label>
                                                    <select name="selectBuyer" id="selectBuyer" class="selectpicker form-control" data-live-search="true">
                                                        <option value="">---Select Buyer---</option>
                                                        <?php
                                                            $product = $db->rnQuery("SELECT * FROM `user` WHERE 'roll'='1'");
                                                            $i=1;
                                                            while($productitem = mysqli_fetch_array($product)){
                                                                ?>
                                                                <option value=""><?= $productitem['name'] ?></option>
                                                                <?php
                                                                $i++;
                                                            }
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group ">
                                                    <label for="count">Payment</label>
                                                    <select name="" id="payment" class="form-control">
                                                        <option class="text-danger" value="0">Due</option>
                                                        <option class="text-success" value="1">Paid</option>
                                                        <option class="text-primary" value="2">COD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-center">
                                        <button type="submit" class="btn btn-success" name="savecat"> <i class="fa fa-check"></i> Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Row -->
                <!-- End PAge Content -->
                <!-- Right sidebar -->
                
                <?php
                    include_once ("inc/footer.php");
                ?>