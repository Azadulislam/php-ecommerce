<?php

    $dloc = isset($dbloc)? $dbloc:'';

    $cloc = isset($ctloc)? $ctloc:'';

    $prdloc = isset($ploc)? $ploc:'';

    $usrloc = isset($uloc)? $uloc:'';

    $admloc = isset($aloc)? $aloc:'';

    $mailloc = isset($mloc)? $mloc:'';

    include "config.php";

    include "{$dloc}Database.php";

    include "{$cloc}Category.php";

    include "{$prdloc}Product.php";

    include "{$usrloc}User.php";

    include "{$admloc}Admin.php";

    include "Contact.php";

    include "Blog.php";

    include "Order.php";

    include "Cart.php";

    include "Image.php";

    include "Brand.php";
    include "Control.php";
    include "Review.php";

    $db = new classes\Database;

    $order = new classes\Order($db);

    $cart = new classes\Cart($db);

    $brand = new classes\Brand($db);

    $imageClass = new classes\Image($db);

    $contact = new classes\Contact($db);
    $control = new classes\Control($db);
    $review = new classes\Review($db);
    $product = new classes\Product();



?>