
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rencana_per_bagian extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->model('rencana_per_bagian_model','rencana_per_bagian');
		$this->load->model('bagian_model','bagian');
	}	

	public function index()
	{
		$this->load->view('rencana_per_bagian_view');
	}

	public function get_data_restore_detail($id_tahun_anggaran){
		$data = $this->rencana_per_bagian->select_restore_mata_anggaran_where_id($id_tahun_anggaran);
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->kode;	
			$datatable[$g][2] = $data[$g]->mata_anggaran;
			$datatable[$g][3] = $data[$g]->total_dana;
			$datatable[$g][4] = $data[$g]->total_penerimaan_dana;
			$datatable[$g][5] = $data[$g]->catatan;	
		}
		return $datatable;	
	}

	public function  get_data_detail_2($id_tahun_anggaran){
		$data = $this->rencana_per_bagian->select_mata_anggaran_where_id($id_tahun_anggaran);
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->kode;	
			$datatable[$g][2] = $data[$g]->mata_anggaran;
			$datatable[$g][3] = $data[$g]->total_dana;
			$datatable[$g][4] = $data[$g]->total_penerimaan_dana;
			$datatable[$g][5] = 0;
			$datatable[$g][6] = 0;
			$datatable[$g][7] = $data[$g]->catatan;	
		}
		return $datatable;	
	}

	public function  get_data_detail($id_tahun_anggaran){
		$data = $this->rencana_per_bagian->select_mata_anggaran_where_id($id_tahun_anggaran);
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->kode;	
			$datatable[$g][2] = $data[$g]->mata_anggaran;
			$datatable[$g][3] = $data[$g]->total_dana;
			$datatable[$g][4] = $data[$g]->total_penerimaan_dana;
			$datatable[$g][5] = $data[$g]->catatan;	
		}
		return $datatable;	
	}

	public function get_tabel_rencana_per_bagian()
	{
		$data = $this->rencana_per_bagian->view_all();
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->tahun_anggaran;	
			$datatable[$g][2] = $data[$g]->bagian;
			$datatable[$g][3] = $data[$g]->nama_lengkap_update_by;
			$datatable[$g][4] = $data[$g]->update_at;	
		}
		return $datatable;		
	}

	public function get_delete_tabel_rencana_per_bagian()
	{
		$data = $this->rencana_per_bagian->view_delete_all();
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->tahun_anggaran;	
			$datatable[$g][2] = $data[$g]->bagian;
			$datatable[$g][3] = $data[$g]->nama_lengkap_update_by;
			$datatable[$g][4] = $data[$g]->update_at;	
		}
		return $datatable;		
	}

	public function view_tabel_rencana_per_bagian()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['raw_data'] = $this->get_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);		
		}else{
			redirect('login','refresh');
		}
	}

	public function view_delete_tabel_rencana_per_bagian()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['raw_data'] = $this->get_delete_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}					
	}	

	public function add_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['action'] = "tambah_rencana_per_bagian";
			$data['raw_data'] = $this->bagian->view_all();
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function add()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$tahun_anggaran = $this->input->post('tahun_anggaran');
			$nama_bagian = $this->input->post('nama_bagian');
			$file_tahun_anggaran = $_FILES['file_tahun_anggaran'];
			
			$date = date('Y-m-d H:i:s'); 
			
			$tahun_anggaran = array(
				'tahun_anggaran' => $tahun_anggaran, 
				'id_master_bagian' => $nama_bagian, 
				'create_by' => $this->session->userdata('id_FMS'), 
				'update_by' => $this->session->userdata('id_FMS'), 
				'create_at' => $date, 
				'update_at' => $date,  
				'status' => "UNDELETE"
			);

			$id_tahun_anggaran = $this->rencana_per_bagian->add_tahun_anggaran($tahun_anggaran);
			
			require_once(APPPATH.'Excel/reader.php');
			$csv = new Spreadsheet_Excel_Reader();
			$csv->setOutputEncoding('CP1251');
			
			$tmp_file = $file_tahun_anggaran['tmp_name'];
			$csv->read($tmp_file);
			error_reporting(E_ALL ^ E_NOTICE);
			$data_excel = array();
			
			
			for ($i = 3; $i <= $csv->sheets[0]['numRows']; $i++) {
				for ($j = 2; $j <= $csv->sheets[0]['numCols']; $j++) {
					$data_excel[$i-3][$j-2] = $csv->sheets[0]['cells'][$i][$j];
				}
			}
			
			if(count($data_excel)==1){
				if($data_excel[0][2]==null)$data_excel[0][2]=0;
				$mata_anggaran = array(
					'kode' => "".$data_excel[0][0], 
					'mata_anggaran' => "".$data_excel[0][1], 
					'total_dana' => $data_excel[0][2], 
					'id_master_tahun_anggaran' => $id_tahun_anggaran, 
					'catatan' => "".$data_excel[0][3],
					'update_by' => $this->session->userdata('id_FMS'), 
					'update_at' => $date,  
					'status' => "UNDELETE"
				);			
				$this->rencana_per_bagian->add_transaksi_mata_anggaran_single($mata_anggaran);
			}else{
				for($i=0;$i<count($data_excel);$i++){
					$mata_anggaran[$i] = array(
						'kode' => $data_excel[$i][0], 
						'mata_anggaran' => $data_excel[$i][1], 
						'total_dana' => $data_excel[$i][2], 
						'id_master_tahun_anggaran' => $id_tahun_anggaran, 
						'catatan' => $data_excel[$i][3],
						'update_by' => $this->session->userdata('id_FMS'), 
						'update_at' => $date,  
						'status' => "UNDELETE"
					);			
				}
				$this->rencana_per_bagian->add_transaksi_mata_anggaran($mata_anggaran);
			}
			$data['raw_data'] = $this->get_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}					
	}

	public function edit_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['id'] = $this->input->post('id_tahun_anggaran');
			$data['tahun_anggaran'] = $this->input->post('tahun_anggaran');
			$data['nama_bagian'] = $this->input->post('nama_bagian');
			$data['action'] = "ubah_rencana_per_bagian";
			$data['raw_data'] = $this->bagian->view_all();
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function edit()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s'); 
			$tahun_anggaran_data[0] = array(
				'id' => $this->input->post('ubah_id_tahun_anggaran'),
				'tahun_anggaran' => $this->input->post('ubah_tahun_anggaran'),
				'id_master_bagian' => $this->input->post('ubah_nama_bagian'),
	 			'update_by' => $this->session->userdata('id_FMS'),
	 			'update_at' => $date
			);
			$this->rencana_per_bagian->edit_tahun_anggaran($tahun_anggaran_data);
			$data['raw_data'] = $this->get_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function delete_temporary()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s'); 
			$tahun_anggaran_data[0] = array(
				'id' => $this->input->post('delete_id_tahun_anggaran'),
				'status' => "delete",
	 			'update_by' => $this->session->userdata('id_FMS'),
	 			'update_at' => $date
			);
			$this->rencana_per_bagian->edit_tahun_anggaran($tahun_anggaran_data);
			$data['raw_data'] = $this->get_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}	

	public function delete()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_tahun_anggaran = $this->input->post('delete_id_tahun_anggaran'); 
	        $this->rencana_per_bagian->delete_transaksi_mata_anggaran_by_id_master_tahun_anggaran($id_tahun_anggaran);
	        $this->rencana_per_bagian->delete_tahun_anggaran($id_tahun_anggaran);
			$data['raw_data'] = $this->get_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function restore_form(){
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
	        $id_tahun_anggaran = $this->input->post('id_rencana_per_bagian'); 
			$data['raw_data'] = $this->get_delete_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}			
	}

	public function restore()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_tahun_anggaran = explode(",", $this->input->post('id_restore_rencana_per_bagian')); 
			$date = date('Y-m-d H:i:s'); 
			for($i=0;$i<count($id_tahun_anggaran);$i++){
		 		$tahun_anggaran_data[$i] = array(
					'id' => $id_tahun_anggaran[$i],
		 			'update_by' => $this->session->userdata('id_FMS'),
		 			'update_at' => $date,
		 			'status' => "undelete"
				);		
			}
			$this->rencana_per_bagian->edit_tahun_anggaran($tahun_anggaran_data);   
			$data['raw_data'] = $this->get_tabel_rencana_per_bagian();
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}			
	}

	public function edit_mata_anggaran_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_detail_rencana_per_bagian_array = $this->input->post('id_detail_rencana_per_bagian_array');
			$data['action'] = "edit_mata_anggaran_form";
			$id_parse = explode(",", $id_detail_rencana_per_bagian_array);
			$data_per_id = array();
			for($i=0;$i<count($id_parse);$i++){
				$data_per_id[$i] = $this->rencana_per_bagian->select_mata_anggaran_where_id_mata_anggaran($id_parse[$i]);
			}
			$data['raw_data'] = $data_per_id;
			$this->load->view('form_view', $data);		
		}else{
			redirect('login','refresh');
		}			
	}

	public function edit_mata_anggaran()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id = explode(",", $this->input->post('edit_id_mata_anggaran'));
	        $kode = explode(",", $this->input->post('edit_kode_mata_anggaran'));
	        $mata_anggaran = explode(",", $this->input->post('edit_mata_anggaran')); 
	        $total_dana = explode(",", $this->input->post('edit_total_dana')); 
	        $catatan = explode(",", $this->input->post('edit_catatan'));
	        $id_tahun_anggaran = $this->input->post('edit_id_tahun_anggaran'); 

			$date = date('Y-m-d H:i:s'); 

	        for($i=0;$i<count($id);$i++){
				$input[$i] = array(
					'id' => $id[$i],
		        	'kode' => $kode[$i],
		        	'mata_anggaran' => $mata_anggaran[$i], 
		        	'total_dana' => $total_dana[$i], 
		        	'catatan' => $catatan[$i] 
		        );
			}
	        $this->rencana_per_bagian->edit_transaksi_mata_anggaran($input);

	 		$tahun_anggaran_data[0] = array(
				'id' => $id_tahun_anggaran,
	 			'update_by' => $this->session->userdata('id_FMS'),
	 			'update_at' => $date
			);

			$this->rencana_per_bagian->edit_tahun_anggaran($tahun_anggaran_data);
		       
			$data['raw_data'] = $this->get_data_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);		
		}else{
			redirect('login','refresh');
		}			
	}

	public function delete_mata_anggaran_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_detail_rencana_per_bagian_array = $this->input->post('id_detail_rencana_per_bagian_array');
			$data['action'] = "delete_mata_anggaran_form";
			$id_parse = explode(",", $id_detail_rencana_per_bagian_array);
			$data_per_id = array();
			for($i=0;$i<count($id_parse);$i++){
				$data_per_id[$i] = $this->rencana_per_bagian->select_mata_anggaran_where_id_mata_anggaran($id_parse[$i]);
			}
			$data['raw_data'] = $data_per_id;
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}		
	}

	public function delete_temporary_mata_anggaran()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id = explode(",", $this->input->post('delete_id_mata_anggaran')); 
	        $id_tahun_anggaran = $this->input->post('delete_id_tahun_anggaran'); 

			$date = date('Y-m-d H:i:s'); 

	        for($i=0;$i<count($id);$i++){
				$input[$i] = array(
					'id' => $id[$i],
		        	'status' => "delete",
	 				'update_by' => $this->session->userdata('id_FMS'),
	 				'update_at' => $date
		        );
			}
	        $this->rencana_per_bagian->edit_transaksi_mata_anggaran($input);

	 		$tahun_anggaran_data[0] = array(
				'id' => $id_tahun_anggaran,
	 			'update_by' => $this->session->userdata('id_FMS'),
	 			'update_at' => $date
			);

			$this->rencana_per_bagian->edit_tahun_anggaran($tahun_anggaran_data);
		       
			$data['raw_data'] = $this->get_data_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);		
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_mata_anggaran()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id = explode(",", $this->input->post('delete_id_mata_anggaran'));
	        $id_tahun_anggaran = $this->input->post('delete_id_tahun_anggaran'); 

			$date = date('Y-m-d H:i:s'); 

	        for($i=0;$i<count($id);$i++){
	        	$this->rencana_per_bagian->delete_transaksi_mata_anggaran($id[$i]);
			}

	 		$tahun_anggaran_data[0] = array(
				'id' => $id_tahun_anggaran,
	 			'update_by' => $this->session->userdata('id_FMS'),
	 			'update_at' => $date
			);

			$this->rencana_per_bagian->edit_tahun_anggaran($tahun_anggaran_data);

			$data['raw_data'] = $this->get_data_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}		
	}	

	public function  detail_form(){
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
	        $id_tahun_anggaran = $this->input->post('id_rencana_per_bagian'); 
			$data['raw_data'] = $this->get_data_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function  detail_form_2(){
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
	        $id_tahun_anggaran = $this->input->post('id_rencana_per_bagian'); 
			$data['raw_data'] = $this->get_data_detail_2($id_tahun_anggaran);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}	

	public function restore_detail_form(){
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
	        $id_tahun_anggaran = $this->input->post('id_rencana_per_bagian'); 
			$data['raw_data'] = $this->get_data_restore_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}


	public function restore_detail()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_mata_anggaran = explode(",", $this->input->post('id_restore_detail_rencana_per_bagian')); 
			$id_tahun_anggaran = $this->input->post('id_tahun_anggaran');
			$date = date('Y-m-d H:i:s'); 
			for($i=0;$i<count($id_mata_anggaran);$i++){
		 		$mata_anggaran_data[$i] = array(
					'id' => $id_mata_anggaran[$i],
		 			'update_by' => $this->session->userdata('id_FMS'),
		 			'update_at' => $date,
		 			'status' => "undelete"
				);		
			}
			$this->rencana_per_bagian->edit_transaksi_mata_anggaran($mata_anggaran_data);   
			$data['raw_data'] = $this->get_data_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function add_mata_anggaran(){
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s'); 
			$id_tahun_anggaran = $this->input->post('add_id');
		 	$mata_anggaran[0] = array(
		 		'kode' => $this->input->post('add_kode'),
		 		'mata_anggaran' => $this->input->post('add_mata_anggaran'),
		 		'total_dana' => $this->input->post('add_total_dana'),
		 		'id_master_tahun_anggaran' => $id_tahun_anggaran,
		 		'catatan' => $this->input->post('add_catatan'),
		 		'update_by' => $this->session->userdata('id_FMS'),
		 		'update_at' => $date,
		 		'status' => "undelete"
			);		
			$this->rencana_per_bagian->add_transaksi_mata_anggaran($mata_anggaran);   
			$data['raw_data'] = $this->get_data_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}		
	}

	public function upload()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_tahun_anggaran = $this->input->post('detail_id');
			$file_tahun_anggaran = $_FILES['file_tahun_anggaran'];
			
			
			$date = date('Y-m-d H:i:s'); 
			
			require_once(APPPATH.'Excel/reader.php');
			$csv = new Spreadsheet_Excel_Reader();
			$csv->setOutputEncoding('CP1251');
			
			$tmp_file = $file_tahun_anggaran['tmp_name'];
			$csv->read($tmp_file);
			error_reporting(E_ALL ^ E_NOTICE);
			$data_excel = array();
			
			
			for ($i = 3; $i <= $csv->sheets[0]['numRows']; $i++) {
				for ($j = 2; $j <= $csv->sheets[0]['numCols']; $j++) {
					$data_excel[$i-3][$j-2] = $csv->sheets[0]['cells'][$i][$j];
				}
			}

			if(count($data_excel)==1){
				if($data_excel[0][2]==null)$data_excel[0][2]=0;
				$mata_anggaran = array(
					'kode' => "".$data_excel[0][0], 
					'mata_anggaran' => "".$data_excel[0][1], 
					'total_dana' => $data_excel[0][2], 
					'id_master_tahun_anggaran' => $id_tahun_anggaran, 
					'catatan' => "".$data_excel[0][3],
					'update_by' => $this->session->userdata('id_FMS'), 
					'update_at' => $date,  
					'status' => "UNDELETE"
				);			
				$this->rencana_per_bagian->add_transaksi_mata_anggaran_single($mata_anggaran);
			}else{
				for($i=0;$i<count($data_excel);$i++){
					$mata_anggaran[$i] = array(
						'kode' => $data_excel[$i][0], 
						'mata_anggaran' => $data_excel[$i][1], 
						'total_dana' => $data_excel[$i][2], 
						'id_master_tahun_anggaran' => $id_tahun_anggaran, 
						'catatan' => $data_excel[$i][3],
						'update_by' => $this->session->userdata('id_FMS'), 
						'update_at' => $date,  
						'status' => "UNDELETE"
					);			
				}
				$this->rencana_per_bagian->add_transaksi_mata_anggaran($mata_anggaran);
			}		
			$data['raw_data'] = $this->get_data_detail($id_tahun_anggaran);
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}	
	}


}
