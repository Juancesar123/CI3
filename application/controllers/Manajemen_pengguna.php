<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_pengguna extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->model('manajemen_pengguna_model','manajemen_pengguna');
	}

	public function index()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$this->load->view('manajemen_pengguna_view');
		}else{
			redirect('login','refresh');
		}
	}

	public function get_data_manajemen_pengguna()
	{
		$data = $this->manajemen_pengguna->view_all($this->session->userdata('username_FMS'));
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->foto_path;	
			$datatable[$g][2] = $data[$g]->nama_lengkap;
			$datatable[$g][3] = $data[$g]->jenis_kelamin;
			$datatable[$g][4] = $data[$g]->username;
			$datatable[$g][5] = $data[$g]->level;	
			$datatable[$g][6] = $data[$g]->id_biodata;		
		}
		return $datatable;
	}

	public function get_delete_data_manajemen_pengguna()
	{
		$data = $this->manajemen_pengguna->view_delete_all();
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->foto_path;	
			$datatable[$g][2] = $data[$g]->nama_lengkap;
			$datatable[$g][3] = $data[$g]->jenis_kelamin;
			$datatable[$g][4] = $data[$g]->username;
			$datatable[$g][5] = $data[$g]->level;	
			$datatable[$g][6] = $data[$g]->id_biodata;		
		}
		return $datatable;		
	}

	public function view_tabel_manajemen_pengguna()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['raw_data'] = $this->get_data_manajemen_pengguna();
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}	
	}

	public function view_delete_tabel_manajemen_pengguna()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['raw_data'] = $this->get_delete_data_manajemen_pengguna();
			$this->load->view('tes_view', $data);		
		}else{
			redirect('login','refresh');
		}
	}	

	public function add()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
		    $this->load->library('upload');
	        $config = array();
	        $config = $this->set_upload_options();
			$this->upload->initialize($config);
	        if ($this->upload->do_upload('foto')){
	        	$extendtion = explode(".", $_FILES['foto']['name']);
				$foto_path = "images_dir/".$config['file_name'].".".$extendtion[count($extendtion)-1];
		        $user_biodata = array(
					'nama_lengkap' => $this->security->xss_clean($this->input->post('nama_lengkap')),
					'nama_panggilan' => $this->security->xss_clean($this->input->post('nama_panggilan')),
					'tempat_lahir' => $this->security->xss_clean($this->input->post('tempat_lahir')),
					'tanggal_lahir' => $this->security->xss_clean($this->input->post('tanggal_lahir')),
					'alamat' => $this->security->xss_clean($this->input->post('alamat')),
					'jenis_kelamin' => $this->security->xss_clean($this->input->post('jenis_kelamin')),
					'no_telepon' => $this->security->xss_clean($this->input->post('no_telepon')),
					'no_fax' => $this->security->xss_clean($this->input->post('no_fax')),
					'no_hp' => $this->security->xss_clean($this->input->post('no_hp')),
					'email' => $this->security->xss_clean($this->input->post('email')),
					'foto_path' => $foto_path
				);			
	        }else{
	   	        $user_biodata = array(
					'nama_lengkap' => $this->security->xss_clean($this->input->post('nama_lengkap')),
					'nama_panggilan' => $this->security->xss_clean($this->input->post('nama_panggilan')),
					'tempat_lahir' => $this->security->xss_clean($this->input->post('tempat_lahir')),
					'tanggal_lahir' => $this->security->xss_clean($this->input->post('tanggal_lahir')),
					'alamat' => $this->security->xss_clean($this->input->post('alamat')),
					'jenis_kelamin' => $this->security->xss_clean($this->input->post('jenis_kelamin')),
					'no_telepon' => $this->security->xss_clean($this->input->post('no_telepon')),
					'no_fax' => $this->security->xss_clean($this->input->post('no_fax')),
					'no_hp' => $this->security->xss_clean($this->input->post('no_hp')),
					'email' => $this->security->xss_clean($this->input->post('email'))
				);	     	
	        }
	        $id_master_biodata = $this->manajemen_pengguna->add_user_biodata($user_biodata);
	        $user = array(
				'username' => $this->security->xss_clean($this->input->post('username')),
				'password' => $this->security->xss_clean(md5($this->input->post('password'))),
				'level' => $this->security->xss_clean($this->input->post('level')), 
				'last_logout' => $date, 
				'create_by'  => $this->session->userdata('id_FMS'), 
				'update_by'  => $this->session->userdata('id_FMS'), 
				'create_at' => $date, 
				'update_at' => $date, 
				'status' => "NEW", 
				'id_master_biodata' => $id_master_biodata
			);
			$this->manajemen_pengguna->add_user($user);
			$data['raw_data'] = $this->get_data_manajemen_pengguna();
			$this->load->view('tes_view', $data);			
		}else{
			redirect('login','refresh');
		}
	}

	public function edit()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s'); 
	        $edit_id = explode(",",$this->security->xss_clean($this->input->post('edit_id')));
	        $edit_id_biodata = explode(",",$this->security->xss_clean($this->input->post('edit_id_biodata')));
	        $edit_nama_lengkap = explode(",",$this->security->xss_clean($this->input->post('edit_nama_lengkap')));
			$edit_nama_panggilan = explode(",",$this->security->xss_clean($this->input->post('edit_nama_panggilan')));
			$edit_tempat_lahir = explode(",",$this->security->xss_clean($this->input->post('edit_tempat_lahir')));
			$edit_tanggal_lahir = explode(",",$this->security->xss_clean($this->input->post('edit_tanggal_lahir')));
			$edit_alamat = explode(",",$this->security->xss_clean($this->input->post('edit_alamat')));
			$edit_jenis_kelamin = explode(",",$this->security->xss_clean($this->input->post('edit_jenis_kelamin')));
			$edit_no_telepon = explode(",",$this->security->xss_clean($this->input->post('edit_no_telepon')));
			$edit_no_fax = explode(",",$this->security->xss_clean($this->input->post('edit_no_fax')));
			$edit_no_hp = explode(",",$this->security->xss_clean($this->input->post('edit_no_hp')));
			$edit_email = explode(",",$this->security->xss_clean($this->input->post('edit_email')));
			$edit_level = explode(",",$this->security->xss_clean($this->input->post('edit_level')));

			for($i=0;$i<count($edit_id_biodata);$i++){
		   	    $user_biodata[$i] = array(
		   	    	'id' => $edit_id_biodata[$i],
					'nama_lengkap' => $edit_nama_lengkap[$i],
					'nama_panggilan' => $edit_nama_panggilan[$i],
					'tempat_lahir' => $edit_tempat_lahir[$i],
					'tanggal_lahir' => $edit_tanggal_lahir[$i],
					'alamat' => $edit_alamat[$i],
					'jenis_kelamin' => $edit_jenis_kelamin[$i],
					'no_telepon' => $edit_no_telepon[$i],
					'no_fax' => $edit_no_fax[$i],
					'no_hp' => $edit_no_hp[$i],
					'email' => $edit_email[$i]
				);

	 			$user[$i] = array(
	 				'id' => $edit_id[$i],
					'level' => $edit_level[$i],
					'update_by' => $this->session->userdata('id_FMS'),
					'update_at' => $date
				);			
		   	}

		   	$this->manajemen_pengguna->edit_user_biodata($user_biodata);
			$this->manajemen_pengguna->edit_user($user);

			$data['raw_data'] = $this->get_data_manajemen_pengguna();
			$this->load->view('tes_view',$data);	
		}else{
			redirect('login','refresh');
		}
	}

	private function set_upload_options()
	{   
		$time = date('YmdHis');
	    $config = array();
	    $config['upload_path'] = 'images_dir/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;
		$config['file_name'] 	 = "F_".$time;
	    return $config;
	}

	public function edit_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_manajemen_pengguna_array = $this->security->xss_clean($this->input->post('id_manajemen_pengguna_array'));
			$data['action'] = "ubah_manajemen_pengguna_form";
			$id_parse = explode(",", $id_manajemen_pengguna_array);
			$data_per_id = array();
			for($i=0;$i<count($id_parse);$i++){
				$data_per_id[$i] = $this->manajemen_pengguna->select_where_id($id_parse[$i]);
			}
			$data['raw_data'] = $data_per_id;
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_change_image_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['id_biodata'] = $this->security->xss_clean($this->input->post('id_biodata'));
			$data['foto_path'] = $this->security->xss_clean($this->input->post('foto_path'));
			$data['nama_lengkap'] = $this->security->xss_clean($this->input->post('nama_lengkap'));
			$data['action'] = "ubah_image_profile_manajemen_pengguna_form";
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_change_image()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_biodata_pic = $this->security->xss_clean($this->input->post('id_biodata_pic'));
			$old_foto_path_pic = $this->security->xss_clean($this->input->post('old_foto_path_pic'));
		    $this->load->library('upload');
	        $config = array();
	        $config = $this->set_upload_options();
			$this->upload->initialize($config);

	        if ($this->upload->do_upload('foto_pic')){
				unlink($old_foto_path_pic);
	        	$extendtion = explode(".", $_FILES['foto_pic']['name']);
				$foto_path = "images_dir/".$config['file_name'].".".$extendtion[count($extendtion)-1];		
				$user_biodata[0] = array(
					'id' => $id_biodata_pic,
	        		'foto_path' => $foto_path 
	        	);
	        	$this->manajemen_pengguna->edit_user_biodata($user_biodata);
				$data['raw_data'] = $this->get_data_manajemen_pengguna();
				$this->load->view('tes_view',$data);
	        }
	    }else{
			redirect('login','refresh');
		}
	}		

	public function delete_temporary()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s'); 
	        $delete_id = explode(",",$this->security->xss_clean($this->input->post('delete_id')));
	        for($i=0;$i<count($delete_id);$i++){
	 			$user[$i] = array(
	 				'id' => $delete_id[$i],
					'status' => "delete",
					'update_by' => $this->session->userdata('id_FMS'),
					'update_at' => $date
				);			
		   	}
			$this->manajemen_pengguna->edit_user($user);
			$data['raw_data'] = $this->get_data_manajemen_pengguna();
			$this->load->view('tes_view',$data);        
		}else{
			redirect('login','refresh');
		}
	}

	public function delete()
	{
        if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$delete_id = explode(",",$this->security->xss_clean($this->input->post('delete_id')));
	        $delete_id_biodata = explode(",",$this->security->xss_clean($this->input->post('delete_id_biodata')));
	        $delete_old_foto_path = explode(",",$this->security->xss_clean($this->input->post('delete_old_foto_path')));
	        for($i=0;$i<count($delete_id);$i++){
		        $this->manajemen_pengguna->delete_user($delete_id[$i]);
		        $this->manajemen_pengguna->delete_user_biodata($delete_id_biodata[$i]);
				unlink($delete_old_foto_path[$i]);
		    }
			$data['raw_data'] = $this->get_data_manajemen_pengguna();
			$this->load->view('tes_view',$data);  
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_temporary_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_manajemen_pengguna_array = $this->security->xss_clean($this->input->post('id_manajemen_pengguna_array'));
			$data['action'] = "delete_manajemen_pengguna_form";
			$id_parse = explode(",", $id_manajemen_pengguna_array);
			$data_per_id = array();
			for($i=0;$i<count($id_parse);$i++){
				$data_per_id[$i] = $this->manajemen_pengguna->select_where_id($id_parse[$i]);
			}
			$data['raw_data'] = $data_per_id;
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_manajemen_pengguna_array = $this->security->xss_clean($this->input->post('id_manajemen_pengguna_array'));
			$data['action'] = "delete_manajemen_pengguna_form";
			$id_parse = explode(",", $id_manajemen_pengguna_array);
			$data_per_id = array();
			for($i=0;$i<count($id_parse);$i++){
				$data_per_id[$i] = $this->manajemen_pengguna->select_where_id($id_parse[$i]);
			}
			$data['raw_data'] = $data_per_id;
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}			

	public function restore()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s'); 
	        $delete_id = explode(",",$this->security->xss_clean($this->input->post('id_delete_manajemen_pengguna_array')));
	        for($i=0;$i<count($delete_id);$i++){
	 			$user[$i] = array(
	 				'id' => $delete_id[$i],
					'status' => "on",
					'update_by' => $this->session->userdata('id_FMS'),
					'update_at' => $date
				);			
		   	}
			$this->manajemen_pengguna->edit_user($user);
			$data['raw_data'] = $this->get_data_manajemen_pengguna();
			$this->load->view('tes_view',$data);   
		}else{
			redirect('login','refresh');
		}   
	}

}
