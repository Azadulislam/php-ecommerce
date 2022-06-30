<?php
    namespace classes;
    
    use mysqli;
    class Database{
        public $err;
        public $succ;
        public $link = null;
        public $rows;
        public $data;


        function __construct(){
            $this->conn();
        }
        

        public function conn(){
            $this->link = new mysqli(DBHOST,DBUSR,DBPASS,DBN);
            if($this->link){
                return $this->link;
            }else{
                $this->link = "Database is not connected";
            }
        }


        public function rnQuery($query){
            $run = $this->link->query($query);
            if($run == false){
                echo $this->link->error;
                return false;
            }elseif($run == true){
                return $run;
            }
        }

        public function convert($data)
        {
            return mysqli_real_escape_string($this->link,$data);
        }

        public function checkexist($query){
            $run = $this->link->query($query);
            if($run == false){
                echo $this->link->error;
            }else{
                $count = mysqli_num_rows($run);
                if($count>0){
                    return true;
                }else{
                    return false;
                }
            }
        }

        

        public function selectall($query){
            $run = $this->link->query($query);
            $rows = mysqli_num_rows($run);
            if($rows == 0){
                return $this->err = "No data found";
            }else{
                return mysqli_fetch_assoc($run);
            }
        }

        public function selectSingle($query)
        {
            $rn = $this->rnQuery($query);
            if(mysqli_num_rows($rn)>0){
                $data = mysqli_fetch_assoc($rn);
                return $data;
            }else{
                return false;
            }
        }

        public function getSingle($table,$col,$row)
        {
            $select = $this->link->query("SELECT * FROM {$table} WHERE `{$col}`={$row}");
            if(mysqli_num_rows($select)>0){
                $item = mysqli_fetch_array($select,MYSQLI_ASSOC);
                return $item;
            }else{
                return false;
            }
        }

        // Get data from table
        public function getAllData($table)
        {
            $select = $this->link->query("SELECT * FROM {$table}");
            $res_array = array();
            while($item = mysqli_fetch_array($select,MYSQLI_ASSOC)){
                $res_array[] = $item;
            }
            return $res_array;
        }

        // Get data from table
        public function getTableData($table,$col,$row)
        {
            $select = $this->link->query("SELECT * FROM {$table} WHERE `{$col}`='{$row}'");
            return $select;
        }


        public function getActiveData($table)
        {
            $select = $this->link->query("SELECT * FROM {$table} WHERE `status`='1'");
            $res_array = array();
            while($item = mysqli_fetch_array($select,MYSQLI_ASSOC)){
                $res_array[] = $item;
            }
            return $res_array;
        }



        // Update data from table
        public function updateData($table,$col,$data,$row){
            $update = $this->link->query("UPDATE {$table} SET `{$col}`='{$data}' WHERE `id`='{$row}'");
            if($update == false){
                return $this->link->error;
            }else{
                return $update;
            }
        }
        
        public function delete($table,$row)
        {
            $excute = $this->rnQuery("DELETE FROM `{$table}` WHERE `id`='$row'");
            if($excute == true){
                return 1;
            }else{
                return 0;
            }
        }

        public function __destruct(){
            $this->conClose();
        }
    
        public function conClose()
        {
            if($this->link != null){
                $this->link->close();
            }
        }
    }
?>