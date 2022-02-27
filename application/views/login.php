<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Star Games</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/font.css">
  <style>
    .vertical-center {
      margin: 0;
      position: absolute;
      top: 50%;
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
    }

    .center {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 200px;
      border: 3px solid green;
    }

    @media screen and (max-width: 600px) {
      .has-feedback .form-control {
        padding-right: 12px;
      }
    }
  </style>
</head>

<!-- <body class="hold-transition login-page"> -->

<body class="hold-transition login-page" style="    background: #f3fbff!important;">
  <div style="margin-top: 67px;margin-bottom: unset;" class="login-box justify-content-center align-items-center">
    <div class="login-logo" style="font-weight: bold;color:#0984e3;  font-family: cursive;">
      <img style="    margin-top: 1px;" width="120" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/newgame.png"><br>
      <!-- <a href="<?php echo $this->config->item('assets_url'); ?>"><b>Masuk Gaspol</b></a> -->
      New Games
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="    margin-top: -40px;">
      <!-- <p class="login-box-msg">Masuk Dan Mainkan Game Favorite Kamu</p> -->

      <center>
        <div style="margin-bottom:10px;"> <?php echo  $this->session->flashdata('msgalert'); ?> </div>
      </center>

      <form action="<?php echo $this->config->item('base_url'); ?>/login/authentication" method="post">
        <div class="form-group has-feedback mb-5">
          <p style=" width:20%;     /* border-radius: 20px; */   border: 3px solid #74b9ff;border-right: none;background-color: #f3fbff; border-radius: 5px 0px 0px 5px;font-weight: bold;" type="text" class="form-control pull-left" placeholder="+62" name="password" value="+62">+62 </p>

          <input value="" style="  width:80%;     /* border-radius: 20px; */     border: 3px solid #74b9ff;border-left: none;background-color: #dae4e8;border-radius: 0px 5px 5px 0px;font-weight: bold;" type="username" class="form-control" placeholder="" name="username">
          <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
        </div>
        <div class="form-group has-feedback mt-5">
          <input value="" style=" border: 3px solid #74b9ff;    background-color: #dae4e8;    border-radius: 5px;" type="password" class="form-control text-center" placeholder="Password" name="password">
        </div>
        <div class="form-group has-feedback mt-5 text-center">
          <button style="  background-color: #00b894;   color: white;  font-weight: bold;     float: left;" class="btn text-cente btn btn-infor" type="submit"> Login </button>
          <a style="background-color: #fdcb6e;    color: white; font-weight: bold;  border: none;    float: right;" class="btn btn-info" href="sms:93111?body=GASPOL">Register</a>

        </div>

        <div class="form-group has-feedback mt-5 text-center">
          <img width="50" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/3.png">
        </div>


      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>

</html>