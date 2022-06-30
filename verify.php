<?php

$title = "Verify || Demo Shop";

$asset = "";



include("inc/header.php");

?>

<section id="login">

    <div class="container">

        <div class="row">

            <div class="col-md-6 mx-auto">

                <div class="regi_form my-4">

                    <div class="sit_logo">

                        <a class="logo" href="home">
                            <h1 class="mb-0"><span class='title1'>Demo</span> <span class="title2">Shop</span></h1>
                        </a>

                    </div>

                    <form class="form_con" method="post" action="">

                        <div class="form_header">

                            <h5 class="text-center text-uppercase text-success">Register Successfull!</h5>

                            <!-- <p class="text-center text-warning">Verify your account</p> -->

                        </div>

                        <hr class="m-0 mb-3">

                        <?php

                            if(isset($_GET['registerd'])){

                                ?>

                                <div class="row m-0 p-3">

                                    <h4>Hi <?= $_GET['nm']?></h4>

                                    <p>We have Sent email to <b><?= $_GET['registerd']?></b> please check your inbox.</p>

                                </div>

                                <?php

                            }elseif(isset($_GET['invalid'])){

                                ?>

                                <div class="row m-0 p-3">

                                    <p class="text-danger font-weight-bold">Invalid link </p>

                                </div>

                                <?php

                            }elseif(isset($_GET['verify'])){

                                $usr = $_GET['verify'];

                                $chusr = $db->rnQuery("SELECT * FROM `user` WHERE `auth`='$usr'");

                                $usrrows = mysqli_num_rows($chusr);

                                if($usrrows === 1){

                                    $verify = $db->rnQuery("UPDATE `user` SET `verified`='1',`status`='1' WHERE `auth`='$usr'");

                                    if($verify == true){

                                        echo "<script>window.location.href='user-login?verifed'</script>";

                                    }

                                }else{

                                    echo "<script>window.location.href='?invalid'</script>";

                                }

                            }else{

                                echo "<script>window.location.href='customer-register?errdata'</script>";

                            }

                        ?>

                            <a class="mb-3 d-block text-right text-center" href="home"><i class="fas fa-home"></i> HOME</a>

                                </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>



<?php

include("inc/footer.php");

?>