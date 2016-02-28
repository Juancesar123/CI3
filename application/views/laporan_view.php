<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!--semua fungsi ajax dan java script modul ini ada disini-->
<!-- DataTables -->
<link rel="stylesheet" href="http://127.0.0.1/CI/plugins/datatables/dataTables.bootstrap.css">
<!-- jQuery 2.1.4 -->
<script src="http://127.0.0.1/CI/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTables -->
<script src="http://127.0.0.1/CI/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://127.0.0.1/CI/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--ajax in here-->
<script src="http://127.0.0.1/CI/dist/js/autoNumeric.js"></script>
<!--ajax in here-->
<script type="text/javascript">
jQuery(function($) {
    $('.auto').autoNumeric('init');
});
</script>

<script>
	var t = $('#tabel_rencana_perbagian').DataTable({
		  	"autoWidth": false,
			"rowCallback": function( row, data, index ) {
			  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_rencana_per_bagian[]\" value=\""+data[0]+"_"+data[1]+"_"+data[2]+"\" onclick='handleClick(this);'>");
			},
		  	"columnDefs": [
				{ "width": "5%", sClass: "dt-head-center dt-body-right", "bSortable": false, "targets": 0},
				{ "width": "15%", sClass: "dt-head-center dt-body-center", "targets": 1},
				{ "width": "30%", sClass: "dt-head-center dt-body-left", "targets": 2},
				{ "width": "30%", sClass: "dt-head-center dt-body-left", "targets": 3},
				{ "width": "35%", sClass: "dt-head-center dt-body-center", "targets": 4}
				]
			});

	var tabel_show_detail = $('#tabel_show_detail_rencana_perbagian').DataTable({
		"autoWidth": false,
		"rowCallback": function( row, data, index ) {
		  var numFormat = $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ).display;
		  var hasil = data[3] - data[4];
		  var realisasi = (data[4]/data[3])*100;
		  $('td:eq(4)', row).text(numFormat(hasil));
		  $('td:eq(5)', row).text(realisasi);
		},		
		"columnDefs": [
			{ "width": "3%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 0},
			{ "width": "7%", sClass: "dt-head-center dt-body-center", "targets": 1},
			{ "width": "35%", sClass: "dt-head-center dt-body-justify", "targets": 2},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 3},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 4},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 5},
			{ "width": "10%", sClass: "dt-head-center dt-body-center", "targets": 6},
			{ "width": "15%", sClass: "dt-head-center dt-body-justify", "targets": 7}
			]
		});

	function refresh_table_t( table, data){
		//alert(JSON.stringify(data));
		$('input[name="select_all"]').prop("indeterminate", false);
  	  	table.clear().draw();
  	  	table.rows.add(data).draw( false );
	}

	/*
	function refresh_t( table, data) {
	    //alert(JSON.stringify(data));
		table.clear().draw();
		for(var i=0; i<data.length; i++){
	    	table.row.add( [data[i].id,"<input type=\"checkbox\" name=\"id_rencana_per_bagian[]\" value=\""+data[i].id+"_"+data[i].tahun_anggaran+"_"+data[i].bagian+"\" onclick='handleClick(this);' >",data[i].tahun_anggaran,data[i].bagian,data[i].update_by,data[i].update_at] ).draw( false );
		}
	}*/	

	function refresh_tabel_tabel_show_detail( table, data) {
	    //alert(JSON.stringify(data));
		table.clear().draw();
		for(var i=0; i<data.length; i++){
      		table.row.add( [data[i].id,data[i].kode,data[i].mata_anggaran,data[i].total_dana,data[i].total_penerimaan_dana,0,data[i].catatan] ).draw( false );
		}
	}			

	function handleClick(cb) {
		var count = t.$('input[name="id_rencana_per_bagian[]"]:checked').length;
		if(cb.checked){
			if(count>1){
				t.$('input[name="id_rencana_per_bagian[]"]:checked').attr('checked', false);
				cb.checked = true;
			}
			var info_arr = cb.value.split("_"); 
			$('#show_detail_rencana_perbagian').show();
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Detail%20Data%20Form2",
				data:"id_rencana_per_bagian="+info_arr[0], 
				dataType: "json",  
				success:function(data){
					$('#show_detail_tahun_anggaran').val(info_arr[1]);
					$('#show_id_detail_tahun_anggaran').val(info_arr[0]);
					$('#show_detail_bagian').val(info_arr[2]);
					$('#l_show_detail_tahun_anggaran').text(info_arr[1]);
					$('#l_show_detail_bagian').text(info_arr[2]);
					refresh_table_t( tabel_show_detail, data);
					data_rencana_anggaran = data;
				}
			});
			$.ajax({
				type:"POST",
				url:"Pengawasan%20Anggaran/Laporan/Tabel%20Laporan",
				data:"id_rencana_per_bagian="+info_arr[0], 
				success:function(data){
					$("#all_pengajuan_baru").html(data);
				}
			});
		}
	}	

	$(document).ready(function(){
		$('#show_detail_rencana_perbagian').hide();

	  	t.order( [ 1, 'desc' ] ).draw(false);
	  	//t.column(0).visible( false );

		tabel_show_detail.order( [ 1, 'asc' ] ).draw(false);
	    tabel_show_detail.column(0).visible( false );

		$(function(){
			$.ajax({
		      url: "Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tabel%20Rencana%20Perbagian",                          
		      data: "", 
		      dataType: "json",                         
	      	  success: function(data){
	      	  	refresh_table_t( t, data);
			  }
			})
		});
});	    

