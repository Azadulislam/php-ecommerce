<?php
    ob_start();
    $title = "Blog Category || Demo Shop";
    include_once ("inc/header.php");
    $blog = new classes\Blog;
    if(isset($_POST['savecat'])){
        $ins = $blog->addCategory($_POST);
    }elseif(isset($_GET['status'])){
        $status = $blog->categoryStatus($_GET);
    }elseif(isset($_POST['savecategory'])){
        $update = $blog->updateCategory($_POST);
    }elseif(isset($_GET['delete'])){
        $del = $blog->deleteCategory($_GET);
    }
    $dir = "../uploads/";
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-4 align-self-center">
                        <h3 class="text-themecolor">Categories</h3>
                    </div>
                    <div class="col-8 text-center">
                        <h4 class='mt-3'>
                            <?php
                            if(isset($blog->suc)){
                                ?>
                                <span class="text-success text-center"><?= $blog->suc ?></span>
                                <?php
                            }elseif(isset($blog->err)){
                                ?>
                                <span class="text-warning text-center"><?= $blog->err ?></span>
                                <?php
                            }elseif(isset($_GET['deleted'])){
                            ?>
                                <span class="text-warning text-center">Deleted successfully</span>
                            <?php
                            }
                            ?>
                        </h4>
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
                                <div class="form-body ">
                                    <div class="col-md-6 mx-auto p-t-20">
                                        <form action="" method="POST">
                                            <div class="col-12">
                                                <div class="form-group mb-1">
                                                    <label for="catname" class="control-label">Category Name</label>
                                                    <input type="text" name="catname" id="catname" class="form-control" placeholder="Category name">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-12">
                                                <div class="form-group mb-1">
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
                <div class="row">
                    <div class="col-12">
                        <!-- Column -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Categoriy list</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive m-t-10">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.l.</th>
                                                <th>Name</th>
                                                <th>Sataus</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        <?php
                                            $selectAll = $db->rnQuery("SELECT * FROM `blog_category`");
                                            $i=1;
                                            while($category = mysqli_fetch_array($selectAll)){
                                                ?>
                                                <tr id="data">
                                                    <td><?= $i ?></td>
                                                    <td><?= $category['name'] ?></td>
                                                    <td><?php if($category['status']==1){?><a href="?status=<?= $category['id'] ?>" class="btn btn-info"><i class="fas fa-check"></i></a><?php }elseif($category['status']==2){?><a href="?status=<?= $category['id'] ?>" class="btn btn-danger"><i class="fas fa-times"></i></a><?php } ?></td>
                                                    <td>
                                                        <a  data-toggle="modal" data-target="#responsive-modal"  href="javascript:" data-id="<?= $category['id'] ?>" data-url="<?= URL ?>" class="btn btn-info mr-1 mb-1 editbtn" ><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure?')" href="?delete=<?= $category['id'] ?>" class="btn btn-danger mr-1  mb-1"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Edit Category Name</h4>
                                                            </div>
                                                            <form  action="" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="edtcatname" class="control-label">Category Name</label>
                                                                        <input type="text" name="catname" id="edtcatname" class="form-control" placeholder="Category name" required>
                                                                        <input type="hidden" name="id" class="id">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-info my-2" name="savecategory">Save</butoon>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $i++;
                                            }
                                        ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                    include_once ("inc/footer.php");
                ?>