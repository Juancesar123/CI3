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

	var tabel_pengajuan_baru = $('#tabel_pengajuan_baru').DataTable(
	{
	  	"autoWidth": false,
        "sScrollX": "400%",
		"rowCallback": function( row, data, index ) {
		  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"transaksi_mata_anggaran_id[]\" onclick='handleClickPengajuanBaru(this);'  value=\""+data[0]+"\" >");
		},        
	  	"columnDefs": [
			{ "width": "0.1%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 0 },
			{ "width": "10.8%", sClass: "dt-head-center dt-body-justify", "targets": 1 },
			{ "width": "3%", sClass: "dt-head-center dt-body-left", "targets": 2 },
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 3 },
			{ "width": "5%", sClass: "dt-head-center dt-body-right", "type": "num-fmt", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 4 },
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 5 },
			{ "width": "3%", sClass: "dt-head-center dt-body-center", "targets": 6 },
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 7 },
			{ "width": "3%", sClass: "dt-head-center dt-body-center", "targets": 8 },
			{ "width": "5%", sClass: "dt-head-center dt-body-center", "targets": 9 },
			{ "width": "5%", sClass: "dt-head-center dt-body-center", "targets": 10  },
			{ "width": "5%", sClass: "dt-head-center dt-body-justify", "targets": 11 },
			{ "width": "3%", sClass: "dt-head-center dt-body-left", "targets": 12 },
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 13 },
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 14 },
			{ "width": "5%", sClass: "dt-head-center dt-body-right", "type": "num-fmt", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 16 },
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "targets": 16 },
			{ "width": "5%", sClass: "dt-head-center dt-body-right", "type": "num-fmt", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 18 },
			{ "width": "7%", sClass: "dt-head-center dt-body-left", "targets": 18 },		
			{ "width": "7%", sClass: "dt-head-center dt-body-left", "targets": 19 },	
			{ "width": "7%", sClass: "dt-head-center dt-body-left", "targets": 20 },	
			{ "width": "7%", sClass: "dt-head-center dt-body-left", "targets": 21 },
			{ "width": "7%", sClass: "dt-head-center dt-body-right", "type": "num-fmt",render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 23 }
			]
	});

	var tabel_show_detail = $('#tabel_show_detail_rencana_perbagian').DataTable({
		"autoWidth": false,
		"rowCallback": function( row, data, index ) {
		  var numFormat = $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ).display;
		  var hasil = data[3] - data[4];
		  var realisasi = (data[4]/data[3])*100;
		  $('td:eq(5)', row).text(numFormat(hasil));
		  $('td:eq(6)', row).text(realisasi);
		  $('td:eq(0)', row).html("<input type=\"checkbox\" name=\"id_show_detail_rencana_per_bagian[]\" onclick='handleClickShowDetail(this);'  value=\""+data[0]+"_"+data[1]+"_"+data[2]+"_"+data[3]+"_"+data[7]+"_"+data[4]+"_"+hasil+"_"+realisasi+"\" >");
		  
		},		
		"columnDefs": [
			{ "width": "3%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 0},
			{ "width": "7%", sClass: "dt-head-center dt-body-left", "targets": 1},
			{ "width": "35%", sClass: "dt-head-center dt-body-justify", "targets": 2},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 3},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 4},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 5},
			{ "width": "10%", sClass: "dt-head-center dt-body-center", "targets": 6},
			{ "width": "15%", sClass: "dt-head-center dt-body-justify", "targets": 7}
			]
		});		
		/*
		"rowCallback": function( row, data, index ) {
		  var numFormat = $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ).display;
		  var hasil = data[4] - data[5];
		  $('td:eq(5)', row).text(numFormat(hasil));
		},
		"columnDefs": [
			{ "width": "5%", sClass: "dt-head-center dt-body-center", "bSortable": false, "targets": 1 },
			{ "width": "5%", sClass: "dt-head-center dt-body-left", "bSortable": false, "targets": 2 },
			{ "width": "50%", sClass: "dt-head-center dt-body-justify", "targets": 3 },
			{ "width": "10%", sClass: "dt-head-center dt-body-right", "type": "num-fmt", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 4},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", "type": "num-fmt", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), "targets": 5},
			{ "width": "10%", sClass: "dt-head-center dt-body-right", "type": "num-fmt", "targets": 6},
			{ "width": "25%", sClass: "dt-head-center dt-body-justify", "targets": 7 }
			]
	});*/


	function refresh_table_t( table, data){
		//alert(JSON.stringify(data));
		$('input[name="select_all"]').prop("indeterminate", false);
  	  	table.clear().draw();
  	  	table.rows.add(data).draw( false );
	}			

/*
	function refresh_trigger_tabel_tabel_show_detail( table, data, id_pengajuan) {
		$('input[name="select_all"]').prop("indeterminate", false);
  	  	table.clear().draw();
  	  	table.rows.add(data).draw( false );
	}		
*/

	function triger_tabel_rencana_anggaran(id_tahun_anggaran, id_pengajuan){
		$.ajax({
			type:"POST",
			url:"Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Detail%20Data%20Form2",
			data:"id_rencana_per_bagian="+id_tahun_anggaran, 
			dataType: "json",  
			success:function(data){
				refresh_table_t( tabel_show_detail, data, id_pengajuan);
			}
		});
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
					$('#show_detail_id_tahun_anggaran').val(info_arr[0]);
					$('#show_detail_tahun_anggaran').val(info_arr[1]);
					$('#show_detail_bagian').val(info_arr[2]);
					$('#l_show_detail_tahun_anggaran').text(info_arr[1]);
					$('#l_show_detail_bagian').text(info_arr[2]);
					refresh_table_t( tabel_show_detail, data);
				}
			});
		}
	}

	function handleClickShowDetail(cb) {
		var count = tabel_show_detail.$('input[name="id_show_detail_rencana_per_bagian[]"]:checked').length;
		if(cb.checked){
			if(count>1){
				tabel_show_detail.$('input[name="id_show_detail_rencana_per_bagian[]"]:checked').attr('checked', false);
				cb.checked = true;
			}
			var info_arr = cb.value.split("_");
			$('#pengajuan_baru').show();
			$('#transaksi_mata_anggaran_tahun_anggaran').val($('#show_detail_tahun_anggaran').val());
			$('#transaksi_mata_anggaran_bagian').val($('#show_detail_bagian').val());
			$('#transaksi_mata_anggaran_id').val(info_arr[0]);
			$('#transaksi_mata_anggaran_kode').val(info_arr[1]);
			$('#transaksi_mata_anggaran_mata_anggaran').val(info_arr[2]);
			$('#transaksi_mata_anggaran_total_dana').val(info_arr[3]);
			$('#transaksi_mata_anggaran_catatan').val(info_arr[4]);
			$('#l_transaksi_mata_anggaran_tahun_anggaran').text($('#show_detail_tahun_anggaran').val());
			$('#l_transaksi_mata_anggaran_bagian').text($('#show_detail_bagian').val());
			$('#l_transaksi_mata_anggaran_id').text(info_arr[0]);
			$('#l_transaksi_mata_anggaran_mata_anggaran').text(info_arr[1]+' '+info_arr[2]);
			$('#l_transaksi_mata_anggaran_total_dana').autoNumeric('init',{aSep: '.',aDec: ',',aSign: 'Rp '}); 
			$('#l_transaksi_mata_anggaran_total_dana').autoNumeric('set',info_arr[3]);
			$('#l_transaksi_mata_anggaran_total_penerimaan_dana').autoNumeric('init',{aSep: '.',aDec: ',',aSign: 'Rp '}); 
			$('#l_transaksi_mata_anggaran_total_penerimaan_dana').autoNumeric('set',info_arr[5]);
			$('#l_transaksi_mata_anggaran_sisa_dana').autoNumeric('init',{aSep: '.',aDec: ',',aSign: 'Rp '}); 
			$('#l_transaksi_mata_anggaran_sisa_dana').autoNumeric('set',info_arr[6]);
			$('#l_transaksi_mata_anggaran_realisasi').autoNumeric('init',{aSep: '.',aDec: ',',pSign: 's',aSign: ' %'}); 
			$('#l_transaksi_mata_anggaran_realisasi').autoNumeric('set',info_arr[7]);
			$('#l_transaksi_mata_anggaran_catatan').text(info_arr[4]);  
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tabel%20Pengajuan%20Baru",
				data:"transaksi_mata_anggaran_id="+info_arr[0],    
		    	dataType: "json",  
				success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
				}
			});			
		}
	}	

	function handleClickPengajuanBaru(cb) {
		var count = tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').length;
		if(cb.checked){
			if(count>1){
				tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').attr('checked', false);
				cb.checked = true;
			}
		}
	}	

	$(document).ready(function(){
		$('#show_detail_rencana_perbagian').hide();
		$('#pengajuan_baru').hide();

	  	//t.order( [ 0, 'desc' ] ).draw(false);
	  	//t.column(0).visible( false );

		//tabel_show_detail.order( [ 0, 'asc' ] ).draw(false);
	  	//tabel_show_detail.column(0).visible( false );

	  	//tabel_pengajuan_baru.column(0).visible( false );

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

		$('#tabel_restore_pengajuan_baru thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    tabel_restore_pengajuan_baru.$('input[name="id_restore_pengajuan_baru[]"]:not(:checked)').trigger('click');
		    } else {
		    	tabel_restore_pengajuan_baru.$('input[name="id_restore_pengajuan_baru[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});

	    $('#close_show_detail').on( 'click', function () {
			$('#show_detail_rencana_perbagian').hide();
			t.$('input[name="id_rencana_per_bagian[]"]:checked').attr('checked', false);
	    });

	    $('#close_pengajuan_baru').on( 'click', function () {
			$('#pengajuan_baru').hide();
			tabel_show_detail.$('input[name="id_show_detail_rencana_per_bagian[]"]:checked').attr('checked', false);
	    });	 

	    $('#close_restore_pengajuan_baru').on( 'click', function () {
			$('#restore_pengajuan_baru').hide();
	    });	 

	    //kegiatan
	    $('#ubah_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	 	 

	    $('#hapus_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });

	    $('#unggah').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_file_pengajuan_baru = $("#detail_file_pengajuan_baru").get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_file_pengajuan_baru", detail_file_pengajuan_baru);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diunggah!");
				}
			})		
	    });	  

	    $('#detail').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Detail%20Data%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_detail_detail").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });		    

	    $('#tambah_detail').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var add_program_utama = $('#add_program_utama').val();
			var add_program = $('#add_program').val();
			var add_sasaran = $('#add_sasaran').val();
			var add_kegiatan = $('#add_kegiatan').val();
			var add_penanggung_jawab = $('#add_penanggung_jawab').val();
			var add_jumlah_anggaran = $('#add_jumlah_anggaran').autoNumeric('get');
			var add_tanggal_pelaksana = $('#add_tanggal_pelaksana').val();
			var add_keterangan = $('#add_keterangan').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tambah%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("add_program_utama", add_program_utama);
		            data.append("add_program", add_program);
			        data.append("add_sasaran", add_sasaran);
			        data.append("add_kegiatan", add_kegiatan);
			        data.append("add_penanggung_jawab", add_penanggung_jawab);
			        data.append("add_jumlah_anggaran", add_jumlah_anggaran);
			        data.append("add_tanggal_pelaksana", add_tanggal_pelaksana);
			        data.append("add_keterangan", add_keterangan);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil ditambah!");
				}
			})			
	    });	

	    $('#ubah_detail').on( 'click', function () {	
			var edit_id = $('input[name="edit_id"]').val();
			var edit_id_master_file_pengajuan = $('input[name="edit_id_master_file_pengajuan"]').val();
			var edit_id_transaksi_mata_anggaran = $('input[name="edit_id_transaksi_mata_anggaran"]').val();
			var edit_program_utama = $('input[name="edit_program_utama"]').val();
			var edit_program = $('input[name="edit_program"]').val();
			var edit_sasaran = $('input[name="edit_sasaran"]').val();
			var edit_kegiatan = $('input[name="edit_kegiatan"]').val();
			var edit_penanggung_jawab = $('input[name="edit_penanggung_jawab"]').val();
			var edit_total_anggaran = $('input[name="edit_total_anggaran"]').autoNumeric('get');
			var edit_tanggal_pelaksana = $('input[name="edit_tanggal_pelaksana"]').val();
			var edit_keterangan = $('input[name="edit_keterangan"]').val();

			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("edit_id", edit_id);
		            data.append("edit_id_transaksi_mata_anggaran", edit_id_transaksi_mata_anggaran);
		            data.append("edit_id_master_file_pengajuan", edit_id_master_file_pengajuan);
		            data.append("edit_program_utama", edit_program_utama);
			        data.append("edit_program", edit_program);
			        data.append("edit_sasaran", edit_sasaran);
			        data.append("edit_kegiatan", edit_kegiatan);
			        data.append("edit_penanggung_jawab", edit_penanggung_jawab);
			        data.append("edit_total_anggaran", edit_total_anggaran);
			        data.append("edit_tanggal_pelaksana", edit_tanggal_pelaksana);
			        data.append("edit_keterangan", edit_keterangan);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail').on( 'click', function () {	
			var detail_id = $('input[name="detail_id"]').val();
			var detail_id_master_file_pengajuan = $('input[name="detail_id_master_file_pengajuan"]').val();
			var detail_url_file = $('input[name="detail_url_file"]').val();
			var detail_id_transaksi_mata_anggaran = $('input[name="detail_id_transaksi_mata_anggaran"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("detail_id", detail_id);
		            data.append("detail_id_transaksi_mata_anggaran", detail_id_transaksi_mata_anggaran);
		            data.append("detail_url_file", detail_url_file);
		            data.append("detail_id_master_file_pengajuan", detail_id_master_file_pengajuan);
		            return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });			    

	    $('#restore_detail').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var id_restore_pengajuan_baru = new Array();
			tabel_restore_pengajuan_baru.$('input[name="id_restore_pengajuan_baru[]"]:checked').each(function() {
				id_restore_pengajuan_baru.push($(this).val());
			});
			if(id_restore_pengajuan_baru.length>0){			
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Kembalikan%20Data%20Action",
			        contentType: false,
			        processData: false,     
			        dataType: "json",                    
					data: function() {
				        var data = new FormData();
			            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
			            data.append("id_restore_pengajuan_baru", id_restore_pengajuan_baru);
				        return data;
			        }(),
			        success:function(data){
			        	$('#restore_pengajuan_baru').hide();
			        	refresh_table_t(tabel_pengajuan_baru, data);
						alert("Data berhasil dikembalikan!");
					}
				})		
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	

		//file pengajuan
	    $('#upload_file_pengajuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$('#detail_file_pengajuan_id_transaksi_mata_anggaran').val(idArray);
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	

	    $('#ubah_file_pengajuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20File%20Pengajuan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail_file_pengajuan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	  

	    $('#hapus_file_pengajuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20File%20Pengajuan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail_file_pengajuan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	

	    $('#unggah_file_pengajuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_file_pengajuan_id_transaksi_mata_anggaran = $('#detail_file_pengajuan_id_transaksi_mata_anggaran').val();
			var detail_tanggal_file_pengajuan = $('#detail_tanggal_file_pengajuan').val();
			var detail_kepada_file_pengajuan = $('#detail_kepada_file_pengajuan').val();
			var detail_file_pengajuan = $("#detail_file_pengajuan").get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20File%20Pengajuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_file_pengajuan_id_transaksi_mata_anggaran", detail_file_pengajuan_id_transaksi_mata_anggaran);
		            data.append("detail_tanggal_file_pengajuan", detail_tanggal_file_pengajuan);
		            data.append("detail_kepada_file_pengajuan", detail_kepada_file_pengajuan);
		            data.append("detail_file_pengajuan", detail_file_pengajuan);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diunggah!");
				}
			})		
	    });	


	    $('#ubah_detail_file_pengajuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var edit_detail_file_pengajuan_tanggal = $('input[name="edit_detail_file_pengajuan_tanggal"]').val();
			var edit_detail_file_pengajuan_id = $('input[name="edit_detail_file_pengajuan_id"]').val();
			var edit_detail_file_pengajuan_id_master_file_pengajuan = $('input[name="edit_detail_file_pengajuan_id_master_file_pengajuan"]').val();
			var edit_detail_file_pengajuan_id_transaksi_mata_anggaran = $('input[name="edit_detail_file_pengajuan_id_transaksi_mata_anggaran"]').val();
			var edit_detail_file_pengajuan_kepada = $('input[name="edit_detail_file_pengajuan_kepada"]').val();
			var edit_detail_file_pengajuan_file = $('input[name="edit_detail_file_pengajuan_file"]').get(0).files[0];
			var edit_detail_file_pengajuan_lama = $('input[name="edit_detail_file_pengajuan_lama"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20File%20Pengajuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("edit_detail_file_pengajuan_tanggal", edit_detail_file_pengajuan_tanggal);
		            data.append("edit_detail_file_pengajuan_id", edit_detail_file_pengajuan_id);
		            data.append("edit_detail_file_pengajuan_id_master_file_pengajuan", edit_detail_file_pengajuan_id_master_file_pengajuan);
		            data.append("edit_detail_file_pengajuan_id_transaksi_mata_anggaran", edit_detail_file_pengajuan_id_transaksi_mata_anggaran);
		            data.append("edit_detail_file_pengajuan_kepada", edit_detail_file_pengajuan_kepada);
			        data.append("edit_detail_file_pengajuan_file", edit_detail_file_pengajuan_file);
			        data.append("edit_detail_file_pengajuan_lama", edit_detail_file_pengajuan_lama);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail_file_pengajuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_detail_file_pengajuan_lama = $('input[name="detail_detail_file_pengajuan_lama"]').val();
			var detail_detail_file_pengajuan_id = $('input[name="detail_detail_file_pengajuan_id"]').val();
			var detail_detail_file_pengajuan_id_master_file_pengajuan = $('input[name="detail_detail_file_pengajuan_id_master_file_pengajuan"]').val();
			var detail_detail_file_pengajuan_id_transaksi_mata_anggaran = $('input[name="detail_detail_file_pengajuan_id_transaksi_mata_anggaran"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20File%20Pengajuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_detail_file_pengajuan_lama", detail_detail_file_pengajuan_lama);
		            data.append("detail_detail_file_pengajuan_id", detail_detail_file_pengajuan_id);
		            data.append("detail_detail_file_pengajuan_id_master_file_pengajuan", detail_detail_file_pengajuan_id_master_file_pengajuan);
		            data.append("detail_detail_file_pengajuan_id_transaksi_mata_anggaran", detail_detail_file_pengajuan_id_transaksi_mata_anggaran);
		            return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });			    

		//surat pengajuan	
	    $('#upload_surat_pengajuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$('#detail_surat_pengajuan_id_transaksi_mata_anggaran').val(idArray);
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	


	    $('#ubah_surat_pengajuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Pengajuan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail_surat_pengajuan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	 

	    $('#hapus_surat_pengajuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Pengajuan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail_surat_pengajuan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	

	    $('#unggah_surat_pengajuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_surat_pengajuan_id_transaksi_mata_anggaran = $('#detail_surat_pengajuan_id_transaksi_mata_anggaran').val();
			var detail_surat_pengajuan_tanggal = $('input[name="detail_surat_pengajuan_tanggal"]').val();
			var detail_surat_pengajuan_kepada = $('input[name="detail_surat_pengajuan_kepada"]').val();
			var detail_surat_pengajuan_nomor_surat = $('input[name="detail_surat_pengajuan_nomor_surat"]').val();
			var detail_surat_pengajuan_perihal_surat = $('input[name="detail_surat_pengajuan_perihal_surat"]').val();
			var detail_surat_pengajuan_surat_pengajuan = $('input[name="detail_surat_pengajuan_surat_pengajuan"]').get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Surat%20Pengajuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_surat_pengajuan_id_transaksi_mata_anggaran", detail_surat_pengajuan_id_transaksi_mata_anggaran);
		            data.append("detail_surat_pengajuan_tanggal", detail_surat_pengajuan_tanggal);
		            data.append("detail_surat_pengajuan_kepada", detail_surat_pengajuan_kepada);
		            data.append("detail_surat_pengajuan_nomor_surat", detail_surat_pengajuan_nomor_surat);
			        data.append("detail_surat_pengajuan_perihal_surat", detail_surat_pengajuan_perihal_surat);
		            data.append("detail_surat_pengajuan_surat_pengajuan", detail_surat_pengajuan_surat_pengajuan);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diunggah!");
				}
			})	
	    });	  

	    $('#ubah_detail_surat_pengajuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var edit_detail_surat_pengajuan_tanggal = $('input[name="edit_detail_surat_pengajuan_tanggal"]').val();
			var edit_detail_surat_pengajuan_id = $('input[name="edit_detail_surat_pengajuan_id"]').val();
			var edit_detail_surat_pengajuan_id_master_file_surat_pengajuan = $('input[name="edit_detail_surat_pengajuan_id_master_file_surat_pengajuan"]').val();
			var edit_detail_surat_pengajuan_id_transaksi_mata_anggaran = $('input[name="edit_detail_surat_pengajuan_id_transaksi_mata_anggaran"]').val();
			var edit_detail_surat_pengajuan_kepada = $('input[name="edit_detail_surat_pengajuan_kepada"]').val();
			var edit_detail_surat_pengajuan_nomor_surat = $('input[name="edit_detail_surat_pengajuan_nomor_surat"]').val();
			var edit_detail_surat_pengajuan_perihal_surat = $('input[name="edit_detail_surat_pengajuan_perihal_surat"]').val();
			var edit_detail_surat_pengajuan_file = $('input[name="edit_detail_surat_pengajuan_file"]').get(0).files[0];
			var edit_detail_surat_pengajuan_lama = $('input[name="edit_detail_surat_pengajuan_lama"]').val();
			
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Pengajuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("edit_detail_surat_pengajuan_tanggal", edit_detail_surat_pengajuan_tanggal);
		            data.append("edit_detail_surat_pengajuan_id", edit_detail_surat_pengajuan_id);
		            data.append("edit_detail_surat_pengajuan_id_master_file_surat_pengajuan", edit_detail_surat_pengajuan_id_master_file_surat_pengajuan);
		            data.append("edit_detail_surat_pengajuan_id_transaksi_mata_anggaran", edit_detail_surat_pengajuan_id_transaksi_mata_anggaran);
		            data.append("edit_detail_surat_pengajuan_kepada", edit_detail_surat_pengajuan_kepada);
			        data.append("edit_detail_surat_pengajuan_nomor_surat", edit_detail_surat_pengajuan_nomor_surat);
			        data.append("edit_detail_surat_pengajuan_perihal_surat", edit_detail_surat_pengajuan_perihal_surat);
			        data.append("edit_detail_surat_pengajuan_file", edit_detail_surat_pengajuan_file);
			        data.append("edit_detail_surat_pengajuan_lama", edit_detail_surat_pengajuan_lama);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
					//alert(JSON.stringify(data));
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail_surat_pengajuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_detail_surat_pengajuan_lama = $('input[name="detail_detail_surat_pengajuan_lama"]').val();
			var detail_detail_surat_pengajuan_id = $('input[name="detail_detail_surat_pengajuan_id"]').val();
			var detail_detail_surat_pengajuan_id_master_file_surat_pengajuan = $('input[name="detail_detail_surat_pengajuan_id_master_file_surat_pengajuan"]').val();
			var detail_detail_surat_pengajuan_id_transaksi_mata_anggaran = $('input[name="detail_detail_surat_pengajuan_id_transaksi_mata_anggaran"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Pengajuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_detail_surat_pengajuan_lama", detail_detail_surat_pengajuan_lama);
		            data.append("detail_detail_surat_pengajuan_id", detail_detail_surat_pengajuan_id);
		            data.append("detail_detail_surat_pengajuan_id_master_file_surat_pengajuan", detail_detail_surat_pengajuan_id_master_file_surat_pengajuan);
		            data.append("detail_detail_surat_pengajuan_id_transaksi_mata_anggaran", detail_detail_surat_pengajuan_id_transaksi_mata_anggaran);
		            return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	//alert(JSON.stringify(data));
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });			    

		//surat persetujuan
	    $('#upload_surat_persetujuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$('#detail_surat_persetujuan_id_transaksi_mata_anggaran').val(idArray);
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	

		
	    $('#ubah_surat_persetujuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Persetujuan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail_surat_persetujuan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	 

	    $('#hapus_surat_persetujuan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Persetujuan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail_surat_persetujuan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	

	    $('#unggah_surat_persetujuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_surat_persetujuan_id_transaksi_mata_anggaran = $('#detail_surat_persetujuan_id_transaksi_mata_anggaran').val();
			var detail_surat_persetujuan_tanggal = $('input[name="detail_surat_persetujuan_tanggal"]').val();
			var detail_surat_persetujuan_kepada = $('input[name="detail_surat_persetujuan_kepada"]').val();
			var detail_surat_persetujuan_nomor_surat = $('input[name="detail_surat_persetujuan_nomor_surat"]').val();
			var detail_surat_persetujuan_perihal_surat = $('input[name="detail_surat_persetujuan_perihal_surat"]').val();
			var detail_surat_persetujuan_total_dana = $('input[name="detail_surat_persetujuan_total_dana"]').autoNumeric('get');
			var detail_surat_persetujuan_file = $('input[name="detail_surat_persetujuan_file"]').get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Surat%20Persetujuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_surat_persetujuan_id_transaksi_mata_anggaran", detail_surat_persetujuan_id_transaksi_mata_anggaran);
		            data.append("detail_surat_persetujuan_tanggal", detail_surat_persetujuan_tanggal);
		            data.append("detail_surat_persetujuan_kepada", detail_surat_persetujuan_kepada);
		            data.append("detail_surat_persetujuan_nomor_surat", detail_surat_persetujuan_nomor_surat);
			        data.append("detail_surat_persetujuan_perihal_surat", detail_surat_persetujuan_perihal_surat);
		            data.append("detail_surat_persetujuan_total_dana", detail_surat_persetujuan_total_dana);
		            data.append("detail_surat_persetujuan_file", detail_surat_persetujuan_file);
			        return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diunggah!");
				}
			})	
	    });	  

	    $('#ubah_detail_surat_persetujuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var edit_detail_surat_persetujuan_id_master_file_surat_persetujuan = $('input[name="edit_detail_surat_persetujuan_id_master_file_surat_persetujuan"]').val();
			var edit_detail_surat_persetujuan_tanggal = $('input[name="edit_detail_surat_persetujuan_tanggal"]').val();
			var edit_detail_surat_persetujuan_id = $('input[name="edit_detail_surat_persetujuan_id"]').val();
			var edit_detail_surat_persetujuan_id_master_file_surat_persetujuan = $('input[name="edit_detail_surat_persetujuan_id_master_file_surat_persetujuan"]').val();
			var edit_detail_surat_persetujuan_id_transaksi_mata_anggaran = $('input[name="edit_detail_surat_persetujuan_id_transaksi_mata_anggaran"]').val();
			var edit_detail_surat_persetujuan_kepada = $('input[name="edit_detail_surat_persetujuan_kepada"]').val();
			var edit_detail_surat_persetujuan_nomor_surat = $('input[name="edit_detail_surat_persetujuan_nomor_surat"]').val();
			var edit_detail_surat_persetujuan_perihal_surat = $('input[name="edit_detail_surat_persetujuan_perihal_surat"]').val();
			var edit_detail_surat_persetujuan_total_dana = $('input[name="edit_detail_surat_persetujuan_total_dana"]').autoNumeric('get');
			var edit_detail_surat_persetujuan_file = $('input[name="edit_detail_surat_persetujuan_file"]').get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Persetujuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("edit_detail_surat_persetujuan_id_master_file_surat_persetujuan", edit_detail_surat_persetujuan_id_master_file_surat_persetujuan);
		            data.append("edit_detail_surat_persetujuan_tanggal", edit_detail_surat_persetujuan_tanggal);
		            data.append("edit_detail_surat_persetujuan_id", edit_detail_surat_persetujuan_id);
		            data.append("edit_detail_surat_persetujuan_id_master_file_surat_persetujuan", edit_detail_surat_persetujuan_id_master_file_surat_persetujuan);
		            data.append("edit_detail_surat_persetujuan_id_transaksi_mata_anggaran", edit_detail_surat_persetujuan_id_transaksi_mata_anggaran);
			        data.append("edit_detail_surat_persetujuan_kepada", edit_detail_surat_persetujuan_kepada);
			        data.append("edit_detail_surat_persetujuan_nomor_surat", edit_detail_surat_persetujuan_nomor_surat);
			        data.append("edit_detail_surat_persetujuan_perihal_surat", edit_detail_surat_persetujuan_perihal_surat);
			        data.append("edit_detail_surat_persetujuan_total_dana", edit_detail_surat_persetujuan_total_dana);
			        data.append("edit_detail_surat_persetujuan_file", edit_detail_surat_persetujuan_file);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail_surat_persetujuan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_detail_surat_persetujuan_lama = $('input[name="detail_detail_surat_persetujuan_lama"]').val();
			var detail_detail_surat_persetujuan_id = $('input[name="detail_detail_surat_persetujuan_id"]').val();
			var detail_detail_surat_persetujuan_id_master_file_surat_persetujuan = $('input[name="detail_detail_surat_persetujuan_id_master_file_surat_persetujuan"]').val();
			var detail_detail_surat_persetujuan_id_transaksi_mata_anggaran = $('input[name="detail_detail_surat_persetujuan_id_transaksi_mata_anggaran"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Persetujuan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_detail_surat_persetujuan_lama", detail_detail_surat_persetujuan_lama);
		            data.append("detail_detail_surat_persetujuan_id", detail_detail_surat_persetujuan_id);
		            data.append("detail_detail_surat_persetujuan_id_master_file_surat_persetujuan", detail_detail_surat_persetujuan_id_master_file_surat_persetujuan);
		            data.append("detail_detail_surat_persetujuan_id_transaksi_mata_anggaran", detail_detail_surat_persetujuan_id_transaksi_mata_anggaran);
		            return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });			    

		//penerimaan dana
	    $('#tambah_penerimaan_dana_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$('#detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian').val(idArray);
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	

	    $('#ubah_penerimaan_dana_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Penerimaan%20Dana%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail_penerimaan_dana").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	 

	    $('#hapus_penerimaan_dana_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Penerimaan%20Dana%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail_penerimaan_dana").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}			
	    });	    

	    $('#tambah_detail_penerimaan_dana').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();

			var detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian = $('#detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian').val();
			var detail_penerimaan_dana_tanggal = $('#detail_penerimaan_dana_tanggal').val();
			var detail_penerimaan_dana_jumlah_dana_yang_diterima = $('#detail_penerimaan_dana_jumlah_dana_yang_diterima').autoNumeric('get');
			var id_tahun_anggaran = $('#show_detail_id_tahun_anggaran').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tambah%20Data%20Penerimaan%20Dana%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian", detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian);
		            data.append("detail_penerimaan_dana_tanggal", detail_penerimaan_dana_tanggal);
		            data.append("detail_penerimaan_dana_jumlah_dana_yang_diterima", detail_penerimaan_dana_jumlah_dana_yang_diterima);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	triger_tabel_rencana_anggaran(id_tahun_anggaran,transaksi_mata_anggaran_id);
	            	alert("Data berhasil ditambah!");
				}
			})			
	    });	

	    $('#ubah_detail_penerimaan_dana').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var edit_detail_penerimaan_dana_tanggal = $('input[name="edit_detail_penerimaan_dana_tanggal"]').val();
			var edit_detail_penerimaan_dana_total_dana = $('input[name="edit_detail_penerimaan_dana_total_dana"]').autoNumeric('get');
			var edit_detail_penerimaan_dana_id = $('input[name="edit_detail_penerimaan_dana_id"]').val();
			var id_tahun_anggaran = $('#show_detail_id_tahun_anggaran').val();
			
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Penerimaan%20Dana%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("edit_detail_penerimaan_dana_tanggal", edit_detail_penerimaan_dana_tanggal);
			        data.append("edit_detail_penerimaan_dana_total_dana", edit_detail_penerimaan_dana_total_dana);
			        data.append("edit_detail_penerimaan_dana_id", edit_detail_penerimaan_dana_id);
			        return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	triger_tabel_rencana_anggaran(id_tahun_anggaran,transaksi_mata_anggaran_id);
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail_penerimaan_dana').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_detail_penerimaan_dana_id = $('input[name="detail_detail_penerimaan_dana_id"]').val();
			var id_tahun_anggaran = $('#show_detail_id_tahun_anggaran').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Penerimaan%20Dana%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_detail_penerimaan_dana_id", detail_detail_penerimaan_dana_id);
		            return data;
		        }(),
		        success:function(data){
					refresh_table_t(tabel_pengajuan_baru, data);
	            	triger_tabel_rencana_anggaran(id_tahun_anggaran,transaksi_mata_anggaran_id);
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });			    

		//persetujuan dekanat
	    $('#tambah_persetujuan_dekanat_form').on( 'click', function () {
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$('#detail_persetujuan_dekanat_id_transaksi_mata_anggaran').val(idArray);
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	

	    $('#ubah_persetujuan_dekanat_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Persetujuan%20Dekanat%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail_persetujuan_dekanat").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}		
	    });	 

	    $('#hapus_persetujuan_dekanat_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Persetujuan%20Dekanat%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail_persetujuan_dekanat").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}	
	    });	    

	    $('#tambah_detail_persetujuan_dekanat').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();

			var detail_persetujuan_dekanat_id_transaksi_mata_anggaran = $('#detail_persetujuan_dekanat_id_transaksi_mata_anggaran').val();
			var detail_persetujuan_dekanat_tanggal = $('#detail_persetujuan_dekanat_tanggal').val();
			//alert("["+detail_persetujuan_dekanat_id_transaksi_mata_anggaran+"] ini di cek ["+detail_persetujuan_dekanat_tanggal+"]");
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tambah%20Data%20Persetujuan%20Dekanat%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_persetujuan_dekanat_id_transaksi_mata_anggaran", detail_persetujuan_dekanat_id_transaksi_mata_anggaran);
		            data.append("detail_persetujuan_dekanat_tanggal", detail_persetujuan_dekanat_tanggal);
			        return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil ditambah!");
				}
			})			
	    });	

	    $('#ubah_detail_persetujuan_dekanat').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var edit_detail_persetujuan_dekanat_tanggal = $('input[name="edit_detail_persetujuan_dekanat_tanggal"]').val();
			var edit_detail_persetujuan_dekanat_id = $('input[name="edit_detail_persetujuan_dekanat_id"]').val();
			
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Persetujuan%20Dekanat%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("edit_detail_persetujuan_dekanat_tanggal", edit_detail_persetujuan_dekanat_tanggal);
			        data.append("edit_detail_persetujuan_dekanat_id", edit_detail_persetujuan_dekanat_id);
			        return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail_persetujuan_dekanat').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_detail_persetujuan_dekanat_id = $('input[name="detail_detail_persetujuan_dekanat_id"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Persetujuan%20Dekanat%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_detail_persetujuan_dekanat_id", detail_detail_persetujuan_dekanat_id);
		            return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });	

		//laporan kegiatan 
	    $('#unggah_laporan_kegiatan_form').on( 'click', function () {
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$('#detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian').val(idArray);
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	

	    $('#ubah_laporan_kegiatan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Kegiatan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail_laporan_kegiatan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}		
	    });	 

	    $('#hapus_laporan_kegiatan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Kegiatan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail_laporan_kegiatan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}	
	    });	    

	    $('#unggah_detail_laporan_kegiatan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian = $('#detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian').val();
			var detail_laporan_kegiatan_tanggal = $('input[name="detail_laporan_kegiatan_tanggal"]').val();
			var detail_laporan_kegiatan_file = $('input[name="detail_laporan_kegiatan_file"]').get(0).files[0];
			//alert(detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian);
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Laporan%20Kegiatan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian", detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian);
		            data.append("detail_laporan_kegiatan_tanggal", detail_laporan_kegiatan_tanggal);
			        data.append("detail_laporan_kegiatan_file", detail_laporan_kegiatan_file);
			        return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diunggah!");
				}
			})		
	    });	

	    $('#ubah_detail_laporan_kegiatan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var edit_detail_laporan_kegiatan_tanggal = $('input[name="edit_detail_laporan_kegiatan_tanggal"]').val();
			var edit_detail_laporan_kegiatan_id = $('input[name="edit_detail_laporan_kegiatan_id"]').val();
			var edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan = $('input[name="edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan"]').val();
			var edit_detail_laporan_kegiatan_id_transaksi_mata_anggaran = $('input[name="edit_detail_laporan_kegiatan_id_transaksi_mata_anggaran"]').val();
			var edit_detail_laporan_kegiatan_lama = $('input[name="edit_detail_laporan_kegiatan_lama"]').val();
			var edit_detail_laporan_kegiatan_file = $('input[name="edit_detail_laporan_kegiatan_file"]').get(0).files[0];
			
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Kegiatan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("edit_detail_laporan_kegiatan_tanggal", edit_detail_laporan_kegiatan_tanggal);
			        data.append("edit_detail_laporan_kegiatan_id", edit_detail_laporan_kegiatan_id);
		            data.append("edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan", edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan);
		            data.append("edit_detail_laporan_kegiatan_id_transaksi_mata_anggaran", edit_detail_laporan_kegiatan_id_transaksi_mata_anggaran);
		            data.append("edit_detail_laporan_kegiatan_lama", edit_detail_laporan_kegiatan_lama);
			        data.append("edit_detail_laporan_kegiatan_file", edit_detail_laporan_kegiatan_file);
			        return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail_laporan_kegiatan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_detail_laporan_kegiatan_id = $('input[name="detail_detail_laporan_kegiatan_id"]').val();
			var detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan = $('input[name="detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan"]').val();
			var detail_detail_laporan_kegiatan_id_transaksi_mata_anggaran = $('input[name="detail_detail_laporan_kegiatan_id_transaksi_mata_anggaran"]').val();
			var detail_detail_laporan_kegiatan_lama = $('input[name="detail_detail_laporan_kegiatan_lama"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Kegiatan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_detail_laporan_kegiatan_id", detail_detail_laporan_kegiatan_id);
		            data.append("detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan", detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan);
		            data.append("detail_detail_laporan_kegiatan_id_transaksi_mata_anggaran", detail_detail_laporan_kegiatan_id_transaksi_mata_anggaran);
		            data.append("detail_detail_laporan_kegiatan_lama", detail_detail_laporan_kegiatan_lama);
		            return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });	

		//laporan keuangan 
	    $('#unggah_laporan_keuangan_form').on( 'click', function () {
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$('#detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian').val(idArray);
			}else{
				alert('Anda belum memilih data!');
				return false;
			}
	    });	

	    $('#ubah_laporan_keuangan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Keuangan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_edit_detail_laporan_keuangan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}		
	    });	 

	    $('#hapus_laporan_keuangan_form').on( 'click', function () {	
			var idArray = new Array();
			var tmp;
			tabel_pengajuan_baru.$('input[name="transaksi_mata_anggaran_id[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Keuangan%20Form",
					data:"transaksi_mata_anggaran_id_array="+idArray,
					success:function(data){
						$("#pop_up_delete_detail_laporan_keuangan").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;
			}	
	    });	    

	    $('#unggah_detail_laporan_keuangan').on( 'click', function () {	

			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian = $('#detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian').val();
			var detail_laporan_keuangan_tanggal = $('input[name="detail_laporan_keuangan_tanggal"]').val();
			var detail_laporan_keuangan_file = $('input[name="detail_laporan_keuangan_file"]').get(0).files[0];

			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Laporan%20Keuangan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian", detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian);
		            data.append("detail_laporan_keuangan_tanggal", detail_laporan_keuangan_tanggal);
			        data.append("detail_laporan_keuangan_file", detail_laporan_keuangan_file);
			        return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diunggah!");
				}
			})		
	    });	

	    $('#ubah_detail_laporan_keuangan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var edit_detail_laporan_keuangan_tanggal = $('input[name="edit_detail_laporan_keuangan_tanggal"]').val();
			var edit_detail_laporan_keuangan_id = $('input[name="edit_detail_laporan_keuangan_id"]').val();
			var edit_detail_laporan_keuangan_id_master_file_laporan_keuangan = $('input[name="edit_detail_laporan_keuangan_id_master_file_laporan_keuangan"]').val();
			var edit_detail_laporan_keuangan_id_transaksi_mata_anggaran = $('input[name="edit_detail_laporan_keuangan_id_transaksi_mata_anggaran"]').val();
			var edit_detail_laporan_keuangan_lama = $('input[name="edit_detail_laporan_keuangan_lama"]').val();
			var edit_detail_laporan_keuangan_file = $('input[name="edit_detail_laporan_keuangan_file"]').get(0).files[0];
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Keuangan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("edit_detail_laporan_keuangan_tanggal", edit_detail_laporan_keuangan_tanggal);
			        data.append("edit_detail_laporan_keuangan_id", edit_detail_laporan_keuangan_id);
			        data.append("edit_detail_laporan_keuangan_id_master_file_laporan_keuangan", edit_detail_laporan_keuangan_id_master_file_laporan_keuangan);
			        data.append("edit_detail_laporan_keuangan_id_transaksi_mata_anggaran", edit_detail_laporan_keuangan_id_transaksi_mata_anggaran);
		            data.append("edit_detail_laporan_keuangan_lama", edit_detail_laporan_keuangan_lama);
			        data.append("edit_detail_laporan_keuangan_file", edit_detail_laporan_keuangan_file);
			        return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil diubah!");
				}
			})					
	    });	

	    $('#hapus_detail_laporan_keuangan').on( 'click', function () {	
			var transaksi_mata_anggaran_id = $('#transaksi_mata_anggaran_id').val();
			var detail_detail_laporan_keuangan_id = $('input[name="detail_detail_laporan_keuangan_id"]').val();
			var detail_detail_laporan_keuangan_id_master_file_laporan_keuangan = $('input[name="detail_detail_laporan_keuangan_id_master_file_laporan_keuangan"]').val();
			var detail_detail_laporan_keuangan_id_transaksi_mata_anggaran = $('input[name="detail_detail_laporan_keuangan_id_transaksi_mata_anggaran"]').val();
			var detail_detail_laporan_keuangan_lama = $('input[name="detail_detail_laporan_keuangan_lama"]').val();
			$.ajax({
				type:"POST",
				url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Keuangan%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
		            data.append("transaksi_mata_anggaran_id", transaksi_mata_anggaran_id);
		            data.append("detail_detail_laporan_keuangan_id", detail_detail_laporan_keuangan_id);
		            data.append("detail_detail_laporan_keuangan_id_master_file_laporan_keuangan", detail_detail_laporan_keuangan_id_master_file_laporan_keuangan);
		            data.append("detail_detail_laporan_keuangan_id_transaksi_mata_anggaran", detail_detail_laporan_keuangan_id_transaksi_mata_anggaran);
		            data.append("detail_detail_laporan_keuangan_lama", detail_detail_laporan_keuangan_lama);
		            return data;
		        }(),
		        success:function(data){
		        	//alert(JSON.stringify(data));
					refresh_table_t(tabel_pengajuan_baru, data);
	            	alert("Data berhasil dihapus!");
				}
			})		
	    });		    	    		    

});	    

</script>

<section class="content-header">
  <h1>
    Pengajuan Anggaran
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Laman Muka</a></li>
    <li><a href="#"><i class="fa fa-edit">Pengajuan Anggaran</i></a></li>
    <li><a href="#"><i class="fa fa-circle-o">Pengajuan Baru</i></a></li>
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
					<div class="modal-header">
						<button type="button" class="close" id="close_show_detail" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Silahkan Pilih Rencana Anggaran Perbagian.</h4>
					</div>
					<div class="modal-body">
	 					<div class="form-group">
	                     	<label for="info">Tahun anggaran</label>&nbsp;:&nbsp;<label for="info" id="l_show_detail_tahun_anggaran"></label>
	                     	<input type="hidden" class="form-control" id="show_detail_id_tahun_anggaran">
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
			                    	<th width="1"></th>         
			                        <th>Kode</th>
			                        <th>Mata anggaran</th>
			                        <th>Total dana</th>
		                       		<th>Total penerima dana</th>
		                       		<th>Sisa dana</th>
		                       		<th>Realisasi (%) </th>
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

	<div class="row" id="pengajuan_baru">
		<div class="col-xs-12">
			<!-- box box-primary -->

			<div class="box box-primary">

				<div class="modal fade" id="mymodalupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Unggah Data Pengajuan Baru</h4>
							</div>
							<div class="modal-body">	
								<div class="form-group">
									<label for="manajemenPengguna">File Pengajuan Baru</label>
								    <input type="file" class="form-control" id="detail_file_pengajuan_baru">
								    <input type="hidden" class="form-control" id="detail_file_id_transaksi_mata_anggaran">
								</div>	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="unggah" data-dismiss="modal">Unggah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Tambah Data Program</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="manajemenPengguna">Program utama</label>
								   	<input type="text" class="form-control" id="add_program_utama" placeholder="Masukan nama program utama">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Program</label>
								   	<input type="text" class="form-control" id="add_program"  placeholder="Masukan nama program">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Sasaran</label>
								   	<input type="text" class="form-control" id="add_sasaran"  placeholder="Masukan sasaran">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Kegiatan</label>
								   	<input type="text" class="form-control" id="add_kegiatan"  placeholder="Masukan nama kegiatan">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Penanggung jawab</label>
								   	<input type="text" class="form-control" id="add_penanggung_jawab"  placeholder="Masukan nama penanggung jawab">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Jumlah anggaran</label>
								   	<input type="text" class="form-control auto" data-a-sep="." data-a-dec="," data-a-sign="Rp "  id="add_jumlah_anggaran"  placeholder="Masukan jumlah anggaran">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal pelaksana</label>
								   	<input type="date" class="form-control" id="add_tanggal_pelaksana"  placeholder="Masukan tanggal pelaksanaan">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Keterangan</label>
								   	<input type="text" class="form-control" id="add_keterangan"  placeholder="Masukan keterangan">
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="tambah_detail" data-dismiss="modal">Simpan</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data Program</h4>
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

				<div class="modal fade" id="mymodaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Permanen Data Program</h4>
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

				<div class="modal fade" id="mymodaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Detail Program</h4>
							</div>
							<div class="modal-body" id="pop_up_detail_detail">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="detail_detail" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<!--file pengajuan-->
				<div class="modal fade" id="mymodaluploadfilepengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Unggah File Pengajuan</h4>
							</div>
							<div class="modal-body">	
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal pengajuan</label>
								    <input type="date" class="form-control" id="detail_tanggal_file_pengajuan">
								    <input type="hidden" class="form-control" id="detail_file_pengajuan_id_transaksi_mata_anggaran"  placeholder="Masukan tanggal pengajuan proposal">
								</div>	
								<div class="form-group">
									<label for="manajemenPengguna">Kepada</label>
								    <input type="text" class="form-control" id="detail_kepada_file_pengajuan"  placeholder="Masukan nama orang yang dituju">
								</div>	
								<div class="form-group">
									<label for="manajemenPengguna">File pengajuan</label>
								    <input type="file" class="form-control" id="detail_file_pengajuan">
								</div>	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="unggah_file_pengajuan" data-dismiss="modal">Unggah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaleditfilepengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data File Pengajuan</h4>
							</div>
							<div class="modal-body" id="pop_up_edit_detail_file_pengajuan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="ubah_detail_file_pengajuan" data-dismiss="modal">Ubah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaldeletefilepengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Permanen File Pengajuan</h4>
							</div>
							<div class="modal-body" id="pop_up_delete_detail_file_pengajuan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="hapus_detail_file_pengajuan" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<!--surat pengajuan-->
				<div class="modal fade" id="mymodaluploadsuratpengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Unggah Data Surat Pengajuan</h4>
							</div>
							<div class="modal-body">	
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal pengajuan</label>
								   	<input type="date" class="form-control" name="detail_surat_pengajuan_tanggal" placeholder="Masukan tanggal">			
								    <input type="hidden" class="form-control" id="detail_surat_pengajuan_id_transaksi_mata_anggaran">
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Kepada</label>
								   	<input type="text" class="form-control" name="detail_surat_pengajuan_kepada" placeholder="Masukan nama orang yang dituju">			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Nomor surat</label>
								   	<input type="text" class="form-control" name="detail_surat_pengajuan_nomor_surat" placeholder="Masukan nomor surat">			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Perihal surat</label>
								   	<input type="text" class="form-control" name="detail_surat_pengajuan_perihal_surat" placeholder="Masukan perihal surat">			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Surat pengajuan</label>
								   	<input type="file" class="form-control" name="detail_surat_pengajuan_surat_pengajuan" placeholder="Masukan surat pengajuan">			
								</div>								
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="unggah_surat_pengajuan" data-dismiss="modal">Unggah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaleditsuratpengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data Surat Pengajuan</h4>
							</div>
							<div class="modal-body" id="pop_up_edit_detail_surat_pengajuan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="ubah_detail_surat_pengajuan" data-dismiss="modal">Ubah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaldeletesuratpengajuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Permanen Surat Pengajuan</h4>
							</div>
							<div class="modal-body" id="pop_up_delete_detail_surat_pengajuan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="hapus_detail_surat_pengajuan" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<!--surat persetujuan--> 
				<div class="modal fade" id="mymodaluploadsuratpersetujuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Unggah Data Surat Persetujuan Universitas</h4>
							</div>
							<div class="modal-body">	
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal surat persetujuan</label>
								   	<input type="date" class="form-control" name="detail_surat_persetujuan_tanggal" placeholder="Masukan tanggal surat persetujuan">			
								   	<input type="hidden" class="form-control" id="detail_surat_persetujuan_id_transaksi_mata_anggaran" >			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Kepada</label>
								   	<input type="text" class="form-control" name="detail_surat_persetujuan_kepada" placeholder="Masukan nama orang yang dituju">			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Nomor surat persetujuan</label>
								   	<input type="text" class="form-control" name="detail_surat_persetujuan_nomor_surat" placeholder="Masukan nomor surat persetujuan">			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Perihal surat persetujuan</label>
								   	<input type="text" class="form-control" name="detail_surat_persetujuan_perihal_surat" placeholder="Masukan perihal surat persetujuan">			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Total dana yang disetujui</label>
								   	<input type="text" class="form-control auto" data-a-sep="." data-a-dec="," data-a-sign="Rp "  name="detail_surat_persetujuan_total_dana" placeholder="Masukan jumlah dana yang disetujui">			
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">File surat persetujuan</label>
								   	<input type="file" class="form-control" name="detail_surat_persetujuan_file" placeholder="Unggah surat persetujuan">			
								</div>	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="unggah_surat_persetujuan" data-dismiss="modal">Unggah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaleditsuratpersetujuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data Surat Persetujuan Universitas</h4>
							</div>
							<div class="modal-body" id="pop_up_edit_detail_surat_persetujuan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="ubah_detail_surat_persetujuan" data-dismiss="modal">Ubah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaldeletesuratpersetujuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Permanen Data Surat Persetujuan Universitas</h4>
							</div>
							<div class="modal-body" id="pop_up_delete_detail_surat_persetujuan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="hapus_detail_surat_persetujuan" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>				

				<!--penerimaan dana--> 
				<div class="modal fade" id="mymodaladdpenerimaandana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Tambah Data Penerimaan Dana</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal penerimaan dana</label>
								   	<input type="date" class="form-control" id="detail_penerimaan_dana_tanggal" >
									 <input type="hidden" class="form-control" id="detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian" >
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">Jumlah dana yang diterima</label>
								   	<input type="text" class="form-control auto" data-a-sep="." data-a-dec="," data-a-sign="Rp " id="detail_penerimaan_dana_jumlah_dana_yang_diterima"  placeholder="Masukan jumlah dana yang diterima">
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="tambah_detail_penerimaan_dana" data-dismiss="modal">Simpan</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaleditpenerimaandana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data Penerimaan Dana</h4>
							</div>
							<div class="modal-body" id="pop_up_edit_detail_penerimaan_dana">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="ubah_detail_penerimaan_dana" data-dismiss="modal">Ubah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaldeletepenerimaandana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Data Penerimaan Dana</h4>
							</div>
							<div class="modal-body" id="pop_up_delete_detail_penerimaan_dana">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="hapus_detail_penerimaan_dana" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<!--persetujuan dekanat-->
				<div class="modal fade" id="mymodaladdpersetujuandekanat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Tambah Data Persetujuan Dekanat</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal persetujuan dekanat</label>
								   	<input type="date" class="form-control" id="detail_persetujuan_dekanat_tanggal" >
									 <input type="hidden" class="form-control" id="detail_persetujuan_dekanat_id_transaksi_mata_anggaran" >
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="tambah_detail_persetujuan_dekanat" data-dismiss="modal">Simpan</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaleditpersetujuandekanat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data Persetujuan Dekanat</h4>
							</div>
							<div class="modal-body" id="pop_up_edit_detail_persetujuan_dekanat">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="ubah_detail_persetujuan_dekanat" data-dismiss="modal">Ubah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaldeletepersetujuandekanat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Data Persetujuan Dekanat</h4>
							</div>
							<div class="modal-body" id="pop_up_delete_detail_persetujuan_dekanat">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="hapus_detail_persetujuan_dekanat" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>				



				<!--Laporan Kegiatan-->
				<div class="modal fade" id="mymodaluploadlaporankegiatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Tambah Data Laporan Kegiatan</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal pengumpulan laporan kegiatan</label>
								   	<input type="date" class="form-control" name="detail_laporan_kegiatan_tanggal" >
									 <input type="hidden" class="form-control" id="detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian" >
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">File laporan kegiatan</label>
								   	<input type="file" class="form-control" name="detail_laporan_kegiatan_file" placeholder="Unggah laporan kegiatan">			
								</div>	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="unggah_detail_laporan_kegiatan" data-dismiss="modal">Simpan</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaleditlaporankegiatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data Laporan Kegiatan</h4>
							</div>
							<div class="modal-body" id="pop_up_edit_detail_laporan_kegiatan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="ubah_detail_laporan_kegiatan" data-dismiss="modal">Ubah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaldeletelaporankegiatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Data Laporan Kegiatan</h4>
							</div>
							<div class="modal-body" id="pop_up_delete_detail_laporan_kegiatan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="hapus_detail_laporan_kegiatan" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>	


				<!--Laporan Keuangan-->
				<div class="modal fade" id="mymodaluploadlaporankeuangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Tambah Data Laporan Keuangan</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="manajemenPengguna">Tanggal pengumpulan laporan keuangan</label>
								   	<input type="date" class="form-control" name="detail_laporan_keuangan_tanggal" >
									 <input type="hidden" class="form-control" id="detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian" >
								</div>
								<div class="form-group">
									<label for="manajemenPengguna">File laporan keuangan</label>
								   	<input type="file" class="form-control" name="detail_laporan_keuangan_file" placeholder="Unggah laporan keuangan">			
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="unggah_detail_laporan_keuangan" data-dismiss="modal">Simpan</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaleditlaporankeuangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Ubah Data Laporan Keuangan</h4>
							</div>
							<div class="modal-body" id="pop_up_edit_detail_laporan_keuangan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="ubah_detail_laporan_keuangan" data-dismiss="modal">Ubah</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal fade" id="mymodaldeletelaporankeuangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div  style="width: 700px;" class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Hapus Data Laporan Keuangan</h4>
							</div>
							<div class="modal-body" id="pop_up_delete_detail_laporan_keuangan">	
							</div>
							<div class="modal-footer">
								<button class="btn btn-success " id="hapus_detail_laporan_keuangan" data-dismiss="modal">Hapus</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>				
						</div>
					</div>
				</div>

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" id="close_pengajuan_baru" aria-hidden="true">&times;</button>
	                    <br>
						<div class="form-group">
							<label for="info_long_btn">Pengajuan Anggaran</label>
							<button class="btn btn-warning" id="upload_form" data-toggle="modal" data-target="#mymodalupload"><i class="fa fa-cloud-upload"></i>Unggah excel</button>
							<button class="btn btn-primary" id="tambah_form" data-toggle="modal" data-target="#mymodaladd"><i class="fa fa-plus"></i>Tambah</button>
							<button class="btn btn-success" id="ubah_form" data-toggle="modal" data-target="#mymodaledit"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_form" data-toggle="modal" data-target="#mymodaldelete"><i class="fa fa-trash"></i>Hapus</button>
						</div>
						<div class="form-group">
							<label for="info_long_btn">File Proposal Fakultas</label>
							<button class="btn btn-warning" id="upload_file_pengajuan_form" data-toggle="modal" data-target="#mymodaluploadfilepengajuan"><i class="fa fa-cloud-upload"></i>Unggah</button>
							<button class="btn btn-success" id="ubah_file_pengajuan_form" data-toggle="modal" data-target="#mymodaleditfilepengajuan"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_file_pengajuan_form" data-toggle="modal" data-target="#mymodaldeletefilepengajuan"><i class="fa fa-trash"></i>Hapus</button>
						</div>
						<div class="form-group">	
							<label for="info_long_btn">Persetujuan Dekanat</label>												
							<button class="btn btn-primary" id="tambah_persetujuan_dekanat_form" data-toggle="modal" data-target="#mymodaladdpersetujuandekanat"><i class="fa fa-plus"></i>Tambah</button>
							<button class="btn btn-success" id="ubah_persetujuan_dekanat_form" data-toggle="modal" data-target="#mymodaleditpersetujuandekanat"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_persetujuan_dekanat_form" data-toggle="modal" data-target="#mymodaldeletepersetujuandekanat"><i class="fa fa-trash"></i>Hapus</button>					
 						</div>
						<div class="form-group">	
							<label for="info_long_btn">Pengajuan Ke Universitas</label>					
							<button class="btn btn-warning" id="upload_surat_pengajuan_form" data-toggle="modal" data-target="#mymodaluploadsuratpengajuan"><i class="fa fa-cloud-upload"></i>Unggah</button>
							<button class="btn btn-success" id="ubah_surat_pengajuan_form" data-toggle="modal" data-target="#mymodaleditsuratpengajuan"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_surat_pengajuan_form" data-toggle="modal" data-target="#mymodaldeletesuratpengajuan"><i class="fa fa-trash"></i>Hapus</button>
						</div>
						<div class="form-group">
							<label for="info_long_btn">Persetujuan Universitas</label>						
							<button class="btn btn-warning" id="upload_surat_persetujuan_form" data-toggle="modal" data-target="#mymodaluploadsuratpersetujuan"><i class="fa fa-cloud-upload"></i>Unggah</button>
							<button class="btn btn-success" id="ubah_surat_persetujuan_form" data-toggle="modal" data-target="#mymodaleditsuratpersetujuan"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_surat_persetujuan_form" data-toggle="modal" data-target="#mymodaldeletesuratpersetujuan"><i class="fa fa-trash"></i>Hapus</button>
						</div>
						<div class="form-group">	
							<label for="info_long_btn">Penerimaan Dana Universitas</label>												
							<button class="btn btn-primary" id="tambah_penerimaan_dana_form" data-toggle="modal" data-target="#mymodaladdpenerimaandana"><i class="fa fa-plus"></i>Tambah</button>
							<button class="btn btn-success" id="ubah_penerimaan_dana_form" data-toggle="modal" data-target="#mymodaleditpenerimaandana"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_penerimaan_dana_form" data-toggle="modal" data-target="#mymodaldeletepenerimaandana"><i class="fa fa-trash"></i>Hapus</button>					
 						</div>
 						<div class="form-group">	
							<label for="info_long_btn">Laporan Kegiatan</label>												
							<button class="btn btn-warning" id="unggah_laporan_kegiatan_form" data-toggle="modal" data-target="#mymodaluploadlaporankegiatan"><i class="fa fa-plus"></i>Unggah</button>
							<button class="btn btn-success" id="ubah_laporan_kegiatan_form" data-toggle="modal" data-target="#mymodaleditlaporankegiatan"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_laporan_kegiatan_form" data-toggle="modal" data-target="#mymodaldeletelaporankegiatan"><i class="fa fa-trash"></i>Hapus</button>					
 						</div>
 						<div class="form-group">	
							<label for="info_long_btn">Laporan Keuangan</label>												
							<button class="btn btn-warning" id="unggah_laporan_keuangan_form" data-toggle="modal" data-target="#mymodaluploadlaporankeuangan"><i class="fa fa-plus"></i>Unggah</button>
							<button class="btn btn-success" id="ubah_laporan_keuangan_form" data-toggle="modal" data-target="#mymodaleditlaporankeuangan"><i class="fa fa-pencil-square-o"></i>Ubah</button>
							<button class="btn btn-danger" id="hapus_laporan_keuangan_form" data-toggle="modal" data-target="#mymodaldeletelaporankeuangan"><i class="fa fa-trash"></i>Hapus</button>					
 						</div>
                    </div>
					<div class="modal-body">
	                    <label for="info">Bagian</label>&nbsp;:&nbsp;<label for="info_long" id="l_transaksi_mata_anggaran_bagian" ></label><br>
                     	<label for="info">Kode</label>&nbsp;:&nbsp;<label for="info_long" id="l_transaksi_mata_anggaran_mata_anggaran"></label><br>
                     	<label for="info"> Total dana </label>&nbsp;:&nbsp;<label for="info_long" id="l_transaksi_mata_anggaran_total_dana"></label><br>
                     	<label for="info"> Penerimaan dana </label>&nbsp;:&nbsp;<label for="info_long" id="l_transaksi_mata_anggaran_total_penerimaan_dana"></label><br>
                     	<label for="info"> Sisa dana </label>&nbsp;:&nbsp;<label for="info_long" id="l_transaksi_mata_anggaran_sisa_dana"></label><br>
                     	<label for="info"> Realisasi dana </label>&nbsp;:&nbsp;<label for="info_long" id="l_transaksi_mata_anggaran_realisasi"></label><br>
                     	<label for="info"> Catatan </label>&nbsp;:&nbsp;<label for="info_long" id="l_transaksi_mata_anggaran_catatan"></label>
                      	<input type="hidden" class="form-control" id="transaksi_mata_anggaran_id">
                      	<input type="hidden" class="form-control" id="transaksi_mata_anggaran_total_dana">
                      	<input type="hidden" class="form-control" id="transaksi_mata_anggaran_catatan">
                      	<input type="hidden" class="form-control" id="transaksi_mata_anggaran_kode">
                      	<input type="hidden" class="form-control" id="transaksi_mata_anggaran_mata_anggaran">
                      	<input type="hidden" class="form-control" id="transaksi_mata_anggaran_bagian">					
					</div>		
					<!-- view data -->					
	                <div class="box-body">
						<table id="tabel_pengajuan_baru" class="table table-bordered table-striped">
			            	<thead>
			                	<tr>
			                    	<th colspan=5>Pengajuan</th>
			                    	<th colspan=3>Proposal Pengajuan</th>
			                        <th rowspan=2>Tanggal Persetujuan dekanat</th>
			                    	<th colspan=5>Pengajuan Ke Universitas</th>
			                    	<th colspan=3>Persetujuan Universitas</th>
			                    	<th colspan=2>Penerimaan Dana</th>
			                    	<th colspan=4>Laporan</th>
			                        <th rowspan=2>Saldo</th>
			                    </tr>			            		
			                	<tr>
			                    	<th></th>
			                    	<th>Kegiatan</th>
			                        <th>Tanggal pelaksanaan</th>
			                        <th>Penanggung jawab</th>
			                        <th>Jumlah dana yang diajukan</th>
			                        <th>Proposal pengajuan</th>
			                        <th>Tanggal pengajuan proposal</th>
			                        <th>Pengajuan proposal Kepada</th>
			                        <th>Tanggal diajukan</th>
			                        <th>Nomor surat pengajuan</th>
			                        <th>Perihal surat pengajuan</th>
			                        <th>Kepada</th>
			                        <th>Surat pengajuan</th>
			                        <th>Tanggal disetujui Universitas</th>
			                        <th>Surat persetujuan</th>
			                        <th>Jumlah dana yang disetujui</th>
			                        <th>Tanggal diterima kasir</th>
			                        <th>Jumlah dana yang diterima kasir</th>
			                        <th>Laporan Kegiatan</th>
			                        <th>Laporan Kegiatan</th>
			                        <th>Laporan Keuangan</th>
			                        <th>Laporan Keuangan</th>
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

</section><!-- /.content -->
