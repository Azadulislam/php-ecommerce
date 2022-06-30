<?php

    session_start();
    $loc      = isset($autoloc)?$autoloc:'';
    include "{$loc}php/auto.php";
    $url      = $_SERVER['PHP_SELF'];
    $php_self = explode('/',$url);
    $page     = end($php_self);
    $ip       = $_SERVER['REMOTE_ADDR'];
    $dir      = "uploads/";
    $pro      = new classes\Product;
    $blog     = new classes\Blog;
    $usr      = new classes\User;




    //Select Data From database

    $allclassifiedpro = $db->getActiveData('classicproduct');
    $allpro           = $db->getActiveData('product');
    $allcategory      = $db->getActiveData('category');
    $countcategory    = count($allcategory);
    $vendor           = $db->rnQuery("SELECT * FROM `user` WHERE `roll`='2' AND `status`='1'");





    //Select Data From database!

    $actual_link = $_SERVER['REQUEST_URI'];
    $countProduct = count($allpro);



    

    if(isset($_POST['addToCart']) || isset($_POST['buye'])){
        if($_POST['proQuantity'] != '0'){
            $quantity = 1;
            if(isset($_POST['quantity'])){
                $quantity = $_POST['quantity'];
            }
            if(isset($_SESSION['cart'])){
                $arra_column = array_column($_SESSION['cart'],'id');
                if(!in_array($_POST['id'],$arra_column)){
                    $count = count($_SESSION['cart']);
                    $item = array(  
                        'id'     =>$_POST['id'],
                        'name'   =>$_POST['name'],
                        'image'  =>$_POST['image'],
                        'qty'    =>$quantity,
                        'dic'    =>$_POST['discount']*$quantity,
                        'price'  =>$quantity*$_POST['price']
                    );
                    $_SESSION['cart'][$count] = $item;
                }else{
                    foreach ($_SESSION['cart'] as $key => $value) {
                        if($value['id']==$_POST['id']){
                            if(isset($_POST['buye'])){
                                echo "<script>location.href='cartlist.php';</script>";
                            }else{
                                echo "<script>alert('Product already added');</script>";
                            }
                        }
                    }
                }
            }else{
                $item = array(  
                    'id'     =>$_POST['id'],
                    'name'   =>$_POST['name'],
                    'image'  =>$_POST['image'],
                    'qty'    =>$quantity,
                    'dic'    =>$_POST['discount']*$quantity,
                    'price'  =>$quantity*$_POST['price']
                );
                $_SESSION['cart'][0]= $item;
            }
            if(isset($_POST['buye'])){
                echo "<script>location.href='cartlist.php';</script>";
            }else{
                $id = '';
                if(isset($_POST['secid'])){
                    $id = $_POST['secid'];
                }
                echo "<script>location.href='".$actual_link."';</script>";
            }
        }else{
            echo "<script>alert('Product is not avilable'); location.href='".$actual_link."';</script>";
        }
    }

    if(isset($_GET['view']) && isset($_GET['classifed'])){

        $id = $_GET['view'];

        $classpro = $db->getSingle('classicproduct','id',$id);

        if($classpro != false){

            $title = $classpro['name'];

        }

    }

    if(isset($_GET['view']) && !isset($_GET['classifed'])){

        $id = $_GET['view'];

        $classpro = $db->getSingle('product','id',$id);

        if($classpro != false){

            $title = $classpro['name'];

        }

    }

    if(isset($_GET['view']) && isset($_GET['blog'])){

        $id = $_GET['view'];

        $classpro = $db->getSingle('blogs','id',$id);

        if($classpro != false){

            $title = $classpro['title'];

        }

    }

    



    // Get Admin Details

    $admin = $db->selectall("SELECT * FROM `admin`");

            

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="image/icon.png" type="image/x-icon">

    <title><?= $title ?></title>



    <link rel="stylesheet" href="<?= $asset ?>asset/css/fontawesome.min.css">

    <link rel="stylesheet" href="<?= $asset ?>plugins/css/bootstrap-select.css">

    <link rel="stylesheet" href="<?= $asset ?>plugins/css/jquery-ui.css">

    <!-- Owl Stylesheets -->

    <link rel="stylesheet" href="<?= $asset ?>asset/css/owl.carousel.css">

    <link rel="stylesheet" href="<?= $asset ?>asset/css/owl.theme.default.css">

    <link rel="stylesheet" href="<?= $asset ?>asset/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= $asset ?>asset/dropify/css/dropify.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    



    <link rel="stylesheet" href="<?= $asset ?>asset/css/style.css">

    <link rel="stylesheet" href="<?= $asset ?>asset/css/checkbox.css">
    <link rel="stylesheet" href="<?= $asset ?>asset/css/custome.css">



    <script src="<?= $asset ?>asset/js/jquery.min.js"></script>

    <script src="<?= $asset ?>asset/js/popper.min.js"></script>

    <script src="<?= $asset ?>asset/js/bootstrap.min.js"></script>

    <script src="<?= $asset ?>plugins/js/bootstrap-select.js"></script>

    <script src="<?= $asset ?>asset/js/fontawesome.min.js"></script>

    <script src="<?= $asset ?>asset/js/owl.carousel.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!--Bootstrap select js-->

    <script src="<?= $asset ?>plugins/js/jquery-ui.min.js"></script>

    <script src="<?= $asset ?>asset/js/validate.js"></script>

    <script src="<?= $asset ?>asset/js/userajax.js"></script>

    <script src="<?= $asset ?>asset/dropify/js/dropify.js"></script>

    <script src="<?= $asset ?>asset/summernote/dist/summernote.min.js"></script>

    <script src="<?= $asset ?>asset/js/app.js"></script>

    <script src="<?= $asset ?>asset/js/ajax.js"></script>



    <!-- include summernote css/js -->

</head>

<body>

    <!--web content body-->

    <section id='header'>

        <div class="tophed clearfix">

            <div class="container">

                <div class="row">

                    <ul class="list-inline mb-0 text-white col-6 text-center">

                        <li class="list-inline-item mr-4"><a href="care.php"><?php date_default_timezone_set('Canada/Yukon'); echo date('Y M D h:i A' , time());?></a></li>
                        <li class="list-inline-item mr-4"><a href="care.php">Customer care</a></li>

                        <li class="list-inline-item mr-4"><i class="fas fa-gift"></i><a href="premium.php" class="ml-2" href="#">premium packages</a></li>

                    </ul>

                    <ul class="list-inline mb-0 text-white col-6 mr-auto text-right">

                    <?php

                        if(isset($_SESSION['cart'])){

                            $count = count($_SESSION['cart']);

                        }



                        // Get user details

                        if(isset($_COOKIE['customer']) || isset($_COOKIE['vendor'])){

                            if(isset($_COOKIE['customer'])){

                                $auth = $_COOKIE['customer'];

                            }elseif(isset($_COOKIE['vendor'])){

                                $auth = $_COOKIE['vendor'];

                            }

                            $selectlogin   = $db->rnQuery("SELECT * FROM `login` WHERE `userauth`='$auth'");
                            $logindata     = mysqli_fetch_assoc($selectlogin);
                            $usrid         = $logindata['user'];

                            $auth          = $logindata['userauth'];

                            $selectusr     = $db->rnQuery("SELECT * FROM `user` WHERE `id`='$usrid'");

                            $usrdata       = mysqli_fetch_assoc($selectusr);

                            $roll          = $logindata['roll'];

                            $name          = $usrdata['fname'];

                            $email         = $usrdata['email'];

                            $floc = isset($fnloc)?$fnloc:'';

                            include ($floc.'php/function.php');

                            ?>

                            <li class="list-inline-item dropdown">

                                <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $name ?> <i class="fas fa-angle-down"></i></a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <li class="dropdown-item"><a href="<?= isset($_COOKIE['vendor'])?'vendor-dashboard':'customer-dashboard' ?>">Profile</a></li>

                                    <li class="dropdown-item"><a href="logout.php?logout=<?= $roll ?>&cookie=<?= $auth ?>">logout</a></li>
                                    <?php
                                        if(isset($_COOKIE['customer'])){
                                            ?>
                                            <li class="dropdown-item"><a href="order-list">My Order</a></li>
                                            <?php
                                        }elseif(isset($_COOKIE['vendor'])){
                                            ?>
                                            <li class="dropdown-item"><a href="vendor-Seles">My Seles</a></li>
                                            <?php
                                        }
                                    ?>

                                </ul>

                            </li>

                            <?php

                        }else{

                            ?>

                            <li class="list-inline-item"><a href="user-login">login</a></li>

                            <li class="list-inline-item dvdr-mdl">|</li>

                            <li class="list-inline-item dropdown"><a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">registration <i class="fas fa-angle-down"></i></a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <li class="dropdown-item"><a href="customer-reg.php">Customer Registration</a></li>

                                    <li class="dropdown-item"><a href="vendor-reg.php">Vendor Registration</a></li>

                                </ul>

                            </li>

                            <?php

                        }

                    ?>

                    </ul>

                </div>

            </div>

        </div>

        <div class="seched py-2">

            <div class="container">

                <div class="row">

                    <div class="headerlogo col-xl-3 col-6">

                        <a class="logotext" href="home">

                            <h1 class="mb-0"><span class='title1'>Demo</span> <span class="title2">Shop</span></h1>

                        </a>

                    </div>

                    <div class="col-lg-6 d-none d-xl-block my-auto">

                        <form class="srctop form-inline" action="search.php">

                            <div data-val="azad" class="src-bar input-group">

                                <input class="src-text" value="<?= isset($_GET['search'])?$_GET['search']:'' ?>" name="search" type="text" placeholder="What are you looking for?">

                                <select name="category" class="select cat" data-live-search="true">

                                    <option value="">Category</option>

                                    <?php

                                    foreach ($allcategory as $key => $item) {

                                        $id = $item['id'];

                                        ?>

                                        <option value="<?= $id ?>" <?php if(isset($_GET['category'])){ if($_GET['category'] == $id){ echo "selected"; }}  ?>><?= $item['name'] ?></option>

                                        <?php

                                    }

                                    ?>

                                </select>

                                <select name="type" id="tone" class="select" data-live-search="true">

                                    <option value="product" <?php if(isset($_GET['type'])){ if($_GET['type'] == 'product'){echo 'selected'; }}  ?>>Product</option>

                                    <option value="vendor" <?php if(isset($_GET['type'])){ if($_GET['type'] == 'vendor'){echo 'selected'; }}  ?>>Vendor</option>

                                </select>

                            </div>

                            <div class="srdbtn_con">

                                <button class="srcbtn" type="submit"><i class="fas fa-search"></i></button>

                            </div>

                        </form>

                    </div>

                    <div class="col-xl-3 col-6 my-auto">

                        <div class="topright text-right text-capitalize my-auto">

                            <div class="toprightbtn d-inline-block"><a class="d-inline-block" href="#"><i class="fas fa-exchange-alt"></i> <span class="d-none d-md-inline-block">compare</span> (0)</a></div>

                            <div class="toprightbtn d-inline-block"><a class="d-inline-block" href="cartlist.php"><i class="fas fa-shopping-cart"></i> <?= isset($count)?$count:'0' ?> <span class="d-none d-md-inline-block">Item</span></a></div>

                            <div class="toprightbtn d-inline-block d-xl-none"><a class="d-inline-block" href="#navbarSupportedContent" data-toggle="menu"><i class="fas fa-bars"></i></a></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="menu">

            <div class="container">

                <div class="d-block d-xl-none my-2">

                    <form class="srctop form-inline justify-content-center" action="search.php">

                        <div class="src-bar input-group">

                            <input class="src-text" name="search" type="text" placeholder="What are you looking for?">

                            <select name="category" class=" select cat" data-live-search="true">

                                <option value="">Category</option>

                                <?php

                                foreach ($allcategory as $key => $item) {

                                    $id = $item['id'];

                                    ?>

                                    <option value="<?= $id ?>" <?php if(isset($_GET['category'])){ if($_GET['category'] == $id){ echo "selected"; }}  ?>><?= $item['name'] ?></option>

                                    <?php

                                }

                                ?>

                            </select>

                            <select name="type" id="ttwo" class="select " data-live-search="true">

                                <option value="product" <?php if(isset($_GET['type'])){ if($_GET['type'] == 'product'){echo 'selected'; }}  ?>>Product</option>

                                <option value="vendor" <?php if(isset($_GET['type'])){ if($_GET['type'] == 'vendor'){echo 'selected'; }}  ?>>Vendor</option>

                            </select>

                        </div>

                        <div class="srdbtn_con">

                            <button type="submit" class="srcbtn"><i class="fas fa-search"></i></button>

                        </div>

                    </form>

                </div>

                <nav class="nav" id="navbarSupportedContent">

                    <li class="text-right"><a class="d-inline-block d-xl-none btn rounded-circle mt-3 mr-3" href="#navbarSupportedContent" data-toggle="menu"><i class="fas fa-times"></i></a></li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='index.php'?'active':''; ?>" href="home">homepage</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize dropdown-toggle <?= $page=='all_category.php'?'active':''; ?> <?= $page=='category.php'?'active':''; ?>" href="all_category.php">All categories</a>

                        <ul class="drop-nav list-unstyled">

                            <?php

                                $selcat = $db->getActiveData('category');

                                foreach($selcat as $category){

                                    ?>

                                    <li>

                                        <a class="text-capitalize" href="search.php?category=<?= $category['id'] ?>&main"><?= $category['name'] ?></a>

                                    </li>

                                    <?php

                                }

                            ?>

                        </ul>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='featured.php'?'active':''; ?>" href="featured.php">featured Products</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='todaysdeal.php'?'active':''; ?>" href="todaysdeal">todays deal</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='bundled_product.php'?'active':''; ?>" href="bundled_product.php">bundled product</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='customer_products.php'?'active':''; ?>" href="customer_products.php">classifieds</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='all_brands.php'?'active':''; ?>" href="all_brands.php">All brands</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='all_vendors.php'?'active':''; ?>" href="all_vendors.php">All vendors</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize dropdown-toggle <?= $page=='blog.php'?'active':''; ?>" href="blog.php">blogs</a>

                        <ul class="drop-nav list-unstyled">

                            <?php

                                $selbrand = $db->getActiveData('blog_category');

                                foreach($selbrand as $item){

                                    ?>

                                    <li>

                                        <a class="text-capitalize" href="blog.php?category=<?= $item['id'] ?>"><?= $item['name'] ?></a>

                                    </li>

                                    <?php

                                }

                            ?>

                        </ul>

                    </li>

                    <!-- <li class="nav-item">

                        <a class="nav-link text-capitalize" href="#">store locator</a>

                    </li> -->

                    <li class="nav-item">

                        <a class="nav-link text-capitalize <?= $page=='contact.php'?'active':''; ?>" href="contact.php">contact</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-capitalize dropdown-toggle <?= $page=='latest.php'?'active':''; ?>" href="#">more</a>

                        <ul class="drop-nav list-unstyled">

                            <li>

                                <a class="text-capitalize" href="latest.php">latest produtct</a>

                            </li>

                        </ul>

                    </li>

                </nav>

            </div>

        </div>

    </section>