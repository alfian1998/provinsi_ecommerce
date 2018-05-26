<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_slideshow extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('slideshow_model');
	}

	function ajax($id=null) {
		if($id == 'get_image') {
        	$slideshow_id  = $this->input->get('slideshow_id');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($slideshow_id != '' && $slideshow_id != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_slideshow($slideshow_id);
        		$html = '';
        		$image_no = 1;
        		foreach($arr_image as $row) {
        			$selected_1 = $selected_2 = '';
        			if($row['image_pos'] == '1') $selected_1 = 'selected';
        			if($row['image_pos'] == '2') $selected_2 = 'selected';
        			//
        			$html.= '<tr id="tr_image_'.$row['image_id'].'">
								<td valign="top"><div class="span12"><br><b>Gambar '.$image_no.'</b></div></td>
								<td valign="top">
									<table width="100%" class="table-no-border">
									<tr>
										<td valign="top">
											<div class="span12">
												<input type="file" name="image_source_'.$image_no.'" class="form-control span6" style="margin-bottom: 5px;">
												<a class="btn btn-xs btn-primary" href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image"><i class="fa fa-eye"></i> View Image</a> | 
												<a class="btn btn-xs btn-danger remove_image" href="javascript:void(0)" data-id="'.$row['image_id'].'"><i class="fa fa-times"></i> Remove Image</a>
												<br>										
												<table class="table-no-border" style="margin-top: 10px;">
													<tr>
														<td width="12%"><b>Judul</b></td>
														<td><b>:</b></td>
														<td><input class="form-control span7" type="text" name="image_title_'.$image_no.'" value="'.$row['image_title'].'" class="span10" placeholder="Masukan deskripsi gambar disini ..."></td>
													</tr>
													<tr>
														<td><b>Deskripsi</b></td>
														<td><b>:</b></td>
														<td>
															<textarea class="form-control span11" placeholder="Masukan deskripsi gambar disini ..." name="image_description_'.$image_no.'">'.$row['image_description'].'</textarea>
														</td>
													</tr>
												</table>
												<input type="hidden" name="image_id_'.$image_no.'" value="'.$row['image_id'].'">
											</div>
										</td>
										<td>
											<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image"><img src="'.base_url().$row['image_path'].$row['image_name'].'" width="120px" class="img-thumbnail"></a>
										</td>
									</tr>
									</table>
								</td>
							</tr>';
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
        									$.get("'.site_url("webmin_slideshow/delete_image").'/"+i,null,function(data) {
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
							<td valign="top"><div class="span12"><b><br>Gambar '.$image_no.'</b></div></td>
							<td valign="top">
								<div class="span12">
									<input type="file" name="image_source_'.$image_no.'" class="form-control span5">
									<table class="table-no-border" style="margin-top: 10px;">
										<tr>
											<td width="12%"><b>Judul</b></td>
											<td><b>:</b></td>
											<td><input type="text" name="image_title_'.$image_no.'" class="form-control span6" placeholder="Masukan judul gambar disini ..."></td>
										</tr>
										<tr>
											<td><b>Deskripsi</b></td>
											<td><b>:</b></td>
											<td>
												<textarea class="form-control" name="image_description_'.$image_no.'" placeholde="Masukkan deskripsi gambar disini ..."></textarea>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>';
        	}
        	//
			echo json_encode(array(
				'html' => $html,
				'image_no' => $image_no,
			));
        }
	}	
	
	function index($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->slideshow_model->paging_slideshow($p,$o);
		$data['list_slideshow'] = $this->slideshow_model->list_slideshow($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/slideshow/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->slideshow_model->get_slideshow($id);
			$data['form_action'] = site_url('webmin_slideshow/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_slideshow/insert');
		}
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/slideshow/form', $data);
		$this->load->view('webmin/main/footer');
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
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_slideshow/index');
	}

	function insert() {
		$this->slideshow_model->insert();
		redirect('webmin/location/slideshow');
	}

	function update($p, $o, $id) {
		$this->slideshow_model->update($id);
		redirect('webmin/location/slideshow');
	}

	function delete($p, $o, $id) {
		$this->slideshow_model->delete($id);
		redirect('webmin/location/slideshow');
	}
	
}