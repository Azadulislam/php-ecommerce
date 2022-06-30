  <footer id="footerone">
      <div class="container">
          <div class="row">
              <div class="col-sm-6 col-lg-3 text-center text-sm-left">
                  <a class="footerlogo" href="home">
                    <h1 class=""><span class='title1'>Demo</span> <span class="title2">Shop</span></h1>
                  </a>
                  <p class="col-8 col-sm-12 p-0 mx-auto">
                      Active Super Shop Multi vendor system is such a platform to build a border less marketplace both for physical and
                      digital goods.
                  </p>
                  <form action="" class="col-8 col-sm-12 p-0 mx-auto" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Your email" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="input-group-text btn btn-theme" type="submit" id="basic-addon2">submit</span>
                        </div>
                    </div>
                  </form>
              </div>
              <div class="col-sm-6 col-lg-3 d-none d-sm-block">
                    <h6 class="footertitle w-50 pt-3">Categories</h6>
                    <ul class="list-unstyled footer-link">
                        <?php
                             $sel = $db->rnQuery("SELECT * FROM `category` LIMIT 0,6");
                             if($sel == true){
                                 if(mysqli_num_rows($sel)>0){
                                     while($item = mysqli_fetch_assoc($sel)){
                        ?> 
                        <li>
                            <a href="search.php?category=<?= $item['id'] ?>&main">
                                <i class="fas fa-arrow-circle-right mr-1"></i> <?= $item['name'] ?>
                            </a>
                        </li>
                        <?php  
                                    }
                                }
                            }
                        ?>
                    </ul>
              </div>
              <div class="col-md-3  d-none d-lg-block">
                  <h6 class="footertitle w-50 pt-3">usfull links</h6>
                  <ul class="list-unstyled footer-link">
                      <li><a href="home"><i class="fas fa-arrow-circle-right mr-1"></i> Home</a></li>
                      <li><a href=""><i class="fas fa-arrow-circle-right mr-1"></i> All products</a></li>
                      <li><a href="featured.php"><i class="fas fa-arrow-circle-right mr-1"></i> Featured Product</a></li>
                      <li><a href="contact.php"><i class="fas fa-arrow-circle-right mr-1"></i> Contact</a></li>
                  </ul>
              </div>
              <div class="col-md-3 d-none d-lg-block">
                  <h6 class="footertitle w-50 pt-3">conatct us</h6>
                  <table class="foot-add-table">
                      <tr>
                          <th><i class="fas fa-home mr-1"></i></th>
                          <th>address:</th>
                      </tr>
                      <tr>
                          <td></td>
                          <td><?= $admin['address'] ?></td>
                      </tr>
                      <tr>
                          <th><i class="fas fa-phone-alt mr-1"></i></th>
                          <th>phone:</th>
                      </tr>
                      <tr>
                          <td></td>
                          <td><a href="tel:+00000000000"><?= $admin['phn'] ?></a></td>
                      </tr>
                      <tr>
                          <th><i class="fas fa-globe-americas mr-1"></i></th>
                          <th>website:</th>
                      </tr>
                      <tr>
                          <td></td>
                          <td><a href="<?= URL ?>">demoshop.com</a></td>
                      </tr>
                      <tr>
                          <th><i class="fas fa-envelope mr-1"></i></th>
                          <th>email:</th>
                      </tr>
                      <tr>
                          <td></td>
                          <td><a href="mailto:"><?= $admin['email'] ?></a></td>
                      </tr>
                  </table>
                  <div class="social-icon">
                      <a class="facebook" href="javascript:"><i class="fab fa-facebook-f"></i></a>
                      <a class="twitter" href="javascript:"><i class="fab fa-twitter"></i></a>
                      <a class="google" href="javascript:"><i class="fab fa-google-plus-g"></i></a>
                      <a class="pinterest" href="javascript:"><i class="fab fa-pinterest-p"></i></a>
                      <a class="youtube" href="javascript:"><i class="fab fa-youtube"></i></a>
                      <a class="skype" href="javascript:"><i class="fab fa-skype"></i></a>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <footer id="footer">
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                  <p class="copytext">
                      <?= date('Y') ?> © All Rights Reserved @ Azadul islam | <a href="termsandcondition.php">Terms &amp; Condition</a> | <a href="privacypolicy.php">Privacy
                          Policy</a>
                  </p>
              </div>
              <div class="col-md-4">
                  <div class="pymentcard my-auto">
                      <img class="img-fluid" src="image/payment.png" alt="">
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <a id="backToTop" href="#"><i class="fas fa-angle-up"></i></a>
  <!---=============resume section end================-->

  <!--web content body end-->
<script src="asset/js/responsive.js"></script>
<script src="asset/js/share.js"></script>

  </body>

  </html>