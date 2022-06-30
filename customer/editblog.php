<?php
$title = "Profile || Active supper shope";
$asset = "";
$dir = "uploads/";
$autoloc = "../";
$adloc = "../";
$fnloc = "../";
include("../inc/header.php");
if(isset($_COOKIE['vendor'])){
    echo "<script>window.location.href='vendor-dashboard'</script>";
}
if(isset($_COOKIE['customer'])){
    include ('../php/function.php');
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        if($id == null){
            echo "<script>window.location.href='edit-blog'</script>";
        }else{
        if(isset($_POST['editblog'])){
            $edit = $blog->update($_POST);
        }
        $blogs = $db->getTableData('blogs','id',$id);
        $blog_item = mysqli_fetch_assoc($blogs);
?>
                    
                    
            
<section id="profile" class="py-4">
    <div class="container">
        <div class="row">
        <div class="col-lg-3">  
            <?php include ('templates/_sidbar.php') ?>
        </div>
        <div id="maindiv" class="col-lg-9"> 
        <div class="content ">
                <form action="" method="post" enctype="multipart/form-data">
                    <h6 class="heading mb-0">Edit blog</h6>
                    <div class="addblog mt-3 col-10 mx-auto p-0">
                        <div class="col-12">
                            <?php
                                if(isset($blog->suc)){
                                    ?>
                                    <div class="alert alert-success text-center p-2 mt-2"><?= $blog->suc ?></div>
                                    <?php
                                }elseif(isset($blog->err)){
                                    ?>
                                    <div class="alert alert-warning text-center p-2 mt-2"><?= $blog->err ?></div>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3" for="title">Title</label>
                            <input type="hidden" name="id" value="<?= $blog_item['id'] ?>">
                            <div class="col-9"><input type="text" class="form-control" name="title" id="title" value="<?= $blog_item['title'] ?>" placehoslder="Enter blog title"></div>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3" for="image">Image</label>
                            <div class="col-9">
                                <input type="file" id="image" name="image" data-height="100" class="dropify" data-default-file="<?= $dir.$blog_item['image'] ?>" >
                                <input type="hidden" name="old" value="<?= $blog_item['image'] ?>">
                            </div>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3 mr-0" for="description">Blog Description</label>
                            <div class="col-9">
                                <textarea name="description" id="description" class="summernote bg-light"><?= $blog_item['description'] ?></textarea>
                                <label for="description" class="error"></label>
                            </div>
                        </div>
                        <div class="row my-2 mx-0">
                            <label class="col-3">Status</label>
                            <label class="col-2">
                                <input name="status" type="radio" <?= $blog_item['status']==1?'checked':'' ?> value="1"  class="">
                                <span class="ml-2">Active</span>
                            </label>
                            <label class="col-7">
                                <input name="status" type="radio" <?= $blog_item['status']==2?'checked':'' ?>  value="2" class="">
                                <span class="ml-2">Inactive</span>
                            </label>
                            <label for="status" class="error col-12"></label>
                        </div>
                        <div class="row m-0 mb-2">
                            <label class="col-3 mr-0"></label>
                            <div class="col-9">
                                <button class="btn btn-theme" name="editblog"><i class="fas fa-check"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
                    <script>
                        $(document).ready(function() {
                            // Basic
                            $('.dropify').dropify();
                        });
                        jQuery(document).ready(function() {
    
                        $('.summernote').summernote({
                            height: 150, // set editor height
                            minHeight: 100, // set minimum height of editor
                            maxHeight: 200, // set maximum height of editor
                            focus: false, // set focus to editable area after initializing summernote
                            placeholder: "Enter product description"
                        });
    
                        $('.inline-editor').summernote({
                            airMode: true
                        });
    
                        });
    
                        window.edit = function() {
                            $(".click2edit").summernote()
                        },
                        window.save = function() {
                            $(".click2edit").summernote('destroy');
                        }
                    </script>
                </div>
        </div>
    </div>
</section>
<?php
        }
    }else{
        echo "<script>window.location.href='blog-list'</script>";
    }
        }else{
            echo "<script>window.location.href='user-login'</script>";
        }
        include("../inc/footer.php");
?>