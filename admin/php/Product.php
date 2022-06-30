<?php

    namespace classes;

    class Product{
        public $dir;
        public $err;
        public $suc;
        public $db;



        public function __construct()
        {
            $this->db = new Database;
            $loc = "../";
            $this->dir = "{$loc}uploads/";
        }

        public function addProduct($data)
        {
            $validext  = array('jpg','png','jpeg');
            $name = $this->db->convert($data['pname']);
            $prddesc = $this->db->convert(trim($data['prddesc']));
            $category = $data['category'];
            $price = $data['price'];
            $seller = $data['seller'];
            $brand = $data['brand'];
            $subCategory = $data['subCategory'];
            if(empty($prddesc)){
                $prddesc = "Product description";
            }

            $quantity = $data['quantity'];

            if(empty($name) || empty($prddesc) || empty($category) || empty($price) || !isset($_FILES['prdimage']) || !isset($data['status']) || empty($brand)){

                return $this->err = "Filds are required";

                exit();

            }else{

                

                $status = $data['status'];

                $image = $_FILES['prdimage'];

                $image_name = $image['name'];

                $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                $databaseFileName = "Product_".rand(1001,99999).time().".".$ext;

                $tmp = $image['tmp_name'];

                $databaseFileName2='default.jpg';

                $databaseFileName3='default.jpg';

                

                

                if($this->checkName($name) == true){

                    $this->err = "Name already Exist";

                }else{

                    if(in_array($ext , $validext)){

                        $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);

                        if(isset($_FILES['prdimage2'])){

                            $image2 = $_FILES['prdimage2'];

                            $image_name2 = $image2['name'];

                            if(!empty($image_name2)){

                                $ext2 = strtolower(pathinfo($image_name2,PATHINFO_EXTENSION));

                                $tmp2 = $image2['tmp_name'];

                                $databaseFileName2 = "Product_".rand(1001,99999).time().".".$ext2;

                                if(in_array($ext, $validext)){

                                    $mvf2 = move_uploaded_file($tmp2,$this->dir.$databaseFileName2);

                                }else{

                                    $this->err = "Please select image with (." . implode(', .',$validext).")";

                                }

                                

                            }

                        }

                        if(isset($_FILES['prdimage3'])){

                            $image3 = $_FILES['prdimage3'];

                            $image_name3 = $image3['name'];

                            if(!empty($image_name3)){

                                $ext3 = strtolower(pathinfo($image_name3,PATHINFO_EXTENSION));

                                $tmp3 = $image3['tmp_name'];

                                $databaseFileName3 = "Product_".rand(1001,99999).time().".".$ext3;

                                if(in_array($ext, $validext)){

                                    $mvf3 = move_uploaded_file($tmp3,$this->dir.$databaseFileName3);

                                }else{

                                    $this->err = "Please select image with (." . implode(', .',$validext).")";

                                }

                                

                            }

                        }

                        if($mvf == true){

                            $slug = str_replace(' ','-',strtolower($name));

                            $ins = $this->db->rnQuery("INSERT INTO `product`(`name`, `pro_desc`, `image`, `image2`, `image3`, `slug`, `category`,`subCategory`, `brand`, `quantity`, `price`,`status`,`seller`) VALUES ('$name','$prddesc','$databaseFileName','$databaseFileName2','$databaseFileName3','$slug','$category','$subCategory','$brand','$quantity','$price','$status','$seller')");

                            if($ins == true){

                                $this->suc = "Product added successfully";

                            }else{

                                $this->err = "Product could not be added".$this->db->link->error;

                            }

                        }else{

                            $this->err = "File can not move";

                            echo "<script>console.log('azad')</script>";

                        }

                    }else{

                        $this->err = "Please select image with (." . implode(', .',$validext).")";

                    }

                }

            }

        }





        public function checkName($name)

        {

            $check = $this->db->checkexist("SELECT * FROM `product` WHERE `name`='$name'");

            if($check == true){

                return true;

            }elseif($check == false){

                return false;

            }

        }





        public function deleteProduct($id)

        {

            $selpro = $this->db->selectSingle("SELECT * FROM `product` WHERE `id`='$id'");

            $img = $selpro['image'];

            $img2 = $selpro['image2'];

            $img3 = $selpro['image3'];

            

            if(file_exists($this->dir.$img)){

                unlink($this->dir.$img);

            }

            if($img2 != 'default.jpg' ){

                if(file_exists($this->dir.$img2)){

                    unlink($this->dir.$img2);

                }

            }

            if($img3 != 'default.jpg'){

                if(file_exists($this->dir.$img3)){

                    unlink($this->dir.$img3);

                }

            }

            $delCat = $this->db->rnQuery("DELETE FROM `product` WHERE `id`='$id'");

            if($delCat == true){

                echo "<script>window.location.href='?deleted'</script>";

                

            }

        }





        public function updateStatus($id)

        {

            $sel = $this->db->selectSingle("SELECT * FROM `product` WHERE `id`='$id'");

            $status = $sel['status'];

            if($status == 1){

                $sts = '2';

            }elseif($status == 2){

                $sts = '1';

            }

            $upfeatured =  $this->db->rnQuery("UPDATE `product` SET `status`='$sts' WHERE `id`='$id'");

            if($upfeatured){

                echo "<script>window.location.href='?updated'</script>";

            }else{

                $this->err = "Could not updated";

            }

        }


        public function updateRollStatus($data)
        {
            $id     = $data['id'];
            $status = $data['status'];
            if($status == 1){
                $status = 0;
            }elseif($status == 0){
                $status = 1;
            }
            $action = $data['action'];
            if($action == 'latest'){
                $query = "UPDATE `product` SET `latest`='$status' WHERE `id`='$id'";
            }elseif($action == 'deal'){
                $query = "UPDATE `product` SET `deal`='$status' WHERE `id`='$id'";
            }
            $run = $this->db->rnQuery($query);
            if($run == true){
                return 1;
            }
        }


        public function updateProduct($data)

        {

            $id = $data['id'];
            $name = $this->db->convert($data['pname']);
            $discount = $data['discount'];
            $description = $this->db->convert(trim($data['prddesc']));
            $category = $data['category'];
            $quantity = $data['quantity'];
            $price = $data['price'];
            $subCategory = $data['subCategory'];
            $brand = $data['brand'];
            $validext = array('jpg','png','jpeg');
            if(empty($name) || empty($description) || empty($category) || empty($price)|| empty($brand)){
                return $this->err = "Filds are required";
                exit();
            }else{
                $databaseFileName = $data['old'];
                if(isset($_FILES['prdimage'])){
                    $image = $_FILES['prdimage'];
                    $image_name = $image['name'];
                    if(!empty($image_name)){
                        $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                        if(in_array($ext, $validext)){

                            if($databaseFileName!='deafult.jpg'){

                                if(file_exists($this->dir.$databaseFileName)){

                                    unlink($this->dir.$databaseFileName);  

                                }

                            }

                            $tmp = $image['tmp_name'];

                            $databaseFileName = "Product_".rand(1001,99999).time().".".$ext;

                            $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);

                        }else{

                            $this->err = "Select valid image with(.". implode(', .',$validext);

                        }

                    }

                }

                $databaseFileName2=$data['old2'];

                $databaseFileName3=$data['old3'];

                if(isset($_FILES['prdimage2'])){

                    $image2 = $_FILES['prdimage2'];

                    $image_name2 = $image2['name'];

                    if(!empty($image_name2)){

                        $ext2 = strtolower(pathinfo($image_name2,PATHINFO_EXTENSION));

                        $tmp2 = $image2['tmp_name'];

                        if(in_array($ext2, $validext)){

                            if($databaseFileName2!='default.jpg'){

                                if(file_exists($this->dir.$databaseFileName2)){

                                    unlink($this->dir.$databaseFileName2);

                                }

                            }

                            $databaseFileName2 = "Product_".rand(1001,99999).time().".".$ext2;

                            $mvf2 = move_uploaded_file($tmp2,$this->dir.$databaseFileName2);

                        }else{

                            $this->err = "Please select image with (." . implode(', .',$validext).")";

                        }

                        

                    }

                }

                if(isset($_FILES['prdimage3'])){

                    $image3 = $_FILES['prdimage3'];

                    $image_name3 = $image3['name'];

                    if(!empty($image_name3)){

                        $ext3 = strtolower(pathinfo($image_name3,PATHINFO_EXTENSION));

                        $tmp3 = $image3['tmp_name'];

                        if(in_array($ext3, $validext)){

                            if($databaseFileName3!='default.jpg'){

                                if(file_exists($this->dir.$databaseFileName3)){

                                    unlink($this->dir.$databaseFileName3);

                                }

                            }

                            $databaseFileName3 = "Product_".rand(1001,99999).time().".".$ext3;

                            $mvf3 = move_uploaded_file($tmp3,$this->dir.$databaseFileName3);

                        }else{

                            $this->err = "Please select image with (." . implode(', .',$validext).")";

                        }

                        

                    }

                }

                $slug = str_replace(' ','-',strtolower($name));

                $ins = $this->db->rnQuery("UPDATE `product` SET `name`='$name',`pro_desc`='$description',`image`='$databaseFileName',`image2`='$databaseFileName2',`image3`='$databaseFileName3',`slug`='$slug',`category`='$category',`brand`='$brand',`quantity`='$quantity',`price`='$price',`discount`='$discount',`subCategory`='$subCategory' WHERE `id`='$id'");

                if($ins == true){

                    $this->suc = "Product Saved successfully";

                }else{

                    $this->err = "Product could not be saved";

                }

            }

        }



        

        public function addclassified($data)

        {

            $validext = array('jpg','png','jpeg');

            $seler = $data['seler'];

            $name = $data['name'];

            $status = $data['status'];

            $description = $data['description'];

            $price = $data['price'];

            $category = $data['category'];

            $databaseFileName2='default.jpg';

            $databaseFileName3='default.jpg';

            if(empty($name) || empty($description) || empty($price) || !isset($_FILES['image']) || empty($status)){

                return $this->err = "Filds are required";

            }else{

                $chckname = $this->checkproName($name);

                if( $chckname== true){

                    $this->err = "Name already exist";

                }elseif($chckname == false){

                    $image = $_FILES['image'];

                    $image_name = $image['name'];

                    $tmp = $image['tmp_name'];

                    $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                    if(!empty($image_name)){

                        $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                        $databaseFileName = "Product_".rand(1001,99999).time().".".$ext;

                        if(in_array($ext, $validext)){

                            if(file_exists($this->dir.$databaseFileName)){

                                unlink($this->dir.$databaseFileName);  

                            }

                            $tmp = $image['tmp_name'];

                            $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);

                            if($mvf == true){

                                if(isset($_FILES['image2'])){

                                    $image2 = $_FILES['image2'];

                                    $image_name2 = $image2['name'];

                                    if(!empty($image_name2)){

                                        $ext2 = strtolower(pathinfo($image_name2,PATHINFO_EXTENSION));

                                        $tmp2 = $image2['tmp_name'];

                                        $databaseFileName2 = "Product_".rand(1001,99999).time().".".$ext2;

                                        if(in_array($ext, $validext)){

                                            $mvf2 = move_uploaded_file($tmp2,$this->dir.$databaseFileName2);

                                        }else{

                                            $this->err = "Please select image with (." . implode(', .',$validext).")";

                                        }

                                        

                                    }

                                }

                                if(isset($_FILES['image3'])){

                                    $image3 = $_FILES['image3'];

                                    $image_name3 = $image3['name'];

                                    if(!empty($image_name3)){

                                        $ext3 = strtolower(pathinfo($image_name3,PATHINFO_EXTENSION));

                                        $tmp3 = $image3['tmp_name'];

                                        $databaseFileName3 = "Product_".rand(1001,99999).time().".".$ext3;

                                        if(in_array($ext, $validext)){

                                            $mvf3 = move_uploaded_file($tmp3,$this->dir.$databaseFileName3);

                                        }else{

                                            $this->err = "Please select image with (." . implode(', .',$validext).")";

                                        }

                                        

                                    }

                                }

                                $slug = str_replace(' ','-',strtolower($name));

                                $ins = $this->db->rnQuery("INSERT INTO `classicproduct`(`name`, `image`, `image2`, `image3`, `description`, `category`, `seller`, `price`, `status`, `slug`) VALUES ('$name','$databaseFileName','$databaseFileName2','$databaseFileName3','$description','$category','$seler','$price','$status','$slug')");

                                if($ins == true){

                                    $this->suc = "Product added successfully";

                                }else{

                                    $this->err = "Product could not be added".$this->db->link->error;

                                }

                            }else{

                                return $this->err = "File can not move";

                            }

                        }else{

                            $this->err = "Select valid image with(.". implode(', .',$validext);

                        }

                    }

                }

            }



        }

        

        

        

        public function checkproName($name){

            $check = $this->db->checkexist("SELECT * FROM `classicproduct` WHERE `name`='$name'");

            return $check;

        }





        public function classifiedStatus($id)

        {

            $sel = $this->db->selectSingle("SELECT * FROM `classicproduct` WHERE `id`='$id'");

            $status = $sel['status'];

            if($status == 1){

                $sts = '2';

            }elseif($status == 2){

                $sts = '1';

            }

            $upfeatured =  $this->db->rnQuery("UPDATE `classicproduct` SET `status`='$sts' WHERE `id`='$id'");

            if($upfeatured){

                echo "<script>window.location.href='?updated'</script>";

            }else{

                $this->err = "Could not updated";

            }

        }







        public function deletClassifiedeProduct($id)

        {

            $selpro = $this->db->selectSingle("SELECT * FROM `classicproduct` WHERE `id`='$id'");

            $img = $selpro['image'];

            $img2 = $selpro['image2'];

            $img3 = $selpro['image3'];

            

            if(file_exists($this->dir.$img)){

                unlink($this->dir.$img);

            }

            if($img2 != 'default.jpg' ){

                if(file_exists($this->dir.$img2)){

                    unlink($this->dir.$img2);

                }

            }

            if($img3 != 'default.jpg'){

                if(file_exists($this->dir.$img3)){

                    unlink($this->dir.$img3);

                }

            }

            $delCat = $this->db->rnQuery("DELETE FROM `classicproduct` WHERE `id`='$id'");

            if($delCat == true){

                echo "<script>window.location.href='?deleted'</script>";

                

            }

        }







        public function updateClassifiedProduct($data)

        {

            $id = $data['id'];

            $name = $data['name'];

            $description = $data['description'];

            $category = $data['category'];

            $price = $data['price'];

            $category = $data['category'];

            $validext = array('jpg','png','jpeg');

            if(empty($name) || empty($description) || empty($category) || empty($price) || !isset($data['status']) ){

                return $this->err = "Fild is required";

                exit();

            }else{

                $status = $data['status'];

                $databaseFileName = $data['old'];

                if(isset($_FILES['image'])){

                    $image = $_FILES['image'];

                    $image_name = $image['name'];

                    if(!empty($image_name)){

                        $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                        if(in_array($ext, $validext)){

                            if(file_exists($this->dir.$databaseFileName)){

                                unlink($this->dir.$databaseFileName);  

                            }

                            $tmp = $image['tmp_name'];

                            $databaseFileName = "Product_".rand(1001,99999).time().".".$ext;

                            $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);

                        }else{

                            $this->err = "Select valid image with(.". implode(', .',$validext);

                        }

                    }

                }

                $databaseFileName2=$data['old2'];

                $databaseFileName3=$data['old3'];

                if(isset($_FILES['image2'])){

                    $image2 = $_FILES['image2'];

                    $image_name2 = $image2['name'];

                    if(!empty($image_name2)){

                        $ext2 = strtolower(pathinfo($image_name2,PATHINFO_EXTENSION));

                        $tmp2 = $image2['tmp_name'];

                        if(in_array($ext2, $validext)){

                            if(file_exists($this->dir.$databaseFileName2)){

                                unlink($this->dir.$databaseFileName2);

                            }

                            $databaseFileName2 = "Product_".rand(1001,99999).time().".".$ext2;

                            $mvf2 = move_uploaded_file($tmp2,$this->dir.$databaseFileName2);

                        }else{

                            $this->err = "Please select image with (." . implode(', .',$validext).")";

                        }

                        

                    }

                }

                if(isset($_FILES['image3'])){

                    $image3 = $_FILES['image3'];

                    $image_name3 = $image3['name'];

                    if(!empty($image_name3)){

                        $ext3 = strtolower(pathinfo($image_name3,PATHINFO_EXTENSION));

                        $tmp3 = $image3['tmp_name'];

                        if(in_array($ext3, $validext)){

                            if(file_exists($this->dir.$databaseFileName3)){

                                unlink($this->dir.$databaseFileName3);

                            }

                            $databaseFileName3 = "Product_".rand(1001,99999).time().".".$ext3;

                            $mvf3 = move_uploaded_file($tmp3,$this->dir.$databaseFileName3);

                        }else{

                            $this->err = "Please select image with (." . implode(', .',$validext).")";

                        }
                    }
                }

                $slug = str_replace(' ','-',strtolower($name));

                $ins = $this->db->rnQuery("UPDATE `classicproduct` SET `name`='$name',`image`='$databaseFileName',`image2`='$databaseFileName2',`image3`='$databaseFileName3',`description`='$description',`category`='$category',`price`='$price',`status`='$status',`slug`='$slug' WHERE `id`='$id'");

                if($ins == true){

                    $this->suc = "Product Saved successfully";

                    return;

                }else{

                    $this->err = "Product could not be saved";

                }

            }

        }
    }



?>