<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();
		$this->load->model('M_user');
		$this->load->model('M_meeting');
    }

	public function index()
	{
		$data['title'] = "Permohonan Rapat";
		$data['model'] = $this->M_meeting;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('id'));
		
		$this->template->views('page/meeting/index', $data);
	}

	public function jadwal()
	{
		$data['title'] = "Permohonan Rapat";
		$data['model'] = $this->M_meeting;
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('id'));
		$data['listData'] = $this->M_meeting->select_all();	
		$data['ctrl'] = $this; 
		
		$this->template->views('page/meeting/jadwal', $data);
	}

	public function view($id) {
		// $data['userdata'] 	= $this->userdata;
		$data['data'] = $this->M_meeting->select_all(['id' => $id]);
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

	public function remove() {
		$json = array();
		$model = $this->M_meeting;

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

	public function create() {
		$this->load->library('form_validation');

		$model = $this->M_meeting;
		$this->form_validation->set_rules($model->rules());
		$this->form_validation->set_message('required', 'Mohon lengkapi {field}!');

		$json = array();
		if (!$this->form_validation->run()) {
			foreach($model->rules() as $key => $val) {
				$json = array_merge($json, array(
					$val['field'] => form_error($val['field'], '<p class="mt-3 text-danger">', '</p>')
				));
			}
		} else {
			$datePermohonan = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_permohonan'));
			// echo $datePermohonan->format('Y-m-d');
			$data = array(
				'instansi' => $this->input->post('instansi'),
				'subject' => $this->input->post('subject'),
				'kategori' => $this->input->post('kategori'),
				'tgl_permohonan' => $datePermohonan->format('Y-m-d'), //date('Y-m-d', strtotime($datePermohonan)),
				'lokasi' => $this->input->post('lokasi'),
				'agenda' => $this->input->post('agenda'),
			);

			if($this->input->post('id')) {
				$id = $this->input->post('id');
				$model->update($id, $data);				
			} else {
				$model->save($data);
			}

			$this->session->set_flashdata('success', 'Berhasil disimpan');
			$json = array('success' => true, 'message' => 'Berhasil disimpan');
			
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}
}
