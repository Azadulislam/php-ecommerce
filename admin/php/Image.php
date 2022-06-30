<?php

    namespace classes;



    class Image{

        public $err;

        public $suc;

        public $db;
        public $control;

        public $dir = "../uploads/";

        public function __construct($db) {

            $this->db      = $db;
            $this->control = new Control($db);
        }

        public function update($data)

        {

            $validext     = array('jpg','png','jpeg');

            $adminBgName  = $data['old_adminbg'];

            $vendorBgName = $data['old_vendorbg'];

            $blogBgName   = $data['old_blogbg'];

            if(isset($_FILES['adminbg'])){

                $image      = $_FILES['adminbg'];

                $image_name = $image['name'];

                if(!empty($image_name)){

                    $ext        = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
                    $tmp        = $image['tmp_name'];
                    $fsize        = $image['size'];
                    $imagSzInfo = getimagesize($tmp);
                    $width      = $imagSzInfo['0'];
                    $height     = $imagSzInfo['1'];
                    if($width != 345 || $height != 164 ){
                        $this->err = "Please select image Size (345x164) ";
                        return;
                        exit();
                    }

                    if(in_array($ext, $validext)){
                        if($adminBgName != 'default.jpg'){
                            if(file_exists($this->dir.$adminBgName)){
                                unlink($this->dir.$adminBgName);
                            }

                        }
                        $adminBgName = "adminbg_".rand(1001,99999).time().".".$ext;
                        $path = $this->dir.$adminBgName;
                        //$mvf = move_uploaded_file($tmp,$this->dir.$adminBgName);
                        $compressMove = $this->control->compressImage($tmp,$fsize,$path);

                    }else{

                        $this->err = "Please select image with (." . implode(', .',$validext).")";

                    }

                    

                }

            }

            if(isset($_FILES['venodrbg'])){

                $image      = $_FILES['venodrbg'];
                $image_name = $image['name'];

                if(!empty($image_name)){

                    $ext   = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
                    $tmp   = $image['tmp_name'];
                    $fsize = $image['size'];
                    $imagSzInfo = getimagesize($tmp);
                    $width      = $imagSzInfo['0'];
                    $height     = $imagSzInfo['1'];
                    if($width < 1920 || $height < 1080 ){
                        $this->err = "Please select image Size lerger (1920x1080) ";
                        return;
                        exit();
                    }
                    if(in_array($ext, $validext)){

                        if($vendorBgName != 'default.jpg'){

                            if(file_exists($this->dir.$vendorBgName)){

                                unlink($this->dir.$vendorBgName);

                            }

                        }

                        $vendorBgName = "vendorbg_".rand(1001,99999).time().".".$ext;

                        //$mvf = move_uploaded_file($tmp,$this->dir.$vendorBgName);
                        $path = $this->dir.$vendorBgName;
                        $compressMove = $this->control->compressImage($tmp,$fsize,$path);

                    }else{

                        $this->err = "Please select image with (." . implode(', .',$validext).")";

                    }

                    

                }

            }

            if(isset($_FILES['blogbg'])){

                $image = $_FILES['blogbg'];

                $image_name = $image['name'];

                if(!empty($image_name)){

                    $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                    $tmp = $image['tmp_name'];
                    $fsize = $image['size'];
                    $imagSzInfo = getimagesize($tmp);
                    $width      = $imagSzInfo['0'];
                    $height     = $imagSzInfo['1'];
                    if($width < 1366 || $height < 768 ){
                        $this->err = "Please select image Size lerger (1366x768) ";
                        return;
                        exit();
                    }
                    if(in_array($ext, $validext)){

                        if($blogBgName != 'default.jpg'){

                            if(file_exists($this->dir.$blogBgName)){

                                unlink($this->dir.$blogBgName);

                            }

                        }

                        $blogBgName = "blogbg_".rand(1001,99999).time().".".$ext;
                        //$mvf = move_uploaded_file($tmp,$this->dir.$blogBgName);
                        $path = $this->dir.$blogBgName;
                        $compressMove = $this->control->compressImage($tmp,$fsize,$path);

                    }else{

                        $this->err = "Please select image with (." . implode(', .',$validext).")";

                    }

                    

                }

            }

            if($compressMove == 1){
                $select = $this->db->rnQuery("SELECT * FROM `images`");
                if(mysqli_num_rows($select) == 1){
                    $item = mysqli_fetch_assoc($select);
                    $id = $item['id'];
                    $up = $this->db->rnQuery("UPDATE `images` SET `admin_bg`='$adminBgName',`vendor_bg`='$vendorBgName',`blog_bg`='$blogBgName' WHERE `id`='$id'");
                }else{
                    $up = $this->db->rnQuery("INSERT INTO `images`(`admin_bg`,`vendor_bg`,`blog_bg`) VALUES('$adminBgName','$vendorBgName','$blogBgName')");
                }

                if($up == true){

                    $this->suc = "Updated succsefully";

                }else{

                    $this->err = "Could not be Updated";

                }

            }

        }

        public function addSlider($data)

        {

            $validext  = array('jpg','png','jpeg');

            if(isset($_FILES['slider'])){

                $image      = $_FILES['slider'];

                $image_name = $image['name'];

                if(!empty($image_name)){

                    $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                    $tmp        = $image['tmp_name'];
                    $imagSzInfo = getimagesize($tmp);
                    $width = $imagSzInfo['0'];
                    $height = $imagSzInfo['1'];
                    if($width < 840 || $height < 486 ){
                        $this->err = "Please select image Size lerger than (840x486) ";
                        return;
                        exit();
                    }elseif($width > 1920|| $height < 1080 ){
                        $this->err = "Please select image Size smaller than(1920x1080)";
                        return;
                        exit();
                    }

                    if(in_array($ext, $validext)){

                        $fileName = "slider_".rand(1001,99999).time().".".$ext;

                        $fsize = $image['size'];
                        
                        $path = $this->dir.$fileName;
                        
                        //$mvf = move_uploaded_file($tmp,$this->dir.$fileName);
                        $compressMove = $this->control->compressImage($tmp,$fsize,$path);

                        $ins =  $this->db->rnQuery("INSERT INTO `slider`(`image`) VALUES ('$fileName')");

                        if($ins == true){

                            $this->suc = "Added succsefully";

                        }else{

                            $this->err = "Could not be added";

                        }

                    }else{

                        $this->err = "Please select image with (." . implode(', .',$validext).")";

                    }

                    

                }else{

                    $this->err = "Field is required";

                }

            }else{

                $this->err = "Field is required";

            }

        }

        public function updateSlider($data)

        {

            $id = $data['id'];

            $fileName = $data['old_slider'];

            $validext  = array('jpg','png','jpeg');

            if(isset($_FILES['slider'])){

                $image = $_FILES['slider'];

                $image_name = $image['name'];

                if(!empty($image_name)){

                    $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));

                    $tmp = $image['tmp_name'];
                    $imagSzInfo = getimagesize($tmp);
                    $width = $imagSzInfo['0'];
                    $height = $imagSzInfo['1'];
                    if($width < 840 || $height < 486 ){
                        $this->err = "Please select image Size lerger than (840x486) ";
                        return;
                        exit();
                    }elseif($width > 1920|| $height > 1080 ){
                        $this->err = "Please select image Size smaller than(1920x1080)";
                        return;
                        exit();
                    }


                    if(in_array($ext, $validext)){

                        if($fileName != 'default.jpg'){

                            if(file_exists($this->dir.$fileName)){

                                unlink($this->dir.$fileName);

                            }

                        }
                        
                        $fileName = "slider_".rand(1001,99999).time().".".$ext;
                        $fsize = $image['size'];
                        $path = $this->dir.$fileName;
                        
                        //$mvf = move_uploaded_file($tmp,$this->dir.$fileName);
                        $compressMove = $this->control->compressImage($tmp,$fsize,$path);
                        $up = $this->db->rnQuery("UPDATE `slider` SET `image`='$fileName' WHERE `id`='$id'");

                        if($up == true){

                            $this->suc = "Updated sccessfully";

                        }

                    }else{

                        $this->err = "Please select image with (." . implode(', .',$validext).")";

                    }

                    

                }else{

                    $this->err = "No Cahages to save";

                }

            }

        }

        public function delete($data)

        {

            $id = $data['id'];

            $old_slider = $data['old_slider'];

            

            if(file_exists($this->dir.$old_slider)){

                unlink($this->dir.$old_slider);

            }

            $delCat = $this->db->rnQuery("DELETE FROM `slider` WHERE `id`='$id'");

            if($delCat == true){

                echo "<script>window.location.href='?deleted'</script>";

                

            }

        }

        

    }

?>