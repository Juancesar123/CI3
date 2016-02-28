<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi_anggaran extends CI_Controller {

/*
	function __construct(){
		parent::__construct();
		$this->load->model('mutasi_anggaran_model','mutasi_anggaran');
	}
*/	

	public function index()
	{
		//$data['mutasi_anggaran'] = $this->mutasi_anggaran->view_all()->result();
		//$this->load->view('mutasi_anggaran_view', $data);		
		$this->load->view('mutasi_anggaran_view');
	}

	public function add()
	{
		

	}

	public function edit()
	{
		

	}

	public function delete()
	{
		
	}	

}
