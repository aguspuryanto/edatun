<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();
		$this->load->model('M_permohonan');
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		
		$this->template->views('page/permohonan/index', $data);
	}

	public function ph() {
		$data['title'] = "Pertimbangan Hukum";
		$data['model'] = $this->M_permohonan;
		$data['listData'] = $this->M_permohonan->select_all();		
		
		$this->template->views('page/permohonan/index', $data);
	}

	public function create_ph() {
		$data['title'] = "Form Permohonan";
		$data['model'] = $this->M_permohonan;
		
		$_POST = $this->input->post();
		if($_POST) {
			// echo json_encode($_POST); die();
			$this->load->library('form_validation');
			$model = $this->M_permohonan;

			if (!file_exists('./uploads')) {
				mkdir('./uploads', 0777, true);
			}

			$config['upload_path']= FCPATH . "/uploads"; //path folder file upload
			$config['allowed_types']='pdf|doc|docx|gif|jpg|png'; //type file yang boleh di upload
			$config['encrypt_name'] = TRUE; //enkripsi file name upload
			
			$this->load->library('upload',$config); //call library upload 

			$json = array();
			$this->form_validation->set_rules($model->rules());	
			$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');
	
			if (!$this->form_validation->run()) {			
				foreach($model->rules() as $key => $val) {
					$json = array_merge($json, array(
						$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
					));
				}
			} else {

				$nextStep = true;
				$data = array(
					'instansi' => $this->input->post('instansi'),
					'kategori' => $this->input->post('kategori'),
					'no_registrasi' => $this->input->post('no_registrasi'),
					'tgl_permohonan' => date('Y-m-d', strtotime($this->input->post('tgl_permohonan'))),
					'subject' => $this->input->post('subject'),
					'kasus_posisi' => $this->input->post('kasus_posisi'),
					'status' => $this->input->post('status'),
				);

				if (!$this->upload->do_upload('dokumen')) {
					$nextStep = false;
					$json = array(
						'success' => false,
						'message' => $this->upload->display_errors()
					);
				}
				else {
					//upload file
					$upload = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
					$dokumen = $upload['upload_data']['file_name']; //set file name ke variable image
	
					$data = array_merge($data, array(
						'dokumen' => $dokumen,
					));
				}
	
				if($nextStep) {
					$model->save($data);
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					$json = array('success' => true, 'message' => 'Berhasil disimpan', 'data' => $data);
				}
			}
	
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
		else {

			$this->template->views('page/permohonan/create_ph', $data);		
		}
	}

	public function perdata() {
		$data['title'] = "Perdata";
		
		$this->template->views('page/permohonan/perdata', $data);
	}

	public function tun() {
		$data['title'] = "Tata usaha Negara";
		
		$this->template->views('page/permohonan/tun', $data);
	}
}
