<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adendum extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('bagian_model','bagian');
	}
	
	public function index()
	{
		$data['bagian'] = $this->bagian->view_all()->result();
		$this->load->view('bagian_view', $data);
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