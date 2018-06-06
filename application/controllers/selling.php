<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Selling extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		$this->load->model('product_model');
		$this->load->model('selling_model');
	}

	function ajax($id = null) {
		if($id == 'get_image') {
        	$config = $this->config_model->get_config();
        	//
        	$product_id  = $this->input->get('product_id');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($product_id != '' && $product_id != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_product($product_id);
        		$html = '';
        		$image_no = 1;
        		foreach($arr_image as $row) {
        			$html.= '<tr id="tr_image_'.$row['image_id'].'">
								<td valign="top" colspan="3">
									<table width="100%" class="table-no-border">
									<tr>
										<td valign="top">
											<div class="form-group">
												<label>Gambar '.$image_no.'</label>
												<div>
													<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image"><img class="img-thumbnail img-edit-product" src="'.base_url().$row['image_path'].$row['image_name'].'" style="border: 2px dotted blue;"></a>
													<div>
														<a class="btn btn-sm btn-primary btn-edit-product-img" href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank"><i class="fa fa-eye"></i> Lihat Gambar</a>
														<a href="javascript:void(0)" class="remove_image btn btn-sm btn-danger btn-edit-product-img" data-id="'.$row['image_id'].'"><i class="fa fa-times"></i> Hapus Gambar</a>
													</div>
												</div>
												<input type="file" class="form-control" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'">
												<span class="alert-product">* Isikan kolom diatas jika ingin mengganti Gambar</span>
												<input type="hidden" name="image_pos_'.$image_no.'" value="2">
												<input type="hidden" name="image_id_'.$image_no.'" value="'.$row['image_id'].'">
											</div>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<script>
							$(function() {
								var id = "image_source_'.$image_no.'";
								$("#"+id).bind("change",function() {
									var size = this.files[0].size;
									validate_image_size(size,"#"+id);
								});
							});
							</script>';
					$image_no++;
        		}        		
        		$image_no = $image_no-1;
        		//
        		$html.= '<script>
        					$(function() {
        						$(".remove_image").bind("click",function() {
        							$(this).each(function() {
        								var i = $(this).attr("data-id");
        								if(confirm("Apakah anda yakin akan menghapus gambar ini ?")) {
        									$.get("'.site_url("selling/delete_image").'/"+i,null,function(data) {
	        									if(data.result == "true") {
	        										//location.reload(true);
	        										$("#tr_image_"+i).remove();
	        									}
	        								},"json");
        								}        								
        							});
        						});
        					});
        				</script>';
        	} else {
        		$html = '<tr>
							<td valign="top" colspan="3">
								<div class="form-group" style="margin-bottom:-10px!important">
									<label>Gambar '.$image_no.'</label>';
							if($image_no == '1'){
				$html .='			<label style="color:red;" class="pull-right">*Gambar '.$image_no.' akan dijadikan Utama</label>';
								}
				$html .='			<input type="file" class="form-control" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'"><br>
									<input type="hidden" name="image_pos_'.$image_no.'" value="2">
								</div>
							</td>
						</tr>
						<script>
						$(function() {
							var id = "image_source_'.$image_no.'";
							$("#"+id).bind("change",function() {
								var size = this.files[0].size;
								validate_image_size(size,"#"+id);
							});
						});
						</script>
						';
        	}
        	//
			echo json_encode(array(
				'html' 		=> $html,
				'image_no' 	=> $image_no,
			));
        }else if($id == 'permalink') {
			$product_nm = $this->input->get('product_nm');
			$permalink = clean_url($product_nm);
			//
			echo json_encode(array(
				'permalink'	=> $permalink
			));
		}
	}

	function index($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_category'] = @$_SESSION['ses_category'];
		$data['ses_qty_unit'] = @$_SESSION['ses_qty_unit'];
		//
		$data['paging'] = $this->product_model->paging_product($p,$o);
		$data['list_product'] = $this->product_model->list_product($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_category'] = $this->selling_model->get_all_category();
		$data['list_qty_unit'] = $this->selling_model->get_all_qty_unit();
		//
		$data['count_on_sale'] = $this->product_model->count_on_sale();
		$data['count_draft'] = $this->product_model->count_draft();
		$data['count_not_sold'] = $this->product_model->count_not_sold();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/selling/index', $data);
		$this->load->view('public/main/footer');
	}	

	function draft($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_category'] = @$_SESSION['ses_category'];
		$data['ses_qty_unit'] = @$_SESSION['ses_qty_unit'];
		//
		$data['paging'] = $this->product_model->paging_product_draft($p,$o);
		$data['list_product_draft'] = $this->product_model->list_product_draft($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_category'] = $this->selling_model->get_all_category();
		$data['list_qty_unit'] = $this->selling_model->get_all_qty_unit();
		//
		$data['count_on_sale'] = $this->product_model->count_on_sale();
		$data['count_draft'] = $this->product_model->count_draft();
		$data['count_not_sold'] = $this->product_model->count_not_sold();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/selling/draft', $data);
		$this->load->view('public/main/footer');
	}	

	function not_sold($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_category'] = @$_SESSION['ses_category'];
		$data['ses_qty_unit'] = @$_SESSION['ses_qty_unit'];
		//
		$data['paging'] = $this->product_model->paging_product_not_sold($p,$o);
		$data['list_product_not_sold'] = $this->product_model->list_product_not_sold($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_category'] = $this->selling_model->get_all_category();
		$data['list_qty_unit'] = $this->selling_model->get_all_qty_unit();
		//
		$data['count_on_sale'] = $this->product_model->count_on_sale();
		$data['count_draft'] = $this->product_model->count_draft();
		$data['count_not_sold'] = $this->product_model->count_not_sold();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/selling/not_sold', $data);
		$this->load->view('public/main/footer');
	}	

	function form($p=1, $o=0, $product_id=null) {	
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($product_id != '') {
			$data['main'] = $this->product_model->get_data($product_id);
			$data['form_action'] = site_url('selling/update/'.$p.'/'.$o.'/'.$product_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('selling/insert');
		}
		//
		$data['list_category'] = $this->selling_model->get_all_category();
		$data['list_parameter'] = $this->selling_model->get_parameter();
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('customer/selling/form', $data);
		$this->load->view('public/main/footer');
	}

	function insert() {
		$this->selling_model->insert();
		redirect('web/location/selling');
	}

	function update($p, $o, $product_id) {
		$this->selling_model->update($product_id);
		redirect('selling');
	}

	function delete($p, $o, $product_id) {
		$this->selling_model->delete($product_id);
		redirect('selling');
	}

	function delete_image($image_id) {
		$process = $this->image_model->delete($image_id);
		if($process) {
			$result = 'true';
		} else {
			$result = 'false';
		}
		//
		echo json_encode(array(
			'result' => $result
		));
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_category = $this->input->post('ses_category');		
		$ses_qty_unit = $this->input->post('ses_qty_unit');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_category'] = ($ses_category != '') ? $ses_category : false;
		$_SESSION['ses_qty_unit'] = ($ses_qty_unit != '') ? $ses_qty_unit : false;
		//
		redirect('selling/index');
	}

	function search_draft() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_category = $this->input->post('ses_category');		
		$ses_qty_unit = $this->input->post('ses_qty_unit');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_category'] = ($ses_category != '') ? $ses_category : false;
		$_SESSION['ses_qty_unit'] = ($ses_qty_unit != '') ? $ses_qty_unit : false;
		//
		redirect('selling/draft');
	}

	function search_not_sold() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_category = $this->input->post('ses_category');		
		$ses_qty_unit = $this->input->post('ses_qty_unit');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_category'] = ($ses_category != '') ? $ses_category : false;
		$_SESSION['ses_qty_unit'] = ($ses_qty_unit != '') ? $ses_qty_unit : false;
		//
		redirect('selling/not_sold');
	}
}