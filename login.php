<?php

$title = "Login || Demo Shop";

$asset = "";

$adloc = "";

include("inc/header.php");



if(isset($_POST["login"])){

    $data = $_POST;

    $encode = json_encode($data);

// Curl Start

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URL."api/user.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($ch);
    curl_close($ch);
}

if(isset($_COOKIE['customer']) || isset($_COOKIE['vendor'])){

    echo "<script>window.location.href='customer-dashboard'</script>";  

}else{

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

                            <h5 class="text-center text-uppercase">Login in</h5>

                            <?php

                                if(isset($response)){

                                    ?>

                                    <p class="text-center  text-danger"><?= $response ?></p>

                                    <?php

                                }else{

                                    ?>

                                     <p class="text-center">Not a member ? Click To <a href="customer-reg.php">Sign up now</a></p>

                                    <?php

                                }

                            ?>

                        </div>

                        <hr class="m-0 mb-3">

                        <div class="row m-0">

                            <div class="col-12 form-group">

                                <input class="w-100" type="email" name="usrmail"  placeholder="Email" value="customer@gmail.com" required>

                            </div>

                            <div class="col-12 form-group">

                                <input class="w-100" type="password" name="usrpass"  placeholder="Password" value="1234" required>

                            </div>

                            <div class="col-12 form-group text-right">

                                <a href="forgotpass.php">Forgot Password?</a>

                                <button class="btn btn-block regbtn my-3" name="login" type="submit">Login</button>

                            </div>

                        </div>

                    </form>
                    <div class="pass">
                        <div class="row bg-secondary text-light p-3 my-3 mx-0 rounded">
                            <div class="col-6 border font-weight-bold"><p>User email</p></div>
                            <div class="col-6 border font-weight-bold"><p>Password</p></div>
                            <div class="col-6 border"><p>customer@gmail.com</p></div>
                            <div class="col-6 border"><p>Customer1</p></div>
                            <div class="col-6 border"><p>vendor@gmail.com</p></div>
                            <div class="col-6 border"><p>Vendor12</p></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>



<?php

}

include("inc/footer.php");

?>