<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shoppingcart extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
	}

	function index() {	
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		//
		$data['form_action'] = site_url('web/update');
		$data['cart'] = $this->cart->contents();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/shoppingcart/index', $data);
		$this->load->view('public/main/footer');
	}	
}