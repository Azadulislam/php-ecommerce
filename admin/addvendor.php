<?php
    $title = "Add Vendor || Demo shop";
    include_once ("inc/header.php");
    $usr = new classes\User;
    if(isset($_POST['addvendor'])){
        $usr->addvendor($_POST);
    }
    
    $dir = "../uploads/";
?>
        
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Add Vendor</h3>
            </div>
        </div>
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- Start Page Content -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white mess">Vendor add form</h4>
                    </div>
                    <div class="card-body">
                    <div class="col-md-12 text-right"><a class="btn btn-info mr-2" href="customer.php">back</a></div>
                        <form action="" method="POST" id="updateProductForm" enctype="multipart/form-data">
                            <div class="form-body">
                                    <?php
                                        if(isset($usr->suc)){
                                            ?>
                                            <div class="alert alert-success text-center mt-3"><?= $usr->suc ?></div>
                                            <?php
                                        }elseif(isset($usr->err)){
                                            ?>
                                            <div class="alert alert-warning text-center mt-3"><?= $usr->err ?></div>
                                            <?php
                                        }
                                        ?>
                                <div  class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="fname" class="control-label">First Name</label>
                                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First name">
                                            <input type="hidden" name="roll" value="2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="lname" class="control-label">Display Name</label>
                                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Display name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="add1" class="control-label">Address 1</label>
                                            <input type="text" name="add1" class="form-control" placeholder="Address 1">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="add2" class="control-label">Address 2</label>
                                            <input type="text" name="add2" class="form-control" placeholder="Address 2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="city" class="control-label">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="state" class="control-label">State</label>
                                            <input type="text" name="state" class="form-control" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="cntry" class="control-label">Country</label>
                                            <input type="text" name="cntry" class="form-control" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pwd" class="control-label">Password</label>
                                            <input type="password" name="pwd" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="zip" class="control-label">Zip code</label>
                                            <input type="number" name="zip" class="form-control" placeholder="Zip code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="cnfpewd" class="control-label">Confirm Password</label>
                                            <input type="password" name="cnfpewd" class="form-control" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-center ">
                                <button type="submit" class="btn btn-success" name="addvendor"><i class="fa fa-check"></i> Add </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include_once ("inc/footer.php");
        ?>