<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('user_model');
	}

	function ajax($id=null) {
		if($id == 'validate_email') {
			$email = $this->input->get('email');
			$validate = $this->user_model->validate_email($email);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_username') {
			$username = $this->input->get('username');
			$validate = $this->user_model->validate_username($username);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_customer_nm') {
			$customer_nm = $this->input->get('customer_nm');
			$validate = $this->user_model->validate_customer_nm($customer_nm);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'permalink') {
			$customer_nm = $this->input->get('customer_nm');
			$permalink = clean_url($customer_nm);
			//
			echo json_encode(array(
				'permalink'	=> $permalink
			));
		}
	}

	function index() {	
		$data['config'] = $this->config_model->general();
		$data['form_action']= site_url("register/insert");
		//
		$data['cart'] = $this->cart->contents();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/register/index', $data);
		$this->load->view('public/main/footer');
	}	

	function insert() {
		$reg_username = $this->input->post('customer_username');
		$reg_password = $this->input->post('customer_password');
		//
		$this->user_model->insert();
		//
		redirect('login/reg_login/'.$reg_username.'/'.$reg_password);
	}
}