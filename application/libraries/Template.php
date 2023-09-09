<?php
// namespace App\Libraries\Templetes;

class Template {
	protected $_ci;

	function __construct() {
		$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
	}

	function views($template = NULL, $data = NULL) {
		if ($template != NULL) {
            // echo json_encode($data);
			$data['_content']		= $this->_ci->load->view($template, $data, TRUE);
			
			//JS
			$data['_js']			= $this->_ci->load->view('template/_js', $data, TRUE);

			echo $data['_template']	= $this->_ci->load->view('template/layout', $data, TRUE);
		}
	}
}
?>