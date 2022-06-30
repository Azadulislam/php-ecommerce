<?php
    ob_start();
    $title = "Classified Product || Azad demo shop";
    include_once ("inc/header.php");
    $pro = new classes\Product;
    if(isset($_GET['delete'])){
        $delid = $_GET['delete'];
        $delet = $pro->deleteProduct($delid);
    }elseif(isset($_GET['status'])){
        $id = $_GET['status'];
        $updeal = $pro->updateStatus($id);
    };
    $dir = "../uploads/";
    
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Products</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Classified Product</h4>
                            </div>
                            <div class="card-body">
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
                                        <div class="alert alert-warning text-center">Product Deleted Successfully</div>
                                        <?php
                                    }
                                ?>
                                <div class="table-responsive m-t-10">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.l.</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        <?php
                                            $product = $db->rnQuery("SELECT * FROM `product`");
                                            $i=1;
                                            while($productitem = mysqli_fetch_array($product)){
                                                $seller = $productitem['seller'];
                                                $user = $db->selectSingle("SELECT * FROM `user` WHERE `id`='$seller'");
                                                if($user == true){
                                                    $roll = $user['roll'];
                                                    if($roll == 1){
                                                        ?>
                                                        <tr id="data">
                                                            <td><?= $i ?></td>
                                                            <td><?= $productitem['name'] ?></td>
                                                            <td><img style="width: 80px" src="<?= $dir.$productitem['image'] ?>"></td>
                                                            <td><?= $productitem['quantity'] ?></td>
                                                            <td><?php if($productitem['status']==1){?><a href="?status=<?= $productitem['id'] ?>" class="btn btn-info"><i class="fas fa-check"></i></a><?php }elseif($productitem['status']==2){?><a href="?status=<?= $productitem['id'] ?>" class="btn btn-danger"><i class="fas fa-times"></i></a><?php } ?></td>
                                                            <td><?= $productitem['price'] ?></td>
                                                            <td><a href="editproduct.php?edit=<?= $productitem['id'] ?>" class="btn btn-info mr-1" ><i class="fas fa-edit"></i></a><a id="print" onclick="return confirm('Are you sure?')" href="?delete=<?= $productitem['id'] ?>" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a></a><a id="print" href="view_product.php?view=<?= $productitem['id'] ?>" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                            }
                                        ?> 
                                        </tbody>
                                    </table>
                                </div>
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