<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

/*
	function __construct(){
		parent::__construct();
		$this->load->model('notifikasi_model','notifikasi');
	}
*/	

	public function index()
	{
		//$data['notifikasi'] = $this->notifikasi->view_all()->result();
		//$this->load->view('notifikasi_view', $data);		
		$this->load->view('notifikasi_view');
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
