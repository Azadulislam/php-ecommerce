<?php
$title = "Contact || Demo Shop";
$asset = "";
$adloc = "";
$autoloc = "";
if(isset($_GET[''])){

}
include("inc/header.php");
if(isset($_POST['con_name'],$_POST['con_email'],$_POST['con_sub'],$_POST['message'])){
    $contact->sendMessage($_POST);
}
?>
<section id="contact">
    <div class="container py-3">
        <div class="row">
            <div class="col-sm-5">
                <div class="contact_left_one mb-4">
                    <h6 class="mt-3 mb-4 contact_left_title"><span>Contact us</span></h6>
                    <ul class="list-unstyled cont_list">
                        <li>
                            <span class="cont_icon">
                                <i class="fas fa-home"></i>
                            </span>
                            <div class="contact_add ml-3">
                                <p><b>Address:</b></p>
                                <p><?= $admin['address'] ?></p>
                            </div>
                        </li>
                        <li>
                            <span class="cont_icon">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                            <div class="contact_add ml-3">
                                <p><b>Phone:</b></p>
                                <p><?= $admin['phn'] ?></p>
                            </div>
                        </li>
                        <li>
                            <span class="cont_icon">
                                <i class="fas fa-globe-asia"></i>
                            </span>
                            <div class="contact_add ml-3">
                                <p><b>Website:</b></p>
                                <p><a href="<?= URL ?>">demoshop.com</a></p>
                            </div>
                        </li>
                        <li>
                            <span class="cont_icon">
                                <i class="far fa-envelope"></i>
                            </span>
                            <div class="contact_add ml-3">
                                <p><b>Email:</b></p>
                                <p><?= $admin['email'] ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- <div class="contact_left_two">
                    <h6 class="mt-3 mb-4 contact_left_title_two"><span>Contact us</span></h6>
                    <p>About Contact</p>
                </div> -->
            </div>
            <div class="col-sm-7">
                <div class="contact_form">
                    <form action="" id="contatcFrom" method="post">
                        <h6 class="contact_right_title"><span>Contact us</span></h6>
                        <?php
                            if(isset($contact->err)){
                                ?><div class="alert alert-warning"><?= $contact->err ?></div><?php
                            }
                            if(isset($_GET['recived'])){
                                ?><p class="text-center text-success h4 p-5">We have recived your email successfully we will back to you soon</p><?php
                            }else{
                        ?>
                        <input type="text" name="con_name" class="name w-100" placeholder="Name">
                        <input type="email" name="con_email" class="email w-100" placeholder="Email">
                        <input type="text" name="con_sub" class="subj w-100" placeholder="Subject">
                        <textarea name="message" id="" class="mess w-100" cols="30" rows="9" placeholder="Message"></textarea>
                        <div class="d-block">
                            <button type="submit" class="cont_btn btn rounded-0 text-uppercase">Send message</button>
                        </div>
                                <?php
                            }
                            ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("inc/footer.php");
?>