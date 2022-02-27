Content Wrapper. Contains page content -->

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Member
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Member</a></li>
        <li class="active">List</li>
      </ol>

    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
    		<div class="col-xs-12">

          <?php  if ($_SESSION['user_data_web']['role'] == 4){
            echo "";
        }else if ($_SESSION['user_data_web']['role'] == 5){
            echo "";
        }else{ ?>

            <div style="float: right"><a href="<?php echo $this->config->item('base_url')?>member/create" class="btn btn-app">
             <i class="fa fa-plus"></i> Input</a></div>
             <div style="float: right"><a href="<?php echo $this->config->item('base_url')?>member/download" class="btn btn-app">
             <i class="fa fa-download"></i> Download</a></div>

		<?php
        } ?>

    		</div>
	        <div class="col-xs-12">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<?php if($this->session->flashdata('msgalert')){ ;?>
						<div class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('msgalert');

                        ?></strong>
						</div>
						<?php } ;?>
		              	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
								<th>Name</th>

		                  		<th>Cif</th>
		                  		<th>Phone</th>
		                  		<!-- <th>Rekening</th> -->
								<!-- <th id="sorting_data();">Point</th> -->
                                <th>Action</th>
							</tr>
                          </thead>
                          <!-- <tfoot>
                                <th>Name</th>
                                <th>Cif</th>
		                  		<th>Phone</th>
		                  		<th>Rekening</th>
								<th>Point</th>

                          </tfoot> -->
						</table>
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
	    </div>
	</section>

    <!-- End Main content -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // $('#member tfoot th').each( function(){
        //     var title =$(this).text();
        //     $(this).html('<input type="text" palceholder="search'+title+'"/>')
        // });
        // $('#member').dataTable( {
        //     language: {
        //         search: "_INPUT_",
        //         searchPlaceholder: "Search..."
        //     }
        // } );


       var table = $('#member').dataTable( {

        // aaSorting: [[4, 'asc']],
        // bPaginate: false,
        // bFilter: false,
        // bInfo: false,
        // bSortable: true,
        // bRetrieve: true,
            "DeferRender": true,
            "processing": true,
            "serverSide": true,
            "bFilter": true,
            // "order" : [columnIndex, "asc|desc"],
            // "order" : [3, "asc|desc"],
            // "order" : [4, "asc"],
            // "order": [[ 0, 'asc' ], [ 4, 'asc' ]],



        // "sDOM":'<"top"i>rt<"bottom"flp><"clear">',
            "ajax": "<?php echo $this->config->item('base_url'); ?>report/datatables_member",
            "type": "GET",
            // "order": [[ 4, "desc" ]],

            "lengthMenu": [[25, 50, 200, -1], [25, 50, 200, "All"]],
            "blengthMenu": [[25, 50, 200, -1], [25, 50, 200, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Name, Cif or Phone Number",
                processing: "<div style='margin-top: 20%;'><b>LOADING</b></div>"
            },




        aaSorting: [[3, 'desc']],

        } );

        // table.columns().every(function (){
        //     var that =this;
        //     $('input',this.footer()).on('keyup change', function(){
        //         if(that.search()!==this.value){
        //             that.search(this.value).draw();
        //         }
        //     })
        // })

        // $('#member').dataTable( {
        //     language: {
        //         searchPlaceholder: "Search records"
        //     }
        // } );



    } );
    $(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
    function sorting_data(){
        alert("wqdqwd");
    }
</script>
<!-- End Content Wrapper. Contains page content
