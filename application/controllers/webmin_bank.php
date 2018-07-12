<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_bank extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('bank_model');
	}

	function ajax($id=null) {
		if($id == 'validate_bank_nm') {
			$bank_nm = $this->input->get('bank_nm');
			$validate = $this->bank_model->validate_bank_nm($bank_nm);
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
		//
		$data['paging'] = $this->bank_model->paging_bank($p,$o);
		$data['list_bank'] = $this->bank_model->list_bank($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_bank'] = $this->bank_model->count_bank();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/bank/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $bank_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($bank_id != '') {
			$data['main'] = $this->bank_model->get_bank($bank_id);
			$data['form_action'] = site_url('webmin_bank/update/'.$p.'/'.$o.'/'.$bank_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_bank/insert');
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/bank/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_bank/index');
	}

	function insert() {
		$this->bank_model->insert();
		redirect('webmin/location/bank');
	}

	function update($p, $o, $bank_id) {
		$this->bank_model->update($bank_id);
		redirect('webmin/location/bank');
	}

	function delete($p, $o, $bank_id) {
		$this->bank_model->delete($bank_id);
		redirect('webmin/location/bank');
	}

	function delete_image($customer_id) {
		$this->bank_model->delete_image($customer_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}