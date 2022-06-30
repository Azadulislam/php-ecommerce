<aside id="blog_sidebar" class="col-3 d-none d-lg-block">

                <ul class="list-unstyled blog_links">

                    <li><a href="blog.php">All blogs</a></li>

                    <?php

                        $selbrand = $db->getActiveData('blog_category');

                        foreach($selbrand as $item){

                            ?>

                            <li><a href="blog.php?category=<?= $item['id'] ?>"><?= $item['name'] ?></a></li>

                            <?php

                        }

                    ?>

                </ul>

                <div class="blogs_tab">
                    <ul class="nav nav-tabs nav-justifyed w-100 bg-white" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="popular" data-toggle="tab" href="#populardiv" role="tab" aria-controls="home" aria-selected="true">Popular</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="ltst" data-toggle="tab" href="#latstdiv" role="tab" aria-controls="profile" aria-selected="false">Latest</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-white p-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="populardiv" role="tabpanel" aria-labelledby="popular">
                            <?php 
                                $runquery = $db->rnQuery("SELECT * FROM `blogs` WHERE `status`=1 ORDER BY `id` DESC LIMIT 0,4");
                                $blog = mysqli_fetch_all($runquery , MYSQLI_ASSOC);
                                shuffle($blog);
                                foreach($blog as $key => $itm){
                                ?>
                                    <div class="row m-0 py-2 blog-div">
                                        <div class="col-4 p-0">
                                            <a class="blog-image" href="view-blog.php?view=<?= $itm['id'] ?>&blog">
                                                <div class="img-overly"><i class="far fa-eye"></i></div>
                                                <img class="img-fluid" src="<?= $dir ?><?= $itm['image']??'default.jpg' ?>">
                                            </a>
                                        </div>
                                        <div class="col-8 p-0 pl-2">
                                            <a class="blog-text" href="view-blog.php?view=<?= $itm['id'] ?>&blog">
                                                <p class="prdct-name"><?= $itm['title'] ?></p>
                                            </a>
                                            <p class="date text-right"><?= date('D M Y', strtotime($itm['time']) )?></p>
                                        </div>
                                    </div>
                                <?PHP    
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="latstdiv" role="tabpanel" aria-labelledby="ltst">
                            <?php 
                                $runquery = $db->rnQuery("SELECT * FROM `blogs` WHERE `status`=1 ORDER BY `id` DESC LIMIT 0,4");
                                $blog = mysqli_fetch_all($runquery , MYSQLI_ASSOC);
                                shuffle($blog);
                                foreach($blog as $key => $itm){
                                ?>
                                    <div class="row m-0 py-2 blog-div">
                                        <div class="col-4 p-0">
                                            <a class="blog-image" href="view-blog.php?view=<?= $itm['id'] ?>&blog">
                                                <div class="img-overly"><i class="far fa-eye"></i></div>
                                                <img class="img-fluid" src="<?= $dir ?><?= $itm['image']??'default.jpg' ?>">
                                            </a>
                                        </div>
                                        <div class="col-8 p-0 pl-2">
                                            <a class="blog-text" href="view-blog.php?view=<?= $itm['id'] ?>&blog">
                                                <p class="prdct-name"><?= $itm['title'] ?></p>
                                            </a>
                                            <p class="date text-right"><?= date('D M Y', strtotime($itm['time']) )?></p>
                                        </div>
                                    </div>
                                <?PHP    
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </aside>