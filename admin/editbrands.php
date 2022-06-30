<?php
    ob_start();
    $title = "Edit Brands || Azad demo shop";
    include_once ("inc/header.php");
    $dir = "../uploads/";
    if(isset($_POST['editBrand'])){
        $update = $brand->update($_POST);
        echo $update;
    };
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        if(empty($id)){
            echo "<script>window.location.href= 'brands.php'</script>";
        }else{
        $selbrand = $db->getSingle('brands','id',$id);
    
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Brand</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Edit Brand form<a class="float-right text-white" href="brands.php">Back</a></h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" id="addBrndform" enctype="multipart/form-data">
                                    <div class="form-body ">
                                        <div class="col-lg-6 col-md-8 col-12 mx-auto p-t-20">
                                            <?php
                                                if(isset($brand->suc)){
                                                    ?>
                                                    <div class="alert alert-success text-center"><?= $brand->suc ?></div>
                                                    <?php
                                                }elseif(isset($brand->err)){
                                                    ?>
                                                    <div class="alert alert-warning text-center"><?= $brand->err ?></div>
                                                    <?php
                                                }
                                            ?>
                                            <div class="col-12">
                                                <div class="form-group mb-1">
                                                    <label for="name" class="control-label">Brand Name</label>
                                                    <input type="text" name="name" id="name" value="<?= $selbrand['name'] ?>" class="form-control" placeholder="Brand name">
                                                    <input type="hidden" value="<?= $selbrand['id'] ?>" name="id">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group  mb-1">
                                                    <label for="logo">Brand logo</label>
                                                    <input type="file" name="logo" id="logo" data-height="80" class="dropify" data-default-file="<?= $dir ?><?= empty($selbrand['logo'])?'default.jpg':$selbrand['logo'] ?>" />
                                                    <input type="hidden" value="<?= $selbrand['logo'] ?>" name="old">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-1">
                                                    <label for="cat" class="control-label">Category</label>
                                                    <select class="form-control" data-get='subcategory' data-target="#subCatBrand" name="category">
                                                        <option value="">--Select category--</option>
                                                        <?php
                                                        $select = $db->getActiveData('category');
                                                        $catid  = $selbrand['category'];
                                                        foreach($select as $item){
                                                            ?><option value="<?= $item['id'] ?>" <?= $catid==$item['id']?'selected':'' ?>><?= $item['name'] ?></option><?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group  mb-1">
                                                    <label for="subCatBrand"> Sub Category</label>
                                                    <select class="form-control" id="subCatBrand" name="Subcategory">
                                                        <option value=""> --Select Sub category-- </option>
                                                        <?php
                                                        $select = $db->rnQuery("SELECT * FROM `sub_category` WHERE `status`='1' AND `cat`='$catid'");
                                                        foreach($select as $item){
                                                            ?><option value="<?= $item['id'] ?>" <?= $selbrand['sCategory']==$item['id']?'selected':'' ?>><?= $item['name'] ?></option><?php
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
                                                            <input id="radio1" name="status" type="radio"  value="1"  class="custom-control-input" <?= $selbrand['status']==1?'checked':'' ?>>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Active</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio2" name="status" type="radio" value="2" class="custom-control-input" <?= $selbrand['status']==2?'checked':'' ?>>
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
                                        <button type="submit" class="btn btn-success" name="editBrand"> <i class="fa fa-check"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                
                <?php
        }
    }else{
        echo "<script>window.location.href= 'brands.php'</script>";
    }

                    include_once ("inc/footer.php");
                ?>