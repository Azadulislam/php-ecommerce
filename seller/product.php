<?php
$title = "Profile || Active supper shope";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");
if(isset($_POST["cstatus"])){
    $data = $_POST;
    $encode = json_encode($data);
// Curl Start
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URL."api/product.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode);
    curl_exec($ch);
    curl_close($ch);
}elseif(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $pro->deleteProduct($id);
}
if(isset($_COOKIE['customer'])){
    echo "<script>window.location.href='customer-dashboard'</script>";
}
if(isset($_COOKIE['vendor'])){
    include ('../php/function.php');
    

    
?>
                    
                    
            
<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">  
                <?php include ('templates/_sidbar.php') ?>
            </div>
            <div id="maindiv" class="col-lg-9"> 
                <div class="content">
                    <h5 class="heading mb-0">Your Product</h5>
                    <div class=" text-right my-1"><a href="vendor-addproduct" class="btn btn-theme"><i class="far fa-plus-square"></i> Add product</a> </div>
                    <div class="productlist">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                $product = $db->getTableData('product','seller',$usrdata['id']);
                                $i = 1;
                                while($product_item = mysqli_fetch_assoc($product)){
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td class="img"><div class="imgdiv"><img class="img-fluid" src="<?= $dir.$product_item['image'] ?>" alt="Product Image"></div></td>
                                        <td><?= $product_item['name'] ?></td>
                                        <td>
                                            <?php if($product_item['status']==1){ ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" value="<?= $product_item['id'] ?>">
                                                    <button  class="btn btn-theme" type="submit" name="cstatus"><i class="fas fa-check"></i></button>
                                                </form>
                                                <a href="?status="></a>
                                                <?php }elseif($product_item['status']==2){ ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id" value="<?= $product_item['id'] ?>">
                                                    <button  class="btn btn-danger" type="submit" name="cstatus"><i class="fas fa-times"></i></button>
                                                </form>
                                            <?php  } ?>
                                            
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="?delete=<?= $product_item['id'] ?>"><i class="far fa-trash-alt"></i></a>
                                            <a class="btn btn-theme" href="vendor-edit-product?edit=<?= $product_item['id'] ?>"><i class='fas fa-edit'></i></a>
                                            <a class="btn btn-theme" href="viewpro?view=<?= $product_item['id'] ?>"><i class='fas fa-eye'></i></a>
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
</section>
<?php
        }else{
            echo "<script>window.location.href='user-login'</script>";
        }
include("../inc/footer.php");
?>