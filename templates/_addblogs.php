<div class="content ">

                <form action="" method="post" enctype="multipart/form-data">

                    <h5 class="heading mb-0">Add blog</h5>

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

                            <input type="hidden" name="bloger" value="<?= $usrdata['id'] ?>">

                            <div class="col-9"><input type="text" class="form-control" name="title" id="title" placehoslder="Enter blog title"></div>

                        </div>

                        <div class="row m-0 mb-2">

                            <label class="col-3" for="image">Image</label>

                            <div class="col-9">

                                <input type="file" id="image" name="image" data-height="100" class="dropify" data-default-file="<?= $dir ?>default.jpg" >

                            </div>

                        </div>

                        <div class="row m-0 mb-2">

                            <label class="col-3 mr-0" for="description">Blog Description</label>

                            <div class="col-9">

                                <textarea name="description" id="description" class="summernote bg-light"></textarea>

                                <label for="description" class="error"></label>

                            </div>

                        </div>
                        <div class="row">
                            <label for="cat" class="control-label col-3 mr-0">Category</label>
                            <div class="form-group col-9">
                                <select class="form-control" name="category">
                                    <option value="">--Select category--</option>
                                    <?php
                                    $selcat = $db->rnQuery("SELECT * FROM `blog_category` WHERE `status`='1'");
                                    while($cat = mysqli_fetch_assoc($selcat)){
                                        ?><option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2 mx-0">

                            <label class="col-3">Status</label>

                            <label class="col-2">

                                <input name="status" type="radio"  value="1"  class="">

                                <span class="ml-2">Active</span>

                            </label>

                            <label class="col-7">

                                <input name="status" type="radio" value="2" class="">

                                <span class="ml-2">Inactive</span>

                            </label>

                            <label for="status" class="error col-12"></label>

                        </div>

                        <div class="row m-0 mb-2">

                            <label class="col-3 mr-0"></label>

                            <div class="col-9">

                                <button class="btn btn-theme" name="addblog">Add</button>

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