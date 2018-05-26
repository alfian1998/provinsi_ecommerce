<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_payment_terms extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('payment_terms_model');
	}
	
	function index($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->payment_terms_model->paging_data($p,$o);
		$data['list_data'] = $this->payment_terms_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_data'] = $this->payment_terms_model->count_data();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/payment_terms/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->payment_terms_model->get_data($id);
			$data['form_action'] = site_url('webmin_payment_terms/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_payment_terms/insert');
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/payment_terms/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_payment_terms/index');
	}

	function insert() {
		$this->payment_terms_model->insert();
		redirect('webmin/location/payment_terms');
	}

	function update($p, $o, $id) {
		$this->payment_terms_model->update($id);
		redirect('webmin/location/payment_terms');
	}

	function delete($p, $o, $id) {
		$this->payment_terms_model->delete($id);
		redirect('webmin/location/payment_terms');
	}
	
}