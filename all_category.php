<?php
$title = "All category || Demo Shop";
$asset = "";
$adloc = "";
$autoloc = "";
$dir = "uploads/";
include("inc/header.php");
?>
<section id="categories">
    <div class="container">
        <h4 class="my-3 page-title"><span>All categories</span></h4>
        <div class="row py-4">
            <?php 
                foreach($allcategory as $category){
                    $catgoryid = $category['id'];
                    $allSubcategory = $db->getTableData('sub_category','cat',$catgoryid);
                    $subCatcount = mysqli_num_rows($allSubcategory);
            ?>
            <div class="col-md-3">
                <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#"><?= $category['name'] ?>(<?= $subCatcount ?>)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul class=" list-unstyled m-0">
                                <?php  
                                    foreach($allSubcategory as $subCategory){
                                        $subCatid = $subCategory['id'];
                                        $allproduct = $db->getTableData('product','category',$subCatid);
                                        $productCount = mysqli_num_rows($allproduct);
                                ?>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="<?= $dir.$subCategory['banner'] ?>"><a class="sub-cat ml-1 text-capitalize" href="#"><?= $subCategory['name'] ?>(<?= $productCount ?>)</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#">Automobile(00)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul class=" list-unstyled m-0">
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Luxury SUV (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Chopper Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Private Air (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
            <?php 
                }
            ?>
            <!-- <div class="col-md-3">
                <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#">Automobile(00)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-3">
                            <ul class=" list-unstyled m-0">
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Luxury SUV (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Chopper Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Private Air (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_4.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#">Automobile(00)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul class=" list-unstyled m-0">
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Luxury SUV (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Chopper Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Private Air (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#">Automobile(00)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul class=" list-unstyled m-0">
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Luxury SUV (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Chopper Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Private Air (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#">Automobile(00)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul class=" list-unstyled m-0">
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Luxury SUV (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Chopper Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Private Air (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <div class="card">
                        <div class="card-header bg-white text-center py-2">
                            <a class="main-cat" href="#">Automobile(00)</a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul class=" list-unstyled m-0">
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Car(0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Luxury SUV (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Chopper Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Racing Bike (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\sub_category_6.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">Private Air (0)</a></li>
                                <li class="px-2 py-1"><img class="cat-img img-fluid" src="image\category_1.jpg"><a class="sub-cat ml-1 text-capitalize" href="#">HObby (0)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<?php
include("inc/footer.php");
?>