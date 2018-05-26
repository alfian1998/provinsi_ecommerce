<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Produk extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
	}

	function index() {	
		$data['cart'] = $this->cart->contents();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/produk/index', $data);
		$this->load->view('webmin/main/footer');
	}	
}