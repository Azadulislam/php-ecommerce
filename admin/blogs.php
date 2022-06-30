<?php
    ob_start();
    $title = "Blogs || Demo Shop";
    include_once ("inc/header.php");
    $blog = new classes\Blog;
    if(isset($_GET['delete'])){
        $delid = $_GET['delete'];
        $delet = $blog->deleteProduct($delid);
    }elseif(isset($_GET['status'])){
        $id = $_GET['status'];
        $upstatus = $blog->updateStatus($id);
        if($upstatus == 1){
            echo "<script>window.location.href='blogs.php'</script>";
        }
    };
    $dir = "../uploads/";
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Blogs</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Manage blogs<a class="float-right text-white" href="addblogs.php"><i class="fas fa-plus-square"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($blog->suc)){
                                        ?>
                                        <div class="alert alert-success text-center"><?= $blog->suc ?></div>
                                        <?php
                                    }elseif(isset($blog->err)){
                                        ?>
                                        <div class="alert alert-warning text-center"><?= $blog->err ?></div>
                                        <?php
                                    }elseif(isset($_GET['deleted'])){
                                        ?>
                                        <div class="alert alert-warning text-center">Blog Deleted Successfully</div>
                                        <?php
                                    }
                                ?>
                                <div class="table-responsive m-t-10">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.l.</th>
                                                <th>Blog Title</th>
                                                <th>Blog Image</th>
                                                <th>Bloger</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        <?php
                                            $selectAll = $db->rnQuery("SELECT * FROM `blogs`");
                                            $i=1;
                                            while($blog = mysqli_fetch_array($selectAll)){
                                                ?>
                                                <tr id="data">
                                                    <td><?= $i ?></td>
                                                    <td><?= $blog['title'] ?></td>
                                                    <td><img style="width: 80px" src="<?= $dir.$blog['image'] ?>"></td>
                                                    <td>
                                                        <?php 
                                                            if(is_numeric($blog['bloger'])){ 
                                                                $blogerid = $blog['bloger'];
                                                                $user = $db->selectSingle("SELECT * FROM `user` WHERE `id`='$blogerid'");
                                                                $bloger = $user['fname'];
                                                            }else{
                                                                $bloger = $blog['bloger'];
                                                            }
                                                            echo $bloger;
                                                        ?>
                                                    </td>
                                                    <td><?php if($blog['status']==1){?><a href="?status=<?= $blog['id'] ?>" class="btn btn-info"><i class="fas fa-check"></i></a><?php }elseif($blog['status']==2){?><a href="?status=<?= $blog['id'] ?>" class="btn btn-danger"><i class="fas fa-times"></i></a><?php } ?></td>
                                                    <td>
                                                        <a href="editblog.php?edit=<?= $blog['id'] ?>" class="btn btn-info mr-1 mb-1"><i class="fas fa-edit"></i></a>
                                                        <a onclick="return confirm('Are you sure?')" href="?delete=<?= $blog['id'] ?>" class="btn btn-danger mr-1  mb-1"><i class="fas fa-trash-alt"></i></a>
                                                        <a id="print" href="<?= URL ?>view-blog.php?view=<?= $blog['id'] ?>&blog" class="btn btn-info" target="_blanck"><i class="fas fa-eye"></i></a>
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
                <!-- Row -->
                <!-- End PAge Content -->
                <!-- Right sidebar -->
                
                <?php
                    include_once ("inc/footer.php");
                ?>