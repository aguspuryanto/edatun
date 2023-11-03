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
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('id'));
		$data['listData'] = $this->M_user->select_all();	
		
		$this->template->views('page/user/index', $data);
	}

	public function jpn()
	{
		$data['title'] = "Data JPN";
		$data['model'] = $this->M_user;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('id'));
		$data['listData'] = $this->M_user->select_all(['role_id' => 5]);	
		
		$this->template->views('page/user/jpn', $data);
	}

	public function setting()
	{
		$data['title'] = "User";
		$data['model'] = $this->M_user;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('id'));

		$_POST = $this->input->post();
		if($_POST) {
			// echo json_encode($this->session->userdata('dataUser')['username']);
			// echo json_encode($_POST); die();
			$this->load->library('form_validation');
			$model = $this->M_user;
			if(isset($_POST['type']) && $_POST['type'] == 'pwd') {
				// $model->username = $this->session->userdata('dataUser')['username'];
			}

			$json = array();
			$this->form_validation->set_rules($model->rules());	
			$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');
	
			if (isset($_POST['type']) && $_POST['type'] != 'pwd' && !$this->form_validation->run()) {			
				foreach($model->rules() as $key => $val) {
					$json = array_merge($json, array(
						$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
					));
				}
			} else {
				if(isset($_POST['type']) && $_POST['type'] == 'pwd') {
					$data = array('password' => md5($this->input->post('password')));
				} else {

					$data = array(
						'instansi' => $this->input->post('instansi'),
						'username' => $this->input->post('username'),
						'nama' => $this->input->post('nama'),
						'divisi' => $this->input->post('divisi'),
						'role_id' => $this->input->post('role_id'),
						'email' => $this->input->post('email'),
						'nohape' => $this->input->post('nohape'),
					);
				}
				
				if($this->input->post('id')) {
					$id = $this->input->post('id');
					$model->update($id, $data);
				} else {
					$model->save($data);
				}

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
				'instansi' => ($this->input->post('instansi')) ?? '-',
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'divisi' => $this->input->post('divisi'),
				'role_id' => $this->input->post('role_id'),
				'email' => $this->input->post('email'),
				'nohape' => $this->input->post('nohape')
			);
			
			$defaultPwd = ($this->input->post('role_id') == '5') ? md5('123456') : md5('admin');
			$data = array_merge($data, array('password' => $defaultPwd));			

			// $otp = random_string('alnum', 6);
			// add user info and $otp into database
			// send $otp to user
			// check the $otp user enter and update user status to actived

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

	public function detailjpn($id) {
		$data['data'] = $this->M_user->select_all(['id' => $id], 'nama,nohape');
		// $data['data'][0]['tgl_permohonan'] = date('d/m/Y', strtotime($data['data'][0]['tgl_permohonan']));
		// unset($data['data']['password']);

		$json = array();
		if($data['data']) {
			$json = array('success' => true, 'data' => $data['data'][0]);
		} else {
			$json = array('success' => false, 'data' => []);
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));		
	}

	public function removejpn($id) {
		
		$json = array();
		$model = $this->M_user;

		if($this->input->post('id')) {
			$id = $this->input->post('id');
			$model->delete($id);

			$this->session->set_flashdata('success', 'Berhasil terhapus');
			$json = array('success' => true, 'message' => 'Berhasil terhapus');
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}
}
