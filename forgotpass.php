<?php
$title = "Reset password || Demo Shop";
$asset = "";
$adloc = "";
include("inc/header.php");

if(isset($_POST["send"]) || isset($_POST['resetpwd'])){
    $data = $_POST;
    $encode = json_encode($data);
    // Curl Start
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URL."api/user.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode);
    $responce = curl_exec($ch);
    curl_close($ch);
}
if(isset($_COOKIE['customer'])){
    echo "<script>window.location.href='profile'</script>";  
}else{
?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="regi_form my-4">
                    <div class="sit_logo">
                        <img src="image\logo_76.png" alt="Site logo">
                    </div>
                    <form class="form_con" method="post" action="">
                        <div class="form_header">
                            <h5 class="text-center text-uppercase">Reset password</h5>
                            <?php
                                if(isset($responce)){
                                    ?>
                                    <p class="text-center  text-danger font-weight-bold  px-4"><?= $responce ?></p>
                                    <?php
                                }else{
                                    ?>
                                     <p class="text-center">Not a member ? Click To <a href="user-login">Sign up now</a></p>
                                    <?php
                                }
                            ?>
                        </div>
                        <hr class="m-0 mb-3">
                        <div class="row m-0">
                            <?php if(isset($_GET['sent'])){ ?>
                            <div class="col-12 form-group">
                                <p>hi <?= $_GET['nm'] ?></p>
                                <p>We have sent an email to <b><?= $_GET['sent'] ?></b>. Please check your inbox to reset your password</p>
                            </div>
                            <?php }elseif(isset($_GET['reset'])){ ?>
                            <div class="col-12 form-group">
                                <input class="w-100" type="password" name="newpass"  placeholder="New password" required>
                                <input type="hidden" value="<?= $_GET['reset'] ?>" name="auth">
                            </div>
                            <div class="col-12 form-group">
                                <input class="w-100" type="password" name="confpass"  placeholder="Confirm password" required>
                            </div>
                            <div class="col-12 form-group text-right">
                                <button class="btn btn-block regbtn my-3" name="resetpwd" type="submit" >Reset</button>
                            </div>
                            <?php }else{ ?>
                            <div class="col-12 form-group">
                                <input class="w-100" type="email" name="email"  placeholder="Email" required>
                            </div>
                            <div class="col-12 form-group text-right">
                                <button class="btn btn-block regbtn my-3" name="send" type="submit">Send email</button>
                                Already have account? <a href="forgotepassword">Login</a>
                            </div>
                            <?php } ?>
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