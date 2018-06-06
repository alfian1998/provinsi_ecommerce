<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Category extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('category_model');
	}

	function ajax($id=null) {
		if($id == 'category_id') {
			$category_parent = $this->input->get('category_parent');
			$category_id = $this->input->get('category_id');
			//
			$get_last_category_id = $this->category_model->get_last_category_id($category_parent);
			//
			$html = '';
			$html.= '<div class="span2">';
			$html.= '<input type="text" name="category_id" class="form-control" value="'.$get_last_category_id['return_2'].$get_last_category_id['return_1'].'" readonly>';
			$html.= '</div>';
			$html.= js_chosen();
			//
			echo json_encode(array(
				'html' => $html
			));
		}
	}
	
	function index($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] 	 	= @$_SESSION['ses_txt_search'];
		$data['ses_category_parent']	= @$_SESSION['ses_category_parent'];
		//
		$data['paging'] = $this->category_model->paging_category($p,$o);
		$data['list_category'] = $this->category_model->list_category($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_category_parent'] = $this->category_model->list_category_parent();
		$data['count_category'] = $this->category_model->count_category();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/category/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function category($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search']	= @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->category_model->paging_category_group($p,$o);
		$data['list_category'] = $this->category_model->list_category_group($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_category'] = $this->category_model->count_category_group();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/category/category', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $category_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($category_id != '') {
			$data['main'] = $this->category_model->get_category($category_id);
			$data['cek_category'] = $this->category_model->cek_category($category_id);
			$data['form_action'] = site_url('webmin_category/update/'.$p.'/'.$o.'/'.$category_id.'/index');
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_category/insert/index');
		}
		//
		$data['list_category_parent'] = $this->category_model->list_category_parent();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/category/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function form_group($p=1, $o=0, $category_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($category_id != '') {
			$data['main'] = $this->category_model->get_category($category_id);
			$data['form_action'] = site_url('webmin_category/update/'.$p.'/'.$o.'/'.$category_id.'/category');
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_category/insert/category');
		}
		//
		$data['last_category_id'] = $this->category_model->get_category_parent_last_category_id();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/category/form_group_category', $data);
		$this->load->view('webmin/main/footer');
	}

	function search($st=null) {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_category_parent = $this->input->post('ses_category_parent');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_category_parent'] = ($ses_category_parent != '') ? $ses_category_parent : false;
		//
		redirect('webmin_category/'.$st);
	}

	function insert($st=null) {
		$this->category_model->insert();
		redirect('webmin_category/'.$st);
	}

	function update($p, $o, $category_id, $st) {
		$this->category_model->update($category_id);
		redirect('webmin_category/'.$st);
	}

	function delete($p, $o, $category_id) {
		$this->category_model->delete($category_id);
		redirect('webmin_category/index');
	}

	function delete_group($p, $o, $category_id) {
		$this->category_model->delete($category_id);
		redirect('webmin_category/category');
	}
	
}