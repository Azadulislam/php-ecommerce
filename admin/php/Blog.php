<?php
    namespace classes;
    class Blog{
        public $dir;
        public $err;
        public $suc;
        public $db;

        public function __construct()
        {
            $this->db = new Database;
            $this->dir = "../uploads/";

        }
        public function addBlog($data)
        {
            $validext  = array('jpg','png','jpeg');
            $title = $this->db->convert($data['title']);
            $descr = $data['description'];
            $bloger = $data['bloger'];
            $category = $data['category'];
            if(empty($title) || empty($descr) || empty($bloger) || !isset($_FILES['image']) || !isset($data['status']) || empty($category)){
                return $this->err = "Filds are required";
            }else{
                $status = $data['status'];
                $image = $_FILES['image'];
                $image_name = $image['name'];
                $ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
                $databaseFileName = "blog_".rand(1001,99999).time().".".$ext;
                $tmp = $image['tmp_name'];
                if($this->checktitle($title) == true){
                    $this->err = "Title already Exist";
                }else{
                    if(in_array($ext , $validext)){
                        $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);
                        if($mvf == true){
                            $slug = str_replace(' ','-',strtolower($title));
                            $ins = $this->db->rnQuery("INSERT INTO `blogs`(`title`, `image`, `description`, `slug`,`category`, `status`, `bloger`) VALUES ('$title','$databaseFileName','$descr','$slug','$category','$status','$bloger')");
                            if($ins == true){
                                $this->suc = "Blogs added successfully";
                            }else{
                                $this->err = "Blogs could not be added";
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


        public function checktitle($title)
        {
            $check = $this->db->checkexist("SELECT * FROM `blogs` WHERE `title`='$title'");
            if($check == true){
                return true;
            }elseif($check == false){
                return false;
            }
        }


        public function deleteProduct($id)
        {
            $selpro = $this->db->selectSingle("SELECT * FROM `blogs` WHERE `id`='$id'");
            $img = $selpro['image'];
            
            if(file_exists($this->dir.$img)){
                unlink($this->dir.$img);
            }
            $delCat = $this->db->rnQuery("DELETE FROM `blogs` WHERE `id`='$id'");
            if($delCat == true){
                echo "<script>window.location.href='?deleted'</script>";
                
            }
        }


        public function updateStatus($id)
        {
            $sel = $this->db->selectSingle("SELECT * FROM `blogs` WHERE `id`='$id'");
            $status = $sel['status'];
            if($status == 1){
                $sts = '2';
            }elseif($status == 2){
                $sts = '1';
            }
            $update =  $this->db->rnQuery("UPDATE `blogs` SET `status`='$sts' WHERE `id`='$id'");

            if($update){
                return 1;
            }else{
                $this->err = "Could not updated";
            }
        }


        public function blogStatus($data)
        {
            $id = $data['id'];
            $status = $data['status'];
            if($status == 1){
                $sts = '2';
            }elseif($status == 2){
                $sts = '1';
            }
            $update =  $this->db->updateData('blogs','status',$sts,$id);

            if($update){
                header('location:'.$_SERVER['PHP_SELF']);
            }else{
                $this->err = "Could not updated";
            }
        }


        public function update($data)
        {
            $validext = array('jpg','png','jpeg');
            $id = $data['id'];
            $title =$this->db->convert( $data['title']);
            $description = trim($data['description']);
            $category = $data['category'];
            if(empty($title) || empty($description) || empty($id) || !isset($data['status']) || empty($category)){
                return $this->err = "Fields are required";
            }else{
                $databaseFileName = $data['old'];
                $status = $data['status'];
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
                            $databaseFileName = "blog_".rand(1001,99999).time().".".$ext;
                            $mvf = move_uploaded_file($tmp,$this->dir.$databaseFileName);
                        }else{
                            $this->err = "Selet valid image with(.". implode(', .',$validext);
                        }
                    }
                }
                $slug = str_replace(' ','-',strtolower($title));
                $ins = $this->db->rnQuery("UPDATE `blogs` SET `title`='$title',`image`='$databaseFileName',`description`='$description',`slug`='$slug',`category`='$category',`status`='$status' WHERE `id`='$id'");
                if($ins == true){
                    $this->suc = "Blog Saved successfully";
                }else{
                    $this->err = "Blog could not be saved";
                }
            }
        }

        public function addCategory($data)
        {
            $name = $this->db->convert($data['catname']);
            if(empty($name) || !isset($data['cat_status'])){
                $this->err = "Fildes are Required";
            }else{
                $status = $data['cat_status'];
                $check = $this->db->checkexist("SELECT * FROM `blog_category` WHERE 'name'='$name'");
                if($check == true){
                    $this->err = "Name alredy Exist";
                }else{
                    $slug = str_replace(' ','-',strtolower($name));
                    $ins = $this->db->rnQuery("INSERT INTO `blog_category`(`name`, `slug`, `status`) VALUES ('$name','$slug','$status')");
                    if($ins == true){
                        $this->suc = "Category Added successful";
                    }else{
                        $this->err = "Category Could not be added";
                    }
                }
            }
        }

        public function categoryStatus($data)
        {
            $id = $data['status'];
            $cat = $this->db->selectSingle("SELECT * FROM `blog_category` WHERE `id`='$id'");
            $status = $cat['status'];
            if($status == 1){
                $sts = '2';
            }elseif($status == 2){
                $sts = '1';
                echo $sts;
            }
            $update =  $this->db->updateData('blog_category','status',$sts,$id);

            if($update){
                header('location: blog_category.php');
            }else{
                $this->err = "Could not updated";
            }
        }


        public function geteditabledata($data)
        {
            $id = $data['id'];
            $category = $this->db->getTableData('blog_category','id',$id);
            $res = mysqli_fetch_assoc($category);
            return $res;
        }




        public function deleteCategory($data)
        {
            $id = $data['delete'];
            $up = $this->db->delete('blog_category',$id);
            if($up == true){
                echo "<script>window.location.href='?deleted'</script>";
            }else{
                $this->err = "Could not Delted";
            }
        }


        public function updateCategory($data)
        {
            $id = $data['id'];
            $name = $this->db->convert($data['catname']);
            if(empty($name)){
                $this->err = "Fildes are required";
            }else{
                $slug = str_replace(' ','-',strtolower($name));
                $up = $this->db->rnQuery("UPDATE `blog_category` SET `name`='$name',`slug`='$slug' WHERE `id`='$id'");
                if($up == true){
                    $this->suc = "Updated successfully";
                }else{
                    $this->err = "Could not updated";
                }
            }
        }
    }

?>