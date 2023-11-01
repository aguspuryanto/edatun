<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();
		$this->load->model('M_user');
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		// $data['konten'] = "dashboard";
		$data['dataUser'] = $this->M_user->selectId($this->session->userdata('id'));
		
		// $this->load->view('template/layout', $data);
		$this->template->views('page/dashboard', $data);
	}
}
