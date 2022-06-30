<?php
    $loc = "../";
    $adloc = "../";
    $dir = "uploads/";
    include ("../php/auto.php");
    if(isset($_POST['action'])){ 
        $min = $_POST['min'];
        $max = $_POST['max'];
        $porder = $_POST['price'];
        $brand = $_POST['brand'];
        $search = $_POST['serach'];
        $vendor = $_POST['vendor'];
        $query = "SELECT * FROM `product` WHERE `status`='1'";
        if(!empty($search)){
            $query.= " AND `name` LIKE '%$search%'";
        }
        if(!empty($_POST['cid'])){
            $id = $_POST['cid'];
            $query.= " AND `category`='$id'";
        }

        if(isset($_POST['scid']) && !empty($_POST['scid'])){
            //print_r($_POST['scid']);
            if(isset($_GET['action']) && $_POST['action'] == 'filter'){
                $scid = $_POST['scid'];
                $query.= " AND `subCategory` = '$scid'";
            }else{
                $scid = implode("', '",$_POST['scid']);
                $query.= " AND `subCategory` IN ('$scid')";
            }
        }
        if(!empty($brand)){
            $query.= " AND `brand`='$brand'";
        }
        if(!empty($vendor)){
            $query.= " AND `seller`='$vendor'";
        }

        if(!empty($min) && !empty($max)){
            $query.= " AND `price` BETWEEN '$min' AND '$max'";
        }
        if(!empty($porder)){
            if($porder == "asc"){
                $query.= " ORDER BY `price` ASC";
            }elseif($porder == "desc"){
                $query.= " ORDER BY `price` DESC";
            }
            
        }
        //echo $query;
        $select = $db->rnQuery($query);
        $response = '';
        
        while ($item = mysqli_fetch_assoc($select)) {
            if($item["quantity"] > 0){
                $condition = '<div class="cond bg-success"> Avilable</div>';
            }else{
                $condition = '<div class="cond bg-danger"> out of stock </div>';
            }
            $sellerid = $item['seller'];
            $sellerName = $control->sellerName($sellerid);
            $discount = $item['discount'];
            $price = $item['price']/100;
            $dic_price = number_format($price*$discount,0 , '.', '');
            $slleprice = $item['price'] - $dic_price;
            $regularPrice = '';
            $id = $item['id']; 
            $avg = $control->avarage($id); 
            if($discount != 0){
                $regularPrice = '<span class="dic mr-2">&dollar;'.$item['price'].'</span>';
            }
            $response.= '
            <div class="col-md-3 col-6 mt-2">
                <form action="" method="post">
                    <div class="product">
                        <a href="view-product.php?view='.$item["id"].'&product">
                            <div class="prdimg">
                                '.$condition.'
                                <div class="view"></div>
                                <span data-toggle="tooltip" title="Quick View"><i class="fas fa-eye d-block"></i></span>
                                <div class="imagediv">
                                    <img class="l" src="'.$dir.$item['image'].'" alt="Procudt image">
                                </div>
                            </div>
                        </a>
                        <div class="prdct-desc text-center">
                            <p class="prdct-name text-capitalize">
                                <a class="prdname" href="view-product.php?view='. $item["id"] .'&product">'.$item["name"].'</a>
                            </p>
                            <div class="reting">
                            <span class="text-warning">';

                                for($i=0; $i < round($avg) ; $i++){
                                    $response.= '<i class="fas fa-star text-warning"></i>';
                                }
                                $emp = 5 - round($avg);
                                for($i2=0; $i2 < $emp ; $i2++){
                                    $response.= '<i class="far fa-star text-warning"></i>';
                                }
                                $response.='</span>
                            </div>
                            
                            <p class="prc mb-0">'. $regularPrice .'<span class="reg">&dollar;'.$slleprice .'</span></p>
                            <a href="javascript:" class="shopname text-capitalize d-block">
                                '.$sellerName.'
                            </a>
                            <input type="hidden" name="id" value="'. $item['id'] .'">
                            <input type="hidden" name="name" value="'.$item['name'] .'">
                            <input type="hidden" name="image" value="'. $item['image'] .'">
                            <input type="hidden" name="price" value="'. $item['price'] .'">
                            <input type="hidden" name="proQuantity" value="'. $item['quantity'] .'">
                            <div class="footbtn py-2">
                                <button type="submit" name="addToCart" class="addcart footbtn-item" data-toggle="tooltip" title="Add to cart"><strong><i class="fas fa-shopping-cart"></i></strong></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>';
        }
       echo $response;
    }

?>