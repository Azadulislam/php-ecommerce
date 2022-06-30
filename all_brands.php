<?php
$title = "All category || Demo Shop";
$asset = "";
$dir   = "uploads/";
include("inc/header.php");
?>
<section id="brands">
    <div class="container">
        <h4 class="my-3 page-title"><span>All Brands</span></h4>
        <div class="row">
            <?php
            foreach($allcategory as $item){
                $catgoryid = $item['id'];
                $allbrand = $db->getTableData('brands','category',$catgoryid);
                $subCatcount = mysqli_num_rows($allbrand);
                if($subCatcount > 0){
            ?>
            <div class="col-md-4 col-lg-3 col-6 ">
                <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#"><?= $item['name'] ?>(<?= $subCatcount ?>)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                        <?php while($item = mysqli_fetch_assoc($allbrand)){ ?>
                            <ul class=" list-unstyled m-0">
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="<?= $dir ?><?= empty($item['logo'])?'default.jpg':$item['logo'] ?>"><a class="sub-cat ml-1 text-capitalize" href="#"><?= $item['name'] ?></a></li>
                            </ul>
                        <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
                }
            ?>
        </div>
    </div>
</section>
<?php
include("inc/footer.php");
?>