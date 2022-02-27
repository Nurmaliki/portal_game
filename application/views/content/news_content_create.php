<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            News Content
            <small>Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->config->item('base_url'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo $this->config->item('base_url'); ?>news_content">News Content</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <?php if ($this->session->flashdata('msgalert')) {; ?>
                        <div class="alert alert-success" role="alert">
                            <strong><?php echo $this->session->flashdata('msgalert'); ?></strong>
                        </div>
                    <?php }; ?>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body" style="">
                        <?php if (empty($field)) { ?>
                            <form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/do_upload" method="post" id="news_content" enctype="multipart/form-data">
                            <?php } else { ?>
                                <form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/action_create" method="post" id="news_content" enctype="multipart/form-data">
                                <?php } ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">News Category</label>
                                    <?php // print_r($field); 
                                    ?>
                                    <select class="form-control" name="category_id">
                                        <?php
                                        if (count($category) > 0) {
                                            for ($i = 0; $i < count($category); $i++) {


                                                if ($category[$i]['id'] == $field['category_id']) {
                                        ?>
                                                    <option value="<?php echo $category[$i]['id']; ?>" selected><?php echo $category[$i]['name']; ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['name']; ?></option>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">News Content Title</label>
                                    <input maxlength="100" required type="text" class="form-control" id="name" placeholder="Enter name here" name="name" value="<?php echo $field['title']; ?>">

                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">News Content Sub title</label>
                                    <input maxlength="160" required type="text" class="form-control" id="sub_title" placeholder="Enter Sub title here" name="sub_title" value="<?php echo $field['sub_title']; ?>">

                                </div>

                                <br>
                                <div>
                                    <label for="exampleInputEmail1">News Content Body</label>
                                    <br>
                                    <textarea required name="body" id="body" form="news_content" class="form-control "><?php echo $field['body']; ?></textarea>
                                </div>

                                <div>
                                    <label for="exampleInputEmail1"> image</label>
                                    <br>
                                    <textarea name="picture" id="picture" form="news_content" class="form-control" readonly><?php echo $path; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Video link</label>
                                    <input type="text" class="form-control" id="video" placeholder="Enter name here" name="video" value="<?php echo $field['video']; ?>">

                                </div>
                                <div>
                                    <?php if (!empty($field)) { ?>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    <?php } ?>
                                </div>
                                <!-- </form> -->
                    </div>
                    <!-- /.box-body -->

                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Upload image</h3>
                <p style="font-size: 10px">Ukuran image sebaiknya (360 x 188 px) </p>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>

                </div>
            </div>
            <div class="box-body" style="">
                <?php //echo form_open_multipart('news_content/do_upload');
                ?>

                <input id="inp" type="file" name="userfile" size="20" form="news_content" />

                <br /><br />

                <input type="submit" value="upload" class="btn btn-primary" />
             
                <img id="img">
                <img class="img-responsive pad" src="http://10.255.0.140/cms_btn/uploads/<?php echo $path; ?>" alt="Photo">

                </form>
            </div>
        </div>
    </section>

    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content -->



<script>
    function readFile() {

        if (this.files && this.files[0]) {

            var FR = new FileReader();

            FR.addEventListener("load", function(e) {
                document.getElementById("img").src = e.target.result;
                document.getElementById("b64").innerHTML = e.target.result;
            });

            FR.readAsDataURL(this.files[0]);
        }

    }

    document.getElementById("inp").addEventListener("change", readFile);
</script>