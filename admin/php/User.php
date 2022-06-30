<?php
    namespace classes;
    
    class User{
        public $err;
        public $succ;
        public $result;
        public $db;
        public $dir;
        public $lauth;

        function __construct(){
            $this->db = new Database;
            $this->dir = "../uploads/";
        }

        public function updateStatus($id)
        {
            $sel = $this->db->selectSingle("SELECT * FROM `user` WHERE `id`='$id'");
            $status = $sel['status'];
            $roll = $sel['roll'];
            if($status == '1'){
                $sts = '0';
            }elseif($status == '0'){
                $sts = '1';
            }
            $upStatus =  $this->db->rnQuery("UPDATE `user` SET `status`='$sts' WHERE `id`='$id'");

            if($upStatus){
                if($roll == 1){
                    header("location: ".URL."admin/customer.php");
                }else{
                    header("location: ".URL."admin/vendor.php");
                }
            }else{
                $this->err = "Could not updated";
            }
        }
        public function updateCustomer($data)
        {
            $fname = $data['fname'];
            $lname = $data['lname'];
            $filename = $data['oldpic'];
            $add1 = $data['add1'];
            $add2 = $data['add2'];
            $city = $data['city'];
            $phnum = $data['phnum'];
            $state = $data['state'];
            $cntry = $data['cntry'];
            $zip = $data['zip'];
            $id = $data['id'];
            if(!empty($fname) && !empty($lname) && !empty($phnum) && !empty($add1) && !empty($city) && !empty($cntry) && !empty($zip) ){
                if(isset($_FILES['profilepic'])){
                    $validext = array('jpg','png','jpeg');
                    $file = $_FILES['profilepic'];
                    $flname = $file['name'];
                    $ftmp = $file['tmp_name'];
                    if(!empty($flname)){
                        $fext = strtolower(pathinfo($flname,PATHINFO_EXTENSION));
                        if(in_array($fext, $validext)){
                            if($filename != "profile.png"){
                                if(file_exists($this->dir.$filename)){
                                    unlink($this->dir.$filename);
                                }
                            }else{
                                $this->err = "azad";
                            }
                            $filename = "profile_".rand('1001','99999').time().".".$fext;
                            $mv = move_uploaded_file($ftmp,$this->dir.$filename);
                            if($mv == true){
                                $this->err = "File can't move";
                            }
                        }else{
                            $this->err = "Select valid file";
                        }
                    }
                }
                $update = $this->db->rnQuery("UPDATE `user` SET `fname`='$fname',`lname`='$lname',`profile`='$filename',`ph_num`='$phnum',`address1`='$add1',`address2`='$add2',`city`='$city',`state`='$state',`country`='$cntry',`zip`='$zip' WHERE `id`='$id'");
                if($update==true){
                    echo "<script>window.location.href='?edit=$id&success'</script>";
                }else{
                    $this->err = "Culd not be updated!";
                }
            }else{
                $this->err = "Fildes are required!";
            }
        }



        public function updateVendor($data)
        {
            $fname = $data['fname'];
            $lname = $data['lname'];
            $filename = $data['oldpic'];
            $bgfilename = $data['oldbg'];
            if(empty($filename)){
                $filename = "profile.png";
            }
            //return $filename;
            $add1 = $data['add1'];
            $add2 = $data['add2'];
            $city = $data['city'];
            $state = $data['state'];
            $cntry = $data['cntry'];
            $validext = array('jpg','png','jpeg');
            $zip = $data['zip'];
            $id = $data['id'];
            if(!empty($fname) && !empty($lname) && !empty($add1) && !empty($city) && !empty($cntry) && !empty($zip)){
                if(isset($_FILES['profilepic'])){
                    $file = $_FILES['profilepic'];
                    $flname = $file['name'];
                    $ftmp = $file['tmp_name'];
                    if(!empty($flname)){
                        $fext = strtolower(pathinfo($flname,PATHINFO_EXTENSION));
                        if(in_array($fext, $validext)){
                            if($filename != "profile.png"){
                                if(file_exists($this->dir.$filename)){
                                    unlink($this->dir.$filename);
                                }
                            }else{
                                $this->err = "azad";
                            }
                            $filename = "profile_".rand('1001','99999').time().".".$fext;
                            $mv = move_uploaded_file($ftmp,$this->dir.$filename);
                            if($mv == true){
                                $this->err = "File can't move";
                            }
                        }else{
                            $this->err = "Select valid file";
                        }
                    }
                }
                if(isset($_FILES['bgimage'])){
                    $file = $_FILES['bgimage'];
                    $flname = $file['name'];
                    $ftmp = $file['tmp_name'];
                    if(!empty($flname)){
                        $fext = strtolower(pathinfo($flname,PATHINFO_EXTENSION));
                        if(in_array($fext, $validext)){
                            if($bgfilename != "profile-bg.jpg"){
                                if(file_exists($this->dir.$bgfilename)){
                                    unlink($this->dir.$bgfilename);
                                }
                            }else{
                                $this->err = "azad";
                            }
                            $bgfilename = "profileBg_".rand('1001','99999').time().".".$fext;
                            $mv = move_uploaded_file($ftmp,$this->dir.$bgfilename);
                            if($mv == true){
                                $this->err = "File can't move";
                            }
                        }else{
                            $this->err = "Select valid file";
                        }
                    }
                }
                $update = $this->db->rnQuery("UPDATE `user` SET `fname`='$fname',`lname`='$lname',`profile`='$filename',`background`='$bgfilename',`address1`='$add1',`address2`='$add2',`city`='$city',`state`='$state',`country`='$cntry',`zip`='$zip' WHERE `id`='$id'");
                if($update==true){
                    echo "<script>window.location.href='?edit=$id&success'</script>";
                }else{
                    $this->err = "Culd not be updated!";
                }
            }else{
                $this->err = "Fildes are required!";
            }
        }

        public function addcustomer($data)
        {
            $fname = $data['fname'];
            $lname = $data['lname'];
            $phnum = $data['phnum'];
            $email = $data['email'];
            $add1 = $data['add1'];
            $add2 = $data['add2'];
            $city = $data['city'];
            $state = $data['state'];
            $cntry = $data['cntry'];
            $zip = $data['zip'];
            $pwd = $data['pwd'];
            $cnfpewd = $data['cnfpewd'];
            $roll = $data['roll'];
            if(!empty($fname) && !empty($lname) && !empty($phnum) && !empty($email) && !empty($add1) && !empty($add2) && !empty($city) && !empty($cntry) && !empty($zip) && !empty($pwd) && !empty($cnfpewd) ){
                $chmail = $this->db->checkexist("SELECT * FROM `user` WHERE `email`='$email'");
                if($chmail == true){
                    $this->err = "Email already exist";
                }elseif($chmail == false){
                    if($pwd == $cnfpewd){
                        if(strlen($pwd) >7){
                            $en_pass = md5(sha1($pwd));
                            $auth = md5(sha1($email.$en_pass));
                            $ins = $this->db->rnQuery("INSERT INTO `user`(`fname`, `lname`, `email`, `ph_num`, `pass`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `auth`, `roll`) VALUES ('$fname','$lname','$email','$phnum','$en_pass','$add1','$add2','$city','$state','$cntry','$zip','$auth','$roll')");
                            if($ins  == true){
                                registerVerify($email,$fname,$roll,$auth);
                            }else{
                                $this->err = "Error in add user contact with administrator";
                            }
                        }else{
                            $this->err = "Password must be in 8 character or more";
                        }
                    }else{
                        $this->err = "Password did not matched";
                    }
                }
            }else{
                $this->err = "Fildes are required!";
            }

        }



        public function addvendor($data)
        {
            $fname = $data['fname'];
            $dname = $data['lname'];
            $email = $data['email'];
            $add1 = $data['add1'];
            $add2 = $data['add2'];
            $city = $data['city'];
            $state = $data['state'];
            $cntry = $data['cntry'];
            $zip = $data['zip'];
            $pwd = $data['pwd'];
            $cnfpewd = $data['cnfpewd'];
            $roll = $data['roll'];
            if(!empty($fname) && !empty($dname) && !empty($email) && !empty($add1) && !empty($add2) && !empty($city) && !empty($cntry) && !empty($zip) && !empty($pwd) && !empty($cnfpewd) ){
                $chmail = $this->db->checkexist("SELECT * FROM `user` WHERE `email`='$email'");
                if($chmail == true){
                    $this->err = "Email already exist";
                }elseif($chmail == false){
                    if($pwd == $cnfpewd){
                        if(strlen($pwd) >7){
                            $en_pass = md5(sha1($pwd));
                            $auth = md5(sha1($email.$en_pass));
                            $ins = $this->db->rnQuery("INSERT INTO `user`(`fname`, `lname`, `email`, `pass`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `auth`, `roll`) VALUES ('$fname','$dname','$email','$en_pass','$add1','$add2','$city','$state','$cntry','$zip','$auth','$roll')");
                            if($ins  == true){
                                registerVerify($email,$fname,$roll,$auth);
                            }else{
                                $this->err = "Error in add user contact with administrator";
                            }
                        }else{
                            $this->err = "Password must be in 8 character or more";
                        }
                    }else{
                        $this->err = "Password did not matched";
                    }
                }
            }else{
                $this->err = "Fildes are required!";
            }
        }

        public function customerLogin($data)
        {
            $email = $data['email'];
            $pass = $data['pass'];
            if( empty($email) || empty($pass) ){
                $this->err = "Fields are required";
            }else{
                $en_pass = md5(sha1($pass));
                $auth    = md5(sha1($email.$en_pass));
                $chek = $this->db->rnQuery("SELECT * FROM `user` WHERE `auth`='$auth'");
                $rows = mysqli_num_rows($chek);
                if($rows == 1){
                    $usrdata =  mysqli_fetch_assoc($chek);
                    $verify  = $usrdata['verified'];
                    $status  = $usrdata['status'];
                    if($verify == 1){
                        if($status == 1){
                            $cd = $usrdata['roll'];
                            if($cd == 1){
                                $usrid     = $usrdata['id'];
                                $roll      = "customer";
                                $loginauth = md5(sha1($email.$en_pass.time().rand(10001,999999)));
                                $inslogin  = $this->db->rnQuery("INSERT INTO `login`(`user`, `userauth`, `roll`, `status`) VALUES ('$usrid','$loginauth','$roll','1')");
                                if($inslogin == true){
                                    $this->lauth = $loginauth;
                                    return 1;
                                }else{
                                    return 0;
                                }
                            }elseif($cd == 2){
                                $this->err = "Your account is not a customer account";
                            }
                        }else{
                            $this->err = "You account hase been suspended";
                        }
                    }else{
                        $this->err = "Your account is not verified please verify your account"; 
                    }
                }else{
                    $this->err = "Wrong info Please check your info and try again";
                }                                                                                                                                                                                             
            }
        }
    }






?>