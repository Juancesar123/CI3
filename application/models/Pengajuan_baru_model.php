<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_baru_model extends CI_Model {

	public function view_all($id_transaksi_mata_anggaran){
		$sql = "SELECT a.`id`, a.`tanggal_diterima_kasir`, a.`dana_diterima`, a.`id_transaksi_mata_anggaran`,a.`tanggal_persetujuan_dekanat`,a.`program_utama`,a.`program`,a.`sasaran`,a.`kegiatan`,a.`penanggung_jawab`,a.`total_anggaran`,a.`tanggal_pelaksana`,a.`keterangan`,a.`id_master_file_pengajuan`,b.`tanggal` as `tanggal_file_pengajuan`,b.`kepada` as `kepada_file_pengajuan`, b.`nama_file` as `nama_file_pengajuan`,b.`url_file` as `url_file_pengajuan`,a.`id_master_file_surat_pengajuan`,c.`kepada` as `kepada_surat_pengajuan`,c.`tanggal` as `tanggal_surat_pengajuan`,c.`nomor_surat` as `nomor_surat_pengajuan`,c.`perihal_surat` as `perihal_surat_pengajuan`,c.`kepada` as `kepada_surat_pengajuan`,c.`nama_file` as `nama_file_surat_pengajuan`,c.`url_file` as `url_file_surat_pengajuan`,a.`id_master_file_surat_persetujuan`,d.`tanggal` as `tanggal_surat_persetujuan`,d.`nomor_surat` as `nomor_surat_persetujuan`,d.`perihal_surat` as `perihal_surat_persetujuan`,d.`total_dana` as `total_dana_surat_persetujuan`,d.`nama_file` as `nama_file_surat_persetujuan`,d.`url_file` as `url_file_surat_persetujuan`,d.`kepada` as `kepada_surat_persetujuan` ,e.`tanggal` as `tanggal_file_laporan_kegiatan`,e.`nama_file` as `nama_file_laporan_kegiatan`,e.`url_file` as `url_file_laporan_kegiatan` ,f.`tanggal` as `tanggal_file_laporan_keuangan`,f.`nama_file` as `nama_file_laporan_keuangan`, f.`url_file` as `url_file_laporan_keuangan` ,a.`create_by`,a.`update_by`,a.`create_at`,a.`update_at`,a.`status` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `master_file_pengajuan` b ON b.`id` = a.`id_master_file_pengajuan` LEFT JOIN `master_file_surat_pengajuan` c ON c.`id` = a.`id_master_file_surat_pengajuan`  LEFT JOIN `master_file_surat_persetujuan` d ON d.`id` = a.`id_master_file_surat_persetujuan` LEFT JOIN `master_file_laporan_kegiatan` e ON e.`id` = a.`id_master_file_laporan_kegiatan` LEFT JOIN `master_file_laporan_keuangan` f ON f.`id` = a.`id_master_file_laporan_keuangan` WHERE a.`id_transaksi_mata_anggaran` = ".$this->db->escape($id_transaksi_mata_anggaran)." AND a.`status` != \"DELETE\" ORDER BY a.`update_at` DESC";
		return $this->db->query($sql)->result();
	}
/*
	public function view_delete_all($id_transaksi_mata_anggaran){
		$sql = "SELECT a.`id`, a.`tanggal_diterima_kasir`, a.`dana_diterima`, a.`id_transaksi_mata_anggaran`,a.`tanggal_persetujuan_dekanat`,a.`program_utama`,a.`program`,a.`sasaran`,a.`kegiatan`,a.`penanggung_jawab`,a.`total_anggaran`,a.`tanggal_pelaksana`,a.`keterangan`,a.`id_master_file_pengajuan`,b.`tanggal` as `tanggal_file_pengajuan`,b.`kepada` as `kepada_file_pengajuan`, b.`nama_file` as `nama_file_pengajuan`,b.`url_file` as `url_file_pengajuan`,a.`id_master_file_surat_pengajuan`,c.`kepada` as `kepada_surat_pengajuan`,c.`tanggal` as `tanggal_surat_pengajuan`,c.`nomor_surat` as `nomor_surat_pengajuan`,c.`perihal_surat` as `perihal_surat_pengajuan`,c.`nama_file` as `nama_file_surat_pengajuan`,c.`url_file` as `url_file_surat_pengajuan`,a.`id_master_file_surat_persetujuan`,d.`tanggal` as `tanggal_surat_persetujuan`,d.`nomor_surat` as `nomor_surat_persetujuan`,d.`perihal_surat` as `perihal_surat_persetujuan`,d.`total_dana` as `total_dana_surat_persetujuan`,d.`nama_file` as `nama_file_surat_persetujuan`,d.`url_file` as `url_file_surat_persetujuan` , e.`tanggal` as `tanggal_laporan_kegiatan`, e.`nama_file` as `nama_file_laporan_kegiatan`,e.`url_file` as `url_file_laporan_kegiatan` , f.`tanggal` as `tanggal_laporan_keuangan`, f.`nama_file` as `nama_file_laporan_keuangan`, f.`url_file` as `url_file_laporan_keuangan` ,a.`create_by`,a.`update_by`,a.`create_at`,a.`update_at`,a.`status` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `master_file_pengajuan` b ON b.`id` = a.`id_master_file_pengajuan` LEFT JOIN `master_file_surat_pengajuan` c ON c.`id` = a.`id_master_file_surat_pengajuan`  LEFT JOIN `master_file_surat_persetujuan` d ON d.`id` = a.`id_master_file_surat_persetujuan` LEFT JOIN `master_file_laporan_kegiatan` e ON e.`id` = a.`id_master_file_laporan_kegiatan` LEFT JOIN `master_file_laporan_keuangan` f ON f.`id` = a.`id_master_file_laporan_keuangan` WHERE a.`id_transaksi_mata_anggaran` = ".$this->db->escape($id_transaksi_mata_anggaran)." AND a.`status` = \"DELETE\" ORDER BY a.`update_at` DESC";
		return $this->db->query($sql)->result();
	}
*/
	public function select_pengajuan_anggaran_per_bagian_where_id($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, b.`kode`, b.`mata_anggaran`, b.`total_dana`, d.`tahun_anggaran`, e.`bagian`, b.`catatan`, a.`program_utama`, a.`program`, a.`sasaran`, a.`kegiatan`, a.`penanggung_jawab`, a.`total_anggaran`, a.`tanggal_pelaksana`, a.`keterangan`, a.`id_master_file_pengajuan`, c.`nama_file`, c.`url_file`, f.`tanggal`, a.`id_master_file_laporan_kegiatan`, f.`nama_file` as `nama_file_laporan_kegiatan`, f.`url_file`, g.`tanggal`, a.`id_master_file_laporan_keuangan`, g.`nama_file`  as `nama_file_laporan_keuangan`, g.`url_file`, a.`create_by`, a.`update_by`, a.`create_at`, a.`update_at`, a.`status` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `transaksi_mata_anggaran` b ON b.id = a.`id_transaksi_mata_anggaran` LEFT JOIN `master_file_pengajuan` c ON c.id = a.`id_master_file_pengajuan` LEFT JOIN `master_tahun_anggaran` d ON d.`id` = b.`id_master_tahun_anggaran` LEFT JOIN `master_bagian` e ON e.`id` = d.`id_master_bagian` LEFT JOIN `master_file_laporan_kegiatan` f ON f.`id` = a.`id_master_file_laporan_kegiatan` LEFT JOIN `master_file_laporan_keuangan` g ON g.`id` = a.`id_master_file_laporan_keuangan` WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id)." ORDER BY a.`update_at` DESC";
		return $this->db->query($sql)->result();
	}

	public function select_detail_pengajuan_anggaran_per_bagian_where_id($id){
		$sql = "SELECT a.`id`, a.`tanggal_diterima_kasir`, a.`dana_diterima`, a.`id_transaksi_mata_anggaran`,a.`tanggal_persetujuan_dekanat`,a.`program_utama`,a.`program`,a.`sasaran`,a.`kegiatan`,a.`penanggung_jawab`,a.`total_anggaran`,a.`tanggal_pelaksana`,a.`keterangan`,a.`id_master_file_pengajuan`,b.`tanggal` as `tanggal_file_pengajuan`,b.`kepada` as `kepada_file_pengajuan`, b.`nama_file` as `nama_file_pengajuan`,b.`url_file` as `url_file_pengajuan`, b.`ukuran_file` as `ukuran_file_pengajuan` ,a.`id_master_file_surat_pengajuan`, c.`ukuran_file` as `ukuran_file_surat_pengajuan` ,c.`kepada` as `kepada_surat_pengajuan`,c.`tanggal` as `tanggal_surat_pengajuan`,c.`nomor_surat` as `nomor_surat_pengajuan`,c.`perihal_surat` as `perihal_surat_pengajuan`,c.`nama_file` as `nama_file_surat_pengajuan`,c.`url_file` as `url_file_surat_pengajuan`,a.`id_master_file_surat_persetujuan`, d.`ukuran_file` as `ukuran_file_surat_persetujuan`, d.`tanggal` as `tanggal_surat_persetujuan`,d.`nomor_surat` as `nomor_surat_persetujuan`, d.`kepada` as `kepada_surat_persetujuan`, d.`perihal_surat` as `perihal_surat_persetujuan`,d.`total_dana` as `total_dana_surat_persetujuan`,d.`nama_file` as `nama_file_surat_persetujuan`,d.`url_file` as `url_file_surat_persetujuan` , e.`tanggal` as `tanggal_laporan_kegiatan`, e.`nama_file` as `nama_file_laporan_kegiatan`,e.`url_file` as `url_file_laporan_kegiatan` , f.`ukuran_file` as `ukuran_file_laporan_kegiatan`, f.`tanggal` as `tanggal_laporan_keuangan`, f.`nama_file` as `nama_file_laporan_keuangan`, f.`ukuran_file` as `ukuran_file_laporan_keuangan`, f.`url_file` as `url_file_laporan_keuangan` ,a.`create_by`,a.`update_by`,a.`create_at`,a.`update_at`,a.`status` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `master_file_pengajuan` b ON b.`id` = a.`id_master_file_pengajuan` LEFT JOIN `master_file_surat_pengajuan` c ON c.`id` = a.`id_master_file_surat_pengajuan`  LEFT JOIN `master_file_surat_persetujuan` d ON d.`id` = a.`id_master_file_surat_persetujuan` LEFT JOIN `master_file_laporan_kegiatan` e ON e.`id` = a.`id_master_file_laporan_kegiatan` LEFT JOIN `master_file_laporan_keuangan` f ON f.`id` = a.`id_master_file_laporan_keuangan` WHERE a.`id` = ".$this->db->escape($id)." AND a.`status` != \"DELETE\" ORDER BY a.`update_at` DESC";
		return $this->db->query($sql)->result();
	}	

	public function select_sum_dana_diterima($id){
		$sql = "SELECT SUM(`dana_diterima`) as `total` FROM `transaksi_pengajuan_anggaran_per_bagian` where `id_transaksi_mata_anggaran` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}

	public function select_penerimaan_dana_per_bagian_where_id($id){
		$sql = "SELECT a.`id`,  a.`id_transaksi_mata_anggaran`, a.`tanggal_diterima_kasir`, a.`dana_diterima` FROM `transaksi_pengajuan_anggaran_per_bagian` a WHERE a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}				

	public function select_file_pengajuan_where_id_pengajuan($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, a.`id_master_file_pengajuan`, c.`tanggal`, c.`kepada`, c.`nama_file`, c.`tipe_file`, c.`ukuran_file`, c.`url_file` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `transaksi_mata_anggaran` b ON b.id = a.`id_transaksi_mata_anggaran` LEFT JOIN `master_file_pengajuan` c ON c.id = a.`id_master_file_pengajuan` LEFT JOIN `master_tahun_anggaran` d ON d.`id` = b.`id_master_tahun_anggaran` WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}	

	public function select_surat_pengajuan_where_id_pengajuan($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, a.`id_master_file_surat_pengajuan`, c.`tanggal`, c.`kepada`, c.`nomor_surat`, c.`perihal_surat`, c.`nama_file`, c.`tipe_file`, c.`ukuran_file`, c.`url_file` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `transaksi_mata_anggaran` b ON b.id = a.`id_transaksi_mata_anggaran` LEFT JOIN `master_file_surat_pengajuan` c ON c.id = a.`id_master_file_surat_pengajuan` LEFT JOIN `master_tahun_anggaran` d ON d.`id` = b.`id_master_tahun_anggaran` WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}	

	public function select_surat_persetujuan_where_id_pengajuan($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, a.`id_master_file_surat_persetujuan`, c.`tanggal`, c.`kepada`, c.`nomor_surat`,  c.`kepada`, c.`perihal_surat`, c.`total_dana`, c.`nama_file`, c.`tipe_file`, c.`ukuran_file`, c.`url_file` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `transaksi_mata_anggaran` b ON b.id = a.`id_transaksi_mata_anggaran` LEFT JOIN `master_file_surat_persetujuan` c ON c.id = a.`id_master_file_surat_persetujuan` LEFT JOIN `master_tahun_anggaran` d ON d.`id` = b.`id_master_tahun_anggaran` WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}	

	public function select_penerimaan_dana_where_id_pengajuan($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, a.`tanggal_diterima_kasir`, a.`dana_diterima` FROM `transaksi_pengajuan_anggaran_per_bagian` a  WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}	

	public function select_persetujuan_dekanat_where_id_pengajuan($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, a.`tanggal_persetujuan_dekanat` FROM `transaksi_pengajuan_anggaran_per_bagian` a  WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}				

	public function select_laporan_kegiatan_where_id_pengajuan($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, a.`id_master_file_laporan_kegiatan`, c.`tanggal`, c.`nama_file`, c.`tipe_file`, c.`ukuran_file`, c.`url_file` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `transaksi_mata_anggaran` b ON b.id = a.`id_transaksi_mata_anggaran` LEFT JOIN `master_file_laporan_kegiatan` c ON c.`id` = a.`id_master_file_laporan_kegiatan` LEFT JOIN `master_tahun_anggaran` d ON d.`id` = b.`id_master_tahun_anggaran` WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}				

	public function select_laporan_keuangan_where_id_pengajuan($id){
		$sql = "SELECT a.`id`, a.`id_transaksi_mata_anggaran`, a.`id_master_file_laporan_keuangan`, c.`tanggal`, c.`nama_file`, c.`tipe_file`, c.`ukuran_file`, c.`url_file` FROM `transaksi_pengajuan_anggaran_per_bagian` a LEFT JOIN `transaksi_mata_anggaran` b ON b.id = a.`id_transaksi_mata_anggaran` LEFT JOIN `master_file_laporan_keuangan` c ON c.`id` = a.`id_master_file_laporan_keuangan` LEFT JOIN `master_tahun_anggaran` d ON d.`id` = b.`id_master_tahun_anggaran` WHERE a.`status` != \"DELETE\" AND a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}				

	public function edit_transaksi_pengajuan_anggaran_per_bagian($data){
		$this->db->update_batch('transaksi_pengajuan_anggaran_per_bagian',$data,'id');
	}

	public function delete_transaksi_pengajuan_anggaran_per_bagian($id){
		$this->db->where('id',$id);
		$this->db->delete('transaksi_pengajuan_anggaran_per_bagian');
	}

	public function add_transaksi_pengajuan_anggaran_per_bagian($data){
		$this->db->insert_batch('transaksi_pengajuan_anggaran_per_bagian', $data);
	}

	public function add_transaksi_pengajuan_anggaran_per_bagian_single($data){
		$this->db->insert('transaksi_pengajuan_anggaran_per_bagian', $data);
		return $this->db->insert_id();
	}

	public function add_master_file_pengajuan($data){
		$this->db->insert('master_file_pengajuan', $data);
		return $this->db->insert_id();
	}
	
	public function edit_master_file_pengajuan($data){
		$this->db->update_batch('master_file_pengajuan', $data,'id');
	}	

	public function delete_master_file_pengajuan($id){
		$this->db->where('id',$id);
		$this->db->delete('master_file_pengajuan');
	}	

	public function add_master_surat_pengajuan($data){
		$this->db->insert('master_file_surat_pengajuan', $data);
		return $this->db->insert_id();
	}
	
	public function edit_master_surat_pengajuan($data){
		$this->db->update_batch('master_file_surat_pengajuan', $data,'id');
	}	

	public function delete_master_surat_pengajuan($id){
		$this->db->where('id',$id);
		$this->db->delete('master_file_surat_pengajuan');
	}

	public function add_master_surat_persetujuan($data){
		$this->db->insert('master_file_surat_persetujuan', $data);
		return $this->db->insert_id();
	}
	
	public function edit_master_surat_persetujuan($data){
		$this->db->update_batch('master_file_surat_persetujuan', $data,'id');
	}	

	public function delete_master_surat_persetujuan($id){
		$this->db->where('id',$id);
		$this->db->delete('master_file_surat_persetujuan');
	}

	public function add_master_laporan_kegiatan($data){
		$this->db->insert('master_file_laporan_kegiatan', $data);
		return $this->db->insert_id();
	}
	
	public function edit_master_laporan_kegiatan($data){
		$this->db->update_batch('master_file_laporan_kegiatan', $data,'id');
	}	

	public function delete_master_laporan_kegiatan($id){
		$this->db->where('id',$id);
		$this->db->delete('master_file_laporan_kegiatan');
	}

	public function add_master_laporan_keuangan($data){
		$this->db->insert('master_file_laporan_keuangan', $data);
		return $this->db->insert_id();
	}
	
	public function edit_master_laporan_keuangan($data){
		$this->db->update_batch('master_file_laporan_keuangan', $data,'id');
	}	

	public function delete_master_laporan_keuangan($id){
		$this->db->where('id',$id);
		$this->db->delete('master_file_laporan_keuangan');
	}	

}

?>