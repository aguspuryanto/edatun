<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();
		$this->load->model('M_user');
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
		if(isset($_GET['type'])) $data['title'] .= " - " . $_GET['type'];

		$data['model'] = $this->M_permohonan;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('role_id'));

		$this->template->views('page/permohonan/create_ph', $data);
	}

	public function edit_ph() {
		$data['title'] = "Form Permohonan";
		if(isset($_GET['type'])) $data['title'] .= " - " . $_GET['type'];
		
		$data['model'] = $this->M_permohonan;
		$data['dataEdit'] = $this->M_permohonan->selectId($_GET['row_id']);
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('role_id'));

		$this->template->views('page/permohonan/edit_ph', $data);
	}

	public function create() {		
		$this->load->library('form_validation');
		$model = $this->M_permohonan;

		if (!file_exists('./uploads')) {
			mkdir('./uploads', 0777, true);
		}

		$config['upload_path']= FCPATH . "/uploads"; //path folder file upload
		$config['allowed_types']='pdf|doc|docx|gif|jpg|png'; //type file yang boleh di upload
		$config['encrypt_name'] = TRUE; //enkripsi file name upload
		// $config['remove_spaces'] = TRUE;
		
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
				'pemohon' => $this->input->post('pemohon'),
				'termohon' => $this->input->post('termohon'),
				'jenis_permohonan' => $this->input->post('jenis_permohonan'),
				'no_registrasi' => $this->input->post('no_registrasi'),
				'tgl_permohonan' => date('Y-m-d', strtotime($this->input->post('tgl_permohonan'))),
				'subject' => $this->input->post('subject'),
				'kasus_posisi' => $this->input->post('kasus_posisi'),
				'status' => $this->input->post('status'),
			);

			// if (!$this->upload->do_upload('dokumen')) {
			// 	$nextStep = false;
			// 	$json = array(
			// 		'success' => false,
			// 		'message' => $this->upload->display_errors()
			// 	);
			// }
			// else {
				//upload file
				// $upload = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
				// $dokumen = $upload['upload_data']['file_name']; //set file name ke variable image

				// $data = array_merge($data, array(
				// 	'dokumen' => $dokumen,
				// ));
			
				$ImageCount = count($_FILES['dokumen']['name']);
				for($i = 0; $i < $ImageCount; $i++){
					$_FILES['file']['name']       = $_FILES['dokumen']['name'][$i];
					$_FILES['file']['type']       = $_FILES['dokumen']['type'][$i];
					$_FILES['file']['tmp_name']   = $_FILES['dokumen']['tmp_name'][$i];
					$_FILES['file']['error']      = $_FILES['dokumen']['error'][$i];
					$_FILES['file']['size']       = $_FILES['dokumen']['size'][$i];

					// Upload file to server
					if($this->upload->do_upload('file')){
						// Uploaded file data
						$imageData = $this->upload->data();
						$uploadImgData[] = $imageData['file_name'];	
					}
				}
				
				if(!empty($uploadImgData)){
					$data = array_merge($data, array('dokumen' => json_encode($uploadImgData)));
					// echo json_encode($data);
				}
			// }

			if($nextStep) {			

				if($this->input->post('id')) {
					$id = $this->input->post('id');
					$model->update($id, $data);				
				} else {
					$model->save($data);
				}

				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan', 'data' => $data);
			}
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}

	public function perdata() {
		$data['title'] = "Perdata";
		
		$this->template->views('page/permohonan/perdata', $data);
	}

	public function tun() {
		$data['title'] = "Tata usaha Negara";
		
		$this->template->views('page/permohonan/tun', $data);
	}

	// Update
	public function konsiliasi() {
		$data['title'] = "Konsiliasi";
		$data['desc'] = "Konsiliasi adalah cara penyelesaian sengketa melalui proses perundingan (musyawarah) untuk mengidentifikasikan maslaah, menciptakan pilihan-pilihan, memberikan pertimbangan pilihan.";
		$data['model'] = $this->M_permohonan;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('role_id'));
		$data['listData'] = $this->M_permohonan->select_all(['jenis_permohonan' => 'Konsiliasi']);		
		
		$this->template->views('page/permohonan/konsiliasi', $data);
	}

	public function view_konsiliasi($id) {
		// $data['userdata'] 	= $this->userdata;
		$data['data'] = $this->M_permohonan->select_all(['id' => $id]);
		// $data['data'][0]['tgl_permohonan'] = date('d/m/Y', strtotime($data['data'][0]['tgl_permohonan']));

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

	public function remove_konsiliasi() {
		$json = array();
		$model = $this->M_permohonan;

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

	public function mediasi() {
		$data['title'] = "Mediasi";
		$data['desc'] = "Mediasi adalah cara penyelesaian sengketa melalui proses perundingan (musyawarah) untuk mengidentifikasi permasalahan dan mendorong tercapainya kesepakatan yag dibuat para pihak sendiri.";
		$data['model'] = $this->M_permohonan;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('role_id'));
		$data['listData'] = $this->M_permohonan->select_all(['jenis_permohonan' => 'Mediasi']);		
		
		$this->template->views('page/permohonan/konsiliasi', $data);
	}

	public function fasilitasi() {
		$data['title'] = "Fasilitasi";
		$data['desc'] = "Fasilitasi adalah cara penyelesaian sengketa bidang perdata antar negara atau pemerintah dengan memfasilitasi pertemuan para pihak tanpa terlalu jauh masuk dalam materi permalasahan.";
		$data['model'] = $this->M_permohonan;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('role_id'));
		$data['listData'] = $this->M_permohonan->select_all(['jenis_permohonan' => 'Fasilitasi']);		
		
		$this->template->views('page/permohonan/konsiliasi', $data);
	}

	public function dokumen($filename = null) {
		// load download helder
		$this->load->helper('download');

		// read file contents
		$data = @file_get_contents(base_url('/uploads/'.$filename));
		if($data) {
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if($ext == "pdf") {
				header("content-type: application/pdf");
				readfile('./uploads/' . $filename);
			} else {
				force_download($filename, $data);
			}
		}

	}
}
