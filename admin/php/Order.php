<?php
    namespace classes;

    class Order{
        public $err;
        public $suc;
        public $db;
        public $orderid;

        public function __construct(Database $db) {
            $this->db = $db;
        }
        

        public function addOrder($add,$session)
        {
            $this->orderid = substr(strtoupper(md5(rand(1001,9999).time())),0,15);
            $phone    = $add['phone'];
            $district = $add['district'];
            $postCode = $add['postCode'];
            $address  = $add['address'];
            $payment  = '0';
            $user     = $add['user'];
            $status   = '0';
            if(empty($phone)||empty($district)||empty($postCode)||empty($address)){
                $this->err = "Fields are required";
            }else{
                $ins = $this->db->rnQuery("INSERT INTO `orders`(`user_id`, `order-id`, `district`, `post-code`, `address`, `payment`, `status`) VALUES ('$user','$this->orderid','$district','$postCode','$address','$payment','$status')");
                if($ins == true){
                    foreach($session as $data){
                        $pro      = $data['id'];
                        $quantity = $data['qty'];
                        $price    = $data['price'];
                        $dicPrice = $data['dic'];
                        
                        $insdtl = $this->db->rnQuery("INSERT INTO `order_details`(`product`, `quantity`, `price`,`discount`, `order_id`) VALUES ('$pro','$quantity','$price','$dicPrice','$this->orderid')");
                    }
                    if($insdtl == true ){
                        return '1';
                        
                    }else{
                        $this->err = "Details could not be inserted";
                    }
                }else{
                    $this->err = "Something wrong";
                }
            }
        }

        public function accceptOreder($data)
        {
            $id = $data['status'];
            $action = $data['action'];
            if($action == 'aprove'){
                $upstatus = '1';
            }elseif($action == 'decline'){
                $upstatus = '2';
            }
            $update = $this->db->rnQuery("UPDATE `orders` SET `status`='$upstatus' WHERE `id`='$id'");
            if($update == true){
                return 1;
            }else{
                return 0;
            }
        }

        public function deliveryUpdate($data = null)
        {
            $up = $this->db->rnQuery("UPDATE `orders` SET `status`='4' WHERE `id`='$data'");
            if($up == 1){
                return 1;
            }
        }

    }
?>