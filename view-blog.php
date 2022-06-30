<?php
$title = "blog || Demo Shop";
$asset = "";
include("inc/header.php");
?>
<section id="blogspage">
    <div class="container">
        <div class="row">
            <?php include_once ("templates/_blogsidbar.php") ?>
            <div class="col-lg-9 col-sm-12">
                <?php
                    if(isset($_GET['view']) && isset($_GET['blog'])){
                        $id = $_GET['view'];
                        $blogs = $db->getTableData('blogs','id',$id);
                        $item  = mysqli_fetch_assoc($blogs);

                        $blogerid = $item['bloger'];
                        if(is_numeric($blogerid)){
                            $bloger     = $db->getSingle('user','id',$blogerid);
                            $blogerName = $bloger['fname'];
                        }else{
                            $blogerName = $blogerid;
                        }
                    }
                ?>
                <div class="blog_dtl p-3">
                    <div class="blogimg">
                        <img src="<?= $dir ?><?= $item['image']??"default.jpg" ?>" alt="Blog image">
                    </div>
                    <h4 class="blogname my-2"><?= $item['title'] ?></h4>
                    <p class="mb-0 mb-3">By <?= $blogerName ?></p>
                    <div class="share">
                        <div class="share-icon btn btn-primary">
                            facebook
                        </div>
                    </div>
                    <div class="description">
                        <?= $item['description'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("inc/footer.php");
?>