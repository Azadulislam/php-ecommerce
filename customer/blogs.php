<?php
$title = "Profile || Active supper shope";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");
if(isset($_POST['cStatus'])){
    $data = $_POST;
    $encode = json_encode($data);
    // Curl start
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, URL."api/blog.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($ch);
    curl_close($ch);
    // !Curl start
    echo $response;
}
if(isset($_COOKIE['vendor'])){
    echo "<script>window.location.href='vendor-dashboard'</script>";
}
if(isset($_COOKIE['customer'])){
    include ('../php/function.php');
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $blog->deleteProduct($id);
    }
?>       
<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
        <div class="col-lg-3">  
            <?php include ('templates/_sidbar.php') ?>
        </div>
        <div id="maindiv" class="col-lg-9">  
            <div class="content">
                <h6 class="heading mb-0">Your Blogs</h6>
                <div class=" text-right my-1"><a href="add-blog" class="btn btn-theme"><i class="far fa-plus-square"></i> Add Blog</a> </div>
                <div class="bloglist">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                while ($blog = mysqli_fetch_assoc($blogs)) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><img class="img-fluid" src="<?= $dir.$blog['image'] ?>" alt=""></td>
                                    <td><?= $blog['title'] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" value="<?= $blog['id'] ?>" name="id">
                                            <input type="hidden" value="<?= $blog['status'] ?>" name="status">
                                            <?php if($blog['status']==1){ ?>
                                                <button type="submit" class="btn btn-theme" name="cStatus"><i class='fas fa-check'></i></button>
                                            <?php }elseif($blog['status']==2){ ?>
                                                <button type="submit" class="btn btn-danger" name="cStatus"><i class='fas fa-times'></i></button>
                                            <?php }?>
                                        </form>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="?delete=<?= $blog['id'] ?>"><i class='far fa-trash-alt'></i></a>
                                        <a class="btn btn-theme" href="edit-blog?edit=<?= $blog['id'] ?>"><i class='fas fa-edit'></i></a>
                                        <a class="btn btn-theme" href="#"><i class='fas fa-eye'></i></a>
                                    </td>
                                </tr>
                                <?php
                                ++$i;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
        }else{
            echo "<script>window.location.href='user-login'</script>";
        }
include("../inc/footer.php");
?>