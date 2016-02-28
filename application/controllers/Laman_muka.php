<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laman_muka extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['raw_data']= array(
				'username_FMS' => $this->session->userdata('username_FMS'),
				'level_FMS' => $this->session->userdata('level_FMS'),
				'status_FMS' => $this->session->userdata('status_FMS'),
				'nama_lengkap_FMS' => $this->session->userdata('nama_lengkap_FMS'),
				'nama_panggilan_FMS' => $this->session->userdata('nama_panggilan_FMS'),
				'foto_path_FMS' => $this->session->userdata('foto_path_FMS'),
				'create_at_FMS' => $this->session->userdata('create_at_FMS')
			);
			$this->load->view('laman_muka_view',$data);
		}else{
			redirect('login','refresh');
		}		
	}
}
