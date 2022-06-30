<?php
    ob_start();
    $title = "Brands || Azad demo shop";
    include_once ("inc/header.php");
    if(isset($_GET['delete'])){
        $delete = $brand->delete($_GET);
    }elseif(isset($_GET['status'])){
        $upbrand = $brand->updateStatus($_GET);
    };
    $dir = "../uploads/";
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
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Manage Brand<a class="float-right text-white" href="addbrands.php"><i class="fas fa-plus-square"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($brand->suc)){
                                        ?>
                                        <div class="alert alert-success text-center"><?= $brand->suc ?></div>
                                        <?php
                                    }elseif(isset($brand->err)){
                                        ?>
                                        <div class="alert alert-warning text-center"><?= $brand->err ?></div>
                                        <?php
                                    }elseif(isset($_GET['deleted'])){
                                        ?>
                                        <div class="alert alert-warning text-center">Brand Deleted Successfully</div>
                                        <?php
                                    }
                                ?>
                                <div class="table-responsive m-t-10">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.l.</th>
                                                <th>Name</th>
                                                <th>Logo</th>
                                                <th>status</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        <?php
                                            $brands = $db->getAllData('brands');
                                            $i=1;
                                            foreach($brands as $key => $item){
                                                ?>
                                                <tr id="data">
                                                    <td><?= $i ?></td>
                                                    <td><?= $item['name'] ?></td>
                                                    <td><img style="width: 80px" src="<?= $dir.$item['logo'] ?>"></td>
                                                    <td>
                                                        <?php if($item['status']==1){?>
                                                            <a href="?status=<?= $item['id'] ?>" class="btn btn-info"><i class="fas fa-check"></i></a>
                                                        <?php }elseif($item['status']==2){?>
                                                            <a href="?status=<?= $item['id'] ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="editbrands.php?edit=<?= $item['id'] ?>" class="btn btn-info mr-1" ><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure?')" href="?delete=<?= $item['id'] ?>" class="btn btn-danger mr-1"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
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