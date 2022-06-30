<?php
    ob_start();
    $title = "Edit Blog || Azad demo shop";
    include_once ("inc/header.php");
    $blogclass = new classes\Blog;
    if(isset($_POST['update'])){
        $up = $blogclass->update($_POST);
    }
    $dir = "../uploads/";
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $blog = $db->selectSingle("SELECT * FROM `blogs` WHERE `id`='$id'");
            if($blog == false){
                echo "<script>window.location.href='blogs.php'</script>";
            }
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Edit Blogs</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Edit Blogs form<a class="float-right text-white" href="blogs.php">Back</a></h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" id="addblogform" enctype="multipart/form-data">
                                    <div class="form-body ">
                                        <div class="col-lg-6 col-md-10 col-12 mx-auto p-t-20">
                                            <div class="col-12">
                                            <?php
                                                if(isset($blogclass->suc)){
                                                    ?>
                                                    <div class="alert alert-success text-center"><?= $blogclass->suc ?></div>
                                                    <?php
                                                }elseif(isset($blogclass->err)){
                                                    ?>
                                                    <div class="alert alert-warning text-center"><?= $blogclass->err ?></div>
                                                    <?php
                                                }
                                            ?>
                                                <div class="form-group mb-1">
                                                    <label for="title" class="control-label">Blog Title</label>
                                                    <input type="text" name="title" id="title" value="<?= $blog['title'] ?>" class="form-control" placeholder="Category name">
                                                    <input type="hidden" name="id" value="<?= $blog['id'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group  mb-1">
                                                    <label for="image">Blog image</label>
                                                    <input type="file" name="image" id="image" data-height="80" class="dropify" data-default-file="<?= $dir.$blog['image'] ?>" />
                                                    <input type="hidden" name="old" value="<?= $blog['image'] ?>"/>
                                                    <label for="image" class="error mb-0"></label>
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <label for="description">Blog Description</label>
                                                    <textarea name="description" id="description" class="summernote" cols="20" rows="5" data-placeholder="Enter product description"><?= $blog['description'] ?></textarea>
                                                <label for="description" class="error"></label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-1">
                                                    <label for="cat" class="control-label">Category</label>
                                                    <select class="form-control" name="category">
                                                        <option value="">--Select category--</option>
                                                        <?php
                                                        $select = $db->getActiveData('blog_category');
                                                        foreach($select as $item){
                                                            ?><option value="<?= $item['id'] ?>" <?= $blog['category']==$item['id']?'selected':'' ?>><?= $item['name'] ?></option><?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-1">
                                                    <label class="control-label">Status</label>
                                                    <div class="form-check">
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio1" name="status" type="radio"  value="1"  class="custom-control-input" <?= $blog['status']==1?'checked':'' ?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Active</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio2" name="status" type="radio" value="2" class="custom-control-input" <?= $blog['status']==2?'checked':'' ?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Inactive</span>
                                                        </label>
                                                        <label for="status" class="error"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-center">
                                        <button type="submit" class="btn btn-success" name="update"> <i class="fa fa-check"></i> Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                
                <?php
        }else{
            echo "<script>window.location.href='blogs.php'</script>";
        }
                    include_once ("inc/footer.php");
                ?>