<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {

/*
	function __construct(){
		parent::__construct();
		$this->load->model('konfirmasi_model','konfirmasi');
	}
*/	

	public function index()
	{
		//$data['konfirmasi'] = $this->konfirmasi->view_all()->result();
		//$this->load->view('konfirmasi_view', $data);
		$this->load->view('konfirmasi_view');
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
?>