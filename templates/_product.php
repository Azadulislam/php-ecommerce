                                                <form action="" method="post">
                                                    <div class="product">
                                                        <a href="view-product.php?view=<?= $item['id'] ?>&product">
                                                            <div class="prdimg">
                                                                <?php 
                                                                    if($item['quantity'] > 0){
                                                                ?>
                                                                    <div class="cond bg-success">
                                                                        Avilable
                                                                    </div>
                                                                <?php }else{ ?>
                                                                    <div class="cond bg-danger">
                                                                        out of stock
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="view"></div>
                                                                <span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span>
                                                                <div class="imagediv">
                                                                    <img class="l" src="<?= $dir.$item['image'] ?>" alt="Procudt image">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div class="prdct-desc text-center">
                                                            <p class="prdct-name text-capitalize">
                                                                <a class="prdname" href="view-product.php?view=<?= $item['id'] ?>&product"><?= $item['name'] ?></a>
                                                            </p>
                                                            <div class="reting text-warning">
                                                            <?php
                                                                $id = $item['id'];
                                                                $avg = $control->avarage($id);
                                                                include ("./templates/_rating.php");
                                                            ?>
                                                            </div>
                                                            <p class="prc mb-0"><span class="dic mr-2"><?= $item['discount'] !=0?'&dollar;'.$slleprice:'' ?></span><span class="reg">&dollar;<?= $slleprice ?></span></p>
                                                            <a href="javascirpt:" class="shopname text-capitalize d-block">
                                                                <?= $control->sellerName($item['seller']) ?>
                                                            </a>
                                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                            <input type="hidden" name="name" value="<?= $item['name'] ?>">
                                                            <input type="hidden" name="image" value="<?= $item['image'] ?>">
                                                            <input type="hidden" name="price" value="<?= $item['price'] ?>">
                                                            <input type="hidden" name="proQuantity" value="<?= $item['quantity'] ?>">
                                                            <input type="hidden" name="discount" value="<?= $item['discount'] ?>">
                                                            <div class="footbtn py-2">
                                                                <!-- <span class="compare footbtn-item" data-toggle="tooltip" title="Compare"><strong><i class="fas fa-exchange-alt"></i></strong></span>
                                                                <span class="addwish footbtn-item" data-toggle="tooltip" title="Add to wishlist"><strong><i class="fas fa-heart"></i></strong></span> -->
                                                                <button type="submit" name="addToCart" class="addcart footbtn-item" data-toggle="tooltip" title="Add to cart"><strong><i class="fas fa-shopping-cart"></i></strong></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>