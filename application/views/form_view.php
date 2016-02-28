<script src="http://127.0.0.1/CI/dist/js/autoNumeric.js"></script>
<!--ajax in here-->
<script type="text/javascript">
jQuery(function($) {
    $('.auto').autoNumeric('init');
});
</script>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$tahun_anggaran_end = date('Y');
$tahun_anggaran_start = $tahun_anggaran_end - 20;
 
switch ($action) {
	case "ubah_bagian_form":
		for($i=0;$i<count($raw_data);$i++){
			echo"
				<div class=\"form-group\">
				   	<label for=\"exampleInputEmail1\">Bagian</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_nama_bagian[]\" value=\"".$raw_data[$i][0]->bagian."\" placeholder=\"[ kosong ]\">
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_id_bagian[]\" value=\"".$raw_data[$i][0]->id."\">
				</div>
			";
		}
		break;

	case "hapus_bagian_form":
		for($i=0;$i<count($raw_data);$i++){
			echo"
				<div class=\"form-group\">
				   	<label for=\"exampleInputEmail1\">Bagian</label>
				   	<input type=\"text\" class=\"form-control\" value=\"".$raw_data[$i][0]->bagian."\" placeholder=\"[ kosong ]\" disabled>
				   	<input type=\"hidden\" class=\"form-control\" name=\"delete_id_bagian[]\" value=\"".$raw_data[$i][0]->id."\" >
				</div>
			";
		}
		break;

	case "ubah_manajemen_pengguna_form":
		for($i=0;$i<count($raw_data);$i++){
			echo"
				<div class=\"form-group has-feedback\">
					<label>Data Pribadi ".$raw_data[$i][0]->nama_lengkap."</label>
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_id[]\" value=\"".$raw_data[$i][0]->id."\">
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_id_biodata[]\" value=\"".$raw_data[$i][0]->id_biodata."\">
				</div>
				<div class=\"form-group has-feedback\">
				 	<label for=\"manajemenPengguna\">Email</label>
				   	<input type=\"email\" class=\"form-control\" id=\"email\" name=\"edit_email[]\" value=\"".$raw_data[$i][0]->email."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Nama Lengkap</label>
				   	<input type=\"text\" class=\"form-control\" id=\"nama_lengkap\" name=\"edit_nama_lengkap[]\" value=\"".$raw_data[$i][0]->nama_lengkap."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Nama Panggilan</label>
				   	<input type=\"text\" class=\"form-control\" id=\"nama_panggilan\" name=\"edit_nama_panggilan[]\" value=\"".$raw_data[$i][0]->nama_panggilan."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Tempat Lahir</label>
				   	<input type=\"text\" class=\"form-control\" id=\"tempat_lahir\" name=\"edit_tempat_lahir[]\" value=\"".$raw_data[$i][0]->tempat_lahir."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Tanggal Lahir</label>
				   	<input type=\"date\" class=\"form-control\" id=\"tanggal_lahir\" name=\"edit_tanggal_lahir[]\" value=\"".$raw_data[$i][0]->tanggal_lahir."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Alamat</label>
				   	<input type=\"text\" class=\"form-control\" id=\"alamat\" name=\"edit_alamat[]\" value=\"".$raw_data[$i][0]->alamat."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Jenis Kelamin</label>
				   	<select class=\"form-control\" id=\"jenis_kelamin\" size=\"1\" name=\"edit_jenis_kelamin[]\">
				  		<option "; if($raw_data[$i][0]->jenis_kelamin=="Pria") echo "selected"; echo" value=\"Pria\">Pria</option>
				  		<option "; if($raw_data[$i][0]->jenis_kelamin=="Wanita") echo "selected"; echo" value=\"Wanita\">Wanita</option>
				 	</select>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">No Telpon</label>
				   	<input type=\"text\" class=\"form-control\" id=\"no_telepon\" name=\"edit_no_telepon[]\" value=\"".$raw_data[$i][0]->no_telepon."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">No Fax</label>
				   	<input type=\"text\" class=\"form-control\" id=\"no_fax\" name=\"edit_no_fax[]\" value=\"".$raw_data[$i][0]->no_fax."\" placeholder=\"[ kosong ]\">
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">No Hp</label>
				   	<input type=\"text\" class=\"form-control\" id=\"no_hp\" name=\"edit_no_hp[]\" value=\"".$raw_data[$i][0]->no_hp."\" placeholder=\"[ kosong ]\">
				</div>		
				<div class=\"form-group\">
				   	<img style=\"width:200px;\" src=\"".$raw_data[$i][0]->foto_path."\">
				</div>		
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Path</label>
				   	<input type=\"text\" class=\"form-control\" id=\"old_foto_path\" name=\"edit_old_foto_path[]\" value=\"".$raw_data[$i][0]->foto_path."\"  placeholder=\"[ kosong ]\" disabled>
				</div>		
				<div class=\"form-group has-feedback\">
					<label for=\"manajemenPengguna\">Username</label>
					<input type=\"text\" class=\"form-control\" value=\"".$raw_data[$i][0]->username."\"  placeholder=\"[ kosong ]\" disabled>
				</div>							
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Level</label></br>
					<select name=\"edit_level[]\" class=\"form-control\" id=\"level\">
						<option "; if($raw_data[$i][0]->level=="USER") echo "selected"; echo" value=\"USER\">User</option>
						<option "; if($raw_data[$i][0]->level=="MASTER") echo "selected"; echo" value=\"MASTER\">Master</option>
						<option "; if($raw_data[$i][0]->level=="SPESIAL") echo "selected"; echo" value=\"SPESIAL\">Spesial</option>
					</select>
				</div>
				<br>
				<hr>
			";
		}
		break;

	case "delete_manajemen_pengguna_form":
		for($i=0;$i<count($raw_data);$i++){
			echo"
				<div class=\"form-group has-feedback\">
					 <label>Data Pribadi ".$raw_data[$i][0]->nama_lengkap."</label>
				   	<input type=\"hidden\" class=\"form-control\" name=\"delete_id[]\" value=\"".$raw_data[$i][0]->id."\">
				   	<input type=\"hidden\" class=\"form-control\" name=\"delete_id_biodata[]\" value=\"".$raw_data[$i][0]->id_biodata."\">
				</div>
				<div class=\"form-group has-feedback\">
				 	<label for=\"manajemenPengguna\">Email</label>
				   	<input type=\"email\" class=\"form-control\" id=\"email\" name=\"delete_email[]\" value=\"".$raw_data[$i][0]->email."\" placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Nama Lengkap</label>
				   	<input type=\"text\" class=\"form-control\" id=\"nama_lengkap\" name=\"delete_nama_lengkap[]\" value=\"".$raw_data[$i][0]->nama_lengkap."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Nama Panggilan</label>
				   	<input type=\"text\" class=\"form-control\" id=\"nama_panggilan\" name=\"delete_nama_panggilan[]\" value=\"".$raw_data[$i][0]->nama_panggilan."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Tempat Lahir</label>
				   	<input type=\"text\" class=\"form-control\" id=\"tempat_lahir\" name=\"delete_tempat_lahir[]\" value=\"".$raw_data[$i][0]->tempat_lahir."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Tanggal Lahir</label>
				   	<input type=\"date\" class=\"form-control\" id=\"tanggal_lahir\" name=\"delete_tanggal_lahir[]\" value=\"".$raw_data[$i][0]->tanggal_lahir."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Alamat</label>
				   	<input type=\"text\" class=\"form-control\" id=\"alamat\" name=\"delete_alamat[]\" value=\"".$raw_data[$i][0]->alamat."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">Jenis Kelamin</label>
					<input type=\"text\" class=\"form-control\" value=\"".$raw_data[$i][0]->jenis_kelamin."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">No Telpon</label>
				   	<input type=\"text\" class=\"form-control\" id=\"no_telepon\" name=\"delete_no_telepon[]\" value=\"".$raw_data[$i][0]->no_telepon."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
				   	<label for=\"manajemenPengguna\">No Fax</label>
				   	<input type=\"text\" class=\"form-control\" id=\"no_fax\" name=\"delete_no_fax[]\" value=\"".$raw_data[$i][0]->no_fax."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">No Hp</label>
				   	<input type=\"text\" class=\"form-control\" id=\"no_hp\" name=\"delete_no_hp[]\" value=\"".$raw_data[$i][0]->no_hp."\"  placeholder=\"[ kosong ]\" disabled>
				</div>		
				<div class=\"form-group\">
				   	<img style=\"width:200px;\" src=\"".$raw_data[$i][0]->foto_path."\">
				</div>		
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Path</label>
				   	<input type=\"text\" class=\"form-control\" id=\"old_foto_path\" name=\"delete_old_foto_path[]\" value=\"".$raw_data[$i][0]->foto_path."\"  placeholder=\"[ kosong ]\" disabled>
				</div>	
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Username</label>
					<input type=\"text\" class=\"form-control\" value=\"".$raw_data[$i][0]->username."\"  placeholder=\"[ kosong ]\" disabled>
				</div>							
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Level</label></br>
					<input type=\"text\" class=\"form-control\" value=\"".$raw_data[$i][0]->level."\"  placeholder=\"[ kosong ]\" disabled>
				</div>
				<br>
				<hr>
			";
		}
		break;
	
	case "ubah_image_profile_manajemen_pengguna_form":
		echo "
			<div class=\"form-group\">
			   	<img style=\"width:200px; margin-left:170px;\" src=\"".$foto_path."\">
			</div>		
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Path</label>
			   	<input type=\"text\" class=\"form-control\" id=\"old_foto_path_pic\" value=\"".$foto_path."\" disabled>
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Gambar baru</label>
			    <input type=\"file\" class=\"form-control\" id=\"foto_pic\">
			   	<input type=\"hidden\" class=\"form-control\" id=\"id_biodata_pic\" value=\"".$id_biodata."\">
			</div>				
		";
		break;

	case "tambah_rencana_per_bagian":
		echo "
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tahun anggaran</label>
				<select class=\"form-control\" id=\"tahun_anggaran\">
		";
				for($t=$tahun_anggaran_end;$t>=$tahun_anggaran_start ;$t--){
					echo"<option value=\"".$t."/".($t+1)."\">".$t."/".($t+1)."</option>";
				}

		echo"	</select>
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Bagian</label>
   				<select class=\"form-control\" id=\"nama_bagian\" >
			   	";
			   	for($i=0;$i<count($raw_data);$i++){
			   		echo"<option value=\"".$raw_data[$i]->id."\"> ".$raw_data[$i]->bagian." </option>";
			   	}
		echo"	</select>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">File rencana anggaran</label>
			    <input type=\"file\" class=\"form-control\" id=\"file_tahun_anggaran\" placeholder=\"[ kosong ]\">
			</div>				
		";		
		break;
	
	case "ubah_rencana_per_bagian":
		echo "
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tahun anggaran</label>
			   	<input type=\"hidden\" class=\"form-control\" id=\"ubah_id_tahun_anggaran\" value=\"".$id."\">
				<select class=\"form-control\" id=\"ubah_tahun_anggaran\">
		";
				for($t=$tahun_anggaran_end;$t>=$tahun_anggaran_start ;$t--){
					$cek=$t."/".($t+1);
					echo"<option value=\"".$t."/".($t+1)."\" ";
					if($tahun_anggaran==$cek) echo"selected";
					echo" >".$t."/".($t+1)."</option>";
				}

		echo"	</select>				   	
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Bagian</label>
   				<select class=\"form-control\" id=\"ubah_nama_bagian\" >
			   	";
			   	for($i=0;$i<count($raw_data);$i++){
			   		echo"<option value=\"".$raw_data[$i]->id."\" ";
			   		if($nama_bagian==$raw_data[$i]->bagian) echo " selected ";
			   		echo"> ".$raw_data[$i]->bagian." </option>";
			   	}
		echo"	</select>			
			</div>				
		";		
		break;				
	
	case "edit_mata_anggaran_form":
		echo "
			   	<input type=\"hidden\" class=\"form-control\" name=\"edit_id_tahun_anggaran\" value=\"".$raw_data[0][0]->id_master_tahun_anggaran."\">
			";
			for($i=0;$i<count($raw_data);$i++){
			echo"			
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kode Mata Anggaran</label>
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_id_mata_anggaran[]\" value=\"".$raw_data[$i][0]->id."\" >
				   	<input type=\"text\" class=\"form-control\" name=\"edit_kode_mata_anggaran[]\" value=\"".$raw_data[$i][0]->kode."\" placeholder=\"[ kosong ]\" >			
				</div>		
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Mata Anggaran</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_mata_anggaran[]\" value=\"".$raw_data[$i][0]->mata_anggaran."\"  placeholder=\"[ kosong ]\" >			
				</div>		
				<div class=\"form-group has-feedback\">
				 	<label for=\"manajemenPengguna\">Total Dana</label>
			       	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \" id=\"add_total_dana\" name=\"edit_total_dana[]\" value=\"".$raw_data[$i][0]->total_dana."\" id=\"currency\" placeholder=\"[ kosong ]\"/>
				</div>		
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Catatan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_catatan[]\" value=\"".$raw_data[$i][0]->catatan."\"  placeholder=\"[ kosong ]\">			
				</div>
				<hr>																				
			";		
			}
		break;
	
	case "delete_mata_anggaran_form":
		echo "
			   	<input type=\"hidden\" class=\"form-control\" name=\"delete_id_tahun_anggaran\" value=\"".$raw_data[0][0]->id_master_tahun_anggaran."\">
			";
			for($i=0;$i<count($raw_data);$i++){
			echo"			
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kode Mata Anggaran</label>
				   	<input type=\"hidden\" class=\"form-control\" name=\"delete_id_mata_anggaran[]\" value=\"".$raw_data[$i][0]->id."\"  disabled>
				   	<input type=\"text\" class=\"form-control\" name=\"delete_kode_mata_anggaran[]\" value=\"".$raw_data[$i][0]->kode."\" placeholder=\"[ kosong ]\" disabled>			
				</div>		
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Mata Anggaran</label>
				   	<input type=\"text\" class=\"form-control\" name=\"delete_mata_anggaran[]\" value=\"".$raw_data[$i][0]->mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>		
				<div class=\"form-group has-feedback\">
				 	<label for=\"manajemenPengguna\">Total Dana</label>
			       	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \" name=\"delete_total_dana[]\" value=\"".$raw_data[$i][0]->total_dana."\" id=\"currency\" placeholder=\"[ kosong ]\" disabled>
				</div>		
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Catatan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"delete_catatan[]\" value=\"".$raw_data[$i][0]->catatan."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<hr>																				
			";		
			}
		break;
	
	case "edit_pengajuan_baru":
		echo"
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Program utama</label>
			   	<input type=\"text\" class=\"form-control\" name=\"edit_program_utama\" value=\"".$raw_data[0]->program_utama."\" placeholder=\"[ kosong ]\">			
				<input type=\"hidden\" class=\"form-control\" name=\"edit_id\" value=\"".$raw_data[0]->id."\"  disabled>
			   	<input type=\"hidden\" class=\"form-control\" name=\"edit_url_file\" value=\"".$raw_data[0]->url_file."\"  disabled>
			   	<input type=\"hidden\" class=\"form-control\" name=\"edit_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\"  disabled>
			   	<input type=\"hidden\" class=\"form-control\" name=\"edit_id_master_file_pengajuan\" value=\"".$raw_data[0]->id_master_file_pengajuan."\"  disabled>		
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Program</label>
			   	<input type=\"text\" class=\"form-control\" name=\"edit_program\" value=\"".$raw_data[0]->program."\" placeholder=\"[ kosong ]\">			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Sasaran</label>
			   	<input type=\"text\" class=\"form-control\" name=\"edit_sasaran\" value=\"".$raw_data[0]->sasaran."\" placeholder=\"[ kosong ]\">			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Kegiatan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"edit_kegiatan\" value=\"".$raw_data[0]->kegiatan."\" placeholder=\"[ kosong ]\">			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Penanggung jawab</label>
			   	<input type=\"text\" class=\"form-control\" name=\"edit_penanggung_jawab\" value=\"".$raw_data[0]->penanggung_jawab."\" placeholder=\"[ kosong ]\">			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Total anggaran program</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"  name=\"edit_total_anggaran\" value=\"".$raw_data[0]->total_anggaran."\" placeholder=\"[ kosong ]\">			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal pelaksanaan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"edit_tanggal_pelaksana\" value=\"".$raw_data[0]->tanggal_pelaksana."\" placeholder=\"[ kosong ]\">			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Keterangan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"edit_keterangan\" value=\"".$raw_data[0]->keterangan."\" placeholder=\"[ kosong ]\">			
			</div>
			";
		break;
	
	case "detail_pengajuan_baru":
		echo"
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Program utama</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_program_utama\" value=\"".$raw_data[0]->program_utama."\" placeholder=\"[ kosong ]\" disabled>			
				<input type=\"hidden\" class=\"form-control\" name=\"detail_id\" value=\"".$raw_data[0]->id."\"  disabled>
			   	<input type=\"hidden\" class=\"form-control\" name=\"detail_url_file\" value=\"".$raw_data[0]->url_file."\"  disabled>
			   	<input type=\"hidden\" class=\"form-control\" name=\"detail_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\"  disabled>
			   	<input type=\"hidden\" class=\"form-control\" name=\"detail_id_master_file_pengajuan\" value=\"".$raw_data[0]->id_master_file_pengajuan."\"  disabled>		
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Program</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_program\" value=\"".$raw_data[0]->program."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Sasaran</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_sasaran\" value=\"".$raw_data[0]->sasaran."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Kegiatan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_kegiatan\" value=\"".$raw_data[0]->kegiatan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Penanggung jawab</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_penanggung_jawab\" value=\"".$raw_data[0]->penanggung_jawab."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Total anggaran program</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"  name=\"detail_total_anggaran\" value=\"".$raw_data[0]->total_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal pelaksanaan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_tanggal_pelaksana\" value=\"".$raw_data[0]->tanggal_pelaksana."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Keterangan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_keterangan\" value=\"".$raw_data[0]->keterangan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			";			
		break;
	
	case "detail_all_pengajuan_baru":
		echo"
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Program utama</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_program_utama\" value=\"".$raw_data[0]->program_utama."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Program</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_program\" value=\"".$raw_data[0]->program."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Sasaran</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_sasaran\" value=\"".$raw_data[0]->sasaran."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Kegiatan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_kegiatan\" value=\"".$raw_data[0]->kegiatan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Penanggung jawab</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_penanggung_jawab\" value=\"".$raw_data[0]->penanggung_jawab."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Total anggaran program</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"  name=\"detail_total_anggaran\" value=\"".$raw_data[0]->total_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal pelaksanaan</label>
			   	<input type=\"date\" class=\"form-control\" name=\"detail_tanggal_pelaksana\" value=\"".$raw_data[0]->tanggal_pelaksana."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Keterangan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_keterangan\" value=\"".$raw_data[0]->keterangan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal proposal pengajuan</label>
			   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_file_pengajuan_tanggal\" value=\"".$raw_data[0]->tanggal_file_pengajuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Kepada</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_file_pengajuan_kepada\" value=\"".$raw_data[0]->kepada_file_pengajuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Nama file proposal pengajuan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_file_pengajuan_nama\" value=\"".$raw_data[0]->nama_file_pengajuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Ukuran file</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_file_pengajuan_ukuran\" value=\"".$raw_data[0]->ukuran_file_pengajuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>	
			<div class=\"form-group\">
			   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file_pengajuan."\"></iframe>		
			</div>	
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal persetujuan dekanat</label>
			   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_persetujuan_dekanat_tanggal\" value=\"".$raw_data[0]->tanggal_persetujuan_dekanat."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal surat pengajuan</label>
			   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_tanggal\" value=\"".$raw_data[0]->tanggal_surat_pengajuan."\" placeholder=\"[ kosong ]\"  disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Kepada</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_kepada\" value=\"".$raw_data[0]->kepada_surat_pengajuan."\" placeholder=\"[ kosong ]\"  disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Nomor surat</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_nomor_surat\" value=\"".$raw_data[0]->nomor_surat_pengajuan."\" placeholder=\"[ kosong ]\"  disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Perihal surat</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_perihal_surat\" value=\"".$raw_data[0]->perihal_surat_pengajuan."\" placeholder=\"[ kosong ]\"  disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Nama file surat pengajuan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_nama\" value=\"".$raw_data[0]->nama_file_surat_pengajuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Ukuran file</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_surat_pengajuan_ukuran\" value=\"".$raw_data[0]->ukuran_file_surat_pengajuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>	
			<div class=\"form-group\">
			   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file_surat_pengajuan."\"></iframe>			
			</div>	
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal surat persetujuan</label>
			   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_tanggal\" value=\"".$raw_data[0]->tanggal_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Kepada</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_kepada\" value=\"".$raw_data[0]->kepada_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Nomor surat persetujuan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_nomor_surat\" value=\"".$raw_data[0]->nomor_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Perihal surat persetujuan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_perihal_surat\" value=\"".$raw_data[0]->perihal_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Total dana yang disetujui</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"  name=\"detail_detail_surat_persetujuan_perihal_surat\" value=\"".$raw_data[0]->total_dana_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Nama file surat persetujuan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_nama\" value=\"".$raw_data[0]->nama_file_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Ukuran file surat persetujuan</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_surat_persetujuan_ukuran\" value=\"".$raw_data[0]->ukuran_file_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>	
			<div class=\"form-group\">
			   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file_surat_persetujuan."\"></iframe>			
			</div>	
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal penerimaan dana</label>
			   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_penerimaan_dana_tanggal\" value=\"".$raw_data[0]->tanggal_diterima_kasir."\" placeholder=\"[ kosong ]\">			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Jumlah dana yang diterima</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"   name=\"edit_detail_penerimaan_dana_total_dana\" value=\"".$raw_data[0]->dana_diterima."\" placeholder=\"[ kosong ]\">			
			</div>	
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal pengumpulan laporan kegiatan</label>
			   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_tanggal\" value=\"".$raw_data[0]->tanggal_laporan_kegiatan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Nama file laporan kegiatan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_nama\" value=\"".$raw_data[0]->nama_file_laporan_kegiatan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Ukuran file laporan kegiatan</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_laporan_kegiatan_ukuran\" value=\"".$raw_data[0]->ukuran_file_laporan_kegiatan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>	
			<div class=\"form-group\">
			   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file_laporan_kegiatan."\"></iframe>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Tanggal pengumpulan laporan keuangan</label>
			   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_tanggal\" value=\"".$raw_data[0]->tanggal_laporan_keuangan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Nama file laporan keuangan</label>
			   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_nama\" value=\"".$raw_data[0]->nama_file_laporan_keuangan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>
			<div class=\"form-group\">
				<label for=\"manajemenPengguna\">Ukuran file laporan keuangan</label>
			   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_laporan_keuangan_ukuran\" value=\"".$raw_data[0]->ukuran_file_laporan_keuangan."\" placeholder=\"[ kosong ]\" disabled>			
			</div>	
			<div class=\"form-group\">
			   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file_laporan_keuangan."\"></iframe>			
			</div>																											
			";		
		break;
	
	case "edit_detail_file_pengajuan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal proposal pengajuan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_file_pengajuan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_file_pengajuan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_file_pengajuan_id_master_file_pengajuan\" value=\"".$raw_data[0]->id_master_file_pengajuan."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_file_pengajuan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kepada</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_file_pengajuan_kepada\" value=\"".$raw_data[0]->kepada."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file proposal pengajuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_file_pengajuan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"edit_detail_file_pengajuan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>	
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_file_pengajuan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\">			 			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">File baru</label>
				   	<input type=\"file\" class=\"form-control\" name=\"edit_detail_file_pengajuan_file\" placeholder=\"[ kosong ]\">			
				</div>
		";
		break;
	
	case "detail_detail_file_pengajuan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal proposal pengajuan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_file_pengajuan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\" disabled>			
				 	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_file_pengajuan_id_master_file_pengajuan\" value=\"".$raw_data[0]->id_master_file_pengajuan."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_file_pengajuan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_file_pengajuan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kepada</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_file_pengajuan_kepada\" value=\"".$raw_data[0]->kepada."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file proposal pengajuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_file_pengajuan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_file_pengajuan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>		
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_file_pengajuan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\">			
				</div>
		";
		break;	
	
	case "edit_detail_surat_pengajuan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal surat pengajuan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_id_master_file_surat_pengajuan\" value=\"".$raw_data[0]->id_master_file_surat_pengajuan."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kepada</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_kepada\" value=\"".$raw_data[0]->kepada."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nomor surat</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_nomor_surat\" value=\"".$raw_data[0]->nomor_surat."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Perihal surat</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_perihal_surat\" value=\"".$raw_data[0]->perihal_surat."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file proposal pengajuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"edit_detail_surat_pengajuan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>	
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">File baru</label>
				   	<input type=\"file\" class=\"form-control\" name=\"edit_detail_surat_pengajuan_file\" placeholder=\"[ kosong ]\">			
				</div>
		";
		break;	
	
	case "detail_detail_surat_pengajuan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal surat pengajuan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\"  disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\"  disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_id_master_file_surat_pengajuan\" value=\"".$raw_data[0]->id_master_file_surat_pengajuan."\" placeholder=\"[ kosong ]\"  disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\"  disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kepada</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_kepada\" value=\"".$raw_data[0]->kepada."\" placeholder=\"[ kosong ]\"  disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nomor surat</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_nomor_surat\" value=\"".$raw_data[0]->nomor_surat."\" placeholder=\"[ kosong ]\"  disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Perihal surat</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_perihal_surat\" value=\"".$raw_data[0]->perihal_surat."\" placeholder=\"[ kosong ]\"  disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file surat pengajuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_surat_pengajuan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>			
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_pengajuan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\">			
				</div>
		";
		break;		
	
	case "edit_detail_surat_persetujuan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal surat persetujuan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_id_master_file_surat_persetujuan\" value=\"".$raw_data[0]->id_master_file_surat_persetujuan."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kepada</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_kepada\" value=\"".$raw_data[0]->kepada."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nomor surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_nomor_surat\" value=\"".$raw_data[0]->nomor_surat."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Perihal surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_perihal_surat\" value=\"".$raw_data[0]->perihal_surat."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Total dana yang disetujui</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"  name=\"edit_detail_surat_persetujuan_total_dana\" value=\"".$raw_data[0]->total_dana."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"edit_detail_surat_persetujuan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>			
					<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">File surat persetujuan</label>
				   	<input type=\"file\" class=\"form-control\" name=\"edit_detail_surat_persetujuan_file\" placeholder=\"[ kosong ]\">			
				</div>
		";
		break;	
	
	case "detail_detail_surat_persetujuan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal surat persetujuan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_id_master_file_surat_persetujuan\" value=\"".$raw_data[0]->id_master_file_surat_persetujuan."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Kepada</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_kepada\" value=\"".$raw_data[0]->kepada."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nomor surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_nomor_surat\" value=\"".$raw_data[0]->nomor_surat."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Perihal surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_perihal_surat\" value=\"".$raw_data[0]->perihal_surat."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Total dana yang disetujui</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"  name=\"detail_detail_surat_persetujuan_perihal_surat\" value=\"".$raw_data[0]->total_dana."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_surat_persetujuan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>			
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_surat_persetujuan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
		";
		break;		
	
	case "edit_detail_penerimaan_dana":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal penerimaan dana</label>
				   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_penerimaan_dana_tanggal\" value=\"".$raw_data[0]->tanggal_diterima_kasir."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_penerimaan_dana_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_penerimaan_dana_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Jumlah dana yang diterima</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \"   name=\"edit_detail_penerimaan_dana_total_dana\" value=\"".$raw_data[0]->dana_diterima."\" placeholder=\"[ kosong ]\">			
				</div>
		";
		
		break;
	
	case "detail_detail_penerimaan_dana":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal penerimaan dana</label>
				   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_penerimaan_dana_tanggal\" value=\"".$raw_data[0]->tanggal_diterima_kasir."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_penerimaan_dana_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_penerimaan_dana_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Jumlah dana yang diterima</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \" name=\"detail_detail_penerimaan_dana_total_dana\" value=\"".$raw_data[0]->dana_diterima."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
		";
		
		break;	
	
	case "edit_detail_persetujuan_dekanat":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal persetujuan dekanat</label>
				   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_persetujuan_dekanat_tanggal\" value=\"".$raw_data[0]->tanggal_persetujuan_dekanat."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_persetujuan_dekanat_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_persetujuan_dekanat_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
		";
		break;
	
	case "detail_detail_persetujuan_dekanat":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal persetujuan dekanat</label>
				   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_persetujuan_dekanat_tanggal\" value=\"".$raw_data[0]->tanggal_persetujuan_dekanat."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_persetujuan_dekanat_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_persetujuan_dekanat_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
		";
		break;	
	
	case "edit_detail_laporan_kegiatan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal pengumpulan laporan keuangan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_laporan_kegiatan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan\" value=\"".$raw_data[0]->id_master_file_laporan_kegiatan."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_kegiatan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_kegiatan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file surat persetujuan</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_laporan_kegiatan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>			
					<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_kegiatan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">File baru</label>
				   	<input type=\"file\" class=\"form-control\" name=\"edit_detail_laporan_kegiatan_file\" placeholder=\"[ kosong ]\">			
				</div>					
		";
		break;
	
	case "detail_detail_laporan_kegiatan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal pengumpulan laporan kegiatan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan\" value=\"".$raw_data[0]->id_master_file_laporan_kegiatan."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file laporan kegiatan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file laporan kegiatan</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_laporan_kegiatan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>			
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_kegiatan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>					
		";
		break;	
	
	case "edit_detail_laporan_keuangan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal pengumpulan laporan keuangan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"edit_detail_laporan_keuangan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_keuangan_id_master_file_laporan_keuangan\" value=\"".$raw_data[0]->id_master_file_laporan_keuangan."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_keuangan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\">			
				   	<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_keuangan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file laporan keuangan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_laporan_keuangan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file laporan keuangan</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"edit_detail_laporan_keuangan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>			
					<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_laporan_keuangan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">File baru</label>
				   	<input type=\"file\" class=\"form-control\" name=\"edit_detail_laporan_keuangan_file\" placeholder=\"[ kosong ]\">			
				</div>					
		";
		break;
	
	case "detail_detail_laporan_keuangan":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal pengumpulan laporan keuangan</label>
				   	<input type=\"date\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_tanggal\" value=\"".$raw_data[0]->tanggal."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_id_master_file_laporan_keuangan\" value=\"".$raw_data[0]->id_master_file_laporan_keuangan."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_id\" value=\"".$raw_data[0]->id."\" placeholder=\"[ kosong ]\" disabled>			
				   	<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_id_transaksi_mata_anggaran\" value=\"".$raw_data[0]->id_transaksi_mata_anggaran."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Nama file laporan keuangan</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_nama\" value=\"".$raw_data[0]->nama_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Ukuran file laporan keuangan</label>
				   	<input type=\"text\" class=\"form-control auto\" data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\" byte\" data-p-sign=\"s\"  name=\"detail_detail_laporan_keuangan_ukuran\" value=\"".$raw_data[0]->ukuran_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>	
				<div class=\"form-group\">
				   	<iframe width=\"670\" height=\"800\" src=\"".$raw_data[0]->url_file."\"></iframe>			
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_laporan_keuangan_lama\" value=\"".$raw_data[0]->url_file."\" placeholder=\"[ kosong ]\" disabled>			
				</div>					
		";
		break;						

	case "add_kasir":
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal pengeluaran</label>
					<input type=\"date\" class=\"form-control\" name=\"detail_detail_kasir_tanggal\" placeholder=\"Pilih tanggal\">			
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_kasir_id_tahun_anggaran_terkini\" value=\"".$id_tahun_anggaran_terkini."\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Mata anggaran</label>
					<select class=\"form-control\" name=\"detail_detail_kasir_mata_anggaran\" >
		";
		for($i=0;$i<count($raw_data);$i++){
					echo"<option value=\"".$raw_data[$i]->id."\">".$raw_data[$i]->kode." ".$raw_data[$i]->mata_anggaran."</option>";
		}
		echo"
					</select>
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Uraian</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_kasir_uraian\" placeholder=\"Masukan uraian\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Jumlah dana</label>
				   	<input type=\"text\" class=\"form-control auto\"  data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \" name=\"detail_detail_kasir_jumlah_dana\" placeholder=\"Masukan jumlah dana\">			
				</div>	
		";
		break;
	case "edit_kasir":
		for($j=0; $j< count($raw_data);$j++){
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal pengeluaran</label>
					<input type=\"date\" class=\"form-control\" name=\"edit_detail_kasir_tanggal[]\" value=\"".$raw_data[$j][0]->tanggal."\" placeholder=\"Pilih tanggal\">	
					<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_kasir_id_transaksi_pengajuan_anggaran[]\" value=\"".$id_tahun_anggaran_terkini."\">			
					<input type=\"hidden\" class=\"form-control\" name=\"edit_detail_kasir_id[]\" value=\"".$raw_data[$j][0]->id."\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Mata anggaran</label>
					<select class=\"form-control\" name=\"edit_detail_kasir_mata_anggaran[]\" >
		";
		for($i=0;$i<count($raw_data_mata_anggaran);$i++){
					echo"<option value=\"".$raw_data_mata_anggaran[$i]->id."\" ";
					if($raw_data_mata_anggaran[$i]->id == $raw_data[$j][0]->id_transaksi_mata_anggaran)echo"selected";
					echo" >".$raw_data_mata_anggaran[$i]->kode." ".$raw_data_mata_anggaran[$i]->mata_anggaran."</option>";
		}
		echo"
					</select>
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Uraian</label>
				   	<input type=\"text\" class=\"form-control\" name=\"edit_detail_kasir_uraian[]\"  value=\"".$raw_data[$j][0]->uraian."\" placeholder=\"Masukan uraian\">			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Jumlah dana</label>
				   	<input type=\"text\" class=\"form-control auto\"  data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \" name=\"edit_detail_kasir_jumlah_dana[]\"  value=\"".$raw_data[$j][0]->jumlah_dana."\"  placeholder=\"Masukan jumlah dana\">			
				</div>	
				<br>
		";
		}
		break;	
	case "delete_kasir":
		for($j=0; $j< count($raw_data);$j++){
		echo "
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Tanggal pengeluaran</label>
					<input type=\"date\" class=\"form-control\" name=\"detail_detail_kasir_tanggal[]\" value=\"".$raw_data[$j][0]->tanggal."\" placeholder=\"Pilih tanggal\" disabled>	
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_kasir_id_transaksi_pengajuan_anggaran[]\" value=\"".$id_tahun_anggaran_terkini."\" disabled>			
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_kasir_mata_anggaran[]\" value=\"".$raw_data[$j][0]->id_transaksi_mata_anggaran."\" disabled>			
					<input type=\"hidden\" class=\"form-control\" name=\"detail_detail_kasir_id[]\" value=\"".$raw_data[$j][0]->id."\" disabled> 			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Mata anggaran</label>
					<input type=\"text\" class=\"form-control\" value=\"";
		for($i=0;$i<count($raw_data_mata_anggaran);$i++){
					if($raw_data_mata_anggaran[$i]->id == $raw_data[$j][0]->id_transaksi_mata_anggaran) echo $raw_data_mata_anggaran[$i]->kode." ".$raw_data_mata_anggaran[$i]->mata_anggaran;
		}
		echo"\" disabled>
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Uraian</label>
				   	<input type=\"text\" class=\"form-control\" name=\"detail_detail_kasir_uraian[]\"  value=\"".$raw_data[$j][0]->uraian."\" placeholder=\"Masukan uraian\" disabled>			
				</div>
				<div class=\"form-group\">
					<label for=\"manajemenPengguna\">Jumlah dana</label>
				   	<input type=\"text\" class=\"form-control auto\"  data-a-sep=\".\" data-a-dec=\",\" data-a-sign=\"Rp \" name=\"detail_detail_kasir_jumlah_dana[]\"  value=\"".$raw_data[$j][0]->jumlah_dana."\"  placeholder=\"Masukan jumlah dana\" disabled>			
				</div>		
				<br>
		";
		}
		break;		
	default:
		echo "Modul tidak diketahui!";
		break;
}

?>