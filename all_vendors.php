<?php

$title   = "All Vendor || Demo Shop";

$asset   = "";

$adloc   = "";

$dir     = "uploads/";

$autoloc = "";

include("inc/header.php");

?>

<section id="vendors">

    <div class="container">

        <h4 class="my-3 page-title"><span>all vendors</span></h4>

        <div class="row py-4">

            <?php

                if(isset($_GET['search']) && isset($_GET['type'])){

                    $src = $db->convert($_GET['search']);

                    $vendor = $db->rnQuery("SELECT * FROM `user` WHERE `roll`='2' AND `status`='1' AND CONCAT_WS(`fname`,`lname`) LIKE '%$src%'");

                    if(mysqli_num_rows($vendor)>0){

                        while($item = mysqli_fetch_assoc($vendor)){

                            include ("templates/_profile.php");

                        }

                    }else{

                        ?><h3 class='text-center w-100'>No Vendor with this key</h3><?php

                    }

                }else{

                    foreach($vendor as $key => $item){

                        include ("templates/_profile.php");

                    }

                }

            ?>

        </div>

    </div>

</section>

<?php

include("inc/footer.php");

?>