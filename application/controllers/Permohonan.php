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
					'layanan' => $this->input->post('layanan'),
					'no_registrasi' => $this->input->post('no_registrasi'),
					'tgl_permohonan' => date('Y-m-d', strtotime($this->input->post('tgl_permohonan'))),
					'subject' => $this->input->post('subject'),
					'kasus_posisi' => $this->input->post('kasus_posisi'),
					'status' => $this->input->post('status'),
				);
	
				$model->save($data);
				$this->session->set_flashdata('success', 'Berhasil disimpan');
				$json = array('success' => true, 'message' => 'Berhasil disimpan');
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
