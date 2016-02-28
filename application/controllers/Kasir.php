<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	function __construct(){
		parent::__construct(); 
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->model('kasir_model','kasir');
		$this->load->model('rencana_per_bagian_model','rencana_per_bagian');
	}

	public function index()
	{
		$this->load->view('kasir_view');
	}

	public function view_tabel_kasir_by_id()
	{

		$id_tahun_anggaran_terkini = $this->input->post('id_tahun_anggaran_terkini');
		$data['raw_data'] = $this->kasir->view_all_by_id_tahun_anggaran_terkini($id_tahun_anggaran_terkini);
		$this->load->view('tes_view', $data);
	}

	public function detail_view_tabel_kasir()
	{
		$date1 = date('Y');
		$date2 = date('Y')+1;
		$tahun_anggaran = $date1."/".$date2;
		$tahun_anggaran_terkini = $this->rencana_per_bagian->select_where_tahun_anggaran($tahun_anggaran);
		$data['raw_data'] = $tahun_anggaran_terkini;
		$this->load->view('kasir_tabel_view',$data);
	}

	public function add()
	{
		$date = date('Y-m-d H:i:s');		
		$input = array(
			'tanggal' => $this->input->post('detail_detail_kasir_tanggal'),
			'id_transaksi_mata_anggaran' => $this->input->post('detail_detail_kasir_mata_anggaran'),
			'id_transaksi_pengajuan_anggaran' => 0,
			'uraian' => $this->input->post('detail_detail_kasir_uraian'),
			'jenis_transaksi' => "KREDIT",
			'jumlah_dana' => $this->input->post('detail_detail_kasir_jumlah_dana'),
			'update_by' => $date,
			'update_at' => 1
		);
		$this->kasir->add($input);
		$data['raw_data'] = $this->kasir->view_all_by_id_tahun_anggaran_terkini($this->input->post('detail_detail_kasir_id_tahun_anggaran_terkini'));
		$this->load->view('tes_view', $data);
	}

	public function add_form()
	{
		$id_tahun_anggaran_terkini = $this->input->post('id_tahun_anggaran_terkini');
		$data['action'] = "add_kasir";
		$data_per_mata_anggaran = $this->rencana_per_bagian->select_mata_anggaran_where_id($id_tahun_anggaran_terkini);
		$data['id_tahun_anggaran_terkini'] = $id_tahun_anggaran_terkini;
		$data['raw_data'] = $data_per_mata_anggaran;
		$this->load->view('form_view', $data);
	}


	public function edit()
	{
		$date = date('Y-m-d H:i:s');		
		$edit_detail_kasir_id_tahun_anggaran_terkini = explode(",",$this->input->post('edit_detail_kasir_id_tahun_anggaran_terkini'));
		$edit_detail_kasir_tanggal = explode(",",$this->input->post('edit_detail_kasir_tanggal'));
		$edit_detail_kasir_id = explode(",",$this->input->post('edit_detail_kasir_id'));
		$edit_detail_kasir_mata_anggaran = explode(",",$this->input->post('edit_detail_kasir_mata_anggaran'));
		$edit_detail_kasir_uraian = explode(",",$this->input->post('edit_detail_kasir_uraian'));
		$edit_detail_kasir_jumlah_dana = explode(",",$this->input->post('edit_detail_kasir_jumlah_dana'));
		for($i=0;$i<count($edit_detail_kasir_id);$i++){
			$input[$i] = array(
				'id' => $edit_detail_kasir_id[$i],
				'tanggal' => $edit_detail_kasir_tanggal[$i],
				'id_transaksi_mata_anggaran' => $edit_detail_kasir_mata_anggaran[$i],
				'uraian' => $edit_detail_kasir_uraian[$i],
				'jenis_transaksi' => 'KREDIT',
				'jumlah_dana' => $edit_detail_kasir_jumlah_dana[$i],
				'update_by' => $date,
				'update_at' => 1
			);
		}		
		$this->kasir->edit($input);
		$data['raw_data'] = $this->kasir->view_all_by_id_tahun_anggaran_terkini($edit_detail_kasir_mata_anggaran[0]);
		$this->load->view('tes_view', $data);
	}

	public function edit_form()
	{
		$idArray = $this->input->post('idArray');
		$id_tahun_anggaran_terkini = $this->input->post('id_tahun_anggaran_terkini');
		$data['action'] = "edit_kasir";
		$id_parse = explode(",", $idArray);
		$data_per_id = array();
		for($i=0;$i<count($id_parse);$i++){
			$data_per_id[$i] = $this->kasir->select_where_id($id_parse[$i]);
		}
		$data_per_mata_anggaran = $this->rencana_per_bagian->select_mata_anggaran_where_id($id_tahun_anggaran_terkini);
		$data['raw_data'] = $data_per_id;
		$data['id_tahun_anggaran_terkini'] = $id_tahun_anggaran_terkini;
		$data['raw_data_mata_anggaran'] = $data_per_mata_anggaran;
		$this->load->view('form_view', $data);
	}

	public function delete()
	{
		$date = date('Y-m-d H:i:s');
		$detail_detail_kasir_id_tahun_anggaran_terkini = explode(",",$this->input->post('detail_detail_kasir_id_tahun_anggaran_terkini'));
		$detail_detail_kasir_id = explode(",",$this->input->post('detail_detail_kasir_id'));
		$detail_detail_kasir_mata_anggaran = explode(",",$this->input->post('detail_detail_kasir_mata_anggaran'));
		for($i=0;$i<count($detail_detail_kasir_id);$i++){
			$this->kasir->delete($detail_detail_kasir_id[$i]);
		}		
		$data['raw_data'] = $this->kasir->view_all_by_id_tahun_anggaran_terkini($detail_detail_kasir_mata_anggaran[0]);
		$this->load->view('tes_view', $data);
	}

	public function delete_form()
	{
		$idArray = $this->input->post('idArray');
		$id_tahun_anggaran_terkini = $this->input->post('id_tahun_anggaran_terkini');
		$data['action'] = "delete_kasir";
		$id_parse = explode(",", $idArray);
		$data_per_id = array();
		for($i=0;$i<count($id_parse);$i++){
			$data_per_id[$i] = $this->kasir->select_where_id($id_parse[$i]);
		}
		$data_per_mata_anggaran = $this->rencana_per_bagian->select_mata_anggaran_where_id($id_tahun_anggaran_terkini);
		$data['raw_data'] = $data_per_id;
		$data['id_tahun_anggaran_terkini'] = $id_tahun_anggaran_terkini;
		$data['raw_data_mata_anggaran'] = $data_per_mata_anggaran;
		$this->load->view('form_view', $data);
	}	

}
?>