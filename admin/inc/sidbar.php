        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background-image: url(<?= $dir ?><?= $images['admin_bg'] ?>) , linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5))">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?= $dir ?><?= $user['image'] ?>" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?= $user['name'] ?></a>
                        <div class="dropdown-menu animated flipInY"> <a href="manage_profile.php" class="dropdown-item"><i class="ti-user"></i> My Profile</a> 
                        <!-- <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> 
                        <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a> -->
                        <!-- <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a> -->
                        <div class="dropdown-divider"></div> <a href="?logout=admin" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> </div>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span>Dashboard </span></a></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="category.php" aria-expanded="false"><i class="mdi mdi-lan"></i><span class="hide-menu">Categoris</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="category.php">Main Category</a></li>
                                <li><a href="sub-category.php">Sub Category</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="fa fa-gift"></i><span class="hide-menu">Products</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="addproduct.php">Add Product</a></li>
                                <li><a href="manage_product.php">Manage Products</a></li>
                                <li><a href="classified.php">Classified Products</a></li>
                                <li></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">User</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="vendor.php">Vendor</a></li>
                                <li><a href="customer.php">Customer</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="fab fa-blogger"></i><span class="hide-menu">Blogs</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="blogs.php">Mannage Blogs</a></li>
                                <li><a href="blog_category.php">Manage Category</a></li>
                            </ul>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="manage_profile.php" aria-expanded="false"><i class="fas fa-id-badge"></i></i>Manage Profile</a></li>
                        <li> <a class="waves-effect waves-dark" href="selles.php" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Selles</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="brands.php" aria-expanded="false"><i class="fab fa-shopify"></i><span class="hide-menu">Brands</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="images.php" aria-expanded="false"><i class="far fa-image"></i><span class="hide-menu">Images</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><a href="javascript:" class="link not_working_alert" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><a href="javascript:" class="link not_working_alert" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item--><a href="?logout=admin" onclick="return confirm('Are you sure? Sign out')" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
            <!-- End Bottom points-->
        </aside>