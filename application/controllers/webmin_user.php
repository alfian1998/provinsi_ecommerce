<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_user extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('user_model');
	}

	function ajax($id=null) {
		if($id == 'validate_user_name') {
			$user_name = $this->input->get('user_name');
			$validate = $this->user_model->validate_user_name($user_name);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_user_realname') {
			$user_realname = $this->input->get('user_realname');
			$validate = $this->user_model->validate_user_realname($user_realname);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}
	}
	
	function index($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_usergroup'] = @$_SESSION['ses_usergroup'];
		$data['ses_status'] = @$_SESSION['ses_status'];
		//
		$data['paging'] = $this->user_model->paging_user($p,$o);
		$data['list_user'] = $this->user_model->list_user($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_user'] = $this->user_model->count_user();
		$data['count_customer'] = $this->user_model->count_customer();
		$data['list_usergroup'] = $this->user_model->get_all_usergroup();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/user/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function customer($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_status'] = @$_SESSION['ses_status'];
		//
		$data['paging'] = $this->user_model->paging_customer($p,$o);
		$data['list_customer'] = $this->user_model->list_customer($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_customer'] = $this->user_model->count_customer();
		$data['count_user'] = $this->user_model->count_user();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/customer/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $user_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($user_id != '') {
			$data['main'] = $this->user_model->get_user_administrator($user_id);
			$data['form_action'] = site_url('webmin_user/update/'.$p.'/'.$o.'/'.$user_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_user/insert');
		}
		//
		$data['list_usergroup'] = $this->user_model->get_all_usergroup();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/user/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function form_customer($p=1, $o=0, $customer_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($customer_id != '') {
			$data['main'] = $this->user_model->get_user($customer_id);
			$data['form_action'] = site_url('webmin_user/update_customer/'.$p.'/'.$o.'/'.$customer_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_user/insert_customer');
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/customer/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_usergroup = $this->input->post('ses_usergroup');		
		$ses_status = $this->input->post('ses_status');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_usergroup'] = ($ses_usergroup != '') ? $ses_usergroup : false;
		$_SESSION['ses_status'] = ($ses_status != '') ? $ses_status : false;
		//
		redirect('webmin_user/index');
	}

	function search_customer() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_status = $this->input->post('ses_status');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_status'] = ($ses_status != '') ? $ses_status : false;
		//
		redirect('webmin_user/customer');
	}

	function insert() {
		$this->user_model->insert_user_administrator();
		redirect('webmin/location/user');
	}

	function update($p, $o, $user_id) {
		$this->user_model->update_user_administrator($user_id);
		redirect('webmin/location/user');
	}

	function update_customer($p, $o, $customer_id) {
		$this->user_model->update_customer($customer_id);
		redirect('webmin/location/user/customer');
	}

	function delete_customer($p, $o, $customer_id) {
		$this->user_model->delete_customer($customer_id);
		redirect('webmin/location/user/customer');
	}

	function delete($p, $o, $user_id) {
		$this->user_model->delete_user_administrator($user_id);
		redirect('webmin/location/user');
	}

	function delete_image($user_id) {
		$this->user_model->delete_image($user_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}