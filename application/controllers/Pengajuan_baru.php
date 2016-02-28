<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_baru extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->model('pengajuan_baru_model','pengajuan_baru');
		$this->load->model('rencana_per_bagian_model','rencana_per_bagian');
		$this->load->model('kasir_model','kasir');
	}

	public function index()
	{	
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$data['raw_data'] = $this->rencana_per_bagian->view_all();
			$this->load->view('pengajuan_baru_view',$data);
		}else{
			redirect('login','refresh');
		}		
	}

	public function get_data_pengajuan_baru($transaksi_mata_anggaran_id)
	{
		$data = $this->pengajuan_baru->view_all($transaksi_mata_anggaran_id);;
		for($g=0;$g<count($data);$g++){
			$datatable[$g][0] = $data[$g]->id;
			$datatable[$g][1] = $data[$g]->kegiatan;	
			$datatable[$g][2] = $data[$g]->tanggal_pelaksana;
			$datatable[$g][3] = $data[$g]->penanggung_jawab;
			$datatable[$g][4] = $data[$g]->total_anggaran;
			$datatable[$g][5] = $data[$g]->nama_file_pengajuan;	
			$datatable[$g][6] = $data[$g]->tanggal_file_pengajuan;	
			$datatable[$g][7] = $data[$g]->kepada_file_pengajuan;	
			$datatable[$g][8] = $data[$g]->tanggal_persetujuan_dekanat;
			$datatable[$g][9] = $data[$g]->tanggal_surat_pengajuan;	
			$datatable[$g][10] = $data[$g]->nomor_surat_pengajuan;
			$datatable[$g][11] = $data[$g]->perihal_surat_pengajuan;	
			$datatable[$g][12] = $data[$g]->kepada_surat_pengajuan;
			$datatable[$g][13] = $data[$g]->nama_file_surat_pengajuan;
			$datatable[$g][14] = $data[$g]->tanggal_surat_persetujuan;
			$datatable[$g][15] = $data[$g]->nama_file_surat_persetujuan;	
			$datatable[$g][16] = $data[$g]->total_dana_surat_persetujuan;	
			$datatable[$g][17] = $data[$g]->tanggal_diterima_kasir;	
			$datatable[$g][18] = $data[$g]->dana_diterima;
			$datatable[$g][19] = $data[$g]->tanggal_file_laporan_kegiatan;		
			$datatable[$g][20] = $data[$g]->nama_file_laporan_kegiatan;	
			$datatable[$g][21] = $data[$g]->tanggal_file_laporan_keuangan;	
			$datatable[$g][22] = $data[$g]->nama_file_laporan_keuangan;
			$datatable[$g][23] = 0;		
		}
		return $datatable;			
	}

	public function view_tabel_pengajuan_baru()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}		
	}
/*
	public function view_tabel_restore_pengajuan_baru()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$data['raw_data'] = $this->pengajuan_baru->view_delete_all($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);		
		}else{
			redirect('login','refresh');
		}		
	}
*/

	public function upload()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_file_pengajuan_baru = $_FILES['detail_file_pengajuan_baru'];
			$date = date('Y-m-d H:i:s');
			require_once(APPPATH.'Excel/reader.php');
			$csv = new Spreadsheet_Excel_Reader();
			$csv->setOutputEncoding('CP1251');
			$tmp_file = $detail_file_pengajuan_baru['tmp_name'];
			$csv->read($tmp_file);
			error_reporting(E_ALL ^ E_NOTICE);
			$data_excel = array();
			for ($i = 3; $i <= $csv->sheets[0]['numRows']; $i++) {
				for ($j = 2; $j <= $csv->sheets[0]['numCols']; $j++) {
					$data_excel[$i-3][$j-2] = $csv->sheets[0]['cells'][$i][$j];
				}
			}
			if(count($data_excel)==1){
				if($data_excel[0][6]==null)$data_excel[0][6]=0;
				$pengajuan_baru = array(
					'id_transaksi_mata_anggaran' => $transaksi_mata_anggaran_id, 
					'program_utama' => "".$data_excel[0][0], 
					'program' => "".$data_excel[0][1], 
					'sasaran' => "".$data_excel[0][2], 
					'kegiatan' => "".$data_excel[0][3], 
					'penanggung_jawab' => "".$data_excel[0][5], 
					'total_anggaran' => $data_excel[0][6], 
					'tanggal_pelaksana' => "".$data_excel[0][4], 
					'keterangan' => "".$data_excel[0][7], 
					'create_by' => $this->session->userdata('id_FMS'), 
					'update_by' => $this->session->userdata('id_FMS'), 
					'create_at' => $date, 
					'update_at' => $date, 
					'status' => "undelete"
				);	
				$this->pengajuan_baru->add_transaksi_pengajuan_anggaran_per_bagian_single($pengajuan_baru);
			}else{
				for($i=0;$i<count($data_excel);$i++){
					$pengajuan_baru[$i] = array(
						'id_transaksi_mata_anggaran' => $transaksi_mata_anggaran_id, 
						'program_utama' => $data_excel[$i][0], 
						'program' => $data_excel[$i][1], 
						'sasaran' => $data_excel[$i][2], 
						'kegiatan' => $data_excel[$i][3], 
						'penanggung_jawab' => $data_excel[$i][5], 
						'total_anggaran' => $data_excel[$i][6], 
						'tanggal_pelaksana' => $data_excel[$i][4], 
						'keterangan' => $data_excel[$i][7], 
						'create_by' => $this->session->userdata('id_FMS'), 
						'update_by' => $this->session->userdata('id_FMS'), 
						'create_at' => $date, 
						'update_at' => $date, 
						'status' => "undelete"
					);			
				}
				$this->pengajuan_baru->add_transaksi_pengajuan_anggaran_per_bagian($pengajuan_baru);				
			}
			$data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);		
		}else{
			redirect('login','refresh');
		}
	}

	public function add()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
	        $transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
	    	$transaksi_pengajuan [0] = array(
	        	'id_transaksi_mata_anggaran' => $transaksi_mata_anggaran_id, 
	        	'program_utama' => $this->input->post('add_program_utama'), 
	        	'program' => $this->input->post('add_program'), 
	        	'sasaran' => $this->input->post('add_sasaran'), 
	        	'kegiatan' => $this->input->post('add_kegiatan'), 
	        	'penanggung_jawab' => $this->input->post('add_penanggung_jawab'), 
	        	'total_anggaran' => $this->input->post('add_jumlah_anggaran'), 
	        	'tanggal_pelaksana' => $this->input->post('add_tanggal_pelaksana'), 
	        	'keterangan' => $this->input->post('add_keterangan'), 
	        	'create_by' => $this->session->userdata('id_FMS'), 
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'create_at' => $date, 
	        	'update_at' => $date, 
	        	'status' => "undelete"
			);
			$this->pengajuan_baru->add_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
			$data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_pengajuan_baru";
			$data['raw_data'] = $this->pengajuan_baru->select_pengajuan_anggaran_per_bagian_where_id($transaksi_mata_anggaran_id);
			$this->load->view('form_view', $data);	
		}else{
			redirect('login','refresh');
		}
	}

	public function edit()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
	        $edit_id_transaksi_mata_anggaran = $this->input->post('edit_id_transaksi_mata_anggaran');
	    	$transaksi_pengajuan [0] = array(
	        	'id' => $this->input->post('edit_id'), 
	        	'program_utama' => $this->input->post('edit_program_utama'), 
	        	'program' => $this->input->post('edit_program'), 
	        	'sasaran' => $this->input->post('edit_sasaran'), 
	        	'kegiatan' => $this->input->post('edit_kegiatan'), 
	        	'penanggung_jawab' => $this->input->post('edit_penanggung_jawab'), 
	        	'total_anggaran' => $this->input->post('edit_total_anggaran'), 
	        	'tanggal_pelaksana' => $this->input->post('edit_tanggal_pelaksana'), 
	        	'keterangan' => $this->input->post('edit_keterangan'), 
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
			$data['raw_data'] = $this->get_data_pengajuan_baru($edit_id_transaksi_mata_anggaran);
			$this->load->view('tes_view', $data);		 
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_pengajuan_baru";
			$data['raw_data'] = $this->pengajuan_baru->select_pengajuan_anggaran_per_bagian_where_id($transaksi_mata_anggaran_id);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$detail_id_transaksi_mata_anggaran = $this->input->post('detail_id_transaksi_mata_anggaran');
	        $detail_url_file = $this->input->post('detail_url_file');
	        if($detail_url_file != NULL) unlink($detail_url_file);
	        $this->pengajuan_baru->delete_master_file_pengajuan($this->input->post('detail_id_master_file_pengajuan'));
			$this->pengajuan_baru->delete_transaksi_pengajuan_anggaran_per_bagian($this->input->post('detail_id'));
			$data['raw_data'] = $this->get_data_pengajuan_baru($detail_id_transaksi_mata_anggaran);
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}
	}

	public function detail_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_all_pengajuan_baru";
			$data['raw_data'] = $this->pengajuan_baru->select_detail_pengajuan_anggaran_per_bagian_where_id($transaksi_mata_anggaran_id);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	private function set_upload_file_pengajuan_options($name_conf)
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = APPPATH.'../pengajuan_dir/';
	    $config['allowed_types'] = 'pdf';
	    $config['max_size']      = '25000000';
	    $config['overwrite']     = FALSE;
		$config['file_name'] 	 = $name_conf;
	    return $config;
	}

	private function set_upload_surat_pengajuan_options($name_conf)
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = APPPATH.'../surat_pengajuan_dir/';
	    $config['allowed_types'] = 'pdf';
	    $config['max_size']      = '25000000';
	    $config['overwrite']     = FALSE;
		$config['file_name'] 	 = $name_conf;
	    return $config;
	}	

	private function set_upload_surat_persetujuan_options($name_conf)
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = APPPATH.'../surat_persetujuan_dir/';
	    $config['allowed_types'] = 'pdf';
	    $config['max_size']      = '25000000';
	    $config['overwrite']     = FALSE;
		$config['file_name'] 	 = $name_conf;
	    return $config;
	}	

	public function upload_file_pengajuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_file_pengajuan_id_transaksi_mata_anggaran = $this->input->post('detail_file_pengajuan_id_transaksi_mata_anggaran');
			$detail_tanggal_file_pengajuan = $this->input->post('detail_tanggal_file_pengajuan');
			$detail_kepada_file_pengajuan = $this->input->post('detail_kepada_file_pengajuan');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['detail_file_pengajuan']['tmp_name']) || !is_uploaded_file($_FILES['detail_file_pengajuan']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['detail_file_pengajuan']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}
	        $config = $this->set_upload_file_pengajuan_options($name_conf);
			$this->upload->initialize($config); 
	      	if ($this->upload->do_upload('detail_file_pengajuan')){
				$size = $_FILES['detail_file_pengajuan']['size'];
				$nama_file = $_FILES['detail_file_pengajuan']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "pengajuan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../pengajuan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);
				$file_pengajuan = array(
					'tanggal' => $detail_tanggal_file_pengajuan,
					'kepada' => $detail_kepada_file_pengajuan,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
				$id_master_file_pengajuan = $this->pengajuan_baru->add_master_file_pengajuan($file_pengajuan);
		        $transaksi_pengajuan [0] = array(
		        	'id' => $detail_file_pengajuan_id_transaksi_mata_anggaran, 
		        	'id_master_file_pengajuan' => $id_master_file_pengajuan, 
		        	'update_by' => $this->session->userdata('id_FMS'), 
		        	'update_at' => $date
				);
				$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        }
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_file_pengajuan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_detail_file_pengajuan";
			$data['raw_data'] = $this->pengajuan_baru->select_file_pengajuan_where_id_pengajuan($transaksi_mata_anggaran_id);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}	

	public function edit_file_pengajuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$edit_detail_file_pengajuan_tanggal = $this->input->post('edit_detail_file_pengajuan_tanggal');
			$edit_detail_file_pengajuan_lama = $this->input->post('edit_detail_file_pengajuan_lama');
			$edit_detail_file_pengajuan_id = $this->input->post('edit_detail_file_pengajuan_id');
			$edit_detail_file_pengajuan_id_master_file_pengajuan = $this->input->post('edit_detail_file_pengajuan_id_master_file_pengajuan');
			$edit_detail_file_pengajuan_id_transaksi_mata_anggaran = $this->input->post('edit_detail_file_pengajuan_id_transaksi_mata_anggaran');
			$edit_detail_file_pengajuan_kepada = $this->input->post('edit_detail_file_pengajuan_kepada');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['edit_detail_file_pengajuan_file']['tmp_name']) || !is_uploaded_file($_FILES['edit_detail_file_pengajuan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['edit_detail_file_pengajuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}
	        $config = $this->set_upload_file_pengajuan_options($name_conf);
			$this->upload->initialize($config);
	        if ($this->upload->do_upload('edit_detail_file_pengajuan_file')){
	        	if($edit_detail_file_pengajuan_lama != NULL) unlink($edit_detail_file_pengajuan_lama);
				$size = $_FILES['edit_detail_file_pengajuan_file']['size'];
				$nama_file = $_FILES['edit_detail_file_pengajuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "pengajuan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../pengajuan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);
				$file_pengajuan[0] = array(
					'id' => $edit_detail_file_pengajuan_id_master_file_pengajuan,
					'tanggal' => $edit_detail_file_pengajuan_tanggal,
					'kepada' => $edit_detail_file_pengajuan_kepada,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
			}else{
				$file_pengajuan[0] = array(
					'id' => $edit_detail_file_pengajuan_id_master_file_pengajuan,
					'tanggal' => $edit_detail_file_pengajuan_tanggal,
					'kepada' => $edit_detail_file_pengajuan_kepada
				);
			}
		
			$this->pengajuan_baru->edit_master_file_pengajuan($file_pengajuan);
	        $transaksi_pengajuan [0] = array(
	        	'id' => $edit_detail_file_pengajuan_id, 
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);

		}else{
			redirect('login','refresh');
		}
	}	

	public function delete_file_pengajuan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_detail_file_pengajuan";
			$data['raw_data'] = $this->pengajuan_baru->select_file_pengajuan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}		
	}	

	public function delete_file_pengajuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_detail_file_pengajuan_lama = $this->input->post('detail_detail_file_pengajuan_lama');
			$detail_detail_file_pengajuan_id = $this->input->post('detail_detail_file_pengajuan_id');
			$detail_detail_file_pengajuan_id_master_file_pengajuan = $this->input->post('detail_detail_file_pengajuan_id_master_file_pengajuan');
			$detail_detail_file_pengajuan_id_transaksi_mata_anggaran = $this->input->post('detail_detail_file_pengajuan_id_transaksi_mata_anggaran');
			if($detail_detail_file_pengajuan_lama != NULL) unlink($detail_detail_file_pengajuan_lama);
			$this->pengajuan_baru->delete_master_file_pengajuan($detail_detail_file_pengajuan_id_master_file_pengajuan);
			$transaksi_pengajuan [0] = array(
	        	'id' => $detail_detail_file_pengajuan_id,
	        	'id_master_file_pengajuan' => 0,
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}		

	public function upload_surat_pengajuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_surat_pengajuan_id_transaksi_mata_anggaran = $this->input->post('detail_surat_pengajuan_id_transaksi_mata_anggaran');
			$detail_surat_pengajuan_tanggal = $this->input->post('detail_surat_pengajuan_tanggal');
			$detail_surat_pengajuan_kepada = $this->input->post('detail_surat_pengajuan_kepada');
		    $detail_surat_pengajuan_nomor_surat = $this->input->post('detail_surat_pengajuan_nomor_surat');
			$detail_surat_pengajuan_perihal_surat = $this->input->post('detail_surat_pengajuan_perihal_surat');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['detail_surat_pengajuan_surat_pengajuan']['tmp_name']) || !is_uploaded_file($_FILES['detail_surat_pengajuan_surat_pengajuan']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['detail_surat_pengajuan_surat_pengajuan']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}
	        $config = $this->set_upload_surat_pengajuan_options($name_conf);
			$this->upload->initialize($config); 
	      	if ($this->upload->do_upload('detail_surat_pengajuan_surat_pengajuan')){
				$nama_file = $_FILES['detail_surat_pengajuan_surat_pengajuan']['name'];
				$size = $_FILES['detail_surat_pengajuan_surat_pengajuan']['size'];
				$extendtion = explode(".", $nama_file);
				$file_path = "surat_pengajuan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../surat_pengajuan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);
				$surat_pengajuan = array(
					'tanggal' => $detail_surat_pengajuan_tanggal,
					'kepada' => $detail_surat_pengajuan_kepada,
					'nomor_surat' => $detail_surat_pengajuan_nomor_surat,
					'perihal_surat' => $detail_surat_pengajuan_perihal_surat,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);

				$id_master_surat_pengajuan = $this->pengajuan_baru->add_master_surat_pengajuan($surat_pengajuan);
		        $transaksi_pengajuan [0] = array(
		        	'id' => $detail_surat_pengajuan_id_transaksi_mata_anggaran, 
		        	'id_master_file_surat_pengajuan' => $id_master_surat_pengajuan, 
		        	'update_by' => $this->session->userdata('id_FMS'), 
		        	'update_at' => $date
				);
				$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        }
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);

		}else{
			redirect('login','refresh');
		}
	}

	public function edit_surat_pengajuan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_detail_surat_pengajuan";
			$data['raw_data'] = $this->pengajuan_baru->select_surat_pengajuan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_surat_pengajuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$edit_detail_surat_pengajuan_tanggal = $this->input->post('edit_detail_surat_pengajuan_tanggal');
			$edit_detail_surat_pengajuan_id = $this->input->post('edit_detail_surat_pengajuan_id');
			$edit_detail_surat_pengajuan_id_master_file_surat_pengajuan = $this->input->post('edit_detail_surat_pengajuan_id_master_file_surat_pengajuan');
			$edit_detail_surat_pengajuan_id_transaksi_mata_anggaran = $this->input->post('edit_detail_surat_pengajuan_id_transaksi_mata_anggaran');
			$edit_detail_surat_pengajuan_kepada = $this->input->post('edit_detail_surat_pengajuan_kepada');
		    $edit_detail_surat_pengajuan_nomor_surat = $this->input->post('edit_detail_surat_pengajuan_nomor_surat');
		    $edit_detail_surat_pengajuan_perihal_surat = $this->input->post('edit_detail_surat_pengajuan_perihal_surat');
		    $edit_detail_surat_pengajuan_lama = $this->input->post('edit_detail_surat_pengajuan_lama');
		    
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['edit_detail_surat_pengajuan_file']['tmp_name']) || !is_uploaded_file($_FILES['edit_detail_surat_pengajuan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['edit_detail_surat_pengajuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}
	        $config = $this->set_upload_surat_pengajuan_options($name_conf);
			$this->upload->initialize($config);
	        if ($this->upload->do_upload('edit_detail_surat_pengajuan_file')){
	        	if($edit_detail_surat_pengajuan_lama != NULL) unlink($edit_detail_surat_pengajuan_lama);
				$size = $_FILES['edit_detail_surat_pengajuan_file']['size'];
				$nama_file = $_FILES['edit_detail_surat_pengajuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "surat_pengajuan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../surat_pengajuan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);
				$surat_pengajuan[0] = array(
					'id' => $edit_detail_surat_pengajuan_id_master_file_surat_pengajuan,
					'tanggal' => $edit_detail_surat_pengajuan_tanggal,
					'kepada' => $edit_detail_surat_pengajuan_kepada,
					'nomor_surat' => $edit_detail_surat_pengajuan_nomor_surat,
					'perihal_surat' => $edit_detail_surat_pengajuan_perihal_surat,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
			}else{
				$surat_pengajuan[0] = array(
					'id' => $edit_detail_surat_pengajuan_id_master_file_surat_pengajuan,
					'tanggal' => $edit_detail_surat_pengajuan_tanggal,
					'kepada' => $edit_detail_surat_pengajuan_kepada,
					'nomor_surat' => $edit_detail_surat_pengajuan_nomor_surat,
					'perihal_surat' => $edit_detail_surat_pengajuan_perihal_surat
				);
			}
			$this->pengajuan_baru->edit_master_surat_pengajuan($surat_pengajuan);
	        $transaksi_pengajuan [0] = array(
	        	'id' => $edit_detail_surat_pengajuan_id, 
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_surat_pengajuan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_detail_surat_pengajuan";
			$data['raw_data'] = $this->pengajuan_baru->select_surat_pengajuan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_surat_pengajuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_detail_surat_pengajuan_lama = $this->input->post('detail_detail_surat_pengajuan_lama');
			$detail_detail_surat_pengajuan_id = $this->input->post('detail_detail_surat_pengajuan_id');
			$detail_detail_surat_pengajuan_id_master_file_surat_pengajuan = $this->input->post('detail_detail_surat_pengajuan_id_master_file_surat_pengajuan');
			$detail_detail_surat_pengajuan_id_transaksi_mata_anggaran = $this->input->post('detail_detail_surat_pengajuan_id_transaksi_mata_anggaran');
			if($detail_detail_surat_pengajuan_lama != NULL) unlink($detail_detail_surat_pengajuan_lama);
			$this->pengajuan_baru->delete_master_surat_pengajuan($detail_detail_surat_pengajuan_id_master_file_surat_pengajuan);
			$transaksi_pengajuan [0] = array(
	        	'id' => $detail_detail_surat_pengajuan_id, 
	        	'id_master_file_surat_pengajuan' => 0,
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);		
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}
	}

	public function upload_surat_persetujuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_surat_persetujuan_id_transaksi_mata_anggaran = $this->input->post('detail_surat_persetujuan_id_transaksi_mata_anggaran');
			$detail_surat_persetujuan_tanggal = $this->input->post('detail_surat_persetujuan_tanggal');
			$detail_surat_persetujuan_kepada = $this->input->post('detail_surat_persetujuan_kepada');
			$detail_surat_persetujuan_nomor_surat = $this->input->post('detail_surat_persetujuan_nomor_surat');
		    $detail_surat_persetujuan_perihal_surat = $this->input->post('detail_surat_persetujuan_perihal_surat');
			$detail_surat_persetujuan_total_dana = $this->input->post('detail_surat_persetujuan_total_dana');
			$detail_surat_persetujuan_file = $this->input->post('detail_surat_persetujuan_file');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['detail_surat_persetujuan_file']['tmp_name']) || !is_uploaded_file($_FILES['detail_surat_persetujuan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['detail_surat_persetujuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}	        
	        $config = $this->set_upload_surat_persetujuan_options($name_conf);
			$this->upload->initialize($config); 
	      	if ($this->upload->do_upload('detail_surat_persetujuan_file')){
	      		
				$size = $_FILES['detail_surat_persetujuan_file']['size'];
				$nama_file = $_FILES['detail_surat_persetujuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "surat_persetujuan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../surat_persetujuan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);
				$surat_persetujuan = array(
					'tanggal' => $detail_surat_persetujuan_tanggal,
					'kepada' => $detail_surat_persetujuan_kepada,
					'nomor_surat' => $detail_surat_persetujuan_nomor_surat,
					'perihal_surat' => $detail_surat_persetujuan_perihal_surat,
					'total_dana' => $detail_surat_persetujuan_total_dana,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
				$id_master_surat_persetujuan = $this->pengajuan_baru->add_master_surat_persetujuan($surat_persetujuan);
		        $transaksi_pengajuan [0] = array(
		        	'id' => $detail_surat_persetujuan_id_transaksi_mata_anggaran, 
		        	'id_master_file_surat_persetujuan' => $id_master_surat_persetujuan, 
		        	'update_by' => $this->session->userdata('id_FMS'), 
		        	'update_at' => $date
				);
				$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        }
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_surat_persetujuan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_detail_surat_persetujuan";
			$data['raw_data'] = $this->pengajuan_baru->select_surat_persetujuan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_surat_persetujuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$edit_detail_surat_persetujuan_id_master_file_surat_persetujuan = $this->input->post('edit_detail_surat_persetujuan_id_master_file_surat_persetujuan');
			$edit_detail_surat_persetujuan_tanggal = $this->input->post('edit_detail_surat_persetujuan_tanggal');
			$edit_detail_surat_persetujuan_id = $this->input->post('edit_detail_surat_persetujuan_id');
			$edit_detail_surat_persetujuan_id_master_file_surat_persetujuan = $this->input->post('edit_detail_surat_persetujuan_id_master_file_surat_persetujuan');
			$edit_detail_surat_persetujuan_id_transaksi_mata_anggaran = $this->input->post('edit_detail_surat_persetujuan_id_transaksi_mata_anggaran');
			$edit_detail_surat_persetujuan_kepada = $this->input->post('edit_detail_surat_persetujuan_kepada');
		    $edit_detail_surat_persetujuan_nomor_surat = $this->input->post('edit_detail_surat_persetujuan_nomor_surat');
		    $edit_detail_surat_persetujuan_perihal_surat = $this->input->post('edit_detail_surat_persetujuan_perihal_surat');
		    $edit_detail_surat_persetujuan_total_dana = $this->input->post('edit_detail_surat_persetujuan_total_dana');
		    $edit_detail_surat_persetujuan_lama = $this->input->post('edit_detail_surat_persetujuan_lama');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['edit_detail_surat_persetujuan_file']['tmp_name']) || !is_uploaded_file($_FILES['edit_detail_surat_persetujuan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['edit_detail_surat_persetujuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}	        
	        $config = $this->set_upload_surat_persetujuan_options($name_conf);
			$this->upload->initialize($config);
	        if ($this->upload->do_upload('edit_detail_surat_persetujuan_file')){
	        	if($edit_detail_surat_persetujuan_lama != NULL) unlink($edit_detail_surat_persetujuan_lama);
				$size = $_FILES['edit_detail_surat_persetujuan_file']['size'];
				$nama_file = $_FILES['edit_detail_surat_persetujuan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "surat_persetujuan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../surat_persetujuan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);
		        $surat_persetujuan[0] = array(
					'id' => $edit_detail_surat_persetujuan_id_master_file_surat_persetujuan,
					'tanggal' => $edit_detail_surat_persetujuan_tanggal,
					'kepada' => $edit_detail_surat_persetujuan_kepada,
					'nomor_surat' => $edit_detail_surat_persetujuan_nomor_surat,
					'perihal_surat' => $edit_detail_surat_persetujuan_perihal_surat,
					'total_dana' => $edit_detail_surat_persetujuan_total_dana,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
			}else{
				$surat_persetujuan[0] = array(
					'id' => $edit_detail_surat_persetujuan_id_master_file_surat_persetujuan,
					'tanggal' => $edit_detail_surat_persetujuan_tanggal,
					'kepada' => $edit_detail_surat_persetujuan_kepada,
					'nomor_surat' => $edit_detail_surat_persetujuan_nomor_surat,
					'perihal_surat' => $edit_detail_surat_persetujuan_perihal_surat,
					'total_dana' => $edit_detail_surat_persetujuan_total_dana
				);
			}
			$this->pengajuan_baru->edit_master_surat_persetujuan($surat_persetujuan);
	        $transaksi_pengajuan [0] = array(
	        	'id' => $edit_detail_surat_persetujuan_id, 
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_surat_persetujuan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_detail_surat_persetujuan";
			$data['raw_data'] = $this->pengajuan_baru->select_surat_persetujuan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_surat_persetujuan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_detail_surat_persetujuan_lama = $this->input->post('detail_detail_surat_persetujuan_lama');
			$detail_detail_surat_persetujuan_id = $this->input->post('detail_detail_surat_persetujuan_id');
			$detail_detail_surat_persetujuan_id_master_file_surat_persetujuan = $this->input->post('detail_detail_surat_persetujuan_id_master_file_surat_persetujuan');
			$detail_detail_surat_persetujuan_id_transaksi_mata_anggaran = $this->input->post('detail_detail_surat_persetujuan_id_transaksi_mata_anggaran');
			if($detail_detail_surat_persetujuan_lama != NULL) unlink($detail_detail_surat_persetujuan_lama);
			$this->pengajuan_baru->delete_master_surat_persetujuan($detail_detail_surat_persetujuan_id_master_file_surat_persetujuan);
	 		$transaksi_pengajuan [0] = array(
	        	'id' => $detail_detail_surat_persetujuan_id,
	        	'id_master_file_surat_persetujuan' => 0,
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}			

	public function add_penerimaan_dana()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian = $this->input->post('detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian');
			$detail_penerimaan_dana_tanggal = $this->input->post('detail_penerimaan_dana_tanggal');
			$detail_penerimaan_dana_jumlah_dana_yang_diterima = $this->input->post('detail_penerimaan_dana_jumlah_dana_yang_diterima');
			$penerimaan_dana[0] = array(
				'id' => $detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian,
				'tanggal_diterima_kasir' => $detail_penerimaan_dana_tanggal,
				'dana_diterima' => $detail_penerimaan_dana_jumlah_dana_yang_diterima,
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($penerimaan_dana);
			$uraian = $this->pengajuan_baru->select_pengajuan_anggaran_per_bagian_where_id($detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian);
			$kasir = array(
				'tanggal' => $detail_penerimaan_dana_tanggal,
				'id_transaksi_mata_anggaran' => $transaksi_mata_anggaran_id,
				'id_transaksi_pengajuan_anggaran' => $detail_penerimaan_dana_id_transaksi_pengajuan_anggaran_per_bagian,
				'uraian' => "Penerimaan dana dari universitas untuk kegiatan ".$uraian[0]->kegiatan." dengan penanggung jawab ".$uraian[0]->penanggung_jawab." untuk tanggal pelaksanaan kegiatan ". $uraian[0]->tanggal_pelaksana,
				'jenis_transaksi' => "DEBET",
				'jumlah_dana' => $detail_penerimaan_dana_jumlah_dana_yang_diterima,
				'create_by' => $this->session->userdata('id_FMS'),
				'create_at' => $date,
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date
			);
			$this->kasir->add($kasir);
	        $total_dana = $this->pengajuan_baru->select_sum_dana_diterima($transaksi_mata_anggaran_id);
			$input[0] = array(
				'id' => $transaksi_mata_anggaran_id,
	        	'total_penerimaan_dana' => $total_dana[0]->total,
	        	'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date,
	        );
	        $this->rencana_per_bagian->edit_transaksi_mata_anggaran($input);
			$data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_penerimaan_dana_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_detail_penerimaan_dana";
			$data['raw_data'] = $this->pengajuan_baru->select_penerimaan_dana_per_bagian_where_id($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_penerimaan_dana()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$edit_detail_penerimaan_dana_id = $this->input->post('edit_detail_penerimaan_dana_id');
			$edit_detail_penerimaan_dana_tanggal = $this->input->post('edit_detail_penerimaan_dana_tanggal');
			$edit_detail_penerimaan_dana_total_dana = $this->input->post('edit_detail_penerimaan_dana_total_dana');
			$penerimaan_dana[0] = array(
				'id' => $edit_detail_penerimaan_dana_id,
				'tanggal_diterima_kasir' => $edit_detail_penerimaan_dana_tanggal,
				'dana_diterima' => $edit_detail_penerimaan_dana_total_dana,
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($penerimaan_dana);
			$kasir[0] = array(
				'id_transaksi_pengajuan_anggaran' => $edit_detail_penerimaan_dana_id,
				'tanggal' => $edit_detail_penerimaan_dana_tanggal,
				'jumlah_dana' => $edit_detail_penerimaan_dana_total_dana,
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date
			);
			$this->kasir->edit_by_id_transaksi_pengajuan_anggaran($kasir);
	        $total_dana = $this->pengajuan_baru->select_sum_dana_diterima($transaksi_mata_anggaran_id);
			$input[0] = array(
				'id' => $transaksi_mata_anggaran_id,
	        	'total_penerimaan_dana' => $total_dana[0]->total,
	        	'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date,
	        );
	        $this->rencana_per_bagian->edit_transaksi_mata_anggaran($input);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);			
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_penerimaan_dana_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_detail_penerimaan_dana";
			$data['raw_data'] = $this->pengajuan_baru->select_penerimaan_dana_per_bagian_where_id($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_penerimaan_dana()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_detail_penerimaan_dana_id = $this->input->post('detail_detail_penerimaan_dana_id');
			$penerimaan_dana[0] = array(
				'id' => $detail_detail_penerimaan_dana_id,
				'tanggal_diterima_kasir' => "00-00-00 00:00:00",
				'dana_diterima' => 0,
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date,
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($penerimaan_dana);
			$this->kasir->delete_by_id_transaksi_pengajuan_anggaran($detail_detail_penerimaan_dana_id);
	        $total_dana = $this->pengajuan_baru->select_sum_dana_diterima($transaksi_mata_anggaran_id);
			$input[0] = array(
				'id' => $transaksi_mata_anggaran_id,
	        	'total_penerimaan_dana' => $total_dana[0]->total,
	        	'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date,
	        );
	        $this->rencana_per_bagian->edit_transaksi_mata_anggaran($input);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}
	}

	public function add_persetujuan_dekanat()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_persetujuan_dekanat_id_transaksi_mata_anggaran = $this->input->post('detail_persetujuan_dekanat_id_transaksi_mata_anggaran');
			$detail_persetujuan_dekanat_tanggal = $this->input->post('detail_persetujuan_dekanat_tanggal');
			$persetujuan_dekanat[0] = array(
				'id' => $detail_persetujuan_dekanat_id_transaksi_mata_anggaran,
				'tanggal_persetujuan_dekanat' => $detail_persetujuan_dekanat_tanggal,
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date,
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($persetujuan_dekanat);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_persetujuan_dekanat_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_detail_persetujuan_dekanat";
			$data['raw_data'] = $this->pengajuan_baru->select_persetujuan_dekanat_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_persetujuan_dekanat()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$edit_detail_persetujuan_dekanat_id = $this->input->post('edit_detail_persetujuan_dekanat_id');
			$edit_detail_persetujuan_dekanat_tanggal = $this->input->post('edit_detail_persetujuan_dekanat_tanggal');
			$persetujuan_dekanat[0] = array(
				'id' => $edit_detail_persetujuan_dekanat_id,
				'tanggal_persetujuan_dekanat' => $edit_detail_persetujuan_dekanat_tanggal,
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date,
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($persetujuan_dekanat);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_persetujuan_dekanat_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_detail_persetujuan_dekanat";
			$data['raw_data'] = $this->pengajuan_baru->select_persetujuan_dekanat_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_persetujuan_dekanat()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_detail_persetujuan_dekanat_id = $this->input->post('detail_detail_persetujuan_dekanat_id');
			$persetujuan_dekanat[0] = array(
				'id' => $detail_detail_persetujuan_dekanat_id ,
				'tanggal_persetujuan_dekanat' =>"0000-00-00 00:00:00",
				'update_by' => $this->session->userdata('id_FMS'),
				'update_at' => $date,
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($persetujuan_dekanat);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}
	}

	private function set_upload_laporan_kegiatan_options($name_conf)
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = APPPATH.'../laporan_kegiatan_dir/';
	    $config['allowed_types'] = 'pdf';
	    $config['max_size']      = '25000000';
	    $config['overwrite']     = FALSE;
		$config['file_name'] 	 = $name_conf;
	    return $config;
	}	

	public function upload_laporan_kegiatan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian = $this->input->post('detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian');
			$detail_laporan_kegiatan_tanggal = $this->input->post('detail_laporan_kegiatan_tanggal');
			$this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['detail_laporan_kegiatan_file']['tmp_name']) || !is_uploaded_file($_FILES['detail_laporan_kegiatan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['detail_laporan_kegiatan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}		        
	        $config = $this->set_upload_laporan_kegiatan_options($name_conf);
			$this->upload->initialize($config); 			
	      	if ($this->upload->do_upload('detail_laporan_kegiatan_file')){
				$size = $_FILES['detail_laporan_kegiatan_file']['size'];
				$nama_file = $_FILES['detail_laporan_kegiatan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "laporan_kegiatan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../laporan_kegiatan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);
				$laporan_kegiatan = array(
					'tanggal' => $detail_laporan_kegiatan_tanggal,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
				$id_master_laporan_kegiatan = $this->pengajuan_baru->add_master_laporan_kegiatan($laporan_kegiatan);
		        $transaksi_pengajuan [0] = array(
		        	'id' => $detail_laporan_kegiatan_id_transaksi_pengajuan_anggaran_per_bagian, 
		        	'id_master_file_laporan_kegiatan' => $id_master_laporan_kegiatan, 
		        	'update_by' => $this->session->userdata('id_FMS'), 
		        	'update_at' => $date
				);
				$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        }
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_laporan_kegiatan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_detail_laporan_kegiatan";
			$data['raw_data'] = $this->pengajuan_baru->select_laporan_kegiatan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_laporan_kegiatan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$edit_detail_laporan_kegiatan_tanggal = $this->input->post('edit_detail_laporan_kegiatan_tanggal');
			$edit_detail_laporan_kegiatan_id = $this->input->post('edit_detail_laporan_kegiatan_id');
			$edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan = $this->input->post('edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan');
			$edit_detail_laporan_kegiatan_id_transaksi_mata_anggaran = $this->input->post('edit_detail_laporan_kegiatan_id_transaksi_mata_anggaran');
			$edit_detail_laporan_kegiatan_lama = $this->input->post('edit_detail_laporan_kegiatan_lama');
			$edit_detail_laporan_kegiatan_file = $this->input->post('edit_detail_laporan_kegiatan_file');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['edit_detail_laporan_kegiatan_file']['tmp_name']) || !is_uploaded_file($_FILES['edit_detail_laporan_kegiatan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['edit_detail_laporan_kegiatan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}	        
	        $config = $this->set_upload_laporan_kegiatan_options($name_conf);
			$this->upload->initialize($config);
	        if ($this->upload->do_upload('edit_detail_laporan_kegiatan_file')){
	        	if($edit_detail_laporan_kegiatan_lama != NULL) unlink($edit_detail_laporan_kegiatan_lama);
				$size = $_FILES['edit_detail_laporan_kegiatan_file']['size'];
				$nama_file = $_FILES['edit_detail_laporan_kegiatan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "laporan_kegiatan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../laporan_kegiatan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);		        
				$laporan_kegiatan[0] = array(
					'id' => $edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan,
					'tanggal' => $edit_detail_laporan_kegiatan_tanggal,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
			}else{
				$laporan_kegiatan[0] = array(
					'id' => $edit_detail_laporan_kegiatan_id_master_file_laporan_kegiatan,
					'tanggal' => $edit_detail_laporan_kegiatan_tanggal
				);
			}
			$this->pengajuan_baru->edit_master_laporan_kegiatan($laporan_kegiatan);
	        $transaksi_pengajuan [0] = array(
	        	'id' => $edit_detail_laporan_kegiatan_id, 
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_laporan_kegiatan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_detail_laporan_kegiatan";
			$data['raw_data'] = $this->pengajuan_baru->select_laporan_kegiatan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_laporan_kegiatan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_detail_laporan_kegiatan_lama = $this->input->post('detail_detail_laporan_kegiatan_lama');
			$detail_detail_laporan_kegiatan_id = $this->input->post('detail_detail_laporan_kegiatan_id');
			$detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan = $this->input->post('detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan');
			$detail_detail_laporan_kegiatan_id_transaksi_mata_anggaran = $this->input->post('detail_detail_laporan_kegiatan_id_transaksi_mata_anggaran');
			if($detail_detail_laporan_kegiatan_lama != NULL) unlink($detail_detail_laporan_kegiatan_lama);
			$this->pengajuan_baru->delete_master_laporan_kegiatan($detail_detail_laporan_kegiatan_id_master_file_laporan_kegiatan);
	 		$transaksi_pengajuan [0] = array(
	        	'id' => $detail_detail_laporan_kegiatan_id,
	        	'id_master_file_laporan_kegiatan' => 0,
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);	
		}else{
			redirect('login','refresh');
		}
	}

	private function set_upload_laporan_keuangan_options($name_conf)
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = APPPATH.'../laporan_keuangan_dir/';
	    $config['allowed_types'] = 'pdf';
	    $config['max_size']      = '25000000';
	    $config['overwrite']     = FALSE;
		$config['file_name'] 	 = $name_conf;
	    return $config;
	}	

	public function upload_laporan_keuangan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian = $this->input->post('detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian');
			$detail_laporan_keuangan_tanggal = $this->input->post('detail_laporan_keuangan_tanggal');
			$detail_laporan_keuangan_file = $this->input->post('detail_laporan_keuangan_file');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['detail_laporan_keuangan_file']['tmp_name']) || !is_uploaded_file($_FILES['detail_laporan_keuangan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['detail_laporan_keuangan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}	        
	        $config = $this->set_upload_laporan_keuangan_options($name_conf);
			$this->upload->initialize($config); 
	      	if ($this->upload->do_upload('detail_laporan_keuangan_file')){
				$size = $_FILES['detail_laporan_keuangan_file']['size'];
				$nama_file = $_FILES['detail_laporan_keuangan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "laporan_keuangan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../laporan_keuangan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);		        	        
				$laporan_keuangan = array(
					'tanggal' => $detail_laporan_keuangan_tanggal,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
				$id_master_laporan_keuangan = $this->pengajuan_baru->add_master_laporan_keuangan($laporan_keuangan);
		        $transaksi_pengajuan [0] = array(
		        	'id' => $detail_laporan_keuangan_id_transaksi_pengajuan_anggaran_per_bagian, 
		        	'id_master_file_laporan_keuangan' => $id_master_laporan_keuangan, 
		        	'update_by' => $this->session->userdata('id_FMS'), 
		        	'update_at' => $date
				);
				$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        }
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_laporan_keuangan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "edit_detail_laporan_keuangan";
			$data['raw_data'] = $this->pengajuan_baru->select_laporan_keuangan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function edit_laporan_keuangan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$time = date('YmdHis');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$edit_detail_laporan_keuangan_tanggal = $this->input->post('edit_detail_laporan_keuangan_tanggal');
			$edit_detail_laporan_keuangan_id = $this->input->post('edit_detail_laporan_keuangan_id');
			$edit_detail_laporan_keuangan_id_master_file_laporan_keuangan = $this->input->post('edit_detail_laporan_keuangan_id_master_file_laporan_keuangan');
			$edit_detail_laporan_keuangan_id_transaksi_mata_anggaran = $this->input->post('edit_detail_laporan_keuangan_id_transaksi_mata_anggaran');
			$edit_detail_laporan_keuangan_lama = $this->input->post('edit_detail_laporan_keuangan_lama');
			$edit_detail_laporan_keuangan_file = $this->input->post('edit_detail_laporan_keuangan_file');
		    $this->load->library('upload');
	        $config = array();
	        if(!file_exists($_FILES['edit_detail_laporan_keuangan_file']['tmp_name']) || !is_uploaded_file($_FILES['edit_detail_laporan_keuangan_file']['tmp_name'])) {
				$name_conf = "no_file";
			}else{
				$nama_file = $_FILES['edit_detail_laporan_keuangan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$name_conf = $time."_".str_replace(' ', '_', $extendtion[0]);
			}
	        $config = $this->set_upload_laporan_keuangan_options($name_conf);
			$this->upload->initialize($config);
	        if ($this->upload->do_upload('edit_detail_laporan_keuangan_file')){
	        	if($edit_detail_laporan_keuangan_lama != NULL) unlink($edit_detail_laporan_keuangan_lama);
				$size = $_FILES['edit_detail_laporan_keuangan_file']['size'];
				$nama_file = $_FILES['edit_detail_laporan_keuangan_file']['name'];
				$extendtion = explode(".", $nama_file);
				$file_path = "laporan_keuangan_dir/".$name_conf.".".$extendtion[1];
				$file_path_chmod = APPPATH."../laporan_keuangan_dir/".$name_conf.".".$extendtion[1];
		        chmod($file_path_chmod, 777);		        	        
				$laporan_keuangan[0] = array(
					'id' => $edit_detail_laporan_keuangan_id_master_file_laporan_keuangan,
					'tanggal' => $edit_detail_laporan_keuangan_tanggal,
					'nama_file' => $nama_file,
					'tipe_file' => $extendtion[count($extendtion)-1], 
					'ukuran_file' => $size, 
					'url_file' => $file_path
				);
			}else{
				$laporan_keuangan[0] = array(
					'id' => $edit_detail_laporan_keuangan_id_master_file_laporan_keuangan,
					'tanggal' => $edit_detail_laporan_keuangan_tanggal
				);
			}
			$this->pengajuan_baru->edit_master_laporan_keuangan($laporan_keuangan);
	        $transaksi_pengajuan [0] = array(
	        	'id' => $edit_detail_laporan_keuangan_id, 
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
			
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_laporan_keuangan_form()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$id_pengajuan = $this->input->post('transaksi_mata_anggaran_id_array');
			$data['action'] = "detail_detail_laporan_keuangan";
			$data['raw_data'] = $this->pengajuan_baru->select_laporan_keuangan_where_id_pengajuan($id_pengajuan);
			$this->load->view('form_view', $data);
		}else{
			redirect('login','refresh');
		}
	}

	public function delete_laporan_keuangan()
	{
		if($this->session->userdata('username_FMS') && $this->session->userdata('level_FMS') && ($this->session->userdata('status_FMS') != "OFF" || $this->session->userdata('status_FMS') != "DELETE")){
			$date = date('Y-m-d H:i:s');
			$transaksi_mata_anggaran_id = $this->input->post('transaksi_mata_anggaran_id');
			$detail_detail_laporan_keuangan_lama = $this->input->post('detail_detail_laporan_keuangan_lama');
			$detail_detail_laporan_keuangan_id = $this->input->post('detail_detail_laporan_keuangan_id');
			$detail_detail_laporan_keuangan_id_master_file_laporan_keuangan = $this->input->post('detail_detail_laporan_keuangan_id_master_file_laporan_keuangan');
			$detail_detail_laporan_keuangan_id_transaksi_mata_anggaran = $this->input->post('detail_detail_laporan_keuangan_id_transaksi_mata_anggaran');
			if($detail_detail_laporan_keuangan_lama != NULL) unlink($detail_detail_laporan_keuangan_lama);
			$this->pengajuan_baru->delete_master_laporan_keuangan($detail_detail_laporan_keuangan_id_master_file_laporan_keuangan);
	 		$transaksi_pengajuan [0] = array(
	        	'id' => $detail_detail_laporan_keuangan_id,
	        	'id_master_file_laporan_keuangan' => 0,
	        	'update_by' => $this->session->userdata('id_FMS'), 
	        	'update_at' => $date
			);
			$this->pengajuan_baru->edit_transaksi_pengajuan_anggaran_per_bagian($transaksi_pengajuan);
	        $data['raw_data'] = $this->get_data_pengajuan_baru($transaksi_mata_anggaran_id);
			$this->load->view('tes_view', $data);
		}else{
			redirect('login','refresh');
		}
	}	

}
