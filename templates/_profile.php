<div class="col-md-4 col-lg-3 col-6 my-2">
                <div class="vendor-profile rounded text-center">
                    <div class="profile-cover">
                        <img class="img-fluid cover-img" src="<?= $dir ?><?= $item['background']??'profile-bg.jpg' ?>" alt="">
                        <div class="vendor-photo">
                            <img class="img-fluid img-thumbnail" src="<?= $dir ?><?= $item['profile']??'profile.png' ?>" alt="">
                        </div>
                    </div>
                    <div class="profile-dtl">
                        <a class="m-0 pt-1 d-block vendor-name" href="#"><?= $item['fname'] ?></a>
                        <p class="vendor-address m-0"><?= $item['address1'] ?></p>
                        <p class="vendor-contact"><b>Email:</b> <?= $item['email'] ?> <b>Phone:</b> <?= $item['ph_num'] ?></p>
                        <a class="btn btn-block m-0 text-uppercase visit-profile" href="javascript:">Visit</a>
                    </div>
                </div>
            </div>