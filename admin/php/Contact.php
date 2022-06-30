<?php
    namespace classes;

    class Contact{
        public $err;
        public $suc;
        public $db;

        public function __construct(Database $db) {
            $this->db = $db;
        }

        public function sendMessage($data)
        {
            $name     = $data['con_name'];
            $conemail = $data['con_email'];
            $subjct   = $data['con_sub'];
            $message  = $data['message'];
            if(empty($name) || empty($conemail) || empty($message)){
                $this->err = "Fields are required!";
            }else{
                contact($conemail,$name,$subjct,$message);
            }
        }
    }

?>