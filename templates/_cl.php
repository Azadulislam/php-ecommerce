        <div class="col-lg-9">  
            <div class="content">
                <h6 class="heading mb-0">Your cart list</h6>
                <div class="cartpro mt-3">
                    <?php 
                        $total = 0;
                        $tDic  = 0;
                        if(!empty($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $key => $value){
                            $sl = $key+1;
                            $total = $total+$value['price'];
                            $productid = $value['id'];
                            $product = $db->getSingle('product','id',$productid);
                            $tDic    = $tDic + $value['dic'];
                    ?>
                    <div class="row m-0 border-top border-bottom py-2">
                        <div class="col-2">
                            <div class="prodcut_img">
                                <img class="img-fluid" src="<?= $dir.$value['image'] ?>" alt="Proudct image">
                            </div>
                        </div>
                        <div class="col-3">
                            <p class=""><?= $value['name'] ?></p>
                        </div>
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text q_plus btn" data-target="#quan<?= $key ?>" data-discount="<?= $product['discount'] ?>" data-price="<?= $product['price'] ?>" data-id="<?= $value['id'] ?>"><i class="fas fa-plus"></i></span>
                                </div>
                                <input type="number" id="quan<?= $key ?>" class="form-control" name="quantity" min="1" max="<?= $product['quantity'] ?>" value="<?= $value['qty'] ?>" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text q_minus btn" data-target="#quan<?= $key ?>" data-discount="<?= $product['discount'] ?>" data-price="<?= $product['price'] ?>" data-id="<?= $value['id'] ?>"><i class="fas fa-minus"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-right">
                            <p class="mb-0">Price: &dollar;<?= $value['price'] ?></p>
                            <p class="mb-1">-&dollar;<?= $value['dic'] ?></p>
                            <a class="btn btn-outline-danger" href="?remove=<?= $value['id'] ?>">Remove</a>
                        </div>
                    </div>
                    <?php
                            }
                        ?>
                    <div class="row mx-0">
                        <div class="col-12 py-3 text-center">
                            <a class="btn btn-danger" href="?removeAll">Remove all</a>
                        </div>
                    </div>
                        <?php
                        }else{
                            ?><h4 class="text-center">No Cart porduct</h4> <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <h6 class="heading mb-0">Subtotal</h6>
            <div class="subtotal border p-3">
                <div class="row m-0">
                    <div class="col-6 p-0">
                    <span><b> Item(s) :</b></span>
                    </div>
                    <div class="col-6 p-0">
                        <span><?= isset($count)?$count:'0' ?></span>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-6 p-0">
                    <span>Sub Total :</span>
                    </div>
                    <div class="col-6 p-0">
                        <span>&dollar;<?= $total ?></span>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-6 p-0">
                    <span>Discount :</span>
                    </div>
                    <div class="col-6 p-0">
                        <span>-&dollar;<?= $tDic ?></span>
                    </div>
                </div>
                <hr class="m-0">
                <div class="row m-0">
                    <div class="col-6 p-0">
                    <span>Total :</span>
                    </div>
                    <div class="col-6 p-0">
                        <span>&dollar;<?= $total-$tDic ?></span>
                    </div>
                </div>
                <form action="" method="get">
                    <?php if(!empty($_SESSION['cart'])){ ?>
                    <button type="submit" name="pbuy" class="btn btn-block btn-theme-hover mt-3">Procced to Buy</button>
                    <?php }else{ ?>
                        <button type="submit" class="btn btn-block btn-theme-hover mt-3" disabled>Procced to Buy</button>
                    <?php } ?>
                </form>
                
            </div>
        </div>
                    