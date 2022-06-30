            <div class="profile_menu">
                <h5 class='heading m-0'>My Profile</h5>
                <ul class="menu_ul">
                    <li class="<?= $page == 'vendor.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="vendor-dashboard">Profile</a>
                    </li>
                    <li class="<?= $page == 'order.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="vendor-Seles">Seles</a>
                    </li>
                    <li class="<?= $page == 'product.php'?'active':'' ?><?= $page == 'addproduct.php'?'active':'' ?><?= $page == 'edit-product.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="vendor-product">Product</a>
                    </li>
                    <li class="<?= $page == 'wallet.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="vendor-wallet">Wallet</a>
                    </li>
                    <li class="<?= $page == 'blogs.php'?'active':'' ?><?= $page == 'addblog.php'?'active':'' ?><?= $page == 'editblog.php'?'active':'' ?>">
                        <a class='profile_menu_item'  href="vendor-blog">Blog</a>
                    </li>
                    <li class="<?= $page == 'editprofile.php'?'active':'' ?>">
                        <a class='profile_menu_item'  href="vendor-edit-profile">Edit Profile</a>
                    </li>
                </ul>
            </div>