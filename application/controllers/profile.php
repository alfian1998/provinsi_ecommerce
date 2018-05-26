<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
		$this->load->model('customer_model');
		$this->load->model('user_model');
		$this->load->model('region_model');
		$this->load->model('bank_model');
	}

	function ajax($id=null) {
		if($id == 'validate_email') {
			$email = $this->input->get('email');
			$customer_id = $this->session->userdata('ses_customer_id');
			$validate = $this->user_model->validate_email($email, $customer_id);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_username') {
			$username = $this->input->get('username');
			$customer_id = $this->session->userdata('ses_customer_id');
			$validate = $this->user_model->validate_username($username, $customer_id);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_customer_nm') {
			$customer_nm = $this->input->get('customer_nm');
			$customer_id = $this->session->userdata('ses_customer_id');
			$validate = $this->user_model->validate_customer_nm($customer_nm, $customer_id);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_bank_owner') {
			$bank_owner = $this->input->get('bank_owner');
			$customer_id = $this->session->userdata('ses_customer_id');
			$validate = $this->user_model->validate_bank_owner($bank_owner, $customer_id);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'customer_kabupaten') {
			$ses_customer_id = $this->session->userdata('ses_customer_id');
			$main = $this->customer_model->get_customer($ses_customer_id);
			//
			$customer_provinsi = $this->input->get('customer_provinsi');
			$customer_kabupaten = $this->input->get('customer_kabupaten');
			//
			$list_kabupaten = $this->region_model->get_all_customer_kabupaten($customer_provinsi);
			//
			$html = '';
			$html .='<script type="text/javascript">
						$(function() {';
				if(@$main['customer_kecamatan'] != ''){
		    $html .="	customer_kecamatan('".$main["customer_kabupaten"]."','".$main["customer_kecamatan"]."');";
		    	}elseif(@$main['customer_kecamatan'] == ''){
		    $html .="	customer_kecamatan('".$main["customer_kabupaten"]."','".$main["customer_kecamatan"]."');";
		    	}
			$html .=" 	$('#customer_kabupaten').bind('change',function(e) {
					        e.preventDefault();
					        var i = $(this).val();
					        customer_kecamatan(i);
					    }); ";
		    $html .=" 	function customer_kecamatan(i,k) {
					        $.get('".site_url('profile/ajax/customer_kecamatan')."?customer_kabupaten='+i+'&customer_kecamatan='+k,null,function(data) {
					            $('#box_kecamatan').html(data.html);
					        },'json');
					    }";
			$html .='	});
					</script>';
			//
			$html.= '<select name="customer_kabupaten" id="customer_kabupaten" class="chosen-select span4">';
			$html.= '<option value="">-- Pilih Kabupaten --</option>';
			foreach($list_kabupaten as $kab) {
				if($customer_kabupaten == $kab['id_kab']) {
					$html.= '<option value="'.$kab['id_kab'].'" selected>'.$kab['nama'].'</option>';	
				} else {
					$html.= '<option value="'.$kab['id_kab'].'">'.$kab['nama'].'</option>';
				}				
			}
			$html.= '</select>';
			$html.= js_chosen();
			//
			echo json_encode(array(
				'html' => $html
			));
		}else if($id == 'customer_kecamatan') {
			$ses_customer_id = $this->session->userdata('ses_customer_id');
			$main = $this->customer_model->get_customer($ses_customer_id);
			//
			$customer_kabupaten = $this->input->get('customer_kabupaten');
			$customer_kecamatan = $this->input->get('customer_kecamatan');
			//
			$list_kecamatan = $this->region_model->get_all_customer_kecamatan($customer_kabupaten);
			//
			$html = '';
			$html .='<script type="text/javascript">
						$(function() {';
				if(@$main['customer_kelurahan'] != ''){
		    $html .="	customer_kelurahan('".$main["customer_kecamatan"]."','".$main["customer_kelurahan"]."');";
		    	}elseif(@$main['customer_kelurahan'] == ''){
		    $html .="	customer_kelurahan('".$main["customer_kecamatan"]."','".$main["customer_kelurahan"]."');";
		    	}
			$html .=" 	$('#customer_kecamatan').bind('change',function(e) {
					        e.preventDefault();
					        var i = $(this).val();
					        customer_kelurahan(i);
					    }); ";
		    $html .=" 	function customer_kelurahan(i,k) {
					        $.get('".site_url('profile/ajax/customer_kelurahan')."?customer_kecamatan='+i+'&customer_kelurahan='+k,null,function(data) {
					            $('#box_kelurahan').html(data.html);
					        },'json');
					    }";
			$html .='	});
					</script>';
			//
			$html.= '<select name="customer_kecamatan" id="customer_kecamatan" class="chosen-select span4">';
			$html.= '<option value="">-- Pilih Kecamatan --</option>';
			foreach($list_kecamatan as $kec) {
				if($customer_kecamatan == $kec['id_kec']) {
					$html.= '<option value="'.$kec['id_kec'].'" selected>'.$kec['nama'].'</option>';	
				} else {
					$html.= '<option value="'.$kec['id_kec'].'">'.$kec['nama'].'</option>';
				}				
			}
			$html.= '</select>';
			$html.= js_chosen();
			//
			echo json_encode(array(
				'html' => $html
			));
		}else if($id == 'customer_kelurahan') {
			$customer_kecamatan = $this->input->get('customer_kecamatan');
			$customer_kelurahan = $this->input->get('customer_kelurahan');
			//
			$list_kelurahan = $this->region_model->get_all_customer_kelurahan($customer_kecamatan);
			//
			$html = '';
			$html.= '<select name="customer_kelurahan" id="customer_kelurahan" class="chosen-select span4">';
			$html.= '<option value="">-- Pilih Kelurahan --</option>';
			foreach($list_kelurahan as $kel) {
				if($customer_kelurahan == $kel['id_kel']) {
					$html.= '<option value="'.$kel['id_kel'].'" selected>'.$kel['nama'].'</option>';	
				} else {
					$html.= '<option value="'.$kel['id_kel'].'">'.$kel['nama'].'</option>';
				}				
			}
			$html.= '</select>';
			$html.= js_chosen();
			//
			echo json_encode(array(
				'html' => $html
			));
		}
	}

	function index($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		//
		$data['form_action'] = site_url('profile/update/'.$data['ses_customer_id']);
		//
		$data['main'] = $this->customer_model->get_customer($data['ses_customer_id']);
		//validate
		$data['validate_account'] = $this->customer_model->validate_account($data['ses_customer_id']);
		$data['validate_address'] = $this->customer_model->validate_address($data['ses_customer_id']);
		$data['validate_bank_account'] = $this->customer_model->validate_bank_account($data['ses_customer_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/profile/index', $data);
		$this->load->view('public/main/footer');
	}	

	function address($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		//
		$data['form_action'] = site_url('profile/update_address/'.$data['ses_customer_id']);
		//
		$data['main'] = $this->customer_model->get_customer($data['ses_customer_id']);
		$data['list_provinsi'] = $this->region_model->list_address_provinsi();
		//validate
		$data['validate_account'] = $this->customer_model->validate_account($data['ses_customer_id']);
		$data['validate_address'] = $this->customer_model->validate_address($data['ses_customer_id']);
		$data['validate_bank_account'] = $this->customer_model->validate_bank_account($data['ses_customer_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/profile/address', $data);
		$this->load->view('public/main/footer');
	}

	function bank_account($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		//
		$data['form_action'] = site_url('profile/update_bank_account/'.$data['ses_customer_id']);
		//
		$data['main'] = $this->customer_model->get_customer($data['ses_customer_id']);
		$data['list_bank'] = $this->bank_model->get_all_bank();
		//validate
		$data['validate_account'] = $this->customer_model->validate_account($data['ses_customer_id']);
		$data['validate_address'] = $this->customer_model->validate_address($data['ses_customer_id']);
		$data['validate_bank_account'] = $this->customer_model->validate_bank_account($data['ses_customer_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/profile/bank_account', $data);
		$this->load->view('public/main/footer');
	}	

	function update($customer_id = "") {
		$this->customer_model->update($customer_id);
		redirect('profile');
	}

	function update_address($customer_id = "") {
		$this->customer_model->update_address($customer_id);
		redirect('profile/address');
	}

	function update_bank_account($customer_id = "") {
		$this->customer_model->update_bank_account($customer_id);
		redirect('profile/bank_account');
	}

	function delete_image($customer_id) {
		$this->customer_model->delete_image($customer_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
}