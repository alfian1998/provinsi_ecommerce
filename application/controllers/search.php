<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('region_model');
		$this->load->model('customer_model');
	}

	function ajax($id=null,$p=null,$o=null) {
		if($id == 'ses_kecamatan') {
			$ses_customer_id = $this->session->userdata('ses_customer_id');
			//session
			$ses_kabupaten = @$_SESSION['ses_kabupaten'];
			$ses_kecamatan = @$_SESSION['ses_kecamatan'];
			$ses_kelurahan = @$_SESSION['ses_kelurahan'];
			//
			$kabupaten = $this->input->get('ses_kabupaten');
			$kecamatan = $this->input->get('ses_kecamatan');
			//
			$list_kecamatan = $this->region_model->get_all_customer_kecamatan($kabupaten);
			//
			$html = '';
			$html .='<script type="text/javascript">
						$(function() {';

			$html .="$('#ses_search,#ses_kabupaten,#ses_kecamatan,#ses_kelurahan').bind('change',function() {
			            $('#form-search').attr('action','".site_url('search/search/'.$p.'/'.$o)."').submit();
			        });";

				if($ses_kecamatan != ''){
		    $html .="	ses_kelurahan('".$ses_kecamatan."','".$ses_kelurahan."');";
		    	}
			$html .=" 	$('#ses_kecamatan').bind('change',function(e) {
					        e.preventDefault();
					        var i = $(this).val();
					        ses_kelurahan(i);
					    }); ";
		    $html .=" 	function ses_kelurahan(i,k) {
					        $.get('".site_url('search/ajax/ses_kelurahan/'.$p.'/'.$o)."?ses_kecamatan='+i+'&ses_kelurahan='+k,null,function(data) {
					            $('#box_kelurahan').html(data.html);
					        },'json');
					    }";
			$html .='	});
					</script>';
			//
			$html.= '<select name="ses_kecamatan" id="ses_kecamatan" class="chosen-select" style="width: 96%;">';
			$html.= '<option value="">-- Semua Kecamatan --</option>';
			foreach($list_kecamatan as $kec) {
				if($ses_kecamatan == $kec['id_kec']) {
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
		}else if($id == 'ses_kelurahan') {
			$kecamatan = $this->input->get('ses_kecamatan');
			$kelurahan = $this->input->get('ses_kelurahan');
			//
			$list_kelurahan = $this->region_model->get_all_customer_kelurahan($kecamatan);
			//
			$html = '';

			$html .='<script type="text/javascript">
						$(function() {';
			$html .="$('#ses_search,#ses_kabupaten,#ses_kecamatan,#ses_kelurahan').bind('change',function() {
			            $('#form-search').attr('action','".site_url('search/search/'.$p.'/'.$o)."').submit();
			        });";
			$html .='	});
					</script>';

			$html.= '<select name="ses_kelurahan" id="ses_kelurahan" class="chosen-select" style="width: 96%;">';
			$html.= '<option value="">-- Semua Kelurahan --</option>';
			foreach($list_kelurahan as $kel) {
				if($kelurahan == $kel['id_kel']) {
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
		$data['config'] = $this->config_model->general();
		// session login
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_search'] = @$_SESSION['ses_search'];
		$data['ses_urutan'] = @$_SESSION['ses_urutan'];
		$data['ses_kabupaten'] = @$_SESSION['ses_kabupaten'];
		$data['ses_kecamatan'] = @$_SESSION['ses_kecamatan'];
		$data['ses_kelurahan'] = @$_SESSION['ses_kelurahan'];
		//
		if ($data['ses_search'] == '') {
			redirect('');
		}
		//
		$data['paging'] = $this->product_model->paging_product_search($p,$o);
		$data['list_product'] = $this->product_model->list_product_search($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_category'] = $this->category_model->list_category_rand();
		$data['list_kabupaten'] = $this->region_model->list_address_kabupaten();
		$data['cart'] = $this->cart->contents();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/search/index', $data);
		$this->load->view('public/main/footer');
	}	

	function search($p=1, $o=0) {
		$ses_search = $this->input->post('ses_search');		
		$ses_urutan = $this->input->post('ses_urutan');		
		$ses_kabupaten = $this->input->post('ses_kabupaten');		
		$ses_kecamatan = $this->input->post('ses_kecamatan');		
		$ses_kelurahan = $this->input->post('ses_kelurahan');		
		//
		$_SESSION['ses_search'] = ($ses_search != '') ? $ses_search : $_SESSION['ses_search'];
		$_SESSION['ses_urutan'] = ($ses_urutan != '') ? $ses_urutan : false;
		$_SESSION['ses_kabupaten'] = ($ses_kabupaten != '') ? $ses_kabupaten : false;
		$_SESSION['ses_kabupaten'] = ($ses_kabupaten != '') ? $ses_kabupaten : false;
		$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
		$_SESSION['ses_kelurahan'] = ($ses_kelurahan != '') ? $ses_kelurahan : false;
		//
		redirect('search/index/'.$p.'/'.$o);
	}	
}