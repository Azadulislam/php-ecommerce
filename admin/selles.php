<?php
    ob_start();
    $title = "Selles || Azad demo shop";
    include_once ("inc/header.php");
    if(isset($_GET['status'])){
        $action = $order->accceptOreder($_GET);
        if($action == 1){
            echo"<script>window.location.href='".$_SERVER['PHP_SELF']."'</script>";
        }
    }
    $dir = "../uploads/";
    if(isset($_GET['updeliver'])){
        $up = $order->deliveryUpdate($_GET['updeliver']);
        if($up == 1){
            echo"<script>window.location.href='".$_SERVER['PHP_SELF']."'</script>";
        }
    }
?>
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Selles</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">Manage selles<a class="float-right text-white" href="addselles.php"><i class="fas fa-plus-square"></i></a></h4>
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
                                    }
                                ?>
                                <div class="table-responsive m-t-10">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Orde id</th>
                                                <th>Buyer</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        <?php
                                            $product = $db->rnQuery("SELECT * FROM `orders`");
                                            while($productitem = mysqli_fetch_array($product)){
                                                $buyerid = $productitem['user_id'];
                                                $status  =  $productitem['status'];
                                                $pid     = $productitem['id'];
                                                if($status == 1){
                                                    $delivertime = date('d-m-Y h:s a',strtotime($productitem['delivered']));
                                                    $uptime      = date('d-m-Y h:s a',time());
                                                    if($delivertime < $uptime){
                                                        $up = $order->deliveryUpdate($productitem['id']);
                                                    }
                                                }
                                                $buyers  = $db->rnQuery("SELECT * FROM `user` WHERE  `id`='$buyerid'");
                                                $buyer   = mysqli_fetch_assoc($buyers);
                                                ?>
                                                <tr id="data">
                                                    <td><span class="text-info">#<?= $productitem['order-id'] ?></span></td>
                                                    <td><?= $buyer['fname']." ".$buyer['lname'] ?></td>
                                                    <td>
                                                        <?php if($productitem['payment'] == '0'){ ?>
                                                            <span class="badge badge-danger px-2 py-1 badge-pill font-weight-normal">Payment pending</span>
                                                        <?php }elseif($productitem['payment']=='1'){ ?>
                                                            <span class="badge badge-primary px-2 py-1 badge-pill font-weight-normal">Paid</span> 
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($status==0){?>
                                                            <span class="badge badge-primary px-2 py-1 badge-pill font-weight-normal" >Pending</span>
                                                        <?php }elseif($status==1){?>
                                                            <span class="badge badge-info px-2 py-1 badge-pill font-weight-normal">Aproved</i></span>
                                                        <?php }elseif($status==2){?>
                                                            <span class="badge badge-warning px-2 py-1 badge-pill font-weight-normal">Declined</i></span>
                                                        <?php }elseif($status==3){?>
                                                            <span class="badge badge-primary px-2 py-1 badge-pill font-weight-normal">Cenceled</span>
                                                        <?php }else if($status==4){ ?>
                                                            <span class="badge badge-success px-2 py-1 badge-pill font-weight-normal">Delivered</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($status < 3){
                                                        ?>
                                                        <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown btn btn-info" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Action</a>
                                                            <div class="dropdown-menu animated flipInY">
                                                                <a href="?status=<?= $pid ?>&action=aprove" class="dropdown-item"><i class="fa fa-check"></i> Accept</a> 
                                                                <div class="dropdown-divider"></div> 
                                                                <a href="?status=<?= $pid ?>&action=decline" class="dropdown-item"><i class="fa fa-times"></i> Deny</a>
                                                                <div class="dropdown-divider"></div> 
                                                                <a id="print" href="<?= URL ?>?view=<?= $pid ?>&order?" class="dropdown-item" target="_blank"><i class="fa fa-eye"></i> View Details</a>
                                                                <?php  
                                                                    if($status == 1){?>
                                                                        <a id="print" href="?updeliver=<?= $pid ?>" class="dropdown-item"><i class="fas fa-truck"></i> Delivered</a>
                                                                    <?php }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </td>
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
                </div>
                <!-- Row -->
                
                <?php
                    include_once ("inc/footer.php");
                ?>