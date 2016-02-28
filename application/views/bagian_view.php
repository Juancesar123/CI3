<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- DATA TABLES -->
<!--semua fungsi ajax dan java script modul ini ada disini-->
<!-- DataTables -->
<!-- jQuery 2.1.4 -->
<link rel="stylesheet" href="http://127.0.0.1/CI/plugins/datatables/dataTables.bootstrap.css">
<script src="http://127.0.0.1/CI/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- DataTables -->
<script src="http://127.0.0.1/CI/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://127.0.0.1/CI/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--ajax in here-->
<script type="text/javascript">

	var t = $('#tabel_bagian').DataTable({
			  "autoWidth": false,
			  "rowCallback": function( row, data, index ) {
				  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_bagian[]\" value=\""+data[0]+"\" onclick='handleClick(this);'>");
			  },			  
			  "columnDefs": [
    				{ "width": "5%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 0 },
    				{ "width": "95%", sClass: "dt-head-center dt-body-left", "targets": 1 }
  				]
			});

	function handleClick(cb) {
		var count = t.$('input[name="id_bagian[]"]:checked').length;
		if(count==0){
			$('#tabel_bagian thead input[name="select_all"]').prop("indeterminate", false);
		}else{
			$('#tabel_bagian thead input[name="select_all"]').prop("indeterminate", true);
		}
	}

	function refresh_table_t(table, data){
  	  	$('input[name="select_all"]').prop("indeterminate", false);
  	  	table.clear().draw();
  	  	table.rows.add(data).draw( false );
	}

  	$(document).ready(function(){

	  	t.order( [ 1, 'desc' ] ).draw(false);
		$(function(){
			$.ajax({
		      url: "Perencanaan%20Anggaran/Bagian/Tabel%20Bagian",                          
		      data: "", 
		      dataType: "json",                         
	      	  success: function(data){
		        refresh_table_t(t, data);
			  }
			})
		});

		$('#tabel_bagian thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    t.$('input[name="id_bagian[]"]:not(:checked)').trigger('click');
		    } else {
		    	t.$('input[name="id_bagian[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});

		$("#tambah_form").click(function(){
			$("#nama_bagian").val("");
		});

	    $('#simpan').on( 'click', function () {
	 		var nama_bagian =$("#nama_bagian").val();
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Bagian/Tambah%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
			        data.append("nama_bagian", nama_bagian);
			        return data;
		        }(),
		        success:function(data){
		        	refresh_table_t(t, data);
		        	alert('Data berhasil disimpan!');
				}
			})
	    });	

		$("#ubah").click(function(){
			var edit_id_bagian = new Array();
			$('input[name="edit_id_bagian[]"]').each(function() {
				edit_id_bagian.push($(this).val());
			});		

			var edit_nama_bagian = new Array();
			$('input[name="edit_nama_bagian[]"]').each(function() {
				edit_nama_bagian.push($(this).val());
			});	

			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Bagian/Ubah%20Data%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("edit_id_bagian", edit_id_bagian);
		            data.append("edit_nama_bagian", edit_nama_bagian);
		            return data;
	            }(),
	            success:function(data){
		        	refresh_table_t(t, data);
	            	alert("Data berhasil diubah!");
				}
			})
		});	

		$("#ubah_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_bagian[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Perencanaan%20Anggaran/Bagian/Ubah%20Data%20Form",
					data:"id_bagian_array="+idArray,
					success:function(data){
						$("#pop_up_edit").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;

			}
		});	


		$("#hapus").click(function(){
			var delete_id_bagian = new Array();
			$('input[name="delete_id_bagian[]"]').each(function() {
				delete_id_bagian.push($(this).val());
			});		

			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Bagian/Hapus%20Data%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("delete_id_bagian", delete_id_bagian);
		            return data;
	            }(),
	            success:function(data){
		        	refresh_table_t(t, data);
	            	alert("Data berhasil dihapus!");
				}
			})
		});	

		$("#hapus_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_bagian[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Perencanaan%20Anggaran/Bagian/Hapus%20Data%20Form",
					data:"id_bagian_array="+idArray,
					success:function(data){
						$("#pop_up_delete").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;

			}
		});			

	});	 
</script>

<section class="content-header">
  <h1>
    Bagian
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Laman Muka</a></li>
    <li><a href="#"><i class="fa fa-table">Perencanaan Anggaran</i></a></li>
    <li><a href="#"><i class="fa fa-circle-o">Bagian</i></a></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<!-- box box-primary -->
			<div class="box box-primary">
				<!-- box-header -->
				<div class="box-header with-border">
					<button class="btn btn-primary " id="tambah_form" data-toggle="modal" data-target="#mymodaladd"><i class="fa fa-plus"></i>Tambah</button>
					<button class="btn btn-success" id="ubah_form" data-toggle="modal" data-target="#mymodaledit"><i class="fa fa-pencil-square-o"></i>Ubah</button>
					<button class="btn btn-danger" id="hapus_form" data-toggle="modal" data-target="#mymodaldelete"><i class="fa fa-trash"></i>Hapus</button>
					<div class="modal fade" id="mymodaladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Tambah Data Bagian</h4>
								</div>
								<div class="modal-body">
				 					<div class="form-group">
				                     	<label for="exampleInputEmail1" >Bagian</label>
				                     	<input type="text" class="form-control" id="nama_bagian" placeholder="Masukan nama bagian">
				                    </div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary " id="simpan" data-dismiss="modal">Simpan</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="mymodaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Ubah Data Bagian</h4>
								</div>
								<div class="modal-body">
									<div id="pop_up_edit">
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="ubah" data-dismiss="modal">Ubah</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="mymodaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Hapus Data Bagian</h4>
								</div>
								<div class="modal-body">
									<div id="pop_up_delete">
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="hapus" data-dismiss="modal">Hapus</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /box-header -->
				<!-- view data -->
                <div class="box-body">
					<table id="tabel_bagian" class="table table-bordered table-striped">
			        <thead>
			            <tr>
			                <th><input name="select_all" value="1" type="checkbox"></th>
			                <th>Bagian</th>
			            </tr>
			        </thead>
			        <tfoot>
			        </tfoot>
	              </table>                   
                </div><!-- /.box-body -->
				<!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div> <!-- /.row -->
</section><!-- /.content -->

