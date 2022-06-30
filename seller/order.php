<?php
$title = "Profile || Active supper shope";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$fnloc = "../";
$adloc = "../";
include("../inc/header.php");
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
                <h5 class="heading mb-0">Your Selle</h5>
                <div class="wishlist mt-3">
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
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
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