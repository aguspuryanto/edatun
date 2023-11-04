<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		// $data['konten'] = "dashboard";
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('id'));
		$data['dataDashboard'] = $this->M_permohonan->total_dashboard();
		// echo json_encode($data['dataDashboard']);
		
		// $this->load->view('template/layout', $data);
		$this->template->views('page/dashboard', $data);
	}
}
