<div class="row m-0 py-2 productsumuri-div">
    <div class="col-4 p-1">
        <a href="view-product.php?view=<?= $item['id'] ?>">
            <div class="img-overly"><i class="far fa-eye"></i></div><img class="img-fluid" src="<?= $dir ?><?= $item['image'] ?>">
        </a>
    </div>
    <div class="col-8">
        <a class="view-product.php?view=<?= $item['id'] ?>" href="#">
            <p class="prdct-name"><?= $item['name'] ?></p>
        </a>
        <div class="reting">
            <?php
                $id = $item['id'];
                $avg = $control->avarage($id);
                include ("./templates/_rating.php");
            ?>
        </div>
        <p class="prc"><span class="dic mr-2"><?php if($item['discount']!=0){ ?>&dollar;<?= $item['price'] ?><?php } ?></span><span class="reg">&dollar;<?= $selprice ?></span></p>
    </div>
</div>