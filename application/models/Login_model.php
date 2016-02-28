<?php

class Login_model extends CI_Model {
	
	public function cek_login($username, $password){
		$sql = "SELECT mu.`username`, mu.`level`, mu.`last_logout`, mu.`create_by`, mu.`update_by`, mu.`create_at`, mu.`update_at`, mu.`status`, mub.`nama_lengkap`, mub.`nama_panggilan`, mub.`tempat_lahir`, mub.`tanggal_lahir`, mub.`alamat`, mub.`jenis_kelamin`, mub.`no_telepon`, mub.`no_fax`, mub.`no_hp`, mub.`email`, mub.`foto_path`, mu.`id`, mub.`id` as `id_biodata` FROM `master_user` mu LEFT JOIN `master_user_biodata` mub ON mu.`id_master_biodata` = mub.`id` WHERE mu.`username` = ".$this->db->escape($username)." AND mu.`password` = ".$this->db->escape($password);
		return $this->db->query($sql)->result();
	}	

}

?>