<?php
    namespace classes;
    class Userc{
        public $err;
        public $succ;
        public $result;
        public $db;
        
        function __construct(){
            $this->db = new Database;
        }
        public function insUsr($data){
            $fnm  = $data['fname'];
            $roll = $data['roll'];
            if($roll == '1'){
                $phone = $data['phone'];
            }elseif($roll == '2'){
                $phone = "01700000000";
            }
            $lnm      = $data['lname'];
            $mail     = $data['email'];
            $pass     = $data['pass'];
            $con_pass = $data['con_pass'];
            $add1     = $data['add1'];
            $add2     = $data['add2'];
            $city     = $data['city'];
            $state    = $data['state'];
            $cntry    = $data['cntry'];
            $zip      = $data['zcode'];

            if(empty($fnm) || empty($lnm) || empty($add1) ||empty($add2) || empty($city) || empty($state) || empty($cntry) || empty($zip) || empty($mail) || empty($phone) || empty($pass) || empty($con_pass || $pass == $con_pass && strlen($pass) >= 8 || !isset($data['agree']))){
                echo "<script>window.location.href='?err'</script>";
            }else{
                if($pass !== $con_pass){
                    echo "<script>window.location.href='?err'</script>";
                }else{
                    $profile = "profile.png";
                    $agree   = $data['agree'];
                    $en_pass = md5(sha1($pass));
                    $auth    = md5(sha1($mail.$en_pass));
                    $query   = "INSERT INTO `user`(`fname`, `lname`, `email`, `ph_num`, `pass`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `auth`, `roll`, `agree`) VALUES ('$fnm','$lnm','$mail','$phone','$en_pass','$add1','$add2','$city','$state','$cntry','$zip','$auth','$roll',$agree)";
                    $ins     = $this->db->rnQuery($query);
                    if($ins == true){
                        registerVerify($mail,$fnm,$roll,$auth);
                    }else{
                        echo "<script>window.location.href='?errdata'</script>";
                    }
                };
                

            };
        }

        public function login($data){
            $email = $data['usrmail'];
            $pass  = $data['usrpass'];

            $en_pass = md5(sha1($pass));
            $auth = md5(sha1($email.$en_pass));
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
                            if($inslogin ==1){
                                $date      = date('Y-m-d',time());
                                $mdate     = date('D, d M Y H:m:s',strtotime($date. ' + 15 days'));
                                echo "<script>document.cookie = '$roll=$loginauth; expires=$mdate UTC; path=/';</script>";
                                ?>
                                    <script>window.location.href="customer-dashboard";</script>
                                <?php
                            }else{
                                $this->err = "Wrong info Please check your info and try again";
                            }
                        }elseif($cd == 2){
                            $usrid     = $usrdata['id'];
                            $roll      = "vendor";
                            $loginauth = md5(sha1($email.$en_pass.time().rand(10001,999999)));
                            $inslogin  = $this->db->rnQuery("INSERT INTO `login`(`user`, `userauth`, `roll`, `status`) VALUES ('$usrid','$loginauth','$roll','1')");
                            if($inslogin == 1){
                                $date      = date('Y-m-d',time());
                                $mdate     = date('D, d M Y H:m:s',strtotime($date. ' + 15 days'));
                                echo "<script>document.cookie = '$roll=$loginauth; expires=$mdate UTC; path=/';</script>";
                                ?>
                                    <script>window.location.href="vendor-dashboard";</script>
                                <?php
                            }else{
                                $this->err = "Wrong info Please check your info and try again";
                            }
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

        public function logoutUsr($data){
            $roll    = $data['logout'];
            $auth    = $data['cookie'];
            $uplogin = $this->db->rnQuery("UPDATE `login` SET `status`='0' WHERE `userauth`='$auth'");
            if($uplogin == true){
                $date = date('Y-m-d',time());
                $mdate = date('D, d M Y H:m:s',strtotime($date. ' - 15 days'));
                echo "<script>document.cookie = '$roll=$auth; expires=$mdate UTC; path=/';</script>";
                echo "<script>window.location.href='home'</script>";
            }
        }


        public function sendEmail($data){
            $email = $data['email'];
            $select_user = $this->db->selectSingle("SELECT * FROM `user` WHERE `email`='$email'");
            if($select_user == true){
                $auth = $select_user['auth'];
                $fnm  = $select_user['fname'];
                $mail = $select_user['email'];
                resetEmail($mail,$fnm,$auth);
                $date  = date('Y-m-d',time());
            }else{
                $this->err = "No account with this email";
            }
        }


        public function changPassword($data){
            $new         = $data['newpass'];
            $conf        = $data['confpass'];
            $auth        = $data['auth'];
            $select_user = $this->db->selectSingle("SELECT * FROM `user` WHERE `auth`='$auth'");
            if($select_user == true){
                if($new == $conf){
                    $email  = $select_user['email'];
                    $uid     = $select_user['id'];
                    $en_pass = md5(sha1($new));
                    $upauth  = md5(sha1($email.$en_pass));
                    $uppass  = $uplogin = $this->db->rnQuery("UPDATE `user` SET `pass`='$en_pass',`auth`='$upauth',`status`='1' WHERE `id`='$uid'");
                    if($uppass == true){
                        echo "<script>window.location.href='login'</script>";
                    }else{
                        $this->err = "Something wrong";
                    }
                }else{
                    $this->err = "Cofirm password did not matched";
                }
            }else{
                $this->err = "Invalid link";
            }
        }
    }




?>