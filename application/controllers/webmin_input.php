<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Input extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
	}

	function index() {	
		$data['cart'] = $this->cart->contents();
		$data['form_action'] = site_url('webmin_input/insert/');
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/input/index', $data);
		$this->load->view('webmin/main/footer');
	}	

	function insert() {
		$this->input_model->insert();
		redirect('webmin_input');
	}

	function ajax($id = null) {
		if($id == 'get_image') {
        	$config = $this->config_model->get_config();
        	//
        	$id_produk  = $this->input->get('id_produk');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($id_produk != '' && $id_produk != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_post($id_produk);
        		$html = '';
        		$image_no = 1;
        		foreach($arr_image as $row) {
        			$html.= '<tr id="tr_image_'.$row['image_id'].'">
								<td valign="top"><div class="span12">Gambar '.$image_no.'<br><span class="news-em">112</span></div></td>
								<td valign="top" colspan="2">
									<table width="100%">
									<tr>
										<td valign="top">
											<div class="span12" style="margin-bottom:10px!important">
												<input type="file" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'">
												<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank">View Image</a> | 
												<a href="javascript:void(0)" class="remove_image" data-id="'.$row['image_id'].'">Remove Image</a>
												<br>
												Deskripsi : <input type="text" name="image_description_'.$image_no.'" value="'.$row['image_description'].'" class="span8" placeholder="Masukan deskripsi gambar disini ...">
												<input type="hidden" name="image_pos_'.$image_no.'" value="2">									
												<input type="hidden" name="image_id_'.$image_no.'" value="'.$row['image_id'].'">
											</div>
										</td>
										<td>
											<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image"><img src="'.base_url().$row['image_path'].$row['image_name'].'" width="100px"></a>
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
        									$.get("'.site_url("webmin_input/delete_image").'/"+i,null,function(data) {
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
							<td valign="top"><div class="span12">Gambar '.$image_no.'<br><span class="news-em">112</span></div></td>
							<td valign="top" colspan="2">
								<div class="span12" style="margin-bottom:10px!important">
									<input type="file" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'"><br>
									Deskripsi : <input type="text" name="image_description_'.$image_no.'" class="span10" placeholder="Masukan deskripsi gambar disini ...">
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
}