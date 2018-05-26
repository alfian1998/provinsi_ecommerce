<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Data extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('produk_model');
	}

	function ajax($id = null) {
		if($id == 'get_image') {
        	$config = $this->config_model->get_config();
        	//
        	$id_produk  = $this->input->get('id_produk');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($id_produk != '' && $id_produk != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_product($id_produk);
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
        									$.get("'.site_url("webmin_data/delete_image").'/"+i,null,function(data) {
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
        }
	}

	function index($p=1, $o=0) {
		$data['p'] = $p;
		$data['o'] = $o;	
		//
		$data['paging'] = $this->produk_model->paging_data($p,$o);
		$data['list_data'] = $this->produk_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/data/index', $data);
		$this->load->view('webmin/main/footer');
	}	

	function form($p=1, $o=0, $id_produk=null) {	
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id_produk != '') {
			$data['main'] = $this->produk_model->get_data($id_produk);
			$data['form_action'] = site_url('webmin_data/update/'.$p.'/'.$o.'/'.$id_produk);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_data/insert');
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/data/form', $data);
		$this->load->view('webmin/main/footer');
	}

	function insert() {
		$this->input_model->insert();
		redirect('webmin_data');
	}

	function update($p, $o, $id_produk) {
		$this->input_model->update($id_produk);
		redirect('webmin_data');
	}

	function delete($p, $o, $id_produk) {
		$this->input_model->delete($id_produk);
		redirect('webmin_data');
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
}