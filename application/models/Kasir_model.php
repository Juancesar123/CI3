<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir_model extends CI_Model {

	public function view_all(){
		$sql = "SELECT a.`id`, a.`tanggal`, a.`id_transaksi_mata_anggaran`, a.`id_transaksi_pengajuan_anggaran`, a.`uraian`, a.`jenis_transaksi`, a.`jumlah_dana`, b.`kode`, a. `create_by`, a.`create_at`, a.`update_by`, a.`update_at` FROM `transaksi_kasir` a LEFT JOIN `transaksi_mata_anggaran` b ON b.`id` = a.`id_transaksi_mata_anggaran`";
		return $this->db->query($sql)->result();
	}

	public function view_all_by_id_tahun_anggaran_terkini($id_master_tahun_anggaran){
		$sql = "SELECT a.`id`, a.`tanggal`, a.`id_transaksi_mata_anggaran`, c.`tahun_anggaran` , d.`bagian`, b.`kode`, b.`mata_anggaran`, a.`id_transaksi_pengajuan_anggaran`, a.`uraian`, a.`jenis_transaksi`, a.`jumlah_dana`, a.`create_by`, a.`create_at`, a.`update_by`, a.`update_at` FROM `transaksi_kasir` a LEFT JOIN `transaksi_mata_anggaran` b ON b.`id` = a.`id_transaksi_mata_anggaran` LEFT JOIN `master_tahun_anggaran` c ON c.`id` = b.`id_master_tahun_anggaran` LEFT JOIN `master_bagian` d ON d.`id` = c.`id_master_bagian` WHERE c.`id` = ".$this->db->escape($id_master_tahun_anggaran);
		return $this->db->query($sql)->result();
	}	

	public function select_where_id($id){
		$sql = "SELECT * FROM transaksi_kasir WHERE id = ".$this->db->escape($id);
		return $this->db->query($sql)->result();
	}		

	public function add($input){
		$this->db->insert('transaksi_kasir', $input);
	}

	public function edit($input){
		$this->db->update_batch('transaksi_kasir',$input,'id');
	}

	public function edit_by_id_transaksi_pengajuan_anggaran($input){
		$this->db->update_batch('transaksi_kasir',$input,'id_transaksi_pengajuan_anggaran');
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('transaksi_kasir');
	}
		
	public function delete_by_id_transaksi_pengajuan_anggaran($id_transaksi_pengajuan_anggaran){
		$this->db->where('id_transaksi_pengajuan_anggaran', $id_transaksi_pengajuan_anggaran);
		$this->db->delete('transaksi_kasir');
	}

}
?>