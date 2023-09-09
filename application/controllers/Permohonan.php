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
		
		$this->template->views('page/permohonan/create_ph', $data);		
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
