<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="http://127.0.0.1/CI/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
  	$(document).ready(function(){

		$(function(){
			$.ajax({
		      url: "Kasir/Detail%20Tabel%20Kasir",                          
		      data: "", 
		      dataType: "html",                         
	      	  success: function(data){
				$("#kasir_this_year").html(data);
			  }
			})
		});

		/*
	  	t.order( [ 0, 'desc' ] ).draw(false);
	  	t.column(0).visible( false );



		$('#tabel_kasir thead input[name="select_all"]').on('click', function(e){
		    if(this.checked){
			    t.$('input[name="id_kasir[]"]:not(:checked)').trigger('click');
		    } else {
		    	t.$('input[name="id_kasir[]"]:checked').trigger('click');
		    }
			e.stopPropagation();
		});

		$("#tambah_form").click(function(){ 	
			$.ajax({
				url:"Kasir/Tambah%20Data%20Kasir%20Form",
				success:function(data){
					$("#pop_up_add").html(data);
				}
			})
		});

	    $('#simpan').on( 'click', function () {
	 		var nama_bagian =$("#nama_bagian").val();
			$.ajax({
				type:"POST",
				url:"Kasir/Tambah%20Data%20Kasir%20Action",
		        contentType: false,
		        processData: false,     
		        dataType: "json",                    
				data: function() {
			        var data = new FormData();
			        data.append("nama_bagian", nama_bagian);
			        return data;
		        }(),
		        success:function(data){
		        	refresh_tabel_t(t, data);
		        	alert('Data berhasil disimpan!');
				}
			})
	    });	

		$("#ubah_form").click(function(){ 	
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_kasir[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Kasir/Ubah%20Data%20Kasir%20Form",
					data:"id_kasir_array="+idArray,
					success:function(data){
						$("#pop_up_edit").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;

			}
		});	

		$("#ubah").click(function(){
			var edit_id_kasir = new Array();
			$('input[name="edit_id_kasir[]"]').each(function() {
				edit_id_kasir.push($(this).val());
			});		

			var edit_nama_bagian = new Array();
			$('input[name="edit_nama_bagian[]"]').each(function() {
				edit_nama_bagian.push($(this).val());
			});	

			$.ajax({
				type:"POST",
				url:"Kasir/Ubah%20Data%20Kasir%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("edit_id_kasir", edit_id_kasir);
		            data.append("edit_nama_bagian", edit_nama_bagian);
		            return data;
	            }(),
	            success:function(data){
		        	refresh_tabel_t(t, data);
	            	alert("Data berhasil diubah!");
				}
			})
		});	

		$("#ubah_form").click(function(){ 	
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_kasir[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Kasir/Ubah%20Data%20Kasir%20Form",
					data:"id_kasir_array="+idArray,
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
			var delete_id_kasir = new Array();
			$('input[name="delete_id_kasir[]"]').each(function() {
				delete_id_kasir.push($(this).val());
			});		

			$.ajax({
				type:"POST",
				url:"Kasir/Hapus%20Data%20Kasir%20Action",
	            contentType: false,
	            processData: false,   
		        dataType: "json",  
				data: function() {
		            var data = new FormData();
		            data.append("delete_id_kasir", delete_id_kasir);
		            return data;
	            }(),
	            success:function(data){
		        	refresh_tabel_t(t, data);
	            	alert("Data berhasil dihapus!");
				}
			})
		});	

		$("#hapus_form").click(function(){ 	
			var idArray = new Array();
			var tmp;
			t.$('input[name="id_kasir[]"]:checked').each(function() {
				idArray.push($(this).val());
			});
			if(idArray.length>0){
				$.ajax({
					type:"POST",
					url:"Kasir/Hapus%20Data%20Kasir%20Form",
					data:"id_kasir_array="+idArray,
					success:function(data){
						$("#pop_up_delete").html(data);
					}
				})
			}else{
				alert('Anda belum memilih data!');
				return false;

			}
		});	
*/
	});	 

</script>

<section class="content-header">
  <h1>
    Kasir
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Laman Muka</a></li>
    <li><a href="#"><i class="fa fa-table">Kasir</i></a></li>
  </ol>
</section>
<section class="content" id="kasir_this_year">

</section><!-- /.content -->

