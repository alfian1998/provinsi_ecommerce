<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_usergroup extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('user_model');
	}

	function ajax($id=null) {
		if($id == 'validate_usergroup_nm') {
			$usergroup_nm = $this->input->get('usergroup_nm');
			$validate = $this->user_model->validate_usergroup_nm($usergroup_nm);
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
		$data['paging'] = $this->user_model->paging_usergroup($p,$o);
		$data['list_usergroup'] = $this->user_model->list_usergroup($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_usergroup'] = $this->user_model->count_usergroup();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/usergroup/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $usergroup_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($usergroup_id != '') {
			$data['main'] = $this->user_model->get_usergroup($usergroup_id);
			$data['form_action'] = site_url('webmin_usergroup/update/'.$p.'/'.$o.'/'.$usergroup_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_usergroup/insert');
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/usergroup/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_usergroup/index');
	}

	function insert() {
		$this->user_model->insert_usergroup();
		redirect('webmin/location/usergroup');
	}

	function update($p, $o, $usergroup_id) {
		$this->user_model->update_usergroup($usergroup_id);
		redirect('webmin/location/usergroup');
	}

	function delete($p, $o, $usergroup_id) {
		$this->user_model->delete_usergroup($usergroup_id);
		redirect('webmin/location/usergroup');
	}
	
}