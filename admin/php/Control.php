<?php
    namespace classes;
    class Control{
        public $db;
        public $disP;
        public $reviewRows;

        public function __construct(Database $db = NULL) {
            $this->db = $db;
        }

        public function compressImage($tmp_name,$fsize,$path)
        {
            $fsm = $fsize/(1024*1024);
            $quality = 100;
            if($fsm > .3 && $fsm <= 1){
                $quality = 50;
            }elseif($fsm > 1 && $fsm < 4){
                $quality = 30;
            }elseif($fsm >= 4 && $fsm< 6){
                $quality = 20;
            }elseif($fsm >= 6){
                $quality = 10;
            }
            //Get image info
            $imgifo = getimagesize($tmp_name);
            $mime = $imgifo['mime'];
            // Create a new image form file
            switch($mime){
                case 'image/jpeg':
                    $img = imagecreatefromjpeg($tmp_name);
                    break;
                case "image/png":
                    $img = imagecreatefrompng($tmp_name);
                    break;
                case 'image/gif':
                    $img = imagecreatefromgif($tmp_name);
                    break;
                default:
                    $img = imagecreatefromjpeg($tmp_name);
            }
            imagejpeg($img,$path,$quality);
            //return $destination;
            if($path == true){
                return 1;
            }else{
                return 0;
            }
        }

        public function sellerName($id)
        {
            if(is_numeric($id)){
                $seller     = $this->db->getSingle('user','id',$id);
                $sellerName = $seller['lname'];
            }else{
                $sellerName = $id;
            }
            return $sellerName;
        }

        public function selPrice($disc, $prc)
        {
            $discount = $disc;
            $price = $prc/100;
            $this->disP = ceil ( $price*$discount );
            $slleprice = $prc - $this->disP;
            return $slleprice;
        }

        public function avarage($id)
        {
            $sel = $this->db->rnQuery("SELECT * FROM `review` WHERE `product`='$id' ");
            $this->reviewRows = $sel->num_rows;
            $seltot = $this->db->rnQuery("SELECT SUM(rating) AS 'total' FROM `review` WHERE `product`='$id'");
            $count = mysqli_fetch_assoc($seltot);
            $avg = 0;
            if($this->reviewRows != 0){
                $avg = $count['total']/$this->reviewRows;
            };
            return $avg;
        }
    }

?>