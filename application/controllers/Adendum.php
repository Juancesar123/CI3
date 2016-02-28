<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adendum extends CI_Controller {
	/*
	function __construct(){
		parent::__construct();
		$this->load->model('adendum_model','adendum');
	}
	*/
	public function index()
	{
	//	$data['adendum'] = $this->adendum->view_all()->result();
	//	$this->load->view('adendum_view', $data);
		$this->load->view('adendum_view');
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