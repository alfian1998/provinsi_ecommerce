<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('checkout_model');
		$this->load->model('region_model');
		$this->load->model('customer_model');
		$this->load->model('payment_terms_model');
		$this->load->model('bank_account_model');
		$this->load->model('payment_instructions_model');
		$this->load->model('user_model');
	}

	function ajax($id=null) {
		if($id == 'pembeli_kabupaten') {
			$pembeli_provinsi = $this->input->get('pembeli_provinsi');
			$pembeli_kabupaten = $this->input->get('pembeli_kabupaten');
			//
			$list_kabupaten = $this->region_model->get_all_customer_kabupaten($pembeli_provinsi);
			//
			$html = '';
			$html .='<script type="text/javascript">
						$(function() {';
			$html .=" 	$('#pembeli_kabupaten').bind('change',function(e) {
					        e.preventDefault();
					        var i = $(this).val();
					        pembeli_kecamatan(i);
					    }); ";
		    $html .=" 	function pembeli_kecamatan(i,k) {
					        $.get('".site_url('checkout/ajax/pembeli_kecamatan')."?pembeli_kabupaten='+i+'&pembeli_kecamatan='+k,null,function(data) {
					            $('#box_kecamatan').html(data.html);
					        },'json');
					    }";
			$html .='	});
					</script>';
			//
			$html.= '<select name="pembeli_kabupaten" id="pembeli_kabupaten" class="chosen-select">';
			$html.= '<option value="">-- Pilih Kabupaten --</option>';
			foreach($list_kabupaten as $kab) {
				if($pembeli_kabupaten == $kab['id_kab']) {
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
		}else if($id == 'pembeli_kecamatan') {
			$pembeli_kabupaten = $this->input->get('pembeli_kabupaten');
			$pembeli_kecamatan = $this->input->get('pembeli_kecamatan');
			//
			$list_kecamatan = $this->region_model->get_all_customer_kecamatan($pembeli_kabupaten);
			//
			$html = '';
			$html .='<script type="text/javascript">
						$(function() {';
			$html .=" 	$('#pembeli_kecamatan').bind('change',function(e) {
					        e.preventDefault();
					        var i = $(this).val();
					        pembeli_kelurahan(i);
					    }); ";
		    $html .=" 	function pembeli_kelurahan(i,k) {
					        $.get('".site_url('checkout/ajax/pembeli_kelurahan')."?pembeli_kecamatan='+i+'&pembeli_kelurahan='+k,null,function(data) {
					            $('#box_kelurahan').html(data.html);
					        },'json');
					    }";
			$html .='	});
					</script>';
			//
			$html.= '<select name="pembeli_kecamatan" id="pembeli_kecamatan" class="chosen-select">';
			$html.= '<option value="">-- Pilih Kecamatan --</option>';
			foreach($list_kecamatan as $kec) {
				if($pembeli_kecamatan == $kec['id_kec']) {
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
		}else if($id == 'pembeli_kelurahan') {
			$pembeli_kecamatan = $this->input->get('pembeli_kecamatan');
			$pembeli_kelurahan = $this->input->get('pembeli_kelurahan');
			//
			$list_kelurahan = $this->region_model->get_all_customer_kelurahan($pembeli_kecamatan);
			//
			$html = '';
			$html.= '<select name="pembeli_kelurahan" id="pembeli_kelurahan" class="chosen-select">';
			$html.= '<option value="">-- Pilih Kelurahan --</option>';
			foreach($list_kelurahan as $kel) {
				if($pembeli_kelurahan == $kel['id_kel']) {
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
		}else if($id == 'auth_login') {
			$t_akun = $this->input->post('t_akun');
			$t_password = anti_injection($this->input->post('t_password'));
			//
			if($t_akun != '' && $t_password != '') {
				$validate = $this->config_model->auth_login($t_akun, $t_password);
				//
				if($validate == '1') {
					echo json_encode(array(
						'result' 	=> 'true', 
						'redirect' 	=> site_url('checkout')
					));
				} elseif($validate == '2') {
					echo json_encode(array(
						'result' 	=> 'false', 
						'message' 	=> '<i></i>Maaf, Email atau Username ini tidak aktif !', 
					));
				} else {
					echo json_encode(array(
						'result' 	=> 'false', 
						'message' 	=> '<i class="fa fa-times"></i> Maaf, Akun dan/atau password Anda salah, silakan coba lagi', 
					));
				}		
			} else {
				redirect('');
			}	
		}else if($id == 'validate_email') {
			$email = $this->input->get('email');
			$validate_customer = $this->user_model->validate_email($email);
			$validate_pembeli = $this->checkout_model->validate_email($email);
			//
			$result = "true";
			if($validate_customer == true || $validate_pembeli == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_phone') {
			$phone = $this->input->get('phone');
			$validate_customers = $this->user_model->validate_phone($phone);
			$validate_pembelis = $this->checkout_model->validate_phone($phone);
			//
			$result = "true";
			if($validate_customers == true || $validate_pembelis == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}
	}

	function index() {	
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['form_action'] = site_url('checkout/insert');
		$data['cart'] = $this->cart->contents();
		//
		foreach ($data['cart'] as $key) {
			if ($key['customer_id'] == $data['ses_customer_id']) {
				$this->delete_cart_customer_same($key['rowid']);
			}
		}
		//
		$data['list_provinsi'] = $this->region_model->list_all_provinsi();
		$data['get_billing_id'] = $this->checkout_model->get_billing_id();
		$data['get_pembeli_id'] = $this->checkout_model->get_pembeli_id();
		$data['customer'] = $this->customer_model->get_customer_complete($data['ses_customer_id']);
		$data['validate_address'] = $this->customer_model->validate_address($data['ses_customer_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/checkout/index', $data);
		$this->load->view('public/main/footer');
	}	

	function payment($billing_id=null) {	
		if ($billing_id == '') {
			redirect('checkout');
		}
		//
		$data['cart'] = $this->cart->contents();
		foreach ($data['cart'] as $key) {
			// Hapus data produk di dalam chart
			$data = array('rowid' => $key['rowid'],
	  				  		'qty' =>0);
			$this->cart->update($data);
		}
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['form_action'] = site_url('checkout/update_payment/'.$billing_id);
		//
		$data['list_checkout'] = $this->checkout_model->list_checkout_non_customer_id($billing_id);
		$data['billing'] = $this->checkout_model->get_billing($billing_id);
		$data['list_payment_terms'] = $this->payment_terms_model->get_all_data();
		$data['list_bank_account'] = $this->bank_account_model->get_all_bank_account();
		$data['billing_id'] = $billing_id;
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/payment/index', $data);
		$this->load->view('public/main/footer');
	}	

	function pay_transfer($billing_id=null) {	
		if ($billing_id == '') {
			redirect('checkout');
		}
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['list_bank_account'] = $this->bank_account_model->get_all_bank_account();
		$data['get_billing'] = $this->checkout_model->get_billing($billing_id);
		$data['list_petunjuk_pembayaran'] = $this->payment_instructions_model->get_all_data();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/pay_transfer/index', $data);
		$this->load->view('public/main/footer');
	}	

	function insert() {
		$billing_id = $this->input->post('billing_id');
		//
		$this->checkout_model->insert();
		//
		redirect('checkout/payment/'.$billing_id);
	}

	function update_payment($billing_id) {
		$this->checkout_model->update_payment($billing_id);
		//
		redirect('checkout/pay_transfer/'.$billing_id);
	}

	function delete_cart_customer_same($rowid = null) {
		$data = array('rowid' => $rowid,
	  				  'qty' =>0);
		$this->cart->update($data);
		redirect('checkout');
	}

	function delete_cart($rowid = null) {
		foreach ($rowid as $key => $value) {
			$data = array('rowid' => $rowid,
	  				  		'qty' =>0);
			$this->cart->update($data);	
		}
		//
		redirect('checkout');
	}

}