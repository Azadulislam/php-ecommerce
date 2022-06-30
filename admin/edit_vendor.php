<?php
    $title = "Edit Vendor || Azad demo shop";
    include_once ("inc/header.php");
    $usr = new classes\User;
    if(isset($_POST['saveuser'])){
        $updt = $usr->updateVendor($_POST);
        echo $updt;
    }
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        if(!empty($id)){
        $profile = $db->selectSingle("SELECT * FROM `user` WHERE `id`='$id'");
        if($profile == false){
            echo "<script>window.location.href='manage_product.php'</script>";
        }

        $roll = $profile['roll'];
        if($roll == 1){
            $con = "Customer";
        }else{
            $con = "Vendor";
        }
    
    $dir = "../uploads/";
?>
        
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Edit <?= $con ?></h3>
            </div>
        </div>
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- Start Page Content -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white mess"><?= $con ?> Edit form</h4>
                    </div>
                    <div class="card-body">
                    <div class="col-md-12 text-right"><a class="btn btn-info mr-2" href="vendor.php">back</a></div>
                        <form action="" method="POST" id="updateProductForm" enctype="multipart/form-data">
                            <div class="form-body">
                                <div  class="col-md-8 col-sm-10 p-t-20 mx-auto">
                                    <div class="col-12">
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
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="fname" class="control-label">First Name</label>
                                            <input type="text" name="fname" id="fname" class="form-control" value="<?= $profile['fname'] ?>" placeholder="First name">
                                            <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="lname" class="control-label">Display Name</label>
                                            <input type="text" name="lname" id="lname" class="form-control" value="<?= $profile['lname'] ?>" placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="profilepic">Profile picture</label>
                                                    <input type="file" name="profilepic" id="profilepic" data-height="80" class="dropify" data-default-file="<?= $dir.$profile['profile'] ?>" />
                                                    <input type="hidden" name="oldpic" value="<?= $profile['profile'] ?>">
                                                    <p class='mb-0'><label for="profilepic" class="error"></label></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bgimage">Background image</label>
                                                    <input type="file" name="bgimage" id="bgimage" data-height="80" class="dropify" data-default-file="<?= $dir.$profile['background'] ?>" />
                                                    <input type="hidden" name="oldbg" value="<?= $profile['background'] ?>">
                                                    <p class='mb-0'><label for="bgimage" class="error"></label></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="add1" class="control-label">Address 1</label>
                                            <input type="text" name="add1" class="form-control" value="<?= $profile['address1'] ?>" placeholder="Address 1">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="add2" class="control-label">Address 2</label>
                                            <input type="text" name="add2" class="form-control" value="<?= $profile['address2'] ?>" placeholder="Address 2">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="city" class="control-label">City</label>
                                            <input type="text" name="city" class="form-control" value="<?= $profile['city'] ?>" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="state" class="control-label">State</label>
                                            <input type="text" name="state" class="form-control" value="<?= $profile['state'] ?>" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="cntry" class="control-label">Country</label>
                                            <input type="text" name="cntry" class="form-control" value="<?= $profile['country'] ?>" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="zip" class="control-label">Zip code</label>
                                            <input type="number" name="zip" class="form-control" value="<?= $profile['zip'] ?>" placeholder="Zip code">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="roll" class="control-label">Roll</label>
                                            <select class="form-control" name="roll" id="">
                                                <option value="1" <?= $profile['roll']=='1'?'selected':'' ?>>Customer</option>
                                                <option value="2" <?= $profile['roll']=='2'?'selected':'' ?>>Vendor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-center ">
                                <button type="submit" class="btn btn-success" name="saveuser"> Save </button>
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