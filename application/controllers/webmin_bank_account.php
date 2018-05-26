<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_bank_account extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('bank_account_model');
		$this->load->model('bank_model');
	}
	
	function index($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->bank_account_model->paging_bank_account($p,$o);
		$data['list_bank_account'] = $this->bank_account_model->list_bank_account($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_bank_account'] = $this->bank_account_model->count_bank_account();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/bank_account/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $bank_account_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($bank_account_id != '') {
			$data['main'] = $this->bank_account_model->get_bank_account($bank_account_id);
			$data['form_action'] = site_url('Webmin_bank_account/update/'.$p.'/'.$o.'/'.$bank_account_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('Webmin_bank_account/insert');
		}
		//
		$data['list_bank'] = $this->bank_model->get_all_bank();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/bank_account/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('Webmin_bank_account/index');
	}

	function insert() {
		$this->bank_account_model->insert();
		redirect('webmin/location/bank_account');
	}

	function update($p, $o, $bank_account_id) {
		$this->bank_account_model->update($bank_account_id);
		redirect('webmin/location/bank_account');
	}

	function delete($p, $o, $bank_account_id) {
		$this->bank_account_model->delete($bank_account_id);
		redirect('webmin/location/bank_account');
	}
	
}