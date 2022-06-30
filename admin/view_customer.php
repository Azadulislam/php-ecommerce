<?php
    $title = "Customer || Azad demo shop";
    include_once ("inc/header.php");
    $pro = new classes\Product;
    if(isset($_GET['view'])){
        $id = $_GET['view'];
        if(!empty($id)){
        $user = $db->selectSingle("SELECT * FROM `user` WHERE `id`='$id'");
        if($user == false){
            echo "<script>window.location.href='customer.php'</script>";
        }
    
    $dir = "../uploads/";
?>
        
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Customer details</h3>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white mess">About Customer</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 text-right"><a class="btn btn-info mr-2" href="customer.php">Back</a></div>
                                <div class="col-md-8 mx-auto">
                                    <div class="row">
                                        <div class=" col-6 col-md-4 mx-auto" ><img class="img-fluid" src="<?= $dir.$user['profile'] ?>" alt="Profile picture"></div>
                                    </div>
                                    <h2 class="my-3 text-center"><?= $user['fname']." ".$user['lname'] ?></h2>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>Email</b></div>
                                        <div class="col-9 p-0">: <?= $user['email']?> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>Phone Number</b></div>
                                        <div class="col-9 p-0">: <?= $user['ph_num']?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>Address</b></div>
                                        <div class="col-9 p-0">: <?= $user['address1'].', '.$user['address2']?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>Country</b></div>
                                        <div class="col-9 p-0">: <?= $user['country'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>City</b></div>
                                        <div class="col-9 p-0">: <?= $user['city'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>State</b></div>
                                        <div class="col-9 p-0">: <?= $user['state'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 p-0"><b>Zip Code</b></div>
                                        <div class="col-9 p-0">: <?= $user['zip'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }else{
                    echo "<script>window.location.href='manage_product.php'</script>";
                }
            }else{
                echo "<script>window.location.href='manage_product.php'</script>";
            }
                    include_once ("inc/footer.php");
                ?>