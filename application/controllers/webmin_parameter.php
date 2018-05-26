<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Parameter extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('parameter_model');
	}

	function ajax($id=null) {
		if($id == 'parameter_nm') {
			$parameter_group = $this->input->get('parameter_group');
			$parameter_nm = $this->input->get('parameter_nm');
			//
			$list_parameter_filed = $this->parameter_model->get_all_parameter_nm($parameter_group);
			//
			$html = '';
			$html.= '<div class="span4"><select name="parameter_nm" id="parameter_nm" class="form-control chosen-select">';
			$html.= '<option value="">Pilih Parameter Nama</option>';
			foreach($list_parameter_filed as $kel) {
				if($parameter_nm == $kel['parameter_nm']) {
					$html.= '<option value="'.$kel['parameter_nm'].'" selected>'.$kel['parameter_nm'].'</option>';	
				} else {
					$html.= '<option value="'.$kel['parameter_nm'].'">'.$kel['parameter_nm'].'</option>';
				}				
			}
			$html.= '</select></div>';
			$html.= js_chosen();
			//
			echo json_encode(array(
				'html' => $html
			));
		}elseif($id == 'validate_id') {
			$parameter_group = $this->input->get('parameter_group');
			$parameter_nm = $this->input->get('parameter_nm');
			$parameter_id = $this->input->get('parameter_id');
			$validate = $this->parameter_model->validate_id($parameter_group,$parameter_nm,$parameter_id);
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
		$data['ses_parameter_group'] = @$_SESSION['ses_parameter_group'];
		//
		$data['paging'] = $this->parameter_model->paging_parameter($p,$o);
		$data['list_parameter'] = $this->parameter_model->list_parameter($o, $data['paging']->offset, $data['paging']->per_page);
		$data['parameter_group'] = $this->parameter_model->get_parameter_group();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/parameter/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $parameter_group=null, $parameter_nm=null, $parameter_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($parameter_group != '' && $parameter_nm != '' && $parameter_id != '') {
			$data['main'] = $this->parameter_model->get_parameter($parameter_group, $parameter_nm, $parameter_id);
			$data['form_action'] = site_url('webmin_parameter/update/'.$p.'/'.$o.'/'.$parameter_group.'/'.$parameter_nm.'/'.$parameter_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_parameter/insert');
		}
		//
		$data['parameter_group'] = $this->parameter_model->get_parameter_group();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/parameter/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_parameter_group = $this->input->post('ses_parameter_group');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_parameter_group'] = ($ses_parameter_group != '') ? $ses_parameter_group : false;
		//
		redirect('webmin_parameter/index');
	}

	function insert() {
		$this->parameter_model->insert();
		redirect('webmin_parameter/index');
	}

	function update($p, $o, $parameter_group, $parameter_field, $parameter_id) {
		$this->parameter_model->update($parameter_group, $parameter_field, $parameter_id);
		redirect('webmin_parameter/index');
	}

	function delete($p, $o, $parameter_group, $parameter_field, $parameter_id) {
		$this->parameter_model->delete($parameter_group, $parameter_field, $parameter_id);
		redirect('webmin_parameter/index');
	}
	
}