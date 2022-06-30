<?php

$title = "Registration || Demo Shop";

$asset = "";

$loc = "";

$adloc = "";

$autoloc = "";



include("inc/header.php");





if (isset($_POST['registration'])){

    $data = $_POST;

    $encode = json_encode($data);

//    Curl Start

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL, URL."/api/user.php");

    curl_setopt($ch,CURLOPT_POST, true);

    curl_setopt($ch,CURLOPT_POSTFIELDS, $encode);

    curl_exec($ch);

    curl_close($ch);

}

if(isset($_COOKIE['customer']) || isset($_COOKIE['vendor'])){

    echo "<script>window.location.href='profile'</script>";  

}else{

?>

<section id="registration">

    <div class="container">

        <div class="row">

            <div class="col-md-8 mx-auto">

                <div class="regi_form my-4">

                    <div class="sit_logo">

                        <a class="logo" href="home">

                            <h1 class="mb-0"><span class='title1'>Demo</span> <span class="title2">Shop</span></h1>

                        </a>

                    </div>

                    <form class="form_con" method="post" id="vendoreReg" action="">

                        <div class="form_header">

                            <h5 class="text-center text-uppercase">Vendor rigistration</h5>

                            <p class="text-center">Already A Member ? Click To <a href="user-login">Login!</a> As Vendor Or <a href="customer-reg.php">Sign Up!</a> As Customer </p>

                        </div>

                        <hr class="m-0 mb-4">

                        <?php

                            if(isset($_GET['err'])){

                                ?>

                                <div class="alert alert-danger text-center">Something want wrong</div>

                                <?php

                            }elseif(isset($_GET['dberr'])){

                                ?>

                                <div class="alert alert-danger text-center">Error in database contact with addministrator</div>

                                <?php

                            }

                        ?>

                        <div class="row m-0">

                            <div class="col-6">

                                <div class="form-group">

                                    <input class="w-100" type="text" name="fname" placeholder="Name" id="">

                                    <input type="hidden" value="2" name="roll">

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-group">

                                    <input class="w-100" type="text" placeholder="Display Name" name="lname" id="">

                                </div>

                            </div>

                            <div class="col-12 form-group">

                                <input class="w-100" type="email" name="email"  placeholder="Email" id="email">

                                <div class="err"></div>

                            </div>

                            <div class="col-6 form-group">

                                <input class="w-100" type="password" name="pass"  placeholder="Password" id="pass">

                            </div>

                            <div class="col-6 form-group">

                                <input class="w-100" type="password" name="con_pass"  placeholder="Confirm Password" id="">

                            </div>

                            <div class="col-12 form-group">

                                <input class="w-100" type="text" name="add1"  placeholder="Address line 1" id="">

                            </div>

                            <div class="col-12 form-group">

                                <input class="w-100" type="text" name="add2"  placeholder="Address line 2" id="">

                            </div>

                            <div class="col-6 form-group">

                                <input class="w-100" type="text" placeholder="city" name="city" id="">

                            </div>

                            <div class="col-6 form-group">

                                <input class="w-100" type="text" name="state"  placeholder="state" id="">

                            </div>

                            <div class="col-6 form-group">

                                <input class="w-100" type="text" name="cntry"  placeholder="Country" id="">

                            </div>

                            <div class="col-6 form-group">

                                <input class="w-100" type="text" name="zcode"  placeholder="Zip" id="">

                            </div>

                            <div class="col-12 form-group">

                                <input type="checkbox" name="agree" value="1"><span class="text-capitalize ml-2">I agree with <a class="text-success" href="termsandcondition.php">tarms &amp; condition</a></span>

                                </br>

                                <label for="agree" class="error"></label>

                                <button class="btn btn-block regbtn my-3" name="registration" id='reg' type="submit">Register</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>



<?php

}

include("inc/footer.php");

?>