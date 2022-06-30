<?php  
    $adloc = "../";
    include ("auto.php");
    include ("stripe-conf.php");
    if (isset($_POST['stripeToken'])){
        $token = $_POST['stripeToken'];
        $orderid = $_POST['order_id'];
        $totalamnt = 0;
        $totalamnt = 0;
        $selectpr  = $db->rnQuery("SELECT * FROM `order_details` WHERE `order_id`='$orderid'");
        if(mysqli_num_rows($selectpr)>0){
        $cartamount = 0;
        $total      = 0;
        while ($product = mysqli_fetch_assoc($selectpr)) {
            $total += $product['price'];
            $cartamount = $total*100;
            global $cartamount;
        }
        $data = \Stripe\Charge::create([
            "amount"=>$cartamount,
            "currency"=>"usd",
            "description"=>"Wesite Payment",
            "source"=>$token
        ]);
        $TrxID = $data['balance_transaction'];
        $stripAmount = $data['amount'];
        $billing_details = $data["billing_details"]["name"];
        $status = $data["paid"];
        if($status == true){
            $orderSel = $db->rnQuery("SELECT * FROM `orders` WHERE `order-id`='$orderid'");
            $order    = mysqli_fetch_assoc($orderSel);
            $time     = $order['time'];
            $mdate    = date('Y-m-d H:m:s',strtotime($time. ' + 7 days'));
            $update   = $db->rnQuery("UPDATE `orders` SET `payment`='1',`p_trxID`='$TrxID',`amount`='$stripAmount',`delivered`='$mdate' WHERE `order-id`='$orderid'");
            $item = array(  
                'status'     =>'1',
                'name'   =>$billing_details,
                'amount'    =>$stripAmount
            );
            $_SESSION['Order-status'] = $item;
            if($update == true){
                echo "<script>window.location.href='../thankyou.php?order-success=".$billing_details."'</script>";
            }
        }elseif($status == false){
            echo "<script>window.location.href='../thankyou.php?order-error'</script>";
        }
        }else{
           echo "<script>window.location.href='../payment.php?order-error'</script>";
        }
    }
?>