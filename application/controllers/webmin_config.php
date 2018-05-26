<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Config extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
	}
	
	function index($act = "") {	
		$data['config'] = $this->config_model->general();
		//
		$data['main'] = $this->config_model->get_config();
		$data['form_action'] = site_url('webmin_config/update/' . $act);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/config/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function update($act = "") {
		$this->config_model->update_config($act);
		redirect('webmin_config');
	}
	
}