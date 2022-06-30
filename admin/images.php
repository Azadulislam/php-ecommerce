<?php

    ob_start();

    $title = "Images || Azad demo shop";

    include_once ("inc/header.php");

    

    

    $dir = "../uploads/";

    if(isset($_POST['save_background'])){

        $imageClass->update($_POST);

    }elseif(isset($_POST['addslider'])){

        $imageClass->addSlider($_POST);

    }elseif(isset($_POST['save_slider'])){

        $imageClass->updateSlider($_POST);

    }elseif(isset($_POST['delete_slider'])){

        $imageClass->delete($_POST);

    }

?>

                <div class="row page-titles">

                    <div class="col-3 align-self-center">

                        <h3 class="text-themecolor mt-0">Images </h3>

                    </div>

                    <div class="col-9 text-center">

                        <h4 class='mt-3'>

                            <?php

                            if(isset($imageClass->suc)){

                                ?>

                                <span class="text-success text-center"><?= $imageClass->suc ?></span>

                                <?php

                            }elseif(isset($imageClass->err)){

                                ?>

                                <span class="text-warning text-center"><?= $imageClass->err ?></span>

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

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card card-outline-info">

                            <div class="card-header">

                                <h4 class="m-b-0 text-white mess">Manage Background Images</h4>

                            </div>

                            <div class="card-body">

                                <?php

                                    

                                    $images = $db->rnQuery("SELECT * FROM `images`");

                                    $image = mysqli_fetch_assoc($images);

                                ?>

                                <form action="" method="post" enctype="multipart/form-data">

                                    <div class="row" id="background_images">

                                        <div class="col-md-4 my-2">

                                            <label for="adminbg">Admin Background</label>

                                            <input type="file" name="adminbg" id="adminbg" data-height="150" class="dropify" data-default-file="<?= $dir ?><?= empty($image['admin_bg'])?'default.jpg':$image['admin_bg'] ?>" />

                                            <input type="hidden" name="old_adminbg" value="<?= $image['admin_bg'] ?>">

                                        </div>

                                        <div class="col-md-4 my-2">

                                            <label for="venodrbg">Vendor Background</label>

                                            <input type="file" name="venodrbg" id="venodrbg" data-height="150" class="dropify" data-default-file="<?= $dir ?><?= empty($image['vendor_bg'])?'default.jpg':$image['vendor_bg'] ?>" />

                                            <input type="hidden" name="old_vendorbg" value="<?= $image['vendor_bg'] ?>">

                                        </div>

                                        <div class="col-md-4 my-2">

                                            <label for="blogbg">Blog Background</label>

                                            <input type="file" name="blogbg" id="blogbg" data-height="150" class="dropify" data-default-file="<?= $dir ?><?= empty($image['blog_bg'])?'default.jpg':$image['blog_bg'] ?>" />

                                            <input type="hidden" name="old_blogbg" value="<?= $image['blog_bg'] ?>">

                                        </div>

                                    </div>

                                    <!-- <div class="row" id="background_images">

                                        <div class="col-md-4 my-2">

                                            <label for="adminbg">Add banner One</label>

                                            <input type="file" name="adminbg" id="adminbg" data-height="150" class="dropify" data-default-file="<?= $dir ?><?= empty($image['admin_bg'])?'default.jpg':$image['admin_bg'] ?>" />

                                            <input type="hidden" name="old_adminbg" value="">

                                        </div>

                                        <div class="col-md-4 my-2">

                                            <label for="venodrbg">Add banner Two</label>

                                            <input type="file" name="venodrbg" id="venodrbg" data-height="150" class="dropify" data-default-file="<?= $dir ?><?= empty($image['vendor_bg'])?'default.jpg':$image['vendor_bg'] ?>" />

                                            <input type="hidden" name="old_vendorbg" value="">

                                        </div>

                                        <div class="col-md-4 my-2">

                                            <label for="blogbg">Add banner Three</label>

                                            <input type="file" name="blogbg" id="blogbg" data-height="150" class="dropify" data-default-file="<?= $dir ?><?= empty($image['blog_bg'])?'default.jpg':$image['blog_bg'] ?>" />

                                            <input type="hidden" name="old_blogbg" value="">

                                        </div>

                                    </div> -->

                                    <div class="save">

                                        <button class="btn btn-info" type="submit" name="save_background">Save Changes</button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="col-lg-12">

                        <div class="card card-outline-info">

                            <div class="card-header">

                                <h4 class="m-b-0 text-white mess">Slider Images <a data-toggle="modal" data-target="#addsliderModal" href="#" class="float-right btn btn-info p-1"><i class="fas fa-plus"></i></a></h4>

                                <div id="addsliderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                <h4 class="modal-title">Add slider image</h4>

                                            </div>

                                            <form  action="" method="POST" enctype="multipart/form-data">

                                                <div class="modal-body">

                                                    <div class="form-group">

                                                        <label for="slider" class="control-label">Selectc image</label>

                                                        <input type="file" name="slider" id="slider" data-height="150" class="dropify" data-default-file="<?= $dir ?>default.jpg" />

                                                    </div>

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                                    <button type="submit" class="btn btn-outline-info my-2" name="addslider">Add</butoon>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <?php  

                                            $slider = $db->getAllData('slider');

                                            $count = count($slider);

                                            if($count > 0){

                                                foreach($slider as $item){

                                        ?>

                                        <div class="col-md-4 my-2">

                                            <form action="" method="POST" enctype="multipart/form-data">

                                                <div class="slieder_item">

                                                    <input type="file" name="slider" data-height="150" class="dropify" data-default-file="<?= $dir ?><?= empty($item['image'])?'default.jpg':$item['image'] ?>" />

                                                    <input type="hidden" name="old_slider" value="<?= $item['image'] ?>">

                                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">

                                                    <div class="action d-flex justify-content-center">

                                                        <button class="btn btn-info mr-2 my-2" type="submit" name="save_slider">Save Change</button>

                                                        <button class="btn btn-danger my-2" type="submit" name="delete_slider">delete</button>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                        <?php

                                            }

                                        }else{

                                            ?>

                                            <div class="col-md-12"><h4>No images</h4></div>

                                            <?php

                                        }

                                        ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php

                    include_once ("inc/footer.php");

                ?>