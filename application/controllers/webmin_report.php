<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_report extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('checkout_model');
	}
	
	function index() {	
		$data['config'] = $this->config_model->general();
		//
		$data['filter_search'] = @$_SESSION['filter_search'];
		$data['ses_billing_date'] = @$_SESSION['ses_billing_date'];
		$data['ses_status'] = @$_SESSION['ses_status'];
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tampilan_data_1'] = @$_SESSION['ses_tampilan_data_1'];
		$data['ses_tampilan_data_2'] = @$_SESSION['ses_tampilan_data_2'];
		//
		$data['form_action'] = site_url('webmin_report/filter');
		//
		if($data['filter_search'] == 'true'){
			$data['list_buyer'] = $this->checkout_model->list_report_buyer();
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/report/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function monthly() {	
		$data['config'] = $this->config_model->general();
		//
		$data['filter_search'] = @$_SESSION['filter_search'];
		$data['ses_bulan'] = @$_SESSION['ses_bulan'];
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_status'] = @$_SESSION['ses_status'];
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tampilan_data_1'] = @$_SESSION['ses_tampilan_data_1'];
		$data['ses_tampilan_data_2'] = @$_SESSION['ses_tampilan_data_2'];
		//
		$data['form_action'] = site_url('webmin_report/filter_monthly');
		//
		if($data['filter_search'] == 'true'){
			$data['list_buyer'] = $this->checkout_model->list_report_buyer();
		}
		//
		$data['list_tahun'] = $this->checkout_model->get_tahun();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/report/monthly', $data);
		$this->load->view('webmin/main/footer');
	}

	function filter(){
		$_SESSION['filter_search']='true';

		$ses_billing_date = $this->input->post('ses_billing_date');		
		$ses_status = $this->input->post('ses_status');			
		$ses_txt_search = $this->input->post('ses_txt_search');			
		$ses_tampilan_data_1 = $this->input->post('ses_tampilan_data_1');		
		$ses_tampilan_data_2 = $this->input->post('ses_tampilan_data_2');		
		//
		$_SESSION['ses_billing_date'] = ($ses_billing_date != '') ? $ses_billing_date : false;
		$_SESSION['ses_status'] = ($ses_status != '') ? $ses_status : false;
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_tampilan_data_1'] = ($ses_tampilan_data_1 != '') ? $ses_tampilan_data_1 : false;
		$_SESSION['ses_tampilan_data_2'] = ($ses_tampilan_data_2 != '') ? $ses_tampilan_data_2 : false;

		redirect('webmin_report');
	}

	function export_excel_harian() {
		$ses_billing_date = @$_SESSION['ses_billing_date'];
		$ses_status = @$_SESSION['ses_status'];
		$ses_txt_search = @$_SESSION['ses_txt_search'];
		$ses_tampilan_data_1 = @$_SESSION['ses_tampilan_data_1'];
		$ses_tampilan_data_2 = @$_SESSION['ses_tampilan_data_2'];
		$filter_search = @$_SESSION['filter_search'];
		//
		if ($ses_tampilan_data_1 !='') {
			$this->checkout_model->export_excel_harian_1();
		}elseif ($ses_tampilan_data_2 !='') {
			$this->checkout_model->export_excel_harian_2();
		}
	}

	function export_excel_bulanan() {
		$ses_bulan = @$_SESSION['ses_bulan'];
		$ses_tahun = @$_SESSION['ses_tahun'];
		$ses_status = @$_SESSION['ses_status'];
		$ses_txt_search = @$_SESSION['ses_txt_search'];
		$ses_tampilan_data_1 = @$_SESSION['ses_tampilan_data_1'];
		$ses_tampilan_data_2 = @$_SESSION['ses_tampilan_data_2'];
		$filter_search = @$_SESSION['filter_search'];
		//
		if ($ses_tampilan_data_1 !='') {
			$this->checkout_model->export_excel_bulanan_1();
		}elseif ($ses_tampilan_data_2 !='') {
			$this->checkout_model->export_excel_bulanan_2();
		}
	}

	function filter_monthly(){
		$_SESSION['filter_search']='true';

		$ses_bulan = $this->input->post('ses_bulan');		
		$ses_tahun = $this->input->post('ses_tahun');		
		$ses_status = $this->input->post('ses_status');			
		$ses_txt_search = $this->input->post('ses_txt_search');			
		$ses_tampilan_data_1 = $this->input->post('ses_tampilan_data_1');		
		$ses_tampilan_data_2 = $this->input->post('ses_tampilan_data_2');		
		//
		$_SESSION['ses_bulan'] = ($ses_bulan != '') ? $ses_bulan : false;
		$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
		$_SESSION['ses_status'] = ($ses_status != '') ? $ses_status : false;
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_tampilan_data_1'] = ($ses_tampilan_data_1 != '') ? $ses_tampilan_data_1 : false;
		$_SESSION['ses_tampilan_data_2'] = ($ses_tampilan_data_2 != '') ? $ses_tampilan_data_2 : false;

		redirect('webmin_report/monthly');
	}
	
}