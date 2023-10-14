<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_chatrooms');
    }

    public function index()
    {
        // 
    }

    public function send_message()
	{
		$message = $this->input->get('message', null);
		$sender_id = $this->input->get('sender_id', '');
		$row_id = $this->input->get('row_id', '');
		// $guid = $this->input->get('guid', '');
		
		$this->M_chatrooms->add_message($message, $sender_id, $row_id);
		
		$this->_setOutput($message);
	}
	
	
	public function get_messages()
	{
		$sender_id = $this->input->get('sender_id', null);
		$row_id = $this->input->get('row_id', null);
		$messages = $this->M_chatrooms->get_messages($sender_id, $row_id);
		
		$this->_setOutput($messages);
	}
	
	
	private function _setOutput($data)
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		echo json_encode($data);
	}
}

/* End of file Api.php and path \application\controllers\Api\Api.php */