</script>

<section class="content-header">
  <h1>
    Laporan
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Laman Muka</a></li>
    <li><a href="#"><i class="fa fa-edit">Pengawasan</i></a></li>
    <li><a href="#"><i class="fa fa-circle-o">Laporan</i></a></li>
  </ol>
</section>
<section class="content">

	<div class="row">
		<div class="col-xs-12">
			<!-- box box-primary -->
			<div class="box box-primary">
				<!-- view data -->
				 <div class="box-body">
				 	<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Silahkan pilih satu tahun anggaran.</h4>
					</div>
					<div class="modal-body">
						<table id="tabel_rencana_perbagian" class="table table-bordered table-striped">
			            	<thead>
			                	<tr>
			                    	<th width="10"></th>         
			                        <th>Tahun anggaran</th>
			                        <th>Bagian</th>
			                        <th>Update by</th>
			                        <th>Update at</th>
			                    </tr>
			                </thead>
			                <tbody>
							</tbody>
			                <tfoot>
			                </tfoot>
			            </table>	              
               		</div>
               </div><!-- /.box-body -->
				<!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div> <!-- /.row -->	

	<div class="row" id="show_detail_rencana_perbagian">
		<div class="col-xs-12">
			<!-- box box-primary -->
			<div class="box box-primary">

				<div class="modal-content">
					<div class="modal-body">
	 					<div class="form-group">
	                     	<label for="info">Tahun anggaran</label>&nbsp;:&nbsp;<label for="info" id="l_show_detail_tahun_anggaran"></label>
	                     	<input type="hidden" class="form-control" id="show_id_detail_tahun_anggaran">
	                     	<input type="hidden" class="form-control" id="show_detail_tahun_anggaran">
	                    </div>
						<div class="form-group">
	                      	<label for="info">Bagian</label>&nbsp;:&nbsp;<label for="info_long" id="l_show_detail_bagian"></label>
	                      	<input type="hidden" class="form-control" id="show_detail_bagian">
	                    </div>
					</div>
					<!-- view data --> <!-- ini view tabelnya search ubahyayayayaya -->
	                <div class="box-body">
	                	<table id="tabel_show_detail_rencana_perbagian" class="table table-bordered table-striped">
			            	<thead>
			                	<tr>
			                        <th></th>
			                        <th>Kode</th>
			                        <th>Mata anggaran</th>
			                        <th>Total dana</th>
			                        <th>Total penerimaan dana</th>
			                        <th>Sisa dana</th>
			                        <th>Realisasi (%)</th>
			                        <th>Catatan</th>
			                    </tr>
			                </thead>
			                <tbody>
							</tbody>
			                <tfoot>
			                </tfoot>
			            </table>
	                </div><!-- /.box-body -->
				</div><!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div>
	<!-- /.row -->	

	<div class="row" >
		<div class="col-xs-12" id="all_pengajuan_baru">
		</div><!--/.col (right) -->
	</div>
	<!-- /.row -->		

</section><!-- /.content -->
