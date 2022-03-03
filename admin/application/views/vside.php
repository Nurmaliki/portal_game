<?php
//print_r($_SESSION); 
?>
<!DOCTYPE html>
<html>
<?php $title_web = $this->config->item('title_web'); ?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('title_web'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link href="<?php echo $this->config->item('assets_url'); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/dist/css/skins/_all-skins.min.css">
  <style type="text/css">
    .lds-ellipsis {
      display: inline-block;
      position: relative;
      width: 64px;
      height: 10px;
      margin-left: auto;
      margin-right: auto;
    }

    .lds-ellipsis div {
      position: absolute;
      top: 0px;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: rgb(50, 50, 50);
      animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }

    .lds-ellipsis div:nth-child(1) {
      left: 6px;
      animation: lds-ellipsis1 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(2) {
      left: 6px;
      animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(3) {
      left: 26px;
      animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(4) {
      left: 45px;
      animation: lds-ellipsis3 0.6s infinite;
    }

    @keyframes lds-ellipsis1 {
      0% {
        transform: scale(0);
      }

      100% {
        transform: scale(1);
      }
    }

    @keyframes lds-ellipsis3 {
      0% {
        transform: scale(1);
      }

      100% {
        transform: scale(0);
      }
    }

    @keyframes lds-ellipsis2 {
      0% {
        transform: translate(0, 0);
      }

      100% {
        transform: translate(19px, 0);
      }
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- tandai -->
  <!-- Google Font -->
  <!--  <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/font.css">  -->
  <!-- jQuery 3 -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script language="JavaScript" type="text/javascript" src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script language="JavaScript" type="text/javascript" src="<?php echo $this->config->item('assets_url'); ?>assets/js/dataTables.bootstrap4.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php
    // print_r($_SESSION);
    // if ( $_SESSION['role'] == ''){

    //   $this->session->set_flashdata('session_habis', 'Silakan login kembali');
    //   header("location: ".$this->config->item('base_url')."login/logout");

    // }
    // $this->session->set_flashdata('msgalert', 'Update success');
    // print_r($_SESSION["user_data"]);
    echo $header;
    if ($_SESSION["user_data"]["status"] == 1) {
      echo $left_coloumn;
      echo $content;
      echo $footer;
    } else { ?>
      <div style="padding-top: 200px;text-align: center;background: #fff;font-weight: bold;font-size: 18px;">
        <center> Akun anda sudah dinonaktifkan, Silahkan hubungi pihak yang terkait untuk info lebih lanjut</center>
      </div>
    <?php }
    //echo $control_sidebar;
    ?>
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <!--<div class="control-sidebar-bg"></div>-->
  </div>
  <!-- ./wrapper -->
  <!-- FastClick -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap  -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- date-range-picker -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/chart.js/Chart.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/dist/js/pages/dashboard2.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo $this->config->item('assets_url'); ?>assets/dist/js/demo.js"></script>


  <script src="<?php echo $this->config->item('assets_url'); ?>assets/tinymce/tinymce.min.js"></script>


  <script src="<?php echo $this->config->item('assets_url'); ?>assets/tinymce/js/tinymce/plugins/codesample/plugin.min.js"></script>

  <script>
    $(function() {
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      });
      $('#datepicker2').datepicker({
        autoclose: true
      });
    })
  </script>



  <script type="text/javascript">
    var redeem_counter = 0;
    var domain_name = window.location.href.substr(0, window.location.href.lastIndexOf("index.php"));

    function downloadreportpoin(data) {
      // var values = "amount="+ data.getAttribute("amount") + "&id="+ data.getAttribute("id")  + "&point="+ data.getAttribute("point") + "&merchant_id=" + data.getAttribute("merchant_id") + "&merchant_name=" + data.getAttribute("merchant_name")+ "&phone=" + data.getAttribute("phone")+ "&email=" + data.getAttribute("email") + "&input-verification-code=" + document.getElementsByName("input-verification-code")[0].value;

      if (redeem_counter == 0) {
        data.innerHTML = '<center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center>';
      }
      redeem_counter += 1;
      // Disable all button to prevent multople redeem
      $('.downloadreportpoin').prop('disabled', true);
      $.ajax({
        url: domain_name + "index.php/reportpoin/download",
        type: "get",

        success: function(response) {
          window.location.href = domain_name + "index.php/reportpoin/download";


        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
  </script>


  <script>
    tinymce.init({
      selector: "textarea.editor",
      setup: function(editor) {
        editor.on('change', function() {
          editor.save();
        });
      },
      editor_deselector: "mceNoEditor",
      skin: "lightgray",
      content_css: "<?php echo $this->config->item('assets_url'); ?>assets/css/bootstrap.min.css,<?php echo $this->config->item('assets_url'); ?>assets/css/font-awesome.min.css",
      plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager",
        "code fullscreen youtube autoresize codemirror codesample"
      ],
      menubar: false,
      toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent table",
      toolbar2: "| fontsizeselect | styleselect | link unlink anchor | responsivefilemanager image media youtube | forecolor backcolor | code codesample fullscreen ",
      image_advtab: true,
      fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
      relative_urls: false,
      remove_script_host: false,
      force_br_newlines: true,
      force_p_newlines: false,
      forced_root_block: '', // Needed for 3.x
      external_filemanager_path: "<?php echo $this->config->item('assets_url'); ?>assets/js/filemanager/",
      filemanager_title: "File Manager",
      external_plugins: {
        "filemanager": "<?php echo $this->config->item('assets_url'); ?>assets/js/filemanager/plugin.min.js"
      },
      codemirror: {
        indentOnInit: true,
        path: "<?php echo $this->config->item('assets_url'); ?>assets/js/codemirror"
      },
      init_instance_callback: function(editor) {
        editor.on('keyup', function(e) {
          $('#actionNo' + editor.id).prop('disabled', false);
        });
      }
    });
  </script>
  <script type="text/javascript">
    // setTimeout(function(){ document.getElementById('alert').fadeOut(); }, 3000);
    $("#alert").fadeOut();
  </script>
</body>

</html>