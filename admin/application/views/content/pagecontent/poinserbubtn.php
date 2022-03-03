<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Poin Serbu Btn
        <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>pagecontent">Page And Content</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <?php print_r($data); ?>
  <section class="content">
    	<div class="row">
	        <div class="col-xs-6">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">
                            
                            <p>Video Youtube</p>
                            <textarea  style="width:100%" name="" id="" cols="60" rows="10"><?php for ($i=0;$i < count($data); $i++){
	                            	if ($data[$i]['param']=='linkyoutube') {
	                            		print_r($data[$i]['text']);
	                            	}
                            	}?>
                            </textarea>
                        </div>
		            	
					
		             
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
            <div class="col-xs-6">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">
                            
                            <p>Tentang</p>
                            <textarea style="width:100%" name="" id="" cols="60" rows="10"><?php for ($i=0;$i < count($data); $i++){
	                            	if ($data[$i]['param']=='tentang') {
	                            		print_r($data[$i]['text']);
	                            	}
                            	}?>
                            	
                            </textarea>
                        </div>
		            	
					
		             
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
	    </div>

        <div class="row">
        <center><h3>Caranya Mudah!</h3></center>
	        <div class="col-xs-3">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">
                            
                          
                           <textarea style="width:100%" name="" id="" cols="25" rows="10"><?php for ($i=0;$i < count($data); $i++){
	                            	if ($data[$i]['param']=='cara1') {
	                            		print_r($data[$i]['text']);
	                            	}
                            	}?></textarea>
                        </div>
		            	
					
		             
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>

            <div class="col-xs-3">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">
                            
                          
                           <textarea style="width:100%" name="" id="" cols="25" rows="10"><?php for ($i=0;$i < count($data); $i++){
	                            	if ($data[$i]['param']=='cara2') {
	                            		print_r($data[$i]['text']);
	                            	}
                            	}?></textarea>
                        </div>
		            	
					
		             
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
            <div class="col-xs-3">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">
                            
                          
                           <textarea style="width:100%" name="" id="" cols="25" rows="10"><?php for ($i=0;$i < count($data); $i++){
	                            	if ($data[$i]['param']=='cara3') {
	                            		print_r($data[$i]['text']);
	                            	}
                            	}?></textarea>
                        </div>
		            	
					
		             
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
            <div class="col-xs-3">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">
                            
                          
                           <textarea  style="width:100%" name="" id="" cols="25" rows="10"><?php for ($i=0;$i < count($data); $i++){
	                            	if ($data[$i]['param']=='cara4') {
	                            		print_r($data[$i]['text']);
	                            	}
                            	}?></textarea>
                        </div>
		            	
					
		             
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
	    </div>


        <div class="row">
	        <div class="col-xs-12">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">
                            <textarea class="tinymce" style="width:100%" name="" id="" cols="100" rows="10"></textarea>
                        </div>
		            	
					
		             
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
           
	    </div>


	</section>

    <!-- End Main content -->
</div>


<!-- End Content Wrapper. Contains page content -->