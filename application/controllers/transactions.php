<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transactions extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('category_model');
		$this->load->model('checkout_model');
		$this->load->model('bank_account_model');
	}

	function index() {	
		$data['config'] = $this->config_model->general();
		// session login
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['form_action'] = site_url('transactions/search');
		$data['list_category_rand'] = $this->category_model->list_category_rand();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/transactions/index', $data);
		$this->load->view('public/main/footer');
	}

	function invoices($billing_id=null, $email=null) {	
		$data['config'] = $this->config_model->general();
		// session login
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['form_action'] = site_url('transactions/upload_transfer/'.$billing_id);
		$data['list_category_rand'] = $this->category_model->list_category_rand();
		//
		$data['list_seller'] = $this->checkout_model->list_seller($billing_id, $email);
		$data['main'] = $this->checkout_model->get_checkout($billing_id, $email);
		$data['list_bank_account'] = $this->bank_account_model->get_all_bank_account();
		$data['get_checkout_kirim_st'] = $this->checkout_model->get_checkout_kirim_st($billing_id);
		$data['get_kirim_date'] = $this->checkout_model->get_kirim_date_limit_1($billing_id);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/transactions/invoices', $data);
		$this->load->view('public/main/footer');
	}	

	function upload_transfer($billing_id = "") {
		$this->checkout_model->upload_transfer($billing_id);
		redirect('transactions/invoices/'.$billing_id.'/null');
	}

	function update_confirm($billing_id = "") {
		$this->checkout_model->update_confirm($billing_id);
		redirect('transactions/invoices/'.$billing_id.'/null');
	}

	function search() {
		$billing_id = $this->input->post('billing_id');		
		$email = $this->input->post('email');		
		//
		$data_billing_id = ($billing_id != '') ? $billing_id : 'null';
		$data_email = ($email != '') ? $email : 'null';
		//
		redirect('transactions/invoices/'.$data_billing_id.'/'.$data_email);
	}
}