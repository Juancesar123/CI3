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

<script>

	var t = $('#tabel_manajemen_pengguna').DataTable({
		"autoWidth": false,
		"rowCallback": function( row, data, index ) {
		  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_manajemen_pengguna[]\" value=\""+data[0]+"\" onclick='handleClick(this);'>");
		  $('td:eq(1)', row).html("<img  class=\"btn\" id=\"change_picture\" onclick='handleChangeImage(this);' data-id =\""+data[6]+"\" data-foto_path =\""+data[1]+"\" data-toggle=\"modal\" data-target=\"#mymodalchangeimage\" src=\""+data[1]+"\" >");
		},
		"columnDefs": [
			{ "width": "5%", sClass: "dt-head-center dt-body-right", "bSortable": false, "targets": 0 },
			{ "width": "10%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 1 },
			{ "width": "30%", sClass: "dt-head-center dt-body-left", "targets": 2 },
			{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 3 },
			{ "width": "20%", sClass: "dt-head-center dt-body-left", "targets": 4 }
			]
	});

	var t_del = $('#tabel_delete_manajemen_pengguna').DataTable({
		"autoWidth": false,
		"rowCallback": function( row, data, index ) {
		  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_delete_manajemen_pengguna[]\" value=\""+data[0]+"\" onclick='handleDeleteClick(this);'>");
		  $('td:eq(1)', row).html("<img  class=\"btn\" id=\"change_picture\" onclick='handleChangeImage(this);' data-id =\""+data[6]+"\" data-foto_path =\""+data[1]+"\" data-toggle=\"modal\" data-target=\"#mymodalchangeimage\" src=\""+data[1]+"\" >");
		},
		"columnDefs": [
			{ "width": "5%", sClass: "dt-head-center dt-body-right", "bSortable": false, "targets": 0 },
			{ "width": "10%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 1 },
			{ "width": "30%", sClass: "dt-head-center dt-body-left", "targets": 2 },
			{ "width": "20%", sClass: "dt-head-center dt-body-center", "targets": 3 },
			{ "width": "20%", sClass: "dt-head-center dt-body-left", "targets": 4 }
			]
	});

	function refresh_table_t(table, data){
  	  	$('input[name="select_all"]').prop("indeterminate", false);
  	  	table.clear().draw();
  	  	table.rows.add(data).draw( false );
	}

	function handleClick(cb) {
		var count = t.$('input[name="id_manajemen_pengguna[]"]:checked').length;
		if(count==0){
			$('#tabel_manajemen_pengguna thead input[name="select_all"]').prop("indeterminate", false);
			$('#tabel_manajemen_pengguna thead input[name="select_all"]').prop("checked", false);
		}else{
			$('#tabel_manajemen_pengguna thead input[name="select_all"]').prop("indeterminate", true);
		}
	}

	function handleDeleteClick(cb) {
		var count = t_del.$('input[name="id_delete_manajemen_pengguna[]"]:checked').length;
		if(count==0){
			$('#tabel_delete_manajemen_pengguna thead input[name="select_all"]').prop("indeterminate", false);
			$('#tabel_delete_manajemen_pengguna thead input[name="select_all"]').prop("checked", false);
		}else{
			$('#tabel_delete_manajemen_pengguna thead input[name="select_all"]').prop("indeterminate", true);
		}
	}	

	function handleChangeImage(img) {
		var id_biodata = $(img).data("id");
		var foto_path = $(img).data("foto_path");
		$.ajax({
			type:"POST",
			url:"Manajemen%20Pengguna/Ubah%20Gambar%20Form",
			data:"id_biodata="+id_biodata+"&foto_path="+foto_path,
			success:function(data){
				$("#pop_up_change_image").html(data);
			}
		});
	}	

	$(document).ready(function(){

		var src = "";
	  	t.order( [ 1, 'desc' ] ).draw(false);
	  	t.column(6).visible( false );
		t_del.order( [ 1, 'desc' ] ).draw(false);

		$('#restore_display').hide();
		

		$('#tutup_restore').on( 'click', function () {
			$('#restore_display').hide();
		});

		$('#restore_form').on( 'click', function () {
			$('#restore_display').show();
			$.ajax({
		      url: "Manajemen%20Pengguna/Tabel%20Delete%20Manajemen%20Pengguna",                          
		      data: "", 
		      dataType: "json",                         
	      	  success: function(data){
	      	  	refresh_table_t(t_del, data);
			  }
			})
		});

		$(function(){
			$.ajax({
		      url: "Manajemen%20Pengguna/Tabel%20Manajemen%20Pengguna",                          
		      data: "", 
		      dataType: "json",                         
	      	  success: function(data){
	      	  	refresh_table_t(t, data);
			  }
			})
		});

		$('#tabel_manajemen_pengguna thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    t.$('input[name="id_manajemen_pengguna[]"]:not(:checked)').trigger('click');
		    } else {
		    	t.$('input[name="id_manajemen_pengguna[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});

		$('#tabel_delete_manajemen_pengguna thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    t_del.$('input[name="id_delete_manajemen_pengguna[]"]:not(:checked)').trigger('click');
		    } else {
		    	t_del.$('input[name="id_delete_manajemen_pengguna[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});		

		$('#nama_lengkap').on('keydown', function(e) {
		    var email = $("#email").val();
			$("#username").val(email);
			$("#password").val(email);
		});

		$("#tambah_form").click(function(){
			$("#nama_lengkap").val("");
			$("#nama_panggilan").val("");
			$("#tempat_lahir").val("");
			$("#tanggal_lahir").val("");
			$("#alamat").val("");
			$("#jenis_kelamin").val("Pria");
			$("#no_telepon").val("");
			$("#no_hp").val("");
			$("#no_fax").val("");
			$("#email").val("");
			$("#username").val("");
			$("#password").val("");
			$("#level").val("USER");
			$("#foto").val("");
		});

	    $('#simpan').on( 'click', function () {
			var nama_lengkap = $("#nama_lengkap").val();
			var nama_panggilan = $("#nama_panggilan").val();
			var tempat_lahir = $("#tempat_lahir").val();
			var tanggal_lahir = $("#tanggal_lahir").val();
			var alamat = $("#alamat").val();
			var jenis_kelamin = $("#jenis_kelamin").val();
			var no_telepon = $("#no_telepon").val();
			var no_hp = $("#no_hp").val();
			var no_fax = $("#no_fax").val();
			var email = $("#email").val();
			var foto = $("#foto").get(0).files[0];
			var username = $("#username").val();
			var password = $("#password").val();
			var level = $("#level").val();
			$.ajax({
				type:"POST",
				url:"Manajemen%20Pengguna/Tambah%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("nama_lengkap", nama_lengkap);
		            data.append("nama_panggilan", nama_panggilan);
		            data.append("tempat_lahir", tempat_lahir);
		            data.append("tanggal_lahir", tanggal_lahir);
		            data.append("alamat", alamat);
		            data.append("jenis_kelamin", jenis_kelamin);
		            data.append("no_telepon", no_telepon);
		            data.append("no_hp", no_hp);
		            data.append("no_fax", no_fax);
		            data.append("email", email);
		            data.append("foto", foto);
		            data.append("username", username);
		            data.append("password", password);
		            data.append("level", level);
			        return data;
		        }(),
		        success:function(data){
		        	alert("Data berhasil disimpan!");
		        	refresh_table_t(t, data);
				}
			})
	    });	

		$("#ubah").click(function(){
			var edit_id = new Array();
			$('input[name="edit_id[]"]').each(function() {
				edit_id.push($(this).val());
			});		
			var edit_id_biodata = new Array();
			$('input[name="edit_id_biodata[]"]').each(function() {
				edit_id_biodata.push($(this).val());
			});	
			var edit_nama_lengkap = new Array();
			$('input[name="edit_nama_lengkap[]"]').each(function() {
				edit_nama_lengkap.push($(this).val());
			});
			var edit_nama_panggilan = new Array();
			$('input[name="edit_nama_panggilan[]"]').each(function() {
				edit_nama_panggilan.push($(this).val());
			});	
			var edit_tempat_lahir = new Array();
			$('input[name="edit_tempat_lahir[]"]').each(function() {
				edit_tempat_lahir.push($(this).val());
			});		
			var edit_tanggal_lahir = new Array();
			$('input[name="edit_tanggal_lahir[]"]').each(function() {
				edit_tanggal_lahir.push($(this).val());
			});		
			var edit_alamat = new Array();
			$('input[name="edit_alamat[]"]').each(function() {
				edit_alamat.push($(this).val());
			});		
			var edit_jenis_kelamin = new Array();
			$('select[name="edit_jenis_kelamin[]"]').each(function() {
				edit_jenis_kelamin.push($(this).val());
			});		
			var edit_no_telepon = new Array();
			$('input[name="edit_no_telepon[]"]').each(function() {
				edit_no_telepon.push($(this).val());
			});		
			var edit_no_hp = new Array();
			$('input[name="edit_no_hp[]"]').each(function() {
				edit_no_hp.push($(this).val());
			});		
			var edit_no_fax = new Array();
			$('input[name="edit_no_fax[]"]').each(function() {
				edit_no_fax.push($(this).val());
			});		
			var edit_email = new Array();
			$('input[name="edit_email[]"]').each(function() {
				edit_email.push($(this).val());
			});			
			var edit_level = new Array();
			$('select[name="edit_level[]"]').each(function() {
				edit_level.push($(this).val());
			});	

			$.ajax({
				type:"POST",
				url:"Manajemen%20Pengguna/Ubah%20Data%20Action",
	            contentType: false,
	            processData: false,   
            	enctype: 'multipart/form-data',
		       	dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("edit_id", edit_id);
		            data.append("edit_id_biodata", edit_id_biodata);
		            data.append("edit_nama_lengkap", edit_nama_lengkap);
		            data.append("edit_nama_panggilan", edit_nama_panggilan);
		            data.append("edit_tempat_lahir", edit_tempat_lahir);
		            data.append("edit_tanggal_lahir", edit_tanggal_lahir);
		            data.append("edit_alamat", edit_alamat);
		            data.append("edit_jenis_kelamin", edit_jenis_kelamin);
		            data.append("edit_no_telepon", edit_no_telepon);
		            data.append("edit_no_hp", edit_no_hp);
		            data.append("edit_no_fax", edit_no_fax);
		            data.append("edit_email", edit_email);
		            data.append("edit_level", edit_level);
		            return data;
	            }(),
	            success:function(data){
	            	alert("Data berhasil diubah!");
		        	refresh_table_t(t, data);
				}
			})
		});	

		$("#ubah_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_manajemen_pengguna[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Manajemen%20Pengguna/Ubah%20Data%20Form",
					data:"id_manajemen_pengguna_array="+idArray,
					success:function(data){
						$("#pop_up_edit").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
		});	

		$('#ubah_pp').on( 'click', function () {
			var id_biodata_pic = $("#id_biodata_pic").val();
			var old_foto_path_pic = $("#old_foto_path_pic").val();
			var foto_pic = $("#foto_pic").get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Manajemen%20Pengguna/Ubah%20Gambar%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("id_biodata_pic", id_biodata_pic);
		            data.append("old_foto_path_pic", old_foto_path_pic);
		            data.append("foto_pic", foto_pic);
			        return data;
		        }(),
		        success:function(data){
		        	alert("Gambar berhasil diubah!");
		        	refresh_table_t(t, data);
				}
			})
	    });	

		$("#hapus").click(function(){
			var delete_id = new Array();
			$('input[name="delete_id[]"]').each(function() {
				delete_id.push($(this).val());
			});		
			var delete_id_biodata = new Array();
			$('input[name="delete_id_biodata[]"]').each(function() {
				delete_id_biodata.push($(this).val());
			});	
			var delete_old_foto_path = new Array();
			$('input[name="delete_old_foto_path[]"]').each(function() {
				delete_old_foto_path.push($(this).val());
			});	

			$.ajax({
				type:"POST",
				url:"Manajemen%20Pengguna/Hapus%20Data%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("delete_id", delete_id);
		            data.append("delete_id_biodata", delete_id_biodata);
		            data.append("delete_old_foto_path", delete_old_foto_path);
		            return data;
	            }(),
	            success:function(data){
	            	alert("Data berhasil dihapus secara permanen!");
	            	refresh_table_t(t, data);
				}
			})
		});	

		$("#hapus_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_manajemen_pengguna[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Manajemen%20Pengguna/Hapus%20Data%20Form",
					data:"id_manajemen_pengguna_array="+idArray,
					success:function(data){
						$("#pop_up_delete").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
		});	

		$("#detail").click(function(){ 		
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_manajemen_pengguna[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Manajemen%20Pengguna/Hapus%20Data%20Form",
					data:"id_manajemen_pengguna_array="+idArray,
					success:function(data){
						$("#pop_up_detail").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
		});					

		$("#hapus_temporary").click(function(){
			var delete_id = new Array();
			$('input[name="delete_id[]"]').each(function() {
				delete_id.push($(this).val());
			});		
			$.ajax({
				type:"POST",
				url:"Manajemen%20Pengguna/Hapus%20Data%20Temporary%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("delete_id", delete_id);
		            return data;
	            }(),
	            success:function(data){
	            	alert("Data berhasil dihapus!");
	            	refresh_table_t(t, data);
				}
			})
		});	

		$("#hapus_temporary_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_manajemen_pengguna[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Manajemen%20Pengguna/Hapus%20Data%20Temporary%20Form",
					data:"id_manajemen_pengguna_array="+idArray,
					success:function(data){
						$("#pop_up_temporary_delete").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
		});			

		$("#restore").click(function(){ 		
			var idArray = new Array();
			var tmp;
			t_del.$('input[name="id_delete_manajemen_pengguna[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Manajemen%20Pengguna/Kembalikan%20Data%20Action",
		            contentType: false,
		            processData: false,   
			        dataType: "json",  
					data: function() {
			            var data = new FormData();
			            data.append("id_delete_manajemen_pengguna_array", idArray);
			            return data;
		            }(), 
		        	dataType: "json", 
					success:function(data){
			        	alert("Data berhasil dikembalikan!");
			        	refresh_table_t(t, data);	
						$('#restore_display').hide();            		
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
		Manajemen Pengguna 
		<small>Preview</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>Laman Muka</a></li>
		<li><a href="#"><i class="fa fa-users">Manajemen Pengguna</i></a></li>
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
					<button class="btn btn-info" id="hapus_temporary_form" data-toggle="modal" data-target="#mymodaltemporarydelete"><i class="fa fa-trash-o"></i>Hapus</button>
					<button class="btn btn-default" id="restore_form"><i class="fa fa-refresh"></i>Kembalikan</button>
					<button class="btn btn-danger" id="hapus_form" data-toggle="modal" data-target="#mymodaldelete"><i class="fa fa-trash"></i>Hapus</button>
					<button class="btn btn-warning" id="detail" data-toggle="modal" data-target="#mymodaldetail"><i class="fa fa-eye"></i>Tampilkan</button>

					<div class="modal fade" id="mymodaladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Tambah Data Pengguna</h4>
								</div>
								<div class="modal-body">
									<div class="form-group has-feedback">
										 <label>Data Pribadi</label>
									</div>
				                    <div class="form-group has-feedback">
									 	<label for="manajemenPengguna">Email</label>
				                     	<input type="email" class="form-control" id="email" placeholder="Masukan email">
				                    </div>
				 					<div class="form-group">
				                     	<label for="manajemenPengguna">Nama Lengkap</label>
				                     	<input type="text" class="form-control" id="nama_lengkap" placeholder="Masukan nama lengkap">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Nama Panggilan</label>
				                      	<input type="text" class="form-control" id="nama_panggilan" placeholder="Masukan nama panggilan">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Tempat Lahir</label>
				                      	<input type="text" class="form-control" id="tempat_lahir" placeholder="Masukan tempat lahir">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Tanggal Lahir</label>
				                      	<input type="date" class="form-control" id="tanggal_lahir">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Alamat</label>
				                      	<input type="text" class="form-control" id="alamat" placeholder="Masukan alamat">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Jenis Kelamin</label>
				                      	<select class="form-control" id="jenis_kelamin" size="1">
									  		<option value="Pria">Pria</option>
									  	<option value="Wanita">Wanita</option>
									  	</select>
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Nomor Telpon</label>
				                      	<input type="text" class="form-control" id="no_telepon" placeholder="Masukan nomor telepon">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Nomor Fax</label>
				                      	<input type="text" class="form-control" id="no_fax" placeholder="Masukan nomor fax">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Nomor Handphone</label>
				                      	<input type="text" class="form-control" id="no_hp" placeholder="Masukan nomor handphone">
				                    </div>
									<div class="form-group">
				                      	<label for="manajemenPengguna">Foto</label>
				                      	<input type="file" class="form-control" id="foto">
				                    </div>				
									<br>
									<div class="form-group has-feedback">
										 <label for="manajemenPengguna">Data Akun</label>
									</div>
									<div class="form-group has-feedback">
										<label for="manajemenPengguna">Username</label>
										<input type="text" class="form-control" id="username" placeholder="Generate otomatis mengikuti alamat email" disabled>
									</div>
									<div class="form-group has-feedback">
										<label for="manajemenPengguna">Password</label>
										<input type="password" class="form-control" id="password" placeholder="Generate otomatis mengikuti alamat email" disabled>
									</div>									
									<div class="form-group">
										<label for="manajemenPengguna">Level</label></br>
										<select class="form-control" id="level">
											<option value="USER">User</option>
											<option value="MASTER">Master</option>
											<option value="SPESIAL">Spesial</option>
										</select>
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
									<h4 class="modal-title" id="myModalLabel">Ubah Data Pengguna</h4>
								</div>
								<div class="modal-body" id="pop_up_edit">	
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="ubah" data-dismiss="modal">Ubah</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>

					<div class="modal fade" id="mymodaltemporarydelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Hapus Data Pengguna</h4>
								</div>
								<div class="modal-body" id="pop_up_temporary_delete">	
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="hapus_temporary" data-dismiss="modal">Hapus</button>
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
									<h4 class="modal-title" id="myModalLabel">Hapus Permanen Data Pengguna</h4>
								</div>
								<div class="modal-body" id="pop_up_delete">	
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="hapus" data-dismiss="modal">Hapus</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>	

					<div class="modal fade" id="mymodalchangeimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Ubah gambar profil</h4>
								</div>
								<div class="modal-body" id="pop_up_change_image">	
								</div>	
								<div class="modal-footer">
									<button class="btn btn-success " id="ubah_pp" data-dismiss="modal">Ubah</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>	

					<div class="modal fade" id="mymodaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Detail data pengguna</h4>
								</div>
								<div class="modal-body" id="pop_up_detail">	
								</div>				
							</div>
						</div>
					</div>									

				</div>
				<!-- /box-header -->
				<!-- view data -->
                <div class="box-body" >
					<table id="tabel_manajemen_pengguna" class="table table-bordered table-striped">
	                <thead>
	                <tr>
		              	<th width="10"><input name="select_all" value="1" type="checkbox"></th>
                        <th width="100">Foto</th>
                        <th>Nama lengkap</th>
                        <th>Jenis kelamin</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th></th>
	                </tr>
	                </thead>
	                <tbody>
	               
	                </tbody>
	                <tfoot>
	                </tfoot>
	              </table>                  
                </div><!-- /.box-body -->
				<!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div> <!-- /.row -->

	<div class="row">
		<div class="col-xs-12">
			<!-- box box-primary -->
			<div class="box box-primary" id="restore_display">
				<!-- box-header -->
                <div class="box-body" >
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" id="tutup_restore" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Pilih data yang ingin Anda kembalikan.</h4>
						</div>
						<div class="modal-body">
							<table id="tabel_delete_manajemen_pengguna" class="table table-bordered table-striped">
			                <thead>
			                <tr>
				                <th><input name="select_all" value="1" type="checkbox"></th>
		                        <th>Foto</th>
		                        <th>Nama lengkap</th>
		                        <th>Jenis kelamin</th>
		                        <th>Username</th>
		                        <th>Level</th>
		                        <th></th>
			                </tr>
			                </thead>
			                <tbody>
			               
			                </tbody>
			                <tfoot>
			                </tfoot>
			              </table>     									
						</div>
						<div class="modal-footer">
							<button class="btn btn-success " id="restore" >Kembalikan</button>
						</div>
				</div>
				<!-- /box-header -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div> <!-- /.row -->	
</section><!-- /.content -->


