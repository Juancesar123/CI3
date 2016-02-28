<?php
class Rencana_per_bagian_model extends CI_Model {

	public function view_all(){
		$sql = "SELECT mta.`id`, mta.`tahun_anggaran`, mta.`id_master_bagian`, mb.`bagian`, mta.`create_by`, mub4.`nama_lengkap` as `nama_lengkap_create_by`, mta.`update_by`, mub3.`nama_lengkap`  as `nama_lengkap_update_by`, mta.`create_at`, mta.`update_at`, mta.`status` FROM `master_tahun_anggaran` mta LEFT JOIN `master_bagian` mb ON mta.`id_master_bagian` = mb.`id` LEFT JOIN `master_user` mu1 ON mta.`update_by` = mu1.`id` LEFT JOIN `master_user` mu2 ON mta.`create_by` = mu2.`id`  LEFT JOIN `master_user_biodata` mub3 ON mu1.`id_master_biodata` = mub3.`id` LEFT JOIN `master_user_biodata` mub4 ON mu2.`id_master_biodata` = mub4.`id` WHERE  mta.`status`!= \"DELETE\"";
		return $this->db->query($sql)->result();
	}

	public function view_delete_all(){
		$sql = "SELECT mta.`id`, mta.`tahun_anggaran`, mta.`id_master_bagian`, mb.`bagian`, mta.`create_by`, mub4.`nama_lengkap` as `nama_lengkap_create_by`, mta.`update_by`, mub3.`nama_lengkap`  as `nama_lengkap_update_by`, mta.`create_at`, mta.`update_at`, mta.`status` FROM `master_tahun_anggaran` mta LEFT JOIN `master_bagian` mb ON mta.`id_master_bagian` = mb.`id` LEFT JOIN `master_user` mu1 ON mta.`update_by` = mu1.`id` LEFT JOIN `master_user` mu2 ON mta.`create_by` = mu2.`id`  LEFT JOIN `master_user_biodata` mub3 ON mu1.`id_master_biodata` = mub3.`id` LEFT JOIN `master_user_biodata` mub4 ON mu2.`id_master_biodata` = mub4.`id` WHERE  mta.`status`= \"DELETE\"";
		return $this->db->query($sql)->result();
	}

	public function select_mata_anggaran_where_id($id){
		$sql = "SELECT a.`id`, a.`kode`, a.`mata_anggaran`, a.`total_dana`, a.`total_penerimaan_dana`, a.`catatan`, b.`tahun_anggaran`, c.`bagian`, a.`id_master_tahun_anggaran` FROM `transaksi_mata_anggaran` a LEFT JOIN `master_tahun_anggaran` b ON b.`id` = a.`id_master_tahun_anggaran` LEFT JOIN `master_bagian` c ON c.`id` = b.`id_master_bagian` WHERE a.`status` != \"DELETE\" AND a.`id_master_tahun_anggaran` = ".$this->db->escape($id)." ORDER BY a.`kode` ASC";
		return $this->db->query($sql)->result();
	}	

	public function select_where_tahun_anggaran($tahun_anggaran){
		$sql = "SELECT mta.`id`, mta.`tahun_anggaran`, mta.`id_master_bagian`, mb.`bagian`, mta.`create_by`, mta.`update_by`, mta.`create_at`, mta.`update_at`, mta.`status` FROM `master_tahun_anggaran` mta LEFT JOIN `master_bagian` mb ON mta.`id_master_bagian` = mb.`id` WHERE mta.`tahun_anggaran` = ".$this->db->escape($tahun_anggaran);
		return $this->db->query($sql)->result();
	}

	public function select_restore_mata_anggaran_where_id($id){
		$sql = "SELECT a.`id`, a.`kode`, a.`mata_anggaran`, a.`total_dana`, a.`total_penerimaan_dana`, a.`catatan`, b.`tahun_anggaran`, c.`bagian`, a.`id_master_tahun_anggaran` FROM `transaksi_mata_anggaran` a LEFT JOIN `master_tahun_anggaran` b ON b.`id` = a.`id_master_tahun_anggaran` LEFT JOIN `master_bagian` c ON c.`id` = b.`id_master_bagian` WHERE a.`status` = \"DELETE\" AND  a.`id_master_tahun_anggaran` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}		

	public function select_mata_anggaran_where_id_mata_anggaran($id){
		$sql = "SELECT a.`id`, a.`kode`, a.`mata_anggaran`, a.`total_dana`, a.`total_penerimaan_dana`, a.`catatan`, b.`tahun_anggaran`, c.`bagian`, a.`id_master_tahun_anggaran` FROM `transaksi_mata_anggaran` a LEFT JOIN `master_tahun_anggaran` b ON b.`id` = a.`id_master_tahun_anggaran` LEFT JOIN `master_bagian` c ON c.`id` = b.`id_master_bagian` WHERE a.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}	

	public function edit_tahun_anggaran($data){
		$this->db->update_batch('master_tahun_anggaran',$data,'id');
	}

	public function delete_tahun_anggaran($id){
		$this->db->where('id',$id);
		$this->db->delete('master_tahun_anggaran');
	}

	public function add_tahun_anggaran($tahun_anggaran){
		$this->db->insert('master_tahun_anggaran', $tahun_anggaran);
		return $this->db->insert_id();
	}

	public function add_transaksi_mata_anggaran($mata_anggaran){
		$this->db->insert_batch('transaksi_mata_anggaran', $mata_anggaran);
	}

	public function add_transaksi_mata_anggaran_single($mata_anggaran){
		$this->db->insert('transaksi_mata_anggaran', $mata_anggaran);
		return $this->db->insert_id();
	}

	public function edit_transaksi_mata_anggaran($data){
		$this->db->update_batch('transaksi_mata_anggaran',$data,'id');
	}

	public function delete_transaksi_mata_anggaran($id){
		$this->db->where('id',$id);
		$this->db->delete('transaksi_mata_anggaran');
	}

	public function delete_transaksi_mata_anggaran_by_id_master_tahun_anggaran($id){
		$this->db->where('id_master_tahun_anggaran',$id);
		$this->db->delete('transaksi_mata_anggaran');
	}


			
}
?>