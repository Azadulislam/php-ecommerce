<?php
$title = "Profile || Active supper shope";
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
    include ('../php/function.php');
    if(isset($_POST['cstatus'])){
        $id = $_POST['id'];
        $pro->classifiedStatus($id);
    }elseif(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $pro->deletClassifiedeProduct($id);
    }
?>
                    
                    
            
<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
        <div class="col-lg-3">  
            <?php include ('templates/_sidbar.php') ?>
        </div>
        <div id="maindiv" class="col-lg-9"> 
            <div class="content">
                <h6 class="heading mb-0">Your Product</h6>
                <div class=" text-right my-1"><a href="add-classified-product" data-page='customer/templates/_classifiedproduct.php' class="btn btn-theme ajxpage"><i class="far fa-plus-square"></i> Add product</a> </div>
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
                                $i=1;
                                while($product_item = mysqli_fetch_assoc($classicproduct)){
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
                                        <?php }elseif($product_item['status']==2){ ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?= $product_item['id'] ?>">
                                            <button  class="btn btn-danger" type="submit" name="cstatus"><i class="fas fa-times"></i></button>
                                        </form>
                                    <?php  } ?>
                                </td>
                                <td>
                                    <a class="btn btn-danger m-1" href="?delete=<?= $product_item['id'] ?>"><i class='far fa-trash-alt'></i></a>
                                    <a class="btn btn-theme m-1" href="edit-product?edit=<?= $product_item['id'] ?>"><i class='fas fa-edit'></i></a>
                                    <a class="btn btn-theme m-1" href="view-classified.php?view=<?= $product_item['id'] ?>"><i class='fas fa-eye'></i></a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
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