<?php

$title = "Blog || Demo Shop";

$asset = "";

include("inc/header.php");



?>

<section id="blogspage">

    <div class="container">

        <div class="row">

            <?php include_once ("templates/_blogsidbar.php") ?>

            <div class="col-lg-9 col-12">

                <div class="blog_content">

                    <?php  

                        if(isset($_GET['category'])){

                            $catgoryid   = $_GET['category'];

                            $blogsbycat = $db->getTableData('blogs','category',$catgoryid);

                            while ($blogitem    = mysqli_fetch_assoc($blogsbycat)) {

                                $blogerid = $blogitem['bloger'];

                                if(is_numeric($blogerid)){

                                    $bloger     = $db->getSingle('user','id',$blogerid);

                                    $blogerName = $bloger['fname'];

                                }else{

                                    $blogerName = $blogerid;

                                }

                                ?>

                                <div class="blog_div row m-0 mb-4">

                                    <div class="blog_image col-sm-4 col-12 p-2">

                                        <a class="text-dark" href="view-blog.php?view=<?= $blogitem['id'] ?>&blog"><img class="img-fluid" src="<?= $dir ?><?= $blogitem['image']??"default.jpg" ?>" alt="<?= $blogitem['title'] ?>"></a>

                                    </div>

                                    <div class="blog_text col-sm-8 col-12 pt-2">

                                        <p class="title mb-2"><a class="text-dark" href="view-blog.php?view=<?= $blogitem['id'] ?>&blog"><?= $blogitem['title'] ?></a></p>

                                        <p class="woner mb-2"><span class="author">Author: <b><?= $blogerName ?></b></span> <span class="date"><b><?= date("d M Y",strtotime($blogitem['time'])) ?></b></span></p>

                                        <div class="desc"><?= $blogitem['description']  ?></div>
                                        <a href="view-blog.php?view=<?= $item['id'] ?>&blog" class="py-2 font-15 d-block text-right" target="_blank" rel="noopener noreferrer">More <i class="far fa-plus-square ml-1"></i></a>
                                    </div>

                                </div>

                                <?php

                            }

                        }else{
                            $selblogs = $db->getActiveData('blogs');

                            foreach($selblogs as $item){
                                $blogerid = $item['bloger'];
                                if(is_numeric($blogerid)){
                                    $bloger     = $db->getSingle('user','id',$blogerid);
                                    $blogerName = $bloger['fname'];
                                }else{
                                    $blogerName = $blogerid;
                                }

                                ?>

                                <div class="blog_div row m-0">

                                    <div class="blog_image col-sm-4 col-12 p-2">
                                        <a class="text-dark" href="view-blog.php?view=<?= $item['id'] ?>&blog" target="_blank"><img class="img-fluid" src="<?= $dir ?><?= $item['image']??"default.jpg" ?>" alt="<?= $item['title'] ?>"></a>
                                    </div>
                                    <div class=" col-sm-8 pt-2">

                                        <p class="title mb-2"><a class="text-dark" target="_blank" href="view-blog.php?view=<?= $item['id'] ?>&blog"><?= $item['title'] ?></a></p>

                                        <p class="woner mb-2"><span class="author">Author: <b><?= $blogerName ?></b></span> <span class="date"><b><?= date("d-m-Y",strtotime($item['time'])) ?></b></span></p>

                                        <div class="desc py-3">
                                            <?=  substr(strip_tags($item['description']),0,200)."..." ?>
                                        </div>
                                        <a href="view-blog.php?view=<?= $item['id'] ?>&blog" class="py-2 font-15 d-block text-right" target="_blank" rel="noopener noreferrer">More <i class="far fa-plus-square ml-1"></i></a>
                                    </div>

                                </div>

                                <?php

                            }

                        }
                    ?>

                </div>

            </div>

        </div>

    </div>

</section>

<?php

include("inc/footer.php");

?>

<!-- <p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 18px; vertical-align: baseline; background: transparent; color: rgb(75, 82, 99); line-height: 28px; font-family: proxima-nova, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">Hi Kevin,</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 18px; vertical-align: baseline; background: transparent; color: rgb(75, 82, 99); line-height: 28px; font-family: proxima-nova, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">Wow, this is quite the info-packed article. It has 5,989 words! I can only speculate how long it took you to put this together. ðŸ™‚</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 18px; vertical-align: baseline; background: transparent; color: rgb(75, 82, 99); line-height: 28px; font-family: proxima-nova, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">Thereâ€™s one more I would add to the list: affirmations.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 18px; vertical-align: baseline; background: transparent; color: rgb(75, 82, 99); line-height: 28px; font-family: proxima-nova, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">The past month, Iâ€™ve switched things up on my blog. Instead of writing weekly or bi-weekly long-form posts, Iâ€™ve been writing something I call â€œblog musingsâ€ five days a week. Theyâ€™re brief, 250-500-word posts designed to inspire, entertain, and educate.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 18px; vertical-align: baseline; background: transparent; color: rgb(75, 82, 99); line-height: 28px; font-family: proxima-nova, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">Basically, theyâ€™re short blogging affirmations. ðŸ™‚</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 18px; vertical-align: baseline; background: transparent; color: rgb(75, 82, 99); line-height: 28px; font-family: proxima-nova, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;">Anyway, excellent work, Kevin. Iâ€™ll be tweeting this and sharing it on Facebook shortly!</p><div><br></div> -->