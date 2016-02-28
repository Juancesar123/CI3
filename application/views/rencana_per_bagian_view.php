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

	var tabel_detail = $('#tabel_detail_rencana_perbagian').DataTable({
		"autoWidth": false,
		"rowCallback": function( row, data, index ) {
		  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_detail_rencana_per_bagian[]\"  onclick='handleClickDetail(this);'  value=\""+data[0]+"\" >");
		},		
		"columnDefs": [
			{ "width": "5%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 0},
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 1},
			{ "width": "50%", sClass: "dt-head-center dt-body-justify", "targets": 2},
			{ "width": "15%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 3},
			{ "width": "25%", sClass: "dt-head-center dt-body-justify", "targets": 4}
			]
		});

	var tabel_restore = $('#tabel_restore_rencana_perbagian').DataTable({
	  	"autoWidth": false,
		"rowCallback": function( row, data, index ) {
		  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_restore_rencana_per_bagian[]\"  onclick='handleClickDetail(this);'  value=\""+data[0]+"\" >");
		},	  	
	  	"columnDefs": [
			{ "width": "5%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 0},
			{ "width": "20%", sClass: "dt-head-center dt-body-left", "targets": 1},
			{ "width": "25%", sClass: "dt-head-center dt-body-left", "targets": 2},
			{ "width": "35%", sClass: "dt-head-center dt-body-left", "targets": 3},
			{ "width": "15%", sClass: "dt-head-center dt-body-center", "targets": 4}
			]
		});

	var tabel_restore_detail = $('#tabel_restore_detail_rencana_perbagian').DataTable({
		"autoWidth": false,
		"rowCallback": function( row, data, index ) {
		  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_restore_detail_rencana_per_bagian[]\" onclick='handleClickDetail(this);'  value=\""+data[0]+"\" >");
		},		
		"columnDefs": [
			{ "width": "5%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 0},
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 1},
			{ "width": "50%", sClass: "dt-head-center dt-body-justify", "targets": 2},
			{ "width": "15%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 3},
			{ "width": "25%", sClass: "dt-head-center dt-body-justify", "targets": 4}
			]
		});
	

	function refresh_table_t( table, data){
		$('input[name="select_all"]').prop("indeterminate", false);
  	  	table.clear().draw();
  	  	table.rows.add(data).draw( false );
	}	

	function handleClickRestore(cb) {
		var count = tabel_restore.$('input[name="id_restore_rencana_per_bagian[]"]:checked').length;
		if(count==0){
			$('#tabel_restore_rencana_perbagian thead input[name="select_all"]').prop("indeterminate", false);
			$('#tabel_restore_rencana_perbagian thead input[name="select_all"]').prop("checked", false);
		}else{
			$('#tabel_restore_rencana_perbagian thead input[name="select_all"]').prop("indeterminate", true);
		}
	}

	function handleClickRestoreDetail(cb) {
		var count = tabel_restore_detail.$('input[name="id_restore_detail_rencana_per_bagian[]"]:checked').length;
		if(count==0){
			$('#tabel_restore_detail_rencana_perbagian thead input[name="select_all"]').prop("indeterminate", false);
			$('#tabel_restore_detail_rencana_perbagian thead input[name="select_all"]').prop("checked", false);
		}else{
			$('#tabel_restore_detail_rencana_perbagian thead input[name="select_all"]').prop("indeterminate", true);
		}
	}	

	function handleClick(cb) {
		if(cb.checked){
			var count = t.$('input[name="id_rencana_per_bagian[]"]:checked').length;
			if(count>1){
				t.$('input[name="id_rencana_per_bagian[]"]:checked').attr('checked', false);
				cb.checked = true;
			}
			var info_arr = cb.value.split("_"); 
			$('#detail_rencana_perbagian').show();
			$('#detail_tahun_anggaran').val(info_arr[1]);
			$('#detail_bagian').val(info_arr[2]);
			$('#detail_id').val(info_arr[0]);
			$('#l_detail_tahun_anggaran').text(info_arr[1]);
			$('#l_detail_bagian').text(info_arr[2]);
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Detail%20Data%20Form",
				data:"id_rencana_per_bagian="+info_arr[0],    
		    	dataType: "json",  
				success:function(data){
					refresh_table_t( tabel_detail, data);
				}
			});
		}
	}

	function handleClickDetail(cb) {
		var count = tabel_detail.$('input[name="id_detail_rencana_per_bagian[]"]:checked').length;
		if(count==0){
			$('#tabel_detail_rencana_perbagian thead input[name="select_all"]').prop("indeterminate", false);
			$('#tabel_detail_rencana_perbagian thead input[name="select_all"]').prop("checked", false);
		}else{
			$('#tabel_detail_rencana_perbagian thead input[name="select_all"]').prop("indeterminate", true);
		}
	}	

	$(document).ready(function(){
		$('#detail_rencana_perbagian').hide();

		$('#restore_rencana_perbagian').hide();

		$('#restore_detail_rencana_perbagian').hide();

	  	t.order( [ 1, 'desc' ] ).draw(false);
	  	//t.column(0).visible( false );

		tabel_detail.order( [ 1, 'asc' ] ).draw(false);
	  	tabel_detail.column(4).visible( false );
	  	tabel_detail.column(5).visible( false );

		tabel_restore.order( [ 1, 'desc' ] ).draw(false);

		tabel_restore_detail.order( [ 1, 'desc' ] ).draw(false);
	  	tabel_restore_detail.column(4).visible( false );
	  	tabel_restore_detail.column(5).visible( false );

		$(function(){
			$.ajax({
		      url: "Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tabel%20Rencana%20Perbagian",   
		      dataType: "json",                         
	      	  success: function(data){
	      	  	refresh_table_t( t, data);
			  }
			})
		});

		$('#tabel_detail_rencana_perbagian thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    tabel_detail.$('input[name="id_detail_rencana_per_bagian[]"]:not(:checked)').trigger('click');
		    } else {
		    	tabel_detail.$('input[name="id_detail_rencana_per_bagian[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});				

		$('#tabel_restore_rencana_perbagian thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    tabel_restore.$('input[name="id_restore_rencana_per_bagian[]"]:not(:checked)').trigger('click');
		    } else {
		    	tabel_restore.$('input[name="id_restore_rencana_per_bagian[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});	


		$('#tabel_restore_detail_rencana_perbagian thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    tabel_restore_detail.$('input[name="id_restore_detail_rencana_per_bagian[]"]:not(:checked)').trigger('click');
		    } else {
		    	tabel_restore_detail.$('input[name="id_restore_detail_rencana_per_bagian[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});	

	    $('#close_detail').on( 'click', function () {
			$('#detail_rencana_perbagian').hide();
			t.$('input[name="id_rencana_per_bagian[]"]:checked').attr('checked', false);		
	    });

	    $('#close_restore').on( 'click', function () {
			$('#restore_rencana_perbagian').hide();
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

	    $('#close_restore_detail').on( 'click', function () {
			$('#restore_detail_rencana_perbagian').hide();	
	    });	    

	    $('#restore_form').on( 'click', function () {
	    	$('#restore_rencana_perbagian').show();
	    	$(function(){
				$.ajax({
			      url: "Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Form",                          
			      data: "", 
			      dataType: "json",                         
		      	  success: function(data){
		      	  	refresh_table_t( tabel_restore, data);
				  }
				})
			});
	    });

	    $('#restore').on( 'click', function () {
			var idArray = new Array();
			var tmp;
			tabel_restore.$('input[name="id_restore_rencana_per_bagian[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Action",
					data:"id_restore_rencana_per_bagian="+idArray,    
		       		dataType: "json",  
					success:function(data){
						$('#restore_rencana_perbagian').hide();
			      	  	refresh_table_t( t, data);	
						alert("Data berhasil dikembalikan!");
					}
				});					
			}else if(idArray.length==0){
				alert('Anda belum memilih data data!');
				return false;
			}
	    });

	    $('#tambah_form').on( 'click', function () {	
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tambah%20Data%20Form",
				success:function(data){
					$("#pop_up_add").html(data);
				}
			})
	    });

    	$('#simpan').on( 'click', function () {
			var tahun_anggaran = $("#tahun_anggaran").val();
			var nama_bagian = $("#nama_bagian").val();
			var file_tahun_anggaran = $("#file_tahun_anggaran").get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tambah%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("tahun_anggaran", tahun_anggaran);
		            data.append("nama_bagian", nama_bagian);
		            data.append("file_tahun_anggaran", file_tahun_anggaran);
			        return data;
		        }(),
		        success:function(data){
	      	  		refresh_table_t( t, data);		     
		        	alert("Data berhasil disimpan!");   	
				}
			})
	    });	    

	    $('#ubah_form').on( 'click', function () {	
			var count = t.$('input[name="id_rencana_per_bagian[]"]:checked').length;
			if(count==1){
				var info_arr = t.$('input[name="id_rencana_per_bagian[]"]:checked').val().split("_"); 
				$.ajax({
					type:"POST",  
					url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Data%20Form", 
					data:"id_tahun_anggaran="+info_arr[0]+"&tahun_anggaran="+info_arr[1]+"&nama_bagian="+info_arr[2],                    
			      	success:function(data){
						$("#pop_up_edit").html(data);
					}
				})
			}else{
				alert("Anda belum memilih data!");
				return false;
			}
	    });

	    $('#ubah').on( 'click', function () {	
			var id = $("#ubah_id_tahun_anggaran").val();
			var tahun_anggaran = $("#ubah_tahun_anggaran").val();
			var nama_bagian = $("#ubah_nama_bagian").val();
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("ubah_id_tahun_anggaran", id);
		            data.append("ubah_tahun_anggaran", tahun_anggaran);
		            data.append("ubah_nama_bagian", nama_bagian);
			        return data;
		        }(),
		        success:function(data){
					$('#detail_rencana_perbagian').hide();
	      	  		refresh_table_t( t, data);	
		        	alert("Data berhasil diubah!");
				}
			})	    	
	    });

	    $('#hapus_temporary_form').on( 'click', function () {	
			var count = t.$('input[name="id_rencana_per_bagian[]"]:checked').length;
			if(count==1){
				var info_arr = t.$('input[name="id_rencana_per_bagian[]"]:checked').val().split("_"); 
				$('#delete_tahun_anggaran').val(info_arr[1]);
				$('#delete_id_tahun_anggaran').val(info_arr[0]);
				$('#delete_nama_bagian').val(info_arr[2]);
			}else{
				alert("Anda belum memilih data!");
				return false;
			}
	    });

	    $('#hapus_sementara').on( 'click', function () {	
			var id = $("#delete_id_tahun_anggaran").val();
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Sementara%20Data%20Action",     
				data:"delete_id_tahun_anggaran="+id,                    
		        dataType: "json",                    
		        success:function(data){
					$('#detail_rencana_perbagian').hide();
					$('#restore_rencana_perbagian').hide();
	      	  		refresh_table_t( t, data);	
		        	alert("Data berhasil dihapus!");
				}
			})
	    });	    

	    $('#hapus_form').on( 'click', function () {	
			var count = t.$('input[name="id_rencana_per_bagian[]"]:checked').length;
			if(count==1){
				var info_arr = t.$('input[name="id_rencana_per_bagian[]"]:checked').val().split("_"); 
				$('#delete_tahun_anggaran_2').val(info_arr[1]);
				$('#delete_id_tahun_anggaran_2').val(info_arr[0]);
				$('#delete_nama_bagian_2').val(info_arr[2]);
			}else{
				alert("Anda belum memilih data!");
				return false;
			}
	    });

	    $('#hapus').on( 'click', function () {	
			var id = $("#delete_id_tahun_anggaran_2").val();
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Data%20Action",     
				data:"delete_id_tahun_anggaran="+id,                    
		        dataType: "json",                    
		        success:function(data){
					$('#detail_rencana_perbagian').hide();
	      	  		refresh_table_t( t, data);	
		        	alert("Data berhasil dihapus!");
				}
			})
	    });	

	    $('#unggah_detail').on( 'click', function () {	
			var detail_id = $("#detail_id").val();
			var file_tahun_anggaran = $("#delete_file_tahun_anggaran").get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Upload%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("detail_id", detail_id);
		            data.append("file_tahun_anggaran", file_tahun_anggaran);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t( tabel_detail, data);
	            	alert("Data berhasil diubah!");
				}
			})		
	    });

	    $('#tambah_detail').on( 'click', function () {	
			var add_id = $("#detail_id").val();
			var add_kode = $("#add_kode").val();
			var add_mata_anggaran = $("#add_mata_anggaran").val();
			var add_total_dana = $("#add_total_dana").autoNumeric('get');
			var add_catatan = $("#add_catatan").val();
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tambah%20Mata%20Anggaran%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("add_id", add_id);
		            data.append("add_kode", add_kode);
		            data.append("add_mata_anggaran", add_mata_anggaran);
		            data.append("add_total_dana", add_total_dana);
		            data.append("add_catatan", add_catatan);
		            return data;
		        }(),
		        success:function(data){
					refresh_table_t( tabel_detail, data); 
	            	alert("Data berhasil disimpan!");
				}
			})		    	
	    });

		$("#ubah_detail_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			tabel_detail.$('input[name="id_detail_rencana_per_bagian[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Mata%20Anggaran%20Form",
					data:"id_detail_rencana_per_bagian_array="+idArray,   
					success:function(data){
						$("#pop_up_edit_detail").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
		});	

		$("#ubah_detail").click(function(){ 		
			var edit_id_mata_anggaran = new Array();
			$('input[name="edit_id_mata_anggaran[]"]').each(function() {
				edit_id_mata_anggaran.push($(this).val());
			});		
			var edit_kode_mata_anggaran = new Array();
			$('input[name="edit_kode_mata_anggaran[]"]').each(function() {
				edit_kode_mata_anggaran.push($(this).val());
			});	
			var edit_mata_anggaran = new Array();
			$('input[name="edit_mata_anggaran[]"]').each(function() {
				edit_mata_anggaran.push($(this).val());
			});
			var edit_total_dana = new Array();
			$('input[name="edit_total_dana[]"]').each(function() {
				edit_total_dana.push($(this).autoNumeric('get'));
			});	
			var edit_catatan = new Array();
			$('input[name="edit_catatan[]"]').each(function() {
				edit_catatan.push($(this).val());
			});	
			
			var edit_id_tahun_anggaran = $('input[name="edit_id_tahun_anggaran"]').val();

			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Mata%20Anggaran%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("edit_id_mata_anggaran", edit_id_mata_anggaran);
		            data.append("edit_kode_mata_anggaran", edit_kode_mata_anggaran);
		            data.append("edit_mata_anggaran", edit_mata_anggaran);
		            data.append("edit_total_dana", edit_total_dana);
		            data.append("edit_catatan", edit_catatan);
		            data.append("edit_id_tahun_anggaran", edit_id_tahun_anggaran);
		            return data;
	            }(),
	            success:function(data){
					refresh_table_t( tabel_detail, data);
	            	alert("Data berhasil diubah!");
				}
			})			
		});			    

		$("#hapus_detail_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			tabel_detail.$('input[name="id_detail_rencana_per_bagian[]"]:checked').each(function() {
				idArray.push($(this).val());
			});

			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Mata%20Anggaran%20Form",
					data:"id_detail_rencana_per_bagian_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
		});	

		$("#hapus_detail").click(function(){ 		
			var delete_id_mata_anggaran = new Array();
			$('input[name="delete_id_mata_anggaran[]"]').each(function() {
				delete_id_mata_anggaran.push($(this).val());
			});		

			var delete_id_tahun_anggaran = $('input[name="delete_id_tahun_anggaran"]').val();

			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Mata%20Anggaran%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("delete_id_mata_anggaran", delete_id_mata_anggaran);
		            data.append("delete_id_tahun_anggaran", delete_id_tahun_anggaran);
		            return data;
	            }(),
	            success:function(data){
					refresh_table_t( tabel_detail, data);	
	            	alert("Data berhasil dihapus!");
				}
			})			
		});		    


		$("#hapus_temporary_detail_form").click(function(){ 		
			var idArray = new Array();
			var tmp;
			tabel_detail.$('input[name="id_detail_rencana_per_bagian[]"]:checked').each(function() {
				idArray.push($(this).val());
			});

			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Mata%20Anggaran%20Form",
					data:"id_detail_rencana_per_bagian_array="+idArray,
					success:function(data){
						$("#pop_up_temporary_delete_detail").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
		});	

		$("#hapus_sementara_detail").click(function(){ 		
			$('#restore_detail_rencana_perbagian').hide();
			var delete_id_mata_anggaran = new Array();
			$('input[name="delete_id_mata_anggaran[]"]').each(function() {
				delete_id_mata_anggaran.push($(this).val());
			});		

			var delete_id_tahun_anggaran = $('input[name="delete_id_tahun_anggaran"]').val();
			//alert(delete_id_tahun_anggaran);
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Sementara%20Mata%20Anggaran%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("delete_id_mata_anggaran", delete_id_mata_anggaran);
		            data.append("delete_id_tahun_anggaran", delete_id_tahun_anggaran);
		            return data;
	            }(),
	            success:function(data){
	            	//alert(JSON.stringify(data));
					refresh_table_t( tabel_detail, data);	
	            	alert("Data berhasil dihapus!");
				}
			})			
		});		

	    $('#restore_detail_form').on( 'click', function () {
	    	$('#restore_detail_rencana_perbagian').show();
			$('#restore_detail_tahun_anggaran').val($('#detail_tahun_anggaran').val());
			$('#restore_detail_bagian').val($('#detail_bagian').val());
			$('#restore_detail_id').val($('#detail_id').val());
			$('#l_restore_detail_tahun_anggaran').text($('#detail_tahun_anggaran').val());
			$('#l_restore_detail_bagian').text($('#detail_bagian').val());
			$.ajax({
				type:"POST",
				url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Detail%20Form",
				data:"id_rencana_per_bagian="+$('#detail_id').val(),    
		    	dataType: "json",  
				success:function(data){
					refresh_table_t( tabel_restore_detail, data);
				}
			});
	    });

	    $('#restore_detail').on( 'click', function () {
			var idArray = new Array();
			var tmp;
			tabel_restore_detail.$('input[name="id_restore_detail_rencana_per_bagian[]"]:checked').each(function() {
				idArray.push($(this).val());
			});

			var restore_id_tahun_anggaran = $('#restore_detail_id').val();

			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Detail%20Action",
					data:"id_restore_detail_rencana_per_bagian="+idArray+"&id_tahun_anggaran="+restore_id_tahun_anggaran,    
		       		dataType: "json",  
					success:function(data){
						$('#restore_detail_rencana_perbagian').hide();
						refresh_table_t(tabel_detail, data);
						alert("Data berhasil dikembalikan!");
					}
				});					
			}else if(idArray.length==0){
				alert('Anda belum memilih data data!');
				return false;
			}
	    });

	});	    

</script>

<section class="content-header">
  <h1>
    Rencanaan Anggaran Perbagian
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Laman Muka</a></li>
    <li><a href="#"><i class="fa fa-table">Perencanaan Anggaran</i></a></li>
    <li><a href="#"><i class="fa fa-circle-o">Rencana Perbagian</i></a></li>
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
					<button class="btn btn-success" id="ubah_form" data-toggle="modal" data-target="#mymodaledit" ><i class="fa fa-pencil-square-o"></i>Ubah</button>
					<button class="btn btn-info" id="hapus_temporary_form" data-toggle="modal" data-target="#mymodaltemporarydelete" ><i class="fa fa-trash-o"></i>Hapus</button>
					<button class="btn btn-default" id="restore_form" ><i class="fa fa-refresh"></i>Kembalikan</button>
					<button class="btn btn-danger" id="hapus_form" data-toggle="modal" data-target="#mymodaldelete" ><i class="fa fa-trash"></i>Hapus</button>

					<div class="modal fade" id="mymodaladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Tambah Data Tahun Anggaran</h4>
								</div>
								<div class="modal-body" id="pop_up_add">	
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
									<h4 class="modal-title" id="myModalLabel">Ubah Data Tahun Anggaran</h4>
								</div>
								<div class="modal-body" id="pop_up_edit">	
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary " id="ubah" data-dismiss="modal">Ubah</button>
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
									<h4 class="modal-title" id="myModalLabel">Hapus Data Tahun Anggaran</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="manajemenPengguna">Tahun anggaran</label>
									   	<input type="text" class="form-control" id="delete_tahun_anggaran" disabled>
									   	<input type="hidden" class="form-control" id="delete_id_tahun_anggaran" >
									</div>
									<div class="form-group">
										<label for="manajemenPengguna">Bagian</label>
									   	<input type="text" class="form-control" id="delete_nama_bagian" disabled>
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary " id="hapus_sementara" data-dismiss="modal">Hapus</button>
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
									<h4 class="modal-title" id="myModalLabel">Hapus Permanen Data Tahun Anggaran</h4>
								</div>
								<div class="modal-body">	
									<div class="form-group">
										<label for="manajemenPengguna">Tahun anggaran</label>
									   	<input type="text" class="form-control" id="delete_tahun_anggaran_2" disabled>
									   	<input type="hidden" class="form-control" id="delete_id_tahun_anggaran_2" >
									</div>
									<div class="form-group">
										<label for="manajemenPengguna">Bagian</label>
									   	<input type="text" class="form-control" id="delete_nama_bagian_2" disabled>
									</div>								
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary " id="hapus" data-dismiss="modal">Hapus</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>
							</div>
						</div>
					</div>										

				</div>
				<!-- /box-header -->
				<!-- view data -->
                <div class="box-body">
					<table id="tabel_rencana_perbagian" class="table table-bordered table-striped">
		            	<thead>
		                	<tr>
		                    	<!--<th width="1"></th>-->
		                    	<th></th>         
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
                </div><!-- /.box-body -->
				<!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div> <!-- /.row -->	


	<div class="row" id="restore_rencana_perbagian">
		<div class="col-xs-12">
			<!-- box box-primary -->
			<div class="box box-primary">		
				<!-- view data -->
                <div class="box-body">
					<div class="modal-header">
						<button type="button" class="close" id="close_restore" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Kembalikan Data Tahun Anggaran</h4>
					</div>
					<div class="modal-body">                
						<table id="tabel_restore_rencana_perbagian" class="table table-bordered table-striped">
			            	<thead>
			                	<tr>
			                    	<th width="10"><input name="select_all" value="1" type="checkbox"></th>         
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
					<div class="modal-footer">
						<button class="btn btn-success " id="restore" >Kembalikan</button>
					</div>		                          
                </div><!-- /.box-body -->
				<!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div>
	 <!-- /.row -->	

	<div class="row" id="detail_rencana_perbagian">
		<div class="col-xs-12">
			<!-- box box-primary -->
			<div class="box box-primary">

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" id="close_detail" aria-hidden="true">&times;</button>
						<button class="btn btn-warning" id="upload_file_detail_form" data-toggle="modal" data-target="#mymodaluploaddetail"><i class="fa fa-cloud-upload"></i>Unggah excel</button>
						<button class="btn btn-primary " id="tambah_detail_form" data-toggle="modal" data-target="#mymodaladddetail"><i class="fa fa-plus"></i>Tambah</button>
						<button class="btn btn-success" id="ubah_detail_form" data-toggle="modal" data-target="#mymodaleditdetail"><i class="fa fa-pencil-square-o"></i>Ubah</button>
						<button class="btn btn-info" id="hapus_temporary_detail_form" data-toggle="modal" data-target="#mymodaltemporarydeletedetail"><i class="fa fa-trash-o"></i>Hapus</button>
						<button class="btn btn-default" id="restore_detail_form" ><i class="fa fa-refresh"></i>Kembalikan</button>
						<button class="btn btn-danger" id="hapus_detail_form" data-toggle="modal" data-target="#mymodaldeletedetail"><i class="fa fa-trash"></i>Hapus</button>
					</div>
					<div class="modal-body">
	 					<div class="form-group">
	                     	<label for="info">Tahun anggaran</label>&nbsp;:&nbsp;<label for="info_long" id="l_detail_tahun_anggaran"></label><br>
	                     	<input type="hidden" class="form-control" id="detail_id">
	                     	<input type="hidden" class="form-control" id="detail_tahun_anggaran">
	                     	<input type="hidden" class="form-control" id="detail_bagian">
	                    </div>
						<div class="form-group">
							<label for="info">Bagian</label>&nbsp;:&nbsp;<label for="info_long" id="l_detail_bagian"></label><br>
	                    </div>
					</div>
					<div class="modal fade" id="mymodaluploaddetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Unggah Data Rencana Anggaran Perbagian</h4>
								</div>
								<div class="modal-body">	
									<div class="form-group">
										<label for="manajemenPengguna">File rencana anggaran</label>
									    <input type="file" class="form-control" id="delete_file_tahun_anggaran">
									</div>	
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="unggah_detail" data-dismiss="modal">Unggah</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>

					<div class="modal fade" id="mymodaladddetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Tambah Data Rencana Anggaran Perbagian</h4>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="manajemenPengguna">Kode</label>
									   	<input type="text" class="form-control" id="add_kode" placeholder="Masukan kode mata anggaran">
									</div>
									<div class="form-group">
										<label for="manajemenPengguna">Mata anggaran</label>
									   	<input type="text" class="form-control" id="add_mata_anggaran" placeholder="Masukan mata anggaran">
									</div>
									<div class="form-group">
										<label for="manajemenPengguna">Total dana</label>
									   	<input type="text" class="form-control auto" data-a-sep="." data-a-dec="," data-a-sign="Rp " id="add_total_dana" placeholder="Masukan total dana">
									</div>
									<div class="form-group">
										<label for="manajemenPengguna">Catatan</label>
									   	<input type="text" class="form-control" id="add_catatan" placeholder="Masukan catatan">
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="tambah_detail" data-dismiss="modal">Simpan</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>

					<div class="modal fade" id="mymodaleditdetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Ubah Data Rencana Anggaran Perbagian</h4>
								</div>
								<div class="modal-body" id="pop_up_edit_detail">	
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="ubah_detail" data-dismiss="modal">Ubah</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>

					<div class="modal fade" id="mymodaltemporarydeletedetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Hapus Data Rencana Anggaran Perbagian</h4>
								</div>
								<div class="modal-body" id="pop_up_temporary_delete_detail">	
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="hapus_sementara_detail" data-dismiss="modal">Hapus</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>

					<div class="modal fade" id="mymodaldeletedetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Hapus Permanen Data Rencana Anggaran Perbagian</h4>
								</div>
								<div class="modal-body" id="pop_up_delete_detail">	
								</div>
								<div class="modal-footer">
									<button class="btn btn-success " id="hapus_detail" data-dismiss="modal">Hapus</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								</div>				
							</div>
						</div>
					</div>

					<!-- view data -->
	                <div class="box-body">
	                	<table id="tabel_detail_rencana_perbagian" class="table table-bordered table-striped">
			            	<thead>
			                	<tr>
			                    	<th><input name="select_all" value="1" type="checkbox"></th>         
			                        <th>Kode</th>
			                        <th>Mata anggaran</th>
			                        <th>Total dana</th>
		                       		<th>Total penerima dana</th>
			                        <th>Catatan</th>
			                    </tr>
			                </thead>
			                <tbody>
							</tbody>
			                <tfoot>
			                </tfoot>
			            </table>
	                </div><!-- /.box-body -->
	            </div>
				<!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div>
	<!-- /.row -->	

	<div class="row" id="restore_detail_rencana_perbagian">
		<div class="col-xs-12">
			<!-- box box-primary -->
			<div class="box box-primary">

				<div class="modal-header">
					<button type="button" class="close" id="close_restore_detail" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Kembalikan Data Rencanaan Anggaran Perbagian</h4>
				</div>
				<div class="modal-body">
 					<div class="form-group">
                     	<label for="info">Tahun anggaran</label>&nbsp;&nbsp;<label for="info" id="l_restore_detail_tahun_anggaran" ></label>
                     	<input type="hidden" class="form-control" id="restore_detail_tahun_anggaran" disabled>
                     	<input type="hidden" class="form-control" id="restore_detail_bagian" disabled>
                     	<input type="hidden" class="form-control" id="restore_detail_id">
                    </div>
					<div class="form-group">
                      	<label for="info">Bagian</label>&nbsp;&nbsp;<label for="info" id="l_restore_detail_bagian"></label>
                    </div>
				</div>
				<!-- view data -->
                <div class="box-body">
                	<table id="tabel_restore_detail_rencana_perbagian" class="table table-bordered table-striped">
		            	<thead>
		                	<tr>
		                    	<th width="10"><input name="select_all" value="1" type="checkbox"></th>         
		                        <th>Kode</th>
		                        <th>Mata anggaran</th>
		                        <th>Total dana</th>
		                        <th>Total penerima dana</th>
		                        <th>Catatan</th>
		                    </tr>
		                </thead>
		                <tbody>
						</tbody>
		                <tfoot>
		                </tfoot>
		            </table>
                </div><!-- /.box-body -->

				<div class="modal-footer">
					<button class="btn btn-primary " id="restore_detail" >Kembalikan</button>
					<button type="button" class="btn btn-default" id="close_restore_detail" >Tutup</button>
				</div>
				<!-- /view data -->
			</div>
			<!-- /box box-primary-->
		</div><!--/.col (right) -->
	</div>
	<!-- /.row -->				

</section><!-- /.content -->
