<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Timjpn extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
		$this->load->model('M_user');
		$this->load->model('M_permohonan');
		$this->load->model('M_timjpn');
    }

    public function index()
    {

    }

    public function detailjpn($id) {        
		$data['data'] = $this->M_timjpn->select_all(['permohonan_id' => $id]);

		$json = array();
		if($data['data']) {
			$json = array('success' => true, 'data' => $data['data']);
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

/* End of file Timjpn.php and path \application\controllers\Timjpn.php */
