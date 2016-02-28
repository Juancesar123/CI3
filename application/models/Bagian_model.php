<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian_model extends CI_Model {

	public function view_all(){
		return $this->db->get('master_bagian')->result();
	}

	public function select_where_id($id){
		$sql = "SELECT * FROM master_bagian WHERE id = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}	

	public function add($input){
		$this->db->insert('master_bagian', $input);
	}

	public function edit($input){
		$this->db->update_batch('master_bagian',$input,'id');
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('master_bagian');
	}
			
}
?>