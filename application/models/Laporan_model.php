<?php
class Laporan_model extends CI_Model {

	public function view_all(){
		$sql = "SELECT mu.`username`, mu.`level`, mub.`nama_lengkap`, mub.`jenis_kelamin`, mub.`foto_path`, mu.`id`, mub.`id` as `id_biodata` FROM `master_user` mu LEFT JOIN `master_user_biodata` mub ON mu.`id_master_biodata` = mub.`id` WHERE mu.`status` != \"DELETE\"";
		return $this->db->query($sql)->result();
	}

	public function view_delete_all(){
		$sql = "SELECT mu.`username`, mu.`level`, mub.`nama_lengkap`, mub.`jenis_kelamin`, mub.`foto_path`, mu.`id`, mub.`id` as `id_biodata` FROM `master_user` mu LEFT JOIN `master_user_biodata` mub ON mu.`id_master_biodata` = mub.`id` WHERE mu.`status` = \"DELETE\"";
		return $this->db->query($sql)->result();
	}

	public function select_where_id($id){
		$sql = "SELECT mu.`username`, mu.`level`, mu.`last_logout`, mu.`create_by`, mu.`update_by`, mu.`create_at`, mu.`update_at`, mu.`status`, mub.`nama_lengkap`, mub.`nama_panggilan`, mub.`tempat_lahir`, mub.`tanggal_lahir`, mub.`alamat`, mub.`jenis_kelamin`, mub.`no_telepon`, mub.`no_fax`, mub.`no_hp`, mub.`email`, mub.`foto_path`, mu.`id`, mub.`id` as `id_biodata` FROM `master_user` mu LEFT JOIN `master_user_biodata` mub ON mu.`id_master_biodata` = mub.`id` WHERE mu.`id` = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}	

	public function add_user($user){
		$this->db->insert('master_user', $user);
	}

	public function add_user_biodata($user_biodata){
		$this->db->insert('master_user_biodata', $user_biodata);
		return $this->db->insert_id();
	}

	public function edit_user($data){
		$this->db->update_batch('master_user',$data,'id');
	}

	public function edit_user_biodata($data){
		$this->db->update_batch('master_user_biodata',$data,'id');
	}

	public function delete_user($id){
		$this->db->where('id',$id);
		$this->db->delete('master_user');
	}

	public function delete_user_biodata($id){
		$this->db->where('id',$id);
		$this->db->delete('master_user_biodata');
	}

			
}
?>