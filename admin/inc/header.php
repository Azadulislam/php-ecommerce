<?php
    if(!isset($_COOKIE['admin'])){
        echo "<script>window.location.href='login.php'</script>";
    }
    $dir = "../uploads/";
    include_once ('php/auto.php');
    $user = $db->selectSingle("SELECT * FROM `admin`");
    $images = $db->selectSingle("SELECT * FROM `images`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is a demo ecommerce web site">
    <meta name="author" content="Azadul islam">
    <meta property="og:locale" content="en_US">
    <meta content="azad's demo shop" prefix="og: http://ogp.me/ns#" property="og:title">
    <meta content="image/profile.jpg" prefix="og: http://ogp.me/ns#" property="og:image">
    <link rel="icon" type="image/png" sizes="16x16" href="../image/icon.png">

    <title><?=isset($title)? $title:"Demo Azadulislam's"?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="<?=isset($loc)? $loc:''?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive table CSS -->
    <link href="<?=isset($loc)? $loc:''?>assets/plugins/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=isset($loc)? $loc:''?>assets/plugins/dropify/dist/css/dropify.css">
    
    <link href="<?=isset($loc)? $loc:''?>assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?=isset($loc)? $loc:''?>assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="<?=isset($loc)? $loc:''?>assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="<?=isset($loc)? $loc:''?>assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/bootstrap-select/bootstrap-select.min.css">
    <link
      href="assets/plugins/bootstrap-switch/bootstrap-switch.min.css"
      rel="stylesheet"
    />
    
    <link href="<?=isset($loc)? $loc:''?>css/style.css" rel="stylesheet">
    <link href="<?=isset($loc)? $loc:''?>css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- summernotes CSS -->
    <link href="<?=isset($loc)? $loc:''?>assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=isset($loc)? $loc:''?>css/coustom.css">
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border mini-sidebar">
    <?php
        
        $php_self = explode('/',$_SERVER['PHP_SELF']);
        $page = end($php_self);
        
        if(isset($_GET['logout'])){
            $name = $_GET['logout'];
            $value = $_COOKIE[$name];
            $date      = date('Y-m-d',time());
            $mdate     = date('D, d M Y H:m:s',strtotime($date. ' - 15 days'));
            echo "<script>document.cookie = '$name=$value; expires=$mdate UTC; path=/';</script>";
            echo "<script>window.location.href='login.php'</script>";
        }
        include_once('inc/alert.php');
    ?>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    
    <!-- Main wrapper -->
    <div id="main-wrapper">
        <!-- Topbar header -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <h1 class="logo d-inline-block"><i class="fas fa-shopping-cart"></i></h1>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <!-- dark Logo text -->
                        <!-- Light Logo text -->    
                        <h1 class="logo d-inline-block"><span class='title1'>Demo</span> <span class="title2">Shop</span></h1>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  sidbar toggler button-->
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Comment -->
                        <li class="nav-item dropdown">
                            <!-- <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a> -->
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Comment -->
                        <!-- Messages -->
                        <li class="nav-item dropdown">
                            <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a> -->
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 4 new messages</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Messages -->
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= $dir ?><?= $user['image'] ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?= $dir ?><?= $user['image'] ?>" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?= $user['name'] ?></h4>
                                                <p class="text-muted"><?= $user['email'] ?></p><a href="manage_profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="manage_profile.php"><i class="ti-user"></i> My Profile</a></li>
                                    <!-- <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li> -->
                                    <!-- <li><a href="#"><i class="ti-email"></i> Inbox</a></li> -->
                                    <li role="separator" class="divider"></li>
                                    <li><a href="manage_profile.php"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="?logout=admin"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link text-muted waves-effect waves-dark" data-toggle="tooltip" title="Go to website" data-placement="left" href="<?= URL ?>" target="_blanck"> <i class="fas fa-external-link-alt"></i></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php include_once ("sidbar.php"); ?>
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">