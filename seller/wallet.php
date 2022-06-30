<?php
$title = "Profile || Active supper shope";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");
if(isset($_COOKIE['customer'])){
    echo "<script>window.location.href='customer-dashboard'</script>";
}
if(isset($_COOKIE['vendor'])){
    include ('../php/function.php');

    
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
                <h5 class="heading mb-0">Wallet History</h5>
                <div class="wallet_balance">
                    <h4 class="text-right">Balance :<span class="mr-2"> $1200</span></h4>
                </div>
                <div class="wishlist">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th>Transition</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                            </tr>
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