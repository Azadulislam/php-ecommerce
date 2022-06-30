<?php

    $title = "Sub category || Azad demo shop";

    include_once ("inc/header.php");

    $cat = new classes\Category;

    if(isset($_POST['saveSubcat'])){

        // start coding

        $addsub = $cat->addSubCategory($_POST);

    }elseif(isset($_POST['edit'])){

        $upSub = $cat->addSubCategory($_POST);

    }elseif(isset($_GET['delete'])){

        $delid = $_GET['delete'];

        $delet = $cat->deleteSubCategory($delid);

    };

    $dir = "../uploads/";

    

?>

                <!-- Bread crumb and right sidebar toggle -->

                <div class="row page-titles">

                    <div class="col-md-5 col-8 align-self-center">

                        <h3 class="text-themecolor">Sub Category</h3>

                    </div>

                </div>

                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Start Page Content -->

                <!-- Row -->

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card card-outline-info">

                            <div class="card-header">

                                <h4 class="m-b-0 text-white mess">Add categories form</h4>

                            </div>

                            <div class="card-body">

                                <form action="" id="subcategoryfom" method="POST" enctype="multipart/form-data">

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

                                                }

                                            ?>

                                            <div class="col-12">

                                                <div class="form-group">

                                                    <label for="catname" class="control-label">Sub Category Name</label>

                                                    <input type="text" name="catname" id="catname" class="form-control" placeholder="Sub Category Name">

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="form-group">

                                                    <label for="catbanner">Sub Category banner</label>

                                                    <input type="file" name="catbanner" id="catbanner" data-height="80" class="dropify" data-default-file="<?= $dir ?>default.jpg" />

                                                    <p class='mb-0'><label for="catbanner" class="error"></label></p>

                                                </div>

                                            </div>

                                            <div class="col-12">

                                                <div class="form-group">

                                                    <label for="cat" class="control-label">Main Category</label>

                                                    <select name="cat" class="form-control" id="cat">

                                                        <option value="">---Select Category---</option>

                                                        <?php

                                                            $selcat = $db->rnQuery("SELECT * FROM `category` WHERE `status`='1'");

                                                            while($cat = mysqli_fetch_assoc($selcat)){

                                                                ?><option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option><?php

                                                            }

                                                        ?>

                                                    </select>

                                                    <p class='mb-0'><label for="cat" class="error"></label></p>

                                                </div>

                                            </div>

                                            <!--/span-->

                                            <div class="col-12">

                                                <div class="form-group">

                                                    <label class="control-label">Status</label>

                                                    <div class="form-check">

                                                        <label class="custom-control custom-radio">

                                                            <input id="radio1" name="cat_status" type="radio"  value="1"  class="custom-control-input">

                                                            <span class="custom-control-indicator"></span>

                                                            <span class="custom-control-description">Active</span>

                                                        </label>

                                                        <label class="custom-control custom-radio">

                                                            <input id="radio2" name="cat_status" type="radio" value="2" class="custom-control-input">

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

                                        <button type="submit" class="btn btn-success" name="saveSubcat"> <i class="fa fa-check"></i> Save</button>

                                    </div>

                                </form>

                            </div>

                        </div>



                    </div>

                </div>

                <div class="row">

                    <div class="col-12">

                        <!-- Column -->

                        <div class="card card-outline-info">

                            <div class="card-header">

                                <h4 class="m-b-0 text-white mess">Categoriy list</h4>

                            </div>

                            <div class="card-body">

                                <?php

                                    if(isset($_GET['deleted'])){

                                        ?>

                                        <div class="alert alert-warning text-center">Data delete successfull</div>

                                        <?php

                                    }

                                ?>

                                <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe">

                                    <thead>

                                        <tr>

                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Category</th>

                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Banner</th>

                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Status</th>

                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Products</th>

                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Action</th>

                                        </tr>

                                    </thead>

                                    <tbody >

                                    <?php

                                        $catlist = $db->rnQuery("SELECT * FROM `sub_category`");

                                        while($scatitem = mysqli_fetch_array($catlist)){

                                            ?>

                                            <tr>

                                                <td><?= $scatitem['name'] ?></td>

                                                <td><img style="width: 100px" src="<?= $dir.$scatitem['banner'] ?>"></td>

                                                <td><?php if($scatitem['status']==1){?><span class="text-megna font-weight-bold">Active</span><?php }elseif($catitem['status']==2){?><span class="text-danger font-weight-bold">Inactive</span><?php } ?></td>

                                                <td><?= $scatitem['product'] ?></td>

                                                <td><a href="edit-subcat.php?edit=<?= $scatitem['id'] ?>" class="btn btn-primary mr-3" ><i class="fa fa-edit"></i> Edit</a><a href="?delete=<?= $scatitem['id'] ?>" class="btn btn-danger"><i class="mdi mdi-delete"></i> Delete</a></td>

                                            </tr>

                                            <?php

                                        }

                                    ?> 

                                    </tbody>

                                </table>

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