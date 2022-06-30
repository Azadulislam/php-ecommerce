<?php

    require ('phpmailer/PHPMailerAutoload.php');

    function registerVerify($email,$name,$cd,$auth){

        $subject = "Please verify your email";

        $message = '

        <!DOCTYPE html>

        <html lang="en">

        <head>

            <meta charset="UTF-8">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>'.$subject.'</title>

        </head>

        <body>

            <p>Hi '.$name.'<br/>

            Thanks for register verify your email address <a href="'.URL.'verify.php?verify='.$auth.'">Verify</a>

            </p>

        </body>

        </html>

        ';

        echo "<script>window.location.href='".URL."verify.php?registerd=$email&nm=$name&cd=$cd'</script>";

        sendmail($email,$subject,$message);

    }



    

    function resetEmail($email,$name,$auth){

        $subject = "Reset password";

        $message = '

        <!DOCTYPE html>

        <html lang="en">

        <head>

            <meta charset="UTF-8">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>'.$subject.'</title>

        </head>

        <body>

            <p>Hi '.$name.'<br/>

            You have requsted for reset your password. Click this link to reset your password <a href="'.URL.'forgotpass?reset='.$auth.'">Reset</a>

            </p>

        </body>

        </html>

        ';

        echo "<script>window.location.href='".URL."forgotpass.php?sent=$email&nm=$name'</script>";

        sendmail($email,$subject,$message);

    }



    function contact($conemail,$name,$sub,$message)

    {

        $Sendmessage = '

        <!DOCTYPE html>

        <html lang="en">

        <head>

            <meta charset="UTF-8">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>'.$sub.'</title>

        </head>

        <body>

            <div>

                <p>'.$message.'</p>

            </div>

        </body>

        </html>

        ';

        echo "<script>window.location.href='".URL."contact.php?recived'</script>";

        recivemail($conemail,$name,$sub,$Sendmessage);

    }

    

    function sendmail($email,$subject,$message){

        $mail = new PHPMailer;

        $mail->SMTPDebug = 4;

        $mail->isSMTP();

        $mail->Host      = MHOST;

        $mail->SMTPAuth  = true;

        $mail->Username  = EMAIL;

        $mail->Password  = MPASS;

        $mail->SMTPSecure ='tls';

        $mail->Port       = 587;

        $mail->setFrom(EMAIL,WON);

        $mail->addAddress($email);

        $mail->addReplyTo(EMAIL,WON);

        $mail->isHTML(true);

        $mail->Subject  = $subject;

        $mail->Body = $message;

        $mail->AltBody = "Verification Message";

        $send         = $mail->send();



    }



    function recivemail($email,$name,$subject,$message){

        $mail = new PHPMailer;

        $mail->SMTPDebug = 4;

        $mail->isSMTP();

        $mail->Host      = MHOST;

        $mail->SMTPAuth  = true;

        $mail->Username  = EMAIL;

        $mail->Password  = MPASS;

        $mail->SMTPSecure ='tls';

        $mail->Port       = 587;

        $mail->setFrom($email,$name);

        $mail->addAddress(EMAIL,WON);

        $mail->addReplyTo($email,$name );

        $mail->isHTML(true);

        $mail->Subject  = $subject;

        $mail->Body = $message;

        $mail->AltBody = "Customer Message";

        $send         = $mail->send();

    }





    



?>