<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller {

	function __construct(){
		parent::__construct(); 
		$this->load->library('session');
		$this->load->model('bagian_model','bagian');
	}

	public function index()
	{
		$this->load->view('bagian_view');
	}

	public function get_data_bagian()
	{
		$data = $this->bagian->view_all();
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->bagian;		
		}
		return $datatable;
	}

	public function view_tabel_bagian()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['raw_data'] = $this->get_data_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}				
	}

	public function add()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$input = array(
				'bagian' => $this->input->post('nama_bagian')
			);
			$this->bagian->add($input);
			$data['raw_data'] = $this->get_data_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function edit()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$edit_id_bagian = $this->input->post('edit_id_bagian');
			$edit_nama_bagian = $this->input->post('edit_nama_bagian');
			$id_parse = explode(",", $edit_id_bagian);
			$bagian_parse = explode(",", $edit_nama_bagian);
			for($i=0;$i<count($id_parse);$i++){
				$input[$i] = array(
					'id' => $id_parse[$i],
					'bagian' => $bagian_parse[$i]
				);
			}		
			$this->bagian->edit($input);
			$data['raw_data'] = $this->get_data_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_bagian_array = $this->input->post('id_bagian_array');
			$data['action'] = "ubah_bagian_form";
			$id_parse = explode(",", $id_bagian_array);
			$data_per_id = array();
			for($i=0;$i<count($id_parse);$i++){
				$data_per_id[$i] = $this->bagian->select_where_id($id_parse[$i]);
			}
			$data['raw_data'] = $data_per_id;
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function delete()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$delete_id_bagian = $this->input->post('delete_id_bagian');
			$id_parse = explode(",", $delete_id_bagian);
			for($i=0;$i<count($id_parse);$i++){
				$this->bagian->delete($id_parse[$i]);
			}		
			$data['raw_data'] = $this->get_data_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function delete_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_bagian_array = $this->input->post('id_bagian_array');
			$data['action'] = "hapus_bagian_form";
			$id_parse = explode(",", $id_bagian_array);
			$data_per_id = array();
			for($i=0;$i<count($id_parse);$i++){
				$data_per_id[$i] = $this->bagian->select_where_id($id_parse[$i]);
			}
			$data['raw_data'] = $data_per_id;
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}	

}
?>