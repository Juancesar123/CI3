<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->model('pengajuan_baru_model','pengajuan_baru');
		$this->load->model('rencana_per_bagian_model','rencana_per_bagian');
	}

	public function index()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$this->load->view('laporan_view');
		}else{
			redirect('login','refresh');
		}
	}

	public function view_tabel_laporan()
	{
 		$id_tahun_anggaran = $this->input->post('id_rencana_per_bagian'); 
		$dataArr = $this->rencana_per_bagian->select_mata_anggaran_where_id($id_tahun_anggaran);
		for($i=0;$i<count($dataArr);$i++){
			$Arr[$i]= array(
				'id_transaksi_mata_anggaran' => $dataArr[$i]->id, 
				'bagian_transaksi_mata_anggaran' => $dataArr[$i]->bagian, 
				'tahun_anggaran_transaksi_mata_anggaran' => $dataArr[$i]->tahun_anggaran, 
				'kode_transaksi_mata_anggaran' => $dataArr[$i]->kode, 
				'mata_anggaran_transaksi_mata_anggaran' => $dataArr[$i]->mata_anggaran, 
				'total_dana_transaksi_mata_anggaran' => $dataArr[$i]->total_dana, 
				'total_penerimaan_dana_transaksi_mata_anggaran' => $dataArr[$i]->total_penerimaan_dana, 
				'catatan_transaksi_mata_anggaran' => $dataArr[$i]->catatan,
				'data' => $this->pengajuan_baru->view_all($dataArr[$i]->id)
			);
		}
		$data['raw_data'] = $Arr;
		$this->load->view('tabel_laporan_view', $data);		
	}

}
