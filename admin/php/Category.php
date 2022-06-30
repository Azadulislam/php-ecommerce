<?php
    namespace classes;

    class Category{
        public $err;
        public $succ;
        public $result;
        public $db;
        public $dir;
        
        function __construct(){
            $this->db = new Database;
            $this->dir = "../uploads/";
        }
        public function addcategory($data){
            $name = $this->db->convert($data['catname']);
            $status = $data['cat_status'];
            $slg = str_replace(' ','-',strtolower($name));
            $chname = $this->checkName($name);
            $file = $_FILES['catbanner'];
            $fileN = $file['name'];
            $tmp = $file['tmp_name'];
            $ext = pathinfo($fileN,PATHINFO_EXTENSION);
            $upfname = "category_".time().rand(1001,99999).'.'.$ext;
            $validExt = array('jpg','png','jpeg');

            if(!in_array($ext,$validExt)){
                $this->err = 'Select an image with(.'.imploge(', .',$validExt);
            }else{
                if($chname == true){
                    $this->err = 'Name already exist!';
                    return  $this->err;
                }else{
                    $mv = move_uploaded_file($tmp, $this->dir.$upfname);
                    if($mv == true){
                        $addcat = $this->db->rnQuery("INSERT INTO `category`(`name`,`banner`,`slug`, `status`) VALUES ('$name','$upfname','$slg','$status')");
                        if($addcat == true){
                            $this->succ = 'Category inserted successfully!';
                            //echo "<script>window.location.href='category.php?success'</script>";
                            return true;
                        }else{
                            $this->err = 'Category could not be inserted!';
                        }
                    }else{
                        $this->err = "File can not moved";
                        return false;
                    }
                }
            }
        }

        public function checkName($name)
        {
            $check = $this->db->checkexist("SELECT * FROM `category` WHERE `name`='$name'");
            if($check == true){
                return true;
            }elseif($check == false){
                return false;
            }
        }


        public function updateCategory($data){
            $id = $data['id'];
            $name = $this->db->convert($data['catname']);
            $status = $data['cat_status'];
            $upfname = $data['oldben'];
            $slg = $this->db->convert(str_replace(' ','-',strtolower($name)));
            $chname = $this->checkName($name);
            $file = $_FILES['catbanner'];
            $fileN = $file['name'];

            if(!empty($fileN)){
                $validExt = array('jpg','png','jpeg');
                $tmp = $file['tmp_name'];
                $ext = pathinfo($fileN,PATHINFO_EXTENSION);
                if(file_exists($this->dir.$upfname)){
                    unlink($this->dir.$upfname);
                }
                if(!in_array($ext,$validExt)){
                    $this->err = 'Image is not valid'.$ext;
                }else{
                    $arry = explode(".",$fileN);
                    $upfname = "shoping_".time().rand(1001,99999).'.'.$ext;
                    $mv = move_uploaded_file($tmp, $this->dir.$upfname);
                }
            }
            if(!empty($name) && !empty($status)){
                $addcat = $this->db->rnQuery("UPDATE `category` SET `name`='$name',`banner`='$upfname',`slug`='$slg',`status`='$status' WHERE `id`='$id'");
                if($addcat == true){
                    $this->succ = 'Category Updated successfully!';
                    echo "<script>window.location.href='edit_category.php?edit=$id&success'</script>";
                    return true;
                }else{
                    $this->err = 'Category could not be Updated!';
                    return false;
                }
            }else{
                $this->err = "Want wrong";
                return false;
            }
        }

        

        public function deleteCategory($id)
        {
            $sel = $this->db->selectSingle("SELECT * FROM `category` WHERE `id`='$id'");
            if($sel == false){
                $this->err = "Wrong info";
            }else{
                $image = $sel['banner'];
                if(file_exists($this->dir.$image)){
                    $delf = unlink($this->dir.$image);
                }
                $delCat = $this->db->rnQuery("DELETE FROM `category` WHERE `id`='$id'");
                if($delCat == true){
                    $this->err = "Data delete successfull";
                    echo "<script>window.location.href='category.php?deleted'</script>";
                }
            }
        }

        
        public function addSubCategory($data)
        {
            $name = $this->db->convert($data['catname']);
            $status = $data['cat_status'];
            $cat = $data['cat'];
            $slg = str_replace(' ','-',strtolower($name));
            $chname = $this->checkSubName($name);
            $file = $_FILES['catbanner'];
            $fileN = $file['name'];
            $tmp = $file['tmp_name'];
            $ext = pathinfo($fileN,PATHINFO_EXTENSION);
            //$arry = explode(".",$fileN);
            $upfname = "sub-category_".time().rand(1001,99999).'.'.$ext;
            $validExt = array('jpg','png','jpeg');

            if(empty($name) || empty($status)){
                $this->err = 'Filde is required';
            }else{
                if(!in_array($ext,$validExt)){
                    $this->err = 'Image is not valid ';
                }else{
                    if($chname == true){
                        $this->err = 'Name already exist!';
                        return  $this->err;
                    }else{
                        $sCat = $this->db->selectSingle("SELECT * FROM `category` WHERE `id`='$cat'");
                        $csCat = $sCat['sub_cat'];
                        $upsCat = $csCat+1;
                        $addcat = $this->db->rnQuery("INSERT INTO `sub_category`(`name`, `banner`, `status`, `cat`,`slug`) VALUES ('$name','$upfname','$status','$cat','$slg')");
                        if($addcat == true){
                            $upca = $this->db->rnQuery("UPDATE `category` SET `sub_cat`='$upsCat' WHERE `id`='$cat'");
                            $mv = move_uploaded_file($tmp, $this->dir.$upfname);
                            if($mv == true){
                                $this->succ = 'Sub Category inserted successfully!';
                                return true;
                                }else{
                                    $this->err = "File can not moved";
                                    return false;
                                }
                            }else{
                                $this->err = 'Sub Category could not be inserted!';
                                return false;
                            }
                        }
                }
            }
        }

        public function checkSubName($name)
        {
            $check = $this->db->checkexist("SELECT * FROM `sub_category` WHERE `name`='$name'");
            if($check == true){
                return true;
            }elseif($check == false){
                return false;
            }
        }


        public function updateSubCategory($data){
            $id = $data['id'];
            $name = $this->db->convert($data['catname']);
            $cat = $data['cat'];
            $status = $data['cat_status'];
            $upfname = $data['oldben'];
            $slg = str_replace(' ','-',strtolower($name));
            $chname = $this->checkName($name);
            $file = $_FILES['catbanner'];
            $fileN = $file['name'];

            if(!empty($fileN)){
                $validExt = array('jpg','png','jpeg');
                $ext = pathinfo($fileN,PATHINFO_EXTENSION);
                $tmp = $file['tmp_name'];
                if(file_exists($this->dir.$upfname)){
                    unlink($this->dir.$upfname);
                }
                if(!in_array($ext,$validExt)){
                    $this->err = 'Image is not valid';
                }else{
                    $arry = explode(".",$fileN);
                    $upfname = "sub-category_".time().rand(1001,99999).'.'.$ext;
                    $mv = move_uploaded_file($tmp, $this->dir.$upfname);
                }
            }
            if(!empty($name) && !empty($status) && !empty($cat)){
                $addcat = $this->db->rnQuery("UPDATE `sub_category` SET `name`='$name',`banner`='$upfname',`status`='$status',`slug`='$slg',`cat`='$cat' WHERE `id`='$id'");
                if($addcat == true){
                    $this->succ = 'Sub Category Updated successfully!';
                    echo "<script>window.location.href='edit-subcat.php?edit=$id&success'</script>";
                    return true;
                }else{
                    $this->err = 'Sub Category could not be Updated!';
                    return false;
                }
            }else{
                $this->err = "Want wrong";
                return false;
            }
        }

        public function deleteSubCategory($id)
        {
            $sel = $this->db->selectSingle("SELECT * FROM `sub_category` WHERE `id`='$id'");
            if($sel == false){
                $this->err = "Sub Category could not be deleted!";
            }else{
                $image = $sel['banner'];
                $cat = $sel['cat'];
                $selcat = $this->db->selectSingle("SELECT * FROM `category` WHERE `id`='$cat'");
                $coun_sub = $selcat['sub_cat'];
                $upsCat = $coun_sub-1;
                if(file_exists($this->dir.$image)){
                    $delf = unlink($this->dir.$image);
                }
                $delCat = $this->db->rnQuery("DELETE FROM `sub_category` WHERE `id`='$id'");
                if($delCat == true){
                    $upca = $this->db->rnQuery("UPDATE `category` SET `sub_cat`='$upsCat' WHERE `id`='$cat'");
                    $this->err = "Data delete successfull";
                    //echo "<script>window.location.href='sub-category.php?deleted'</script>";
                }
            }
        }


    }

?>
