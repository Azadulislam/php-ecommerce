<?php
$title = "Order || Demo Shop";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");
if(isset($_COOKIE['vendor'])){
    echo "<script>window.location.href='vendor-dashboard'</script>";
}
if(isset($_COOKIE['customer'])){
    include ('../php/function.php')
    //$order = $db->getUserProduct('product','seller',$usrdata['id']);
?>

<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">  
                <?php include ('templates/_sidbar.php') ?>
            </div>
            <div id="maindiv" class="col-lg-9">  
                <div class="content">
                    <h5 class="heading mb-0">Your Order</h5>
                    <div class="orderlist mt-3">
                        <?php
                            if(mysqli_num_rows($allorders) > 0){
                            while($item = mysqli_fetch_assoc($allorders)){
                                $orderid = $item['order-id'];
                        ?>
                        <div class="card">
                            <div class="card-header bg-white p-2 px-3">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="mb-0">Order: <a class="text-primary" href="javascript:"><span> #<?= $orderid ?></a></span></p>
                                        <small class="text-muted">Placed on  <?= date("d M Y h:i A",strtotime($item['time'])) ?></small>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a class="text-decoration-none text-uppercase m-2 d-inline-block text-primary" href="javascript:">Manage</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-3 py-0">
                                <?php 
                                    $orderdtl = $db->getTableData('order_details','order_id',$orderid);
                                    while($products = mysqli_fetch_assoc($orderdtl)){
                                        $id = $products['product'];
                                        $orderPro = $db->getTableData('product','id',$id);
                                        $product = mysqli_fetch_assoc($orderPro);
                                        $status = $item['status'];
                                        if($status == 1){
                                            $delivertime = date('d-m-Y h:s a',strtotime($item['delivered']));
                                            $uptime      = date('d-m-Y h:s a',time());
                                            if($delivertime < $uptime){
                                                $up = $order->deliveryUpdate($product['id']);
                                            }
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-2">
                                                <a href="<?= URL ?>view-product.php?view=<?= $id ?>"><img class="img-fluid my-2 w-80" src="<?= $dir.$product['image'] ?>" alt="Product image"></a>
                                            </div>
                                            <div class="col-3 p-0 my-auto"><p class="mb-0"><?= $product['name'] ?></p></div>
                                            <div class="col-2 p-0 my-auto"><p class="mb-0"><span class="text-muted">Quantity:</span><?= $products['quantity'] ?></p></div>
                                            <div class="col-2 p-0 my-auto">
                                                <?php  if($item['payment'] == '0'){ ?>
                                                <span class="badge badge-info px-2 py-1 badge-pill font-weight-normal">need payment</span>
                                                <?php }else{ ?>
                                                <span class="badge badge-success px-2 py-1 badge-pill font-weight-normal">Paid</span>
                                                <?php } ?>
                                            </div>
                                            <div class="col-3 p-0 my-auto">
                                                <?php  if($status == '0'){ ?>
                                                    <span class="badge badge-primary px-2 py-1 badge-pill font-weight-normal">Pending</span>
                                                <?php }elseif($status == 1){ ?>
                                                    <p class="text-success mb-0">It will deliverd by <?= date('d M Y h:i A',strtotime($item['delivered'])) ?></p>
                                                <?php }elseif($status == 2){ ?>
                                                    <span class="badge badge-info px-2 py-1 badge-pill font-weight-normal">Declined</span>
                                                <?php }elseif($status == 3){ ?>
                                                    <span class="badge badge-warning px-2 py-1 badge-pill font-weight-normal">Cencled</span>
                                                <?php }elseif($status == 4 && $products['review'] != 1){ ?>
                                                    <a class="btn btn-outline-success btn-sm " href="review.php?order=<?= $orderid ?>&p=<?= $id ?>">Add review</a>
                                                <?php }elseif($products['review'] == 1 && $status == 4){ ?>
                                                    <a class="btn btn-success btn-sm" href="javascript:">Review Added</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php 
                                    }
                                ?>
                            </div>
                        </div>
                        <?php 
                                }
                            }else{
                                ?><h3 class="text-center" >No order yeat</h3><?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        }else{
            echo "<script>window.location.href='user-login'</script>";
        }
include("../inc/footer.php");
?>