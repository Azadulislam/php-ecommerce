<?php
    namespace classes;

    class Cart{
        public $err;
        public $suc;
        public $db;


        public function __construct(Database $db) {
            $this->db = $db;
        }
        

        public function updateQuantity($data)
        {
            $qty = $data['plus'];
            $pro = $data['pid'];
            //$_SESSION[''];
        }
    }
?>