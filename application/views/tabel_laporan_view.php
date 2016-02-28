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

	function handleClickPengajuanBaru(cb) {
		var count = $('input[name="id_pengajuan_baru[]"]:checked').length;
		if(cb.checked){
			if(count>1){
				$('input[name="id_pengajuan_baru[]"]:checked').attr('checked', false);
				cb.checked = true;
			}
		}
		$.ajax({
			type:"POST",
			url:"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Detail%20Data%20Form",
			data:"id_pengajuan_baru_array="+cb.value,
			success:function(data){
				$("#pop_up_detail_laporan").html(data);
			}
		})	

	}

	function refresh_tabel_pengajuan_baru(table, data) {
		table.clear().draw();
		for(var i=0; i<data.length; i++){
	    	table.row.add( [data[i].id,"<input type=\"checkbox\" name=\"id_pengajuan_baru[]\" data-toggle=\"modal\" data-target=\"#mymodal\" onclick='handleClickPengajuanBaru(this);'  value=\""+data[i].id+"\" >", data[i].kegiatan,data[i].tanggal_pelaksana,data[i].penanggung_jawab,data[i].total_anggaran,data[i].nama_file_pengajuan,data[i].tanggal_file_pengajuan,data[i].kepada_file_pengajuan,data[i].tanggal_persetujuan_dekanat,data[i].tanggal_surat_pengajuan,data[i].nomor_surat_pengajuan,data[i].perihal_surat_pengajuan,data[i].kepada_surat_pengajuan,data[i].tanggal_surat_persetujuan,data[i].nama_file_surat_persetujuan,data[i].total_dana_surat_persetujuan,data[i].tanggal_diterima_kasir,data[i].dana_diterima,data[i].nama_file_laporan_kegiatan,data[i].nama_file_laporan_keuangan,0] ).draw( false );
		}
	}

</script>


<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div  style="width: 800px;" class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id="close_detail" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Detail Data</h4>
			</div>
			<div class="modal-body" id="pop_up_detail_laporan">	
			</div>			
		</div>
	</div>
</div>

<?php
//print_r($raw_data);
echo"
<script type=\"text/javascript\">
";

for($i=0;$i<count($raw_data);$i++){
	echo"
		var tabel_pengajuan_baru_".$i." = $('#tabel_pengajuan_baru_".$i."').DataTable(
		{
		  	\"autoWidth\": false,
	        \"sScrollX\": \"400%\",
		  	\"columnDefs\": [
				{ \"width\": \"0.1%\", sClass: \"dt-head-center dt-body-center\", \"bSortable\": false, \"targets\": 1 },
				{ \"width\": \"10.8%\", sClass: \"dt-head-center dt-body-justify\", \"targets\": 2 },
				{ \"width\": \"3%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 3 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 4 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-right\", \"type\": \"num-fmt\", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), \"targets\": 5 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 6 },
				{ \"width\": \"3%\", sClass: \"dt-head-center dt-body-center\", \"targets\": 7 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 8 },
				{ \"width\": \"3%\", sClass: \"dt-head-center dt-body-center\", \"targets\": 9 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-center\", \"targets\": 10 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-center\", \"targets\": 11  },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-justify\", \"targets\": 12 },
				{ \"width\": \"3%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 13 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 14 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 15 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-right\", \"type\": \"num-fmt\", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), \"targets\": 16 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 17 },
				{ \"width\": \"5%\", sClass: \"dt-head-center dt-body-right\", \"type\": \"num-fmt\", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), \"targets\": 18 },
				{ \"width\": \"7%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 19 },		
				{ \"width\": \"7%\", sClass: \"dt-head-center dt-body-left\", \"targets\": 20 },
				{ \"width\": \"7%\", sClass: \"dt-head-center dt-body-right\", \"type\": \"num-fmt\",render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' ), \"targets\": 21 }
				]
		});
		tabel_pengajuan_baru_".$i.".order( [ 0, 'asc' ] ).draw(false);
	  	tabel_pengajuan_baru_".$i.".column(0).visible( false );

	";
}

echo"
		$('#close_detail').on( 'click', function () {
			$('input[name=\"id_pengajuan_baru[]\"]:checked').attr('checked', false);
		});	 
</script>
";

echo"
<script type=\"text/javascript\">
	$(document).ready(function(){
";
	for($i=0;$i<count($raw_data);$i++){
echo"
		$(function(){
			$.ajax({
				type:\"POST\",
				url:\"Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tabel%20Pengajuan%20Baru\",
				data:\"id_pengajuan_baru=\"+".$raw_data[$i]['id_transaksi_mata_anggaran'].",    
		    	dataType: \"json\",  
				success:function(data){
					refresh_tabel_pengajuan_baru(tabel_pengajuan_baru_".$i.", data);
				}
			})
		});
";
	}
echo"
	});		
</script>
";

for($i=0;$i<count($raw_data);$i++){
	if($raw_data[$i]['total_dana_transaksi_mata_anggaran']!=0){
		echo"
			<div class=\"box box-primary\">
				<div class=\"modal-content\">
					<div class=\"modal-body\">
	                    <label for=\"info\">Bagian</label>&nbsp;:&nbsp;<label for=\"info_long\">".$raw_data[$i]['bagian_transaksi_mata_anggaran']." (".$raw_data[$i]['tahun_anggaran_transaksi_mata_anggaran'].")</label><br>
	                 	<label for=\"info\">Kode</label>&nbsp;:&nbsp;<label for=\"info_long\">".$raw_data[$i]['kode_transaksi_mata_anggaran']." ".$raw_data[$i]['mata_anggaran_transaksi_mata_anggaran']."</label><br>
	                 	<label for=\"info\"> Total dana </label>&nbsp;:&nbsp;<label for=\"info_long\" class=\"auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \">".$raw_data[$i]['total_dana_transaksi_mata_anggaran']."</label><br>
	                 	<label for=\"info\"> Penerimaan dana </label>&nbsp;:&nbsp;<label for=\"info_long\" class=\"auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \">".$raw_data[$i]['total_penerimaan_dana_transaksi_mata_anggaran']."</label><br>
	                 	<label for=\"info\"> Catatan </label>&nbsp;:&nbsp;<label for=\"info_long\">".$raw_data[$i]['catatan_transaksi_mata_anggaran']."</label>
					</div>	
	                <div class=\"box-body\">
						<table id=\"tabel_pengajuan_baru_$i\" class=\"table table-bordered table-striped\">
			            	<thead>
			                	<tr>
			                    	<th></th>
			                    	<th></th>
			                    	<th>Kegiatan</th>
			                        <th>Tanggal pelaksanaan</th>
			                        <th>Penanggung jawab</th>
			                        <th>Jumlah dana yang diajukan</th>
			                        <th>Proposal pengajuan</th>
			                        <th>Tanggal pengajuan proposal</th>
			                        <th>Pengajuan proposal Kepada</th>
			                        <th>Tanggal Persetujuan dekanat</th>
			                        <th>Tanggal diajukan</th>
			                        <th>Nomor surat pengajuan</th>
			                        <th>Perihal surat pengajuan</th>
			                        <th>Kepada</th>
			                        <th>Tanggal disetujui Universitas</th>
			                        <th>Surat persetujuan</th>
			                        <th>Jumlah dana yang disetujui</th>
			                        <th>Tanggal diterima kasir</th>
			                        <th>Jumlah dana yang diterima kasir</th>
			                        <th>Laporan Kegiatan</th>
			                        <th>Laporan Keuangan</th>
			                        <th>Saldo</th>
			                    </tr>
			                </thead>
			                <tbody>
							</tbody>
			                <tfoot>
			                </tfoot>
			            </table>	              
	                </div>			
				</div>
			</div>
		";
	}
}

?>