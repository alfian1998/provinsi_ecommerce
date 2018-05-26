<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('category_model');
		$this->load->model('product_model');
	}

	function index() {	
		$data['config'] = $this->config_model->general();
		// session login
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['cart'] = $this->cart->contents();
		$data['list_produk'] = $this->product_model->list_product_new();
		$data['list_category_parent'] = $this->category_model->list_category_parent();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/categories/index', $data);
		$this->load->view('public/main/footer');
		$this->load->view('public/main/js');
	}	
}