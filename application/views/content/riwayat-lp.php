<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">  
    <meta name="author" content="">
    <title>Serbu BTN - Bank Tabungan Negara</title>
    <!-- Custom fonts for this theme -->
    <link href="<?php echo base_url() ?>assets/v2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Theme CSS -->
    <link href="<?php echo base_url() ?>assets/v2/css/themes.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/v2/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/v2/css/slick-theme.css"/>
    
    
    <link href="<?php echo base_url() ?>assets/v2/css/additional.css?v=<?php echo uniqid(); ?>" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/v2/css/loader.css" rel="stylesheet">

</head>
<body id="riwayatvoucher" class="backoffice">
    
    <?php  require 'navbar-dashboard.php';?>

    <section id="batas"></section>

    <?php require 'leftslider.php'; ?>


    <div class="content">
        <section class="riwayatvoucher">
            <div class="bg-bo-left"><img src="<?php echo base_url() ?>assets/v2/img/bg-bo-left.png" /></div>
            <div class="pointin">
                <div class="text-title">Riwayat Voucher</div>
                <div class="row">
                    <div class="search-box">
                        <div class="form-group-box">
                         
                            <form method="get">
                            <div class="text-label"></div>
                            <input name="search" type="text" placeholder="Cari Merchant..">
                        </form>
                        </div>
                       
                    </div>

                    <div class="search-box row">
                         <div class="form-group-box" style="flex: 1;width: 30%;">
                            <div class="row" style="display: flex;align-items: center;">
                                <div class="col-sm-6">
                                    <div style="    font-size: 0.9em;" class="text-label">Urut Berdasarkan</div>
                                </div>
                                <div class=" col-sm-6">
                                    <div class="dropdown show">
                                        <a class="btn " style="width: 154px;background: rgb(255,255,255);border:1px solid rgb(230,230,230);border-radius: 100px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php 
                                                if (isset($_GET["order"])) {
                                                   if ($_GET["order"] =="highest" ) {
                                                       echo "Tertinggi";
                                                    }elseif ($_GET["order"] =="lowest" ) {
                                                       echo "Terendah";
                                                    }elseif ($_GET["order"] =="oldest" ) {
                                                       echo "Terlama";
                                                    }elseif ($_GET["order"] =="latest" ) {
                                                       echo "Terbaru";
                                                    }                                        
                                                } else{ 
                                                    echo "Terbaru";
                                                }
                                            ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="<?php if(isset($_GET["search"])) { echo base_url()."index.php/merchants/?search=". $_GET["search"] ."&order=latest"; } else{ echo "?order=latest"; } ?>">Terbaru</a>
                                            <a class="dropdown-item" href="<?php if(isset($_GET["search"])) { echo base_url()."index.php/merchants/?search=". $_GET["search"] ."&order=oldest"; } else{ echo "?order=oldest"; } ?>">Terlama</a>
                                            <a class="dropdown-item" href="<?php if(isset($_GET["search"])) { echo base_url()."index.php/merchants/?search=". $_GET["search"] ."&order=lowest"; } else{ echo "?order=lowest"; } ?>">Terendah</a>
                                            <a class="dropdown-item" href="<?php if(isset($_GET["search"])) { echo base_url()."index.php/merchants/?search=". $_GET["search"] ."&order=highest"; } else{ echo "?order=highest"; } ?>">Tertinggi</a>
                                          </div>
                                    </div>
                                </div>
                            </div>                   
                        </div>
                    </div>
                </div>
                <div class="riwayat-voucher-list"> 
                    



                    <?php   if(!is_object($kuponku)){?>
                               
                        <?php foreach(array_chunk($kuponku, 10) as $index=>$chunk) { ?>

                            <div class="riwayat-voucher-list row-berita" id="row<?php echo $index;?>"  style="<?php echo $index > 0 ? 'display:none' : '';?>"> 
                                <?php for($i=0 ; $i < count($chunk); $i++){ ?>
                                    <div style="cursor: pointer;" class="riwayat-voucher-item" data-toggle="modal" data-target="#DetailVoucher-<?php echo $kuponku[$i]->giift_dmo_id;?>">
                                        <div class="riwayat-voucher-image">
                                            <img src="<?php print_r($kuponku[$i]->giift_img_new); ?>" />
                                        </div>
                                        <div class="desc">
                                            <div class="title">
                                                <?php echo $chunk[$i]->giift_name; ?>
                                            </div>
                                            <div class="poin"><?php print_r(number_format($chunk[$i]->redeem_poin,0,",",".")) ?> Poin</div>
                                            <div class="kode_voucher">Kode Voucher : <?php echo $chunk[$i]->giift_number; ?></div>
                                            <div class="datetime"><img src="<?php echo base_url() ?>assets/v2/img/clock.png" /> <?php echo date("d F Y", strtotime($chunk[$i]->redeem_date)); ?></div>
                                        </div>
                                    </div>



                                         <!-- Modal content-->
                                            <div id="DetailVoucher-<?php echo $chunk[$i]->giift_dmo_id;?>" class="modal fade penukaranvoucherpopup" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo $chunk[$i]->giift_name; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                                            <div class="modal-body" style="padding-top: 0">
                                                        <p class="title2"><center><img id="tukarPoinImg" src="<?php print_r($kuponku[$i]->giift_img); ?>" /></center></p>
                                                        <div><p class="title2 poin"><?php print_r(number_format($chunk[$i]->redeem_poin,0,",",".")) ?> Poin</p></div>
                                                        <p class="title2" style="text-align: justify;
                                            text-justify: inter-word;"><?php echo $this->Portal_model->merchant_giift_by_dmo_id($chunk[$i]->giift_dmo_id)[0]['description']; ?></p>
                                                        <p class="title2" style="text-align: justify;
                                            text-justify: inter-word;"><?php echo $this->Portal_model->merchant_giift_by_dmo_id($chunk[$i]->giift_dmo_id)[0]['tc']; ?></p>
                                                        <div>   
                                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>



                                <?php } ?>
                            </div>

                            <?php  }  ?>    



				
           
                </div>
            </div> 
            
            <!--  -->
           <div class="pagination">  
            <ul>
                <?php foreach(array_chunk($kuponku, 10) as $index=>$page) { ?>
                    <li><a onclick="Pagination(<?php echo $index; ?>)" class="paginga page<?php echo $index; ?> <?php echo $index == 0 ? 'active' : '' ?>" style="cursor:pointer"><?php echo $index + 1;?></a></li>
                <?php } ?>  
            </ul>
            </div>
            <?php }else{  ?>  
                    <hr>
                    <center>Kamu tidak mempunyai riwayat voucher</center>
            
             <?php } ?>
            
          
        </section>
    </div>
    <?php require 'menu-bottom-float.php' ?>
   

    <?php  require 'footer_dashboard.php';?>
    <style>
    .penukaranvoucherpopup h4.modal-title, #tukarPoinSuccess h4.modal-title, #tukarVoucherSuccess h4.modal-title {
    font-size: 39px;
    color: #005e96;
    font-family: 'Museo-700';
    text-align: center;
    border-bottom: 1px solid #efefef;
    display: block;
    width: 100%;
    }
p.poin {
    font-family: 'Roboto-Medium';
    color: #d80b00;
    font-size: 15px;
}
    </style>


<script>
    function Pagination(page) {
        if(!$('#row' + page + '').is(":visible")) {
            $('.paginga').removeClass('active');
            $('.page' + page + '').addClass('active');
            $('.row-berita').hide();
            $('#row' + page + '').show();
        };
    }
</script>

</body>
</html>