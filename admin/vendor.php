<?php

    ob_start();

    $title = "Vendor || Azad demo shop";

    include_once ("inc/header.php");

    $usr = new classes\User;

    if(isset($_GET['status'])){

        $id = $_GET['status'];

        $upststus = $usr->updateStatus($id);

    };

    $dir = "../uploads/";

    

?>

    <!-- Bread crumb and right sidebar toggle -->

    <div class="row page-titles">

        <div class="col-md-5 col-8 align-self-center">

            <h3 class="text-themecolor">Vendor</h3>

        </div>

    </div>

    <!-- End Bread crumb and right sidebar toggle -->

    <!-- Start Page Content -->

    <!-- Row -->

    <div class="row">

        <div class="col-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white mess">Vendor List <a class="btn btn-info float-right" href="addvendor.php"><i class="fas fa-user-plus"></i></a></h4>

                </div>

                <div class="card-body">

                    <?php

                        if(isset($pro->suc)){

                            ?>

                            <div class="alert alert-success text-center"><?= $pro->suc ?></div>

                            <?php

                        }elseif(isset($pro->err)){

                            ?>

                            <div class="alert alert-warning text-center"><?= $usr->err ?></div>

                            <?php

                        }elseif(isset($_GET['deleted'])){

                            ?>

                            <div class="alert alert-warning text-center">Vendor Deleted Successfully</div>

                            <?php

                        }

                    ?>

                    <div class="table-responsive m-t-10">

                        <table id="myTable" class="table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>S.L.</th>

                                    <th>Name</th>

                                    <th>Profile picture</th>

                                    <th>Background</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody >

                            <?php

                                $sel_user = $db->rnQuery("SELECT * FROM `user` WHERE `roll`='2'");

                                $i=1;

                                while($user = mysqli_fetch_array($sel_user)){

                                    ?>

                                    <tr id="data">

                                        <td><?= $i ?></td>

                                        <td><?= $user['fname'].' '.$user['lname'] ?></td>

                                        <td><img style="width: 80px" src="<?= $dir.$user['profile'] ?>"></td>

                                        <td><img style="width: 80px" src="<?= $dir.$user['background'] ?>"></td>

                                        <td><?php if($user['status']==1){?><a href="?status=<?= $user['id'] ?>" class="btn btn-info"><i class="fas fa-check"></i></a><?php }elseif($user['status']==0){?><a href="?status=<?= $user['id'] ?>" class="btn btn-danger"><i class="fas fa-times"></i></a><?php } ?></td>

                                        <td></a><a href="view_vendor.php?view=<?= $user['id'] ?>" class="btn btn-info mr-2"><i class="fas fa-eye"></i></a></a><a href="edit_vendor.php?edit=<?= $user['id'] ?>" class="btn btn-info"><i class="fas fa-edit"></i></a></td>

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

    <!-- Row -->

    <!-- End PAge Content -->

    <!-- Right sidebar -->

    

    <?php

        include_once ("inc/footer.php");

    ?>