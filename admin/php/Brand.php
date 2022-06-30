<?php  
    namespace classes;

    class Brand{
        public $err;
        public $suc;
        public $db;
        public $dir = "../uploads/";
        public function __construct($db) {
            $this->db = $db;
        }

        public function insert($data)
        {
            $validext  = array('jpg','png','jpeg');
            $name      = $data['name'];
            $user      = $data['user'];
            $category  = $data['category'];
            $sCategory = $data['Subcategory'];
            if(empty($name) || !isset($_FILES['logo']) || !isset($data['status']) || empty($category)){
                $this->err = "Fildes are required";
            }else{
                $logo   = $_FILES['logo'];
                $status = $data['status'];
                $image_name = $logo['name'];
                $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
                $databaseFileName = "brand_".rand(1001,99999).time().".".$ext;
                $tmp = $logo['tmp_name'];
                if($this->checkname($name) == true){
                    $this->err = "Name already Exist";
                }else{
                    if(in_array($ext , $validext)){
                        $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);
                        if($mvf == true){
                            $slug = str_replace(' ','-',strtolower($name));

                            $ins = $this->db->rnQuery("INSERT INTO `brands`(`name`,`logo`,`user`,`status`,`category`,`sCategory`) VALUES ('$name','$databaseFileName','$user','$status','$category','$sCategory')");
                            if($ins == true){
                                $this->suc = "Brand added successfully";
                            }else{
                                $this->err = "Brand could not be added";
                            }
                        }else{
                            $this->err = "File can not move";
                        }
                    }else{
                        $this->err = "Please select image with (." . implode(', .',$validext).")";
                    }
                }
                
            }
        }

        public function checkname($name)
        {
            $check = $this->db->checkexist("SELECT * FROM `brands` WHERE `name`='$name'");
            if($check == true){
                return true;
            }elseif($check == false){
                return false;
            }
        }


        public function updateStatus($data)
        {
            $id = $data['status'];
            $brand = $this->db->getSingle('brands','id',$id);
            $status = $brand['status'];
            if($status == 1){
                $sts = '2';
            }elseif($status == 2){
                $sts = '1';
            }
            $update =  $this->db->updateData('brands','status',$sts,$id);

            if($update){
                header('location:'.$_SERVER['PHP_SELF']);
            }else{
                $this->err = "Could not updated";
            }
        }


        public function update($data)
        {
            $validext = array('jpg','png','jpeg');
            $id       = $data['id'];
            $name     = $data['name'];
            $category = $data['category'];
            $sCategory = $data['Subcategory'];
            if(empty($name) || empty($id) || !isset($data['status']) || empty($category)){
                $this->err = "Filds are required";
            }else{
                $databaseFileName = $data['old'];
                $status = $data['status'];
                if(isset($_FILES['logo'])){
                    $image = $_FILES['logo'];
                    $image_name = $image['name'];
                    if(!empty($image_name)){
                        $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
                        if(in_array($ext, $validext)){
                            if(file_exists($this->dir.$databaseFileName)){
                                unlink($this->dir.$databaseFileName);  
                            }
                            $tmp = $image['tmp_name'];
                            $databaseFileName = "brands_".rand(1001,99999).time().".".$ext;
                            $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);
                        }else{
                            $this->err = "Selet valid image with(.". implode(', .',$validext);
                        }
                    }
                }
                $slug = str_replace(' ','-',strtolower($name));
                $ins = $this->db->rnQuery("UPDATE `brands` SET `name`='$name',`logo`='$databaseFileName',`slug`='$slug',`status`='$status',`category`='$category',`sCategory` = '$sCategory' WHERE `id`='$id'");
                if($ins == true){
                    $this->suc = "Brand Saved successfully";
                }else{
                    $this->err = "Brand could not be saved";
                }
            }
        }

        public function delete($data)
        {
            $id = $data['delete'];
            $selbrand = $this->db->getSingle('brands','id',$id);
            $img = $selbrand['image'];
            
            if(file_exists($this->dir.$img)){
                unlink($this->dir.$img);
            }
            $delete = $this->db->rnQuery("DELETE FROM `brands` WHERE `id`='$id'");
            if($delete == true){
                echo "<script>window.location.href='?deleted'</script>";
                
            }
        }



    }
?>