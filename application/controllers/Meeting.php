<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		
		$this->template->views('page/meeting/index', $data);
	}

	public function jadwal()
	{
		$data['title'] = "Jadwal";
		
		$this->template->views('page/meeting/jadwal', $data);
	}
}
