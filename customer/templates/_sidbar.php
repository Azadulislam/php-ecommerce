<div class="profile_menu">
                <h6 class='heading m-0'>My Profile</h6>
                <ul class="menu_ul">
                    <li class="<?= $page == 'customer.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="customer-dashboard">Profile</a>
                    </li>
                    <li class="<?= $page == 'cartlist.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="cartlist.php">Cart list</a>
                    </li>
                    <li class="<?= $page == 'order.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="order-list">Order</a>
                    </li>
                    <li class="<?= $page == 'product.php'?'active':'' ?><?= $page == 'addproduct.php'?'active':'' ?><?= $page == 'editproduct.php'?'active':'' ?>">
                        <a class='profile_menu_item' href="product">Product for sell</a>
                    </li>
                    <!-- <li class="">
                        <a class='profile_menu_item' href="wallet-history">Wallet</a>
                    </li> -->
                    <li class="<?= $page == 'blogs.php'?'active':'' ?><?= $page == 'addblog.php'?'active':'' ?><?= $page == 'editblog.php'?'active':'' ?>">
                        <a class='profile_menu_item'  href="blog-list">Blog</a>
                    </li>
                    <li class="<?= $page == 'editprofile.php'?'active':'' ?>">
                        <a class='profile_menu_item'  href="edit-profile">Edit profile</a>
                    </li>
                </ul>
            </div>