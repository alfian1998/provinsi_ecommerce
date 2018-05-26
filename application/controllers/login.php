<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
	}

	function index() {	
		$session_login = $this->session->userdata('ses_login');
		if($session_login == '1'){
			redirect('');
		}
		$data['config'] = $this->config_model->general();
		//
		$data['cart'] = $this->cart->contents();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/login/index', $data);
		$this->load->view('public/main/footer');
	}	

	function ajax($id = null) {
		// authentikasi login
		if($id == 'auth_login') {
			$t_akun = $this->input->post('t_akun');
			$t_password = anti_injection($this->input->post('t_password'));
			//
			if($t_akun != '' && $t_password != '') {
				$validate = $this->config_model->auth_login($t_akun, $t_password);
				//
				if($validate == '1') {
					echo json_encode(array(
						'result' 	=> 'true', 
						'redirect' 	=> site_url('')
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
		}
	}

	function reg_login($username = null, $password = null) {
		$r_username = $username;
		$r_password = $password;
		//
		if($r_username != '' && $r_password != '') {
			$validate = $this->config_model->reg_login($r_username, $r_password);
			//
			if($validate == '1') {
				// echo json_encode(array(
				// 	'result' 	=> 'true', 
				// 	'redirect' 	=> site_url('')
				// ));
				redirect('');
			} elseif($validate == '2') {
				echo json_encode(array(
					'result' 	=> 'false', 
					'message' 	=> '<i></i>Maaf, Email ini tidak aktif !', 
				));
			} else {
				echo json_encode(array(
					'result' 	=> 'false', 
					'message' 	=> '<i class="fa fa-times"></i> Maaf, Email atau password anda salah !', 
				));
			}		
		} else {
			redirect('');
		}
	}

	function logout() {
		//$this->config_model->set_logoff();
		//
		$ses_data = array(
			'ses_login'                => false,
            'ses_customer_id'          => false,
            'ses_customer_nm'          => false,
            'ses_customer_chat_nm'     => false,
            'ses_customer_address'     => false,
            'ses_customer_phone'       => false,
            'ses_customer_email'       => false,
            'ses_customer_username'    => false,
            'ses_customer_sex'         => false,
            'ses_customer_st'          => false,
            'ses_customer_img'         => false,
            'ses_register_date'        => false
		);       
        $this->session->unset_userdata($ses_data);
        // $this->session->sess_destroy();
        // redirect('');
        header('Location: ../chat/remove_chat.php');
	}
}