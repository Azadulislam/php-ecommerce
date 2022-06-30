<?php
    $title = "Edit Category || Azad demo shop";
    include_once ("inc/header.php");
    $cat = new classes\Category;
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        if(!empty($id)){

        $selcat = $db->rnQuery("SELECT * FROM `category` WHERE `id`='$id'");
        if(mysqli_num_rows($selcat)>0){
        $catdata = mysqli_fetch_assoc($selcat);
        if(isset($_POST['savecat'])){
            $upcat = $cat->updateCategory($_POST);
        }
        $dir = "../uploads/";
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Edit Categories</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Edit categories form  <a class="btn btn-info float-right" href="category.php">Back</a></h4>
                            </div>
                            <div class="card-body">
                            <?php
                                if(isset($cat->succ)){
                                    ?>
                                    <div class="alert alert-success text-center"><?= $cat->succ ?></div>
                                    <?php
                                }elseif(isset($cat->err)){
                                    ?>
                                    <div class="alert alert-warning text-center"><?= $cat->err ?></div>
                                    <?php
                                }elseif(isset($_GET['success'])){
                                    ?>
                                    <div class="alert alert-success text-center">Category Save Success</div>
                                    <?php
                                }
                            ?>
                                <form action="" method="POST" id="editcategory" enctype="multipart/form-data">
                                    <div class="form-body ">
                                        <div class="col-md-6 mx-auto p-t-20">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="catname" class="control-label">Category Name</label>
                                                    <input type="text" name="catname" id="catname" value="<?= $catdata['name'] ?>" class="form-control" placeholder="Category name">
                                                    <input type="hidden" name="id" value="<?= $catdata['id'] ?>">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="catbanner">Category banner</label>
                                                    <input type="file" name="catbanner" id="catbanner" data-height="80" class="dropify" data-default-file="<?= $dir.$catdata['banner'] ?>" />
                                                    <input type="hidden" name="oldben" value="<?= $catdata['banner'] ?>">
                                                    <p class='mb-0'><label for="catbanner" class="error"></label></p>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="control-label">Status</label>
                                                    <div class="form-check">
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio1" name="cat_status" type="radio"  value="1" <?= $catdata['status'] == 1? 'checked':'' ?>  class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Active</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio2" name="cat_status" type="radio" value="2" <?= $catdata['status'] == 2? 'checked':'' ?> class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Inactive</span>
                                                        </label>
                                                        <p class='mb-0'><label for="cat_status" class="error"></label></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-center">
                                        <button type="submit" class="btn btn-success" name="savecat"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                
                <?php
                 }else{
                    ?>
                    <h1 class='text-center text-warning text-uppercase'>No category with this id</h1>
                    <?php
                }
        }else{
            echo "<script>window.location.href='category.php'</script>";
        }
                    }else{
                        echo "<script>window.location.href='category.php'</script>";
                    }
                    include_once ("inc/footer.php");
                ?>