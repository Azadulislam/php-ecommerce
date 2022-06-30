<?php
    namespace classes;

    class Review{
        public $err;
        public $suc;
        public $db;

        public function __construct(Database $db) {
            $this->db = $db;
        }

        public function addNew($data)
        {
            $user    = $data['user'];
            $product = $data['product'];
            $ragting = $data['rating'];
            $comment = $data['comment'];
            $order   = $data['order'];
            $runquery = $this->db->rnQuery("INSERT INTO `review`(`rating`,`comment`,`user`,`product`) VALUES('$ragting','$comment','$user','$product')");
            if($runquery == 1){
                $runquery = $this->db->rnQuery("UPDATE `order_details` SET `review`='1' WHERE `product`='$product' AND `order_id`='$order'");
                return $this->suc = 1;
            }
        }

    }
?>