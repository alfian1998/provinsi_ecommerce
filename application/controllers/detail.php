<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('produk_model');
	}

	function index() {	
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		//
		$data['form_action'] = site_url('detail/input');
		$data['list_produk'] = $this->produk_model->list_produk();
		$data['cart'] = $this->cart->contents();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/detail/index', $data);
		$this->load->view('public/main/footer');
	}	

	function input() {
		$data= array('id' => $this->input->post('id'),
					'name' => $this->input->post('produk_nm'),
					'price' => $this->input->post('produk_harga'),
					'produk_desc' => $this->input->post('produk_desc'),
					'folder_img' => $this->input->post('folder_img'),
					'produk_img' => $this->input->post('produk_img'),
					'qty' =>$this->input->post('qty')
					);
		$this->cart->insert($data);
		redirect('detail');
	}
}