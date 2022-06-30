<?php
    ob_start();
    $title = "Manage Profile || Azad demo shop";
    include_once ("inc/header.php");
    $admin = new classes\Admin;
    
    
    $dir = "../uploads/";
    if(isset($_POST['updatePass'])){
        $admin->cahangPwd($_POST);
    }elseif(isset($_POST['updateAdmin'])){
        $admin->update($_POST);
    }
?>
        
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-12  align-self-center">
                        <h3 class="text-themecolor">Admin</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Admin profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-8 mx-auto">
                                    <?php
                                        if(isset($admin->suc)){
                                            ?>
                                            <div class="alert alert-success text-center"><?= $admin->suc ?></div>
                                            <?php
                                        }elseif(isset($admin->err)){
                                            ?>
                                            <div class="alert alert-warning text-center"><?= $admin->err ?></div>
                                            <?php
                                        }
                                    ?>
                                    <div class="row">
                                        <div class=" col-6 col-md-4 mx-auto" ><img class="img-fluid" src="<?= $dir.$user['image'] ?>" alt="Profile picture"></div>
                                    </div>
                                    <h2 class="my-3 text-center"><?= $user['name'] ?></h2>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>Email</b></div>
                                        <div class="col-9 p-0">: <?= $user['email']?> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>Phone Number</b></div>
                                        <div class="col-9 p-0">: <?= $user['phn']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Edit profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-8 mx-auto">
                                    <form action="" method="POST" id="profile" enctype="multipart/form-data">
                                        <div class="form-body ">
                                            <div class="col-md-6 mx-auto p-t-20">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="adminName" class="control-label">User name</label>
                                                        <input type="text" name="adminName" id="adminName" value="<?= $user['name'] ?>" class="form-control" placeholder="User name">
                                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="profilePic">Profile picture</label>
                                                        <input type="file" name="profilePic" id="profilePic" data-height="80" class="dropify" data-default-file="<?= $dir.$user['image'] ?>" />
                                                        <input type="hidden" name="oldPic" value="<?= $user['image'] ?>">
                                                        <p class='mb-0'><label for="profilePic" class="error"></label></p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="phn" class="control-label">Phone Number</label>
                                                        <input type="text" name="phn" id="phn" value="<?= $user['phn'] ?>" class="form-control" placeholder="Phone number">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label">Email</label>
                                                        <input type="email" name="email" id="email" value="<?= $user['email'] ?>" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="address" class="control-label">Address</label>
                                                        <input type="address" name="address" id="address" value="<?= $user['address'] ?>" class="form-control" placeholder="Address">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions text-center">
                                            <button type="submit" class="btn btn-success" name="updateAdmin"> <i class="fa fa-check"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Change Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-8 mx-auto">
                                    <form action="" method="POST" id="chpwd" enctype="multipart/form-data">
                                        <div class="form-body ">
                                            <div class="col-md-6 mx-auto p-t-20">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="oldpass" class="control-label">Old Password</label>
                                                        <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="Old Password">
                                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="newPass">New Password</label>
                                                        <input type="password" name="newPass" id="newPass" data-height="80" class="form-control" placeholder="New Password" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="confPass">Confirm Password</label>
                                                        <input type="password" name="confPass" id="confPass" data-height="80" class="form-control" placeholder="Confirm Password" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions text-center">
                                            <button type="submit" class="btn btn-success" name="updatePass"> <i class="fa fa-check"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    include_once ("inc/footer.php");
                ?>