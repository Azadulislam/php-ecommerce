<?php
    namespace classes;

    class Admin{
        public $err;
        public $suc;
        public $db;

        function __construct(){
            $this->db = new Database;
            $this->dir = "../uploads/";
        }

        public function update($data)
        {
            $name = $data['adminName'];
            $phn = $data['phn'];
            $email = $data['email'];
            $fileName = $data['oldPic'];
            $address = $data['address'];
            $validExt = array('jpg','png','jpeg');
            $id = $data['id'];
            if(!empty($name) && !empty($phn) && !empty($email) && !empty($address)){
                if($_FILES['profilePic']){
                    $file = $_FILES['profilePic'];
                    $fname = $file['name'];
                    $tmp = $file['tmp_name'];
                    if(!empty($fname)){
                        $ext = strtolower(pathinfo($fname,PATHINFO_EXTENSION));
                        if(in_array($ext,$validExt)){
                            if($fileName != 'profile.png'){
                                if(file_exists($this->dir.$fileName)){
                                    unlink($this->dir.$fileName);
                                }
                            }
                            $fileName = "admin_".time().rand(1001,99999).'.'.$ext;
                            move_uploaded_file($tmp,$this->dir.$fileName);
                        }
                    }
                }
                $update = $this->db->rnQuery("UPDATE `admin` SET `name`='$name',`image`='$fileName',`email`='$email',`address`='$address',`phn`='$phn' WHERE `id`='$id'");
                if($update == true){
                    $this->suc = "Data updated successfully";
                    header('location: manage_profile.php');
                }else{
                    $this->err = "Data could not updated!";
                }
            }else{
                $this->err = "Fildes are required";
            }
        }

        public function cahangPwd($data)
        {
            $old = $data['oldpass'];
            $id = $data['id'];
            $new = $data['newPass'];
            $confirm = $data['confPass'];
            if(empty($old) && empty($new)){
                $this->err = "Fildes are required";
            }else{
                $sel = $this->db->selectSingle("SELECT * FROM `admin` WHERE `id`='$id'");
                $dbpass = $sel['pass'];
                if($dbpass == $old){
                    if($new == $confirm){
                        $update = $this->db->rnQuery("UPDATE `admin` SET `pass`='$new' WHERE `id`='$id'");
                        if($update == true){
                            $this->suc = "Password saved success";
                        }else{
                            $this->err = "Password could not be changed";
                        }
                    }else{
                        $this->err = "Confirm password did not matched!";
                    }
                }else{
                    $this->err = "Old password did not mathed!";
                }
            }
        }


        public function login($data)
        {
            $username = $data['username'];
            $password = $data['password'];
            if(empty($username) || empty($password)){
                return $this->err ="Fields are required";
            }else{
                $select = $this->db->rnQuery("SELECT * FROM `admin` WHERE `name`='$username' AND `pass`='$password'");
                $admin = mysqli_fetch_assoc($select);
                if($select== false){
                    $this->err = $this->db->link->error;
                }else{
                    if(mysqli_num_rows($select)==1){
                        if($admin['name']==$username && $admin['pass']==$password){
                            return 1;
                        }else{
                            return $this->err = "Wrong info please enter correcta info and try again";
                        }
                    }else{
                        return $this->err = "Wrong info please enter correct info and try again";
                    }
                }
            }
        }




    }

?>