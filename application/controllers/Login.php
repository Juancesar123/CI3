<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct(); 
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->model('login_model','login');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function validasi_login()
	{
		$username = $this->security->xss_clean($this->input->post('username'));
		$password = $this->security->xss_clean(MD5($this->input->post('password')));
		$data = $this->login->cek_login($username, $password);
		$userdata = array(
			'id_FMS' 		 	 => $data[0]->id,
			'username_FMS' 		 => $data[0]->username,
			'level_FMS'			 => $data[0]->level,
			'last_logout_FMS'	 => $data[0]->last_logout,
			'status_FMS'		 => $data[0]->status,
			'nama_lengkap_FMS'	 => $data[0]->nama_lengkap,
			'nama_panggilan_FMS' => $data[0]->nama_panggilan,
			'foto_path_FMS'		 => $data[0]->foto_path,
			'create_at_FMS'		 => $data[0]->create_at
        );

		if(count($data)==1){
			$this->session->set_userdata($userdata);
			redirect('laman_muka','refresh');
		}else{
			redirect('login','refresh');
		}
	}

	public function logout(){
		$this->session->unset_userdata('username_FMS');
		$this->session->unset_userdata('level_FMS');
		$this->session->unset_userdata('last_logout_FMS');
		$this->session->unset_userdata('status_FMS');
		$this->session->unset_userdata('nama_lengkap_FMS');
		$this->session->unset_userdata('nama_panggilan_FMS');
		$this->session->unset_userdata('foto_path_FMS');
		$this->session->unset_userdata('create_at_FMS');
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

}

?>