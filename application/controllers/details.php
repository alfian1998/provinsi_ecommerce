<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Details extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->load->model('product_model');
	}

	function index($product_id=null) {	
		// session login
		// $product_id_md5 = $this->product_model->get_product_id($product_id_raw);
		// print_r($product_id_md5);
		// exit();
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['cart'] = $this->cart->contents();
		$data['main'] = $this->product_model->get_product($product_id);
		$data['list_produk'] = $this->product_model->list_product_new();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/details/index', $data);
		$this->load->view('public/main/footer');
	}	
}