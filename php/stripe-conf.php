<?php 
    include ("stripe/init.php");
    $publishkey = "pk_test_51ICNe5CmWJk2Hg17MyXlFPvyuzxSzxb52IGyTw8u3MyssT2YGI0YkzoczZjPsSbjAEwtqbltuujF0iSXkDpmbBvq004jlPfJv2";
    $secredkey = "sk_test_51ICNe5CmWJk2Hg17KrPZDmCd6A50aRVDnJziU9xuFkhQEvm56yJm1ydz4TXKQd8olO5F8Ko5NzNS6xHCwRVSqs4E00fjpLL0xw";
    \Stripe\Stripe::setApiKey($secredkey);
?>