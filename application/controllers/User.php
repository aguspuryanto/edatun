<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();
		$this->load->model('M_user');
    }

	public function index()
	{
		$data['title'] = "User";
		$data['model'] = $this->M_user;
		$data['listData'] = $this->M_user->select_all();	
		
		$this->template->views('page/user/index', $data);
	}

	public function setting()
	{
		$data['title'] = "User";
		$data['model'] = $this->M_user;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('role_id'));

		$_POST = $this->input->post();
		if($_POST) {
			// echo json_encode($_POST); die();
			$this->load->library('form_validation');
			$model = $this->M_user;

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
				$data = array(
					'instansi' => $this->input->post('instansi'),
					'kategori' => $this->input->post('kategori'),
					'no_registrasi' => $this->input->post('no_registrasi'),
					'tgl_permohonan' => date('Y-m-d', strtotime($this->input->post('tgl_permohonan'))),
					'subject' => $this->input->post('subject'),
					'kasus_posisi' => $this->input->post('kasus_posisi'),
					'status' => $this->input->post('status'),
				);

				$model->save($data);
				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan', 'data' => $data);
			}
	
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
		else {
		
			$this->template->views('page/user/setting', $data);
		}
	}

	public function picture() {

		if (!file_exists('./uploads')) {
			mkdir('./uploads', 0777, true);
		}

		$config['upload_path']= FCPATH . "/uploads"; //path folder file upload
		$config['allowed_types']='gif|jpg|png'; //type file yang boleh di upload
		$config['max_size'] = 5000;
		$config['encrypt_name'] = TRUE; //enkripsi file name upload
		
		$this->load->library('upload',$config); //call library upload 

		$json = array();
		if (!$this->upload->do_upload('picture_img')) {
			$json = array(
				'success' => false,
				'message' => $this->upload->display_errors()
			);
		}
		else {
			//upload file
			$upload = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
			$dokumen = $upload['upload_data']['file_name']; //set file name ke variable image

			$model = $this->M_user;
			$data = array(
				'picture_img' => $dokumen,
			);

			if($this->input->post('id')) {
				$id = $this->input->post('id');
				$model->update($id, $data);
				// $this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan', 'data' => $data);
			}
		}
	
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
		
	}

	public function create() {
		$this->load->library('form_validation');
		$model = $this->M_user;

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
			$data = array(
				'instansi' => $this->input->post('instansi'),
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'divisi' => $this->input->post('divisi'),
				'role_id' => $this->input->post('role_id'),
				'email' => $this->input->post('email'),
				'nohape' => $this->input->post('nohape'),
				'password' => $this->input->post('nohape'),
			);

			if($this->input->post('id')) {
				$id = $this->input->post('id');
				$model->update($id, $data);
			}
			else {
				$model->save($data);
			}

			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan', 'data' => $data);
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}
}
