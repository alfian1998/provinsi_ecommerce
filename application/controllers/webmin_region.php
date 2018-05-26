<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Region extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
        $this->load->model('region_model');
	}

	function ajax($id=null) {
		if($id == 'validate_prov_by_id') {
			$id_prov = $this->input->get('id_prov');
			$validate = $this->region_model->validate_prov_by_id($id_prov);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_prov_by_nama') {
			$nama = $this->input->get('nama');
			$validate = $this->region_model->validate_prov_by_nama($nama);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_kab_by_id') {
			$id_kab = $this->input->get('id_kab');
			$id_prov = $this->input->get('id_prov');
			$validate = $this->region_model->validate_kab_by_id($id_kab, $id_prov);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_kab_by_nama') {
			$nama = $this->input->get('nama');
			$id_prov = $this->input->get('id_prov');
			$validate = $this->region_model->validate_kab_by_nama($nama, $id_prov);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_kec_by_id') {
			$id_kec = $this->input->get('id_kec');
			$id_kab = $this->input->get('id_kab');
			$validate = $this->region_model->validate_kec_by_id($id_kec, $id_kab);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_kec_by_nama') {
			$nama = $this->input->get('nama');
			$id_kab = $this->input->get('id_kab');
			$validate = $this->region_model->validate_kec_by_nama($nama, $id_kab);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_kel_by_id') {
			$id_kel = $this->input->get('id_kel');
			$id_kec = $this->input->get('id_kec');
			$validate = $this->region_model->validate_kel_by_id($id_kel, $id_kec);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}else if($id == 'validate_kel_by_nama') {
			$nama = $this->input->get('nama');
			$id_kec = $this->input->get('id_kec');
			$validate = $this->region_model->validate_kel_by_nama($nama, $id_kec);
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
		$data['ses_txt_search_provinsi'] = @$_SESSION['ses_txt_search_provinsi'];
		//
		$data['paging'] = $this->region_model->paging_provinsi($p,$o);
		$data['list_provinsi'] = $this->region_model->list_provinsi($o, $data['paging']->offset, $data['paging']->per_page);
		$data['count_provinsi'] = $this->region_model->count_provinsi();
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/index_provinsi', $data);
		$this->load->view('webmin/main/footer');
	}

	function form_provinsi($p=1, $o=0, $id_prov=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id_prov != '') {
			$data['main'] = $this->region_model->get_provinsi($id_prov);
			$data['form_action'] = site_url('webmin_region/update_prov/'.$p.'/'.$o.'/'.$id_prov);
		} else {
			$data['main'] = null;
			$data['form_action'] = site_url('webmin_region/insert_prov');
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/form_provinsi', $data);
		$this->load->view('webmin/main/footer');
	}

	function kabupaten($p=1, $o=0, $id_prov=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search_kabupaten'] = @$_SESSION['ses_txt_search_kabupaten'];
		//
		$data['paging'] = $this->region_model->paging_kabupaten($p,$o,$id_prov);
		$data['list_kabupaten'] = $this->region_model->list_kabupaten($o, $data['paging']->offset, $data['paging']->per_page, $id_prov);
		$data['get_provinsi'] = $this->region_model->get_provinsi($id_prov);
		$data['count_kabupaten'] = $this->region_model->count_kabupaten($id_prov);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/index_kabupaten', $data);
		$this->load->view('webmin/main/footer');
	}

	function form_kabupaten($p=1, $o=0, $id_prov=null, $id_kab=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['id_prov'] = $id_prov;
		$data['id_kab'] = $id_kab;
		//
		if($id_kab != '') {
			$data['main'] = $this->region_model->get_kabupaten($id_kab);
			$data['form_action'] = site_url('webmin_region/update_kab/'.$p.'/'.$o.'/'.$id_kab.'/'.$id_prov);
		} else {
			$data['main'] = null;
			$data['form_action'] = site_url('webmin_region/insert_kab/'.$p.'/'.$o.'/'.$id_prov);
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/form_kabupaten', $data);
		$this->load->view('webmin/main/footer');
	}

	function kecamatan($p=1, $o=0, $id_prov=null, $id_kab=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search_kecamatan'] = @$_SESSION['ses_txt_search_kecamatan'];
		//
		$data['paging'] = $this->region_model->paging_kecamatan($p,$o,$id_kab);
		$data['list_kecamatan'] = $this->region_model->list_kecamatan($o, $data['paging']->offset, $data['paging']->per_page, $id_kab);
		$data['get_provinsi'] = $this->region_model->get_provinsi($id_prov);
		$data['get_kabupaten'] = $this->region_model->get_kabupaten($id_kab);
		$data['count_kecamatan'] = $this->region_model->count_kecamatan($id_kab);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/index_kecamatan', $data);
		$this->load->view('webmin/main/footer');
	}

	function form_kecamatan($p=1, $o=0, $id_prov=null, $id_kab=null, $id_kec=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['id_prov'] = $id_prov;
		$data['id_kab'] = $id_kab;
		$data['id_kec'] = $id_kec;
		//
		if($id_kec != '') {
			$data['main'] = $this->region_model->get_kecamatan($id_kec);
			$data['form_action'] = site_url('webmin_region/update_kec/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec);
		} else {
			$data['main'] = null;
			$data['form_action'] = site_url('webmin_region/insert_kec/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab);
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/form_kecamatan', $data);
		$this->load->view('webmin/main/footer');
	}

	function kelurahan($p=1, $o=0, $id_prov=null, $id_kab=null, $id_kec=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['id_prov'] = $id_prov;
		$data['id_kab'] = $id_kab;
		$data['id_kec'] = $id_kec;
		$data['ses_txt_search_kelurahan'] = @$_SESSION['ses_txt_search_kelurahan'];
		//
		$data['paging'] = $this->region_model->paging_kelurahan($p,$o,$id_kec);
		$data['list_kelurahan'] = $this->region_model->list_kelurahan($o, $data['paging']->offset, $data['paging']->per_page, $id_kec);
		$data['get_provinsi'] = $this->region_model->get_provinsi($id_prov);
		$data['get_kabupaten'] = $this->region_model->get_kabupaten($id_kab);
		$data['get_kecamatan'] = $this->region_model->get_kecamatan($id_kec);
		$data['count_kelurahan'] = $this->region_model->count_kelurahan($id_kec);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/index_kelurahan', $data);
		$this->load->view('webmin/main/footer');
	}

	function form_kelurahan($p=1, $o=0, $id_prov=null, $id_kab=null, $id_kec=null, $id_kel=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['id_prov'] = $id_prov;
		$data['id_kab'] = $id_kab;
		$data['id_kec'] = $id_kec;
		//
		if($id_kel != '') {
			$data['main'] = $this->region_model->get_kelurahan($id_kel);
			$data['form_action'] = site_url('webmin_region/update_kel/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec.'/'.$id_kel);
		} else {
			$data['main'] = null;
			$data['form_action'] = site_url('webmin_region/insert_kel/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec);
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/region/form_kelurahan', $data);
		$this->load->view('webmin/main/footer');
	}
	
	// Provinsi
	function search_provinsi() {
		$ses_txt_search_provinsi = $this->input->post('ses_txt_search_provinsi');		
		$_SESSION['ses_txt_search_provinsi'] = ($ses_txt_search_provinsi != '') ? $ses_txt_search_provinsi : false;
		//
		redirect('webmin_region/index');
	}

	// Kabupaten
	function search_kabupaten($p=1, $o=0, $id_prov=null) {
		$ses_txt_search_kabupaten = $this->input->post('ses_txt_search_kabupaten');		
		$_SESSION['ses_txt_search_kabupaten'] = ($ses_txt_search_kabupaten != '') ? $ses_txt_search_kabupaten : false;
		//
		redirect('webmin_region/kabupaten/'.$p.'/'.$o.'/'.$id_prov);
	}

	// Kecamatan
	function search_kecamatan($p=1, $o=0, $id_prov=null, $id_kab=null) {
		$ses_txt_search_kecamatan = $this->input->post('ses_txt_search_kecamatan');		
		$_SESSION['ses_txt_search_kecamatan'] = ($ses_txt_search_kecamatan != '') ? $ses_txt_search_kecamatan : false;
		//
		redirect('webmin_region/kecamatan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab);
	}

	// Kelurahan
	function search_kelurahan($p=1, $o=0, $id_prov=null, $id_kab=null, $id_kec=null) {
		$ses_txt_search_kelurahan = $this->input->post('ses_txt_search_kelurahan');		
		$_SESSION['ses_txt_search_kelurahan'] = ($ses_txt_search_kelurahan != '') ? $ses_txt_search_kelurahan : false;
		//
		redirect('webmin_region/kelurahan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec);
	}

	// Provinsi
	function insert_prov() {
		$this->region_model->insert_prov();
		redirect('webmin_region/kabupaten');
	}

	function update_prov($p, $o, $id_prov) {
		$this->region_model->update_prov($id_prov);
		redirect('webmin_region/index');
	}

	function delete_prov($p, $o, $id_prov) {
		$this->region_model->delete_prov($id_prov);
		redirect('webmin_region/index');
	}

	// Kabupaten
	function insert_kab($p, $o, $id_prov) {
		$this->region_model->insert_kab();
		redirect('webmin_region/kabupaten/'.$p.'/'.$o.'/'.$id_prov);
	}

	function update_kab($p, $o, $id_kab, $id_prov) {
		$this->region_model->update_kab($id_kab);
		redirect('webmin_region/kabupaten/'.$p.'/'.$o.'/'.$id_prov);
	}

	function delete_kab($p, $o, $id_prov, $id_kab) {
		$this->region_model->delete_kab($id_kab);
		redirect('webmin_region/kabupaten/'.$p.'/'.$o.'/'.$id_prov);
	}

	// Kecamatan
	function insert_kec($p, $o, $id_prov, $id_kab) {
		$this->region_model->insert_kec();
		redirect('webmin_region/kecamatan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab);
	}

	function update_kec($p, $o, $id_prov, $id_kab, $id_kec) {
		$this->region_model->update_kec($id_kec);
		redirect('webmin_region/kecamatan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab);
	}

	function delete_kec($p, $o, $id_prov, $id_kab, $id_kec) {
		$this->region_model->delete_kec($id_kec);
		redirect('webmin_region/kecamatan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab);
	}

	// Kelurahan
	function insert_kel($p, $o, $id_prov, $id_kab, $id_kec) {
		$this->region_model->insert_kel();
		redirect('webmin_region/kelurahan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec);
	}

	function update_kel($p, $o, $id_prov, $id_kab, $id_kec, $id_kel) {
		$this->region_model->update_kel($id_kel);
		redirect('webmin_region/kelurahan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec);
	}

	function delete_kel($p, $o, $id_prov, $id_kab, $id_kec, $id_kel) {
		$this->region_model->delete_kel($id_kel);
		redirect('webmin_region/kelurahan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec);
	}

	// Kabupaten
	function location_kab($p=1, $o=0, $id_prov=null) {
		unset_session('ses_txt_search_kabupaten');
		//
		redirect('webmin_region/kabupaten/'.$p.'/'.$o.'/'.$id_prov);
	}

	// Kecamatan
	function location_kec($p=1, $o=0, $id_prov=null, $id_kab=null) {
		unset_session('ses_txt_search_kecamatan');
		//
		redirect('webmin_region/kecamatan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab);
	}

	// Kelurahan
	function location_kel($p=1, $o=0, $id_prov=null, $id_kab=null, $id_kec=null) {
		unset_session('ses_txt_search_kelurahan');
		//
		redirect('webmin_region/kelurahan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec);
	}
}