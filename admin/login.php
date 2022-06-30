<?php

    if(isset($_COOKIE['admin'])){

        echo "<script>window.location.href='index.php'</script>";

    }else{

    include_once ('php/auto.php');

    if(isset($_POST['admin_login'])){

        $data = json_encode($_POST);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, URL.'admin/api/admin.php');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $res = json_decode($response);

        if(isset($response)){

            if($res->status == 1){

                $value = $res->user;

                $name = 'admin';

                $date      = date('Y-m-d',time());

                $mdate     = date('D, d M Y H:m:s',strtotime($date. ' + 15 days'));

                echo "<script>document.cookie = '$name=$value; expires=$mdate UTC; path=/';</script>";

                echo "<script>window.location.href='index.php'</script>";

            }

        }



    }

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" sizes="16x16" href="../image/icon.png">

    <title>Admin Login</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/coustom.css">

</head>

<body>

    <section id="login">

        <div class="container">

            <div class="row">

                <div class="col-md-5 col-8 mx-auto">

                    <div class="loginform p-4">

                        <form action="" method="POST">

                            <h1 class="text-center"><span class='title1'>Demo</span> <span class="title2">Shop</span></h1>

                            <hr class="my-3">

                            <h6 class="text-center text-light mb-3">Login to Admin panal</h6>

                            <?php

                            if(isset($response)){

                               if($res->status == false){

                            ?>

                            <div class="alert alert-warning text-center"><?= $res->res  ?></div>

                            <?php

                               }

                            }

                            ?>

                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                    <span class="input-group-text"><i class="fas fa-user"></i></span>

                                </div>

                                <input type="text" class="form-control" placeholder="User name" name="username">

                            </div>

                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                    <span class="input-group-text"><i class="fas fa-key"></i></span>

                                </div>

                                <input type="password" class="form-control" placeholder="Password" name="password">

                            </div>

                            <div class="text-right">

                                <button class="btn text-" name="admin_login" type="submit"><i class="fas fa-lock"></i> Sign in</button>

                            </div>

                        </form>

                    </div>

                    <div class="info p-3">

                        <table class="table table-bordered text-light">

                            <tr>

                                <th>Admin</th>

                                <th>username</th>

                                <th>password</th>

                            </tr>
                            <tr>

                                <td>1</td>

                                <td>Admin</td>

                                <td>admin2021</td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <script src="../asset/js/jquery.min.js"></script>

    <script src="../asset/js/popper.min.js"></script>

    <script src="../asset/js/bootstrap.min.js"></script>

</body>

</html>

<?php

    }

?>