<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_buyer_data extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login_administrator();
		//
		$this->load->model('checkout_model');
	}

	function buyer($p=1, $o=0) {
		//get data
		$status = $this->input->get('status');
		$bulan = $this->input->get('bulan');
		$search = $this->input->get('search');
		//
		$paging = $this->checkout_model->paging_buyer($p,$o,$status,$bulan,$search);
		$list_buyer = $this->checkout_model->get_buyer($o, $paging->offset, $paging->per_page,$status,$bulan,$search);
		//
		$html = '';
			foreach ($list_buyer as $data){
			$check_bayar_customer_st = $this->checkout_model->check_bayar_customer_st($data['billing_id']);
		$html.= '<tr>
                    <td align="center" class="info"><b>'.$data['no'].'</b></td>';
        $html.='	<td align="center" class="info">';
        $html.='		<a href="'.site_url('webmin_buyer_data/detail/'.$p.'/'.$o.'/'.$data['billing_id']).'" class="btn btn-xs btn-primary" title="Detail Data"><b>DETAIL DATA</b></a>
        			</td>';
        		if ($data['customer_id'] !='') {
		$html.='    <td class="info"><div style="font-weight: bold; color: blue;">'.$data['customer_nm'].'</div></td>';
                }else{
        $html.='    <td class="info"><div style="font-weight: bold; color: blue;">'.$data['pembeli_nm'].'</div></td>';
				}
        $html.='	<td align="center" class="info"><label class="label label-success" style="font-size: 13px;">'.$data['billing_id'].'</label></td>';
        $html.='	<td class="info"><label class="label label-primary" style="font-size: 12px;">Rp '.digit($data['product_total_price']).'</label></td>';

        if ($check_bayar_customer_st['bayar_customer_st'] == '1') {
        $html.=' 	<td rowspan="2">
        				<label class="label label-success" style="font-size: 12px;"><i class="fa fa-check"></i> Transaksi Selesai</label>
        			';
        }elseif ($check_bayar_customer_st['bayar_customer_st'] == '2'){

        if ($data['diterima_st'] == '1') {
        $html.=' 	<td rowspan="2">
        				<label class="label label-primary" style="font-size: 12px;">Sudah Diterima Pembeli</label>
        				<label class="label label-danger faa-flash animated" style="font-size: 12px;">Anda harus Transfer ke penjual</label><br><br>
        				<ul style="margin-left: -20px;">
        					<li style="color: red; font-weight: bold;">Anda harus segera Transfer ke Rekening Penjual, Jika Anda sudah Transfer ke penjual segera Konfirmasi bahwa Anda sudah Transfer.</li>
        					<li style="color: red; font-weight: bold;">Klik tombol <u>Konfirmasi Sudah Transfer</u> disamping kiri untuk Konfirmasi.</li>
        				</ul>
        			';
        }else{
        	if ($data['transfer_st'] == '2') {
        $html.='<td rowspan="2">';
		$html.=' 	<label class="label label-primary" style="font-size: 12px;">Menunggu Konfirmasi Admin</label><br><br>';
		$html.='	<div>
						<a href="'.site_url('assets/images/transfer_pembeli/'.$data['transfer_img']).'" target="_blank">
                        <img src="'.base_url().'assets/images/transfer_pembeli/'.$data['transfer_img'].'" style="width: 200px; height: 250px; float: left; margin-right: 22px;" class="img-thumbnail">
                        <ul>
                        	<li style="color: red; font-weight: bold;">Gambar Bukti Transfer Pembeli</li>
                        	<li style="color: red; font-weight: bold;">Klik Gambar untuk memperbesar</li>
                        	<li style="color: red; font-weight: bold;">Silahkan Cek Rekening Anda dahulu apakah transfer sudah masuk</li>
                        	<li style="color: red; font-weight: bold;">Jika sudah silahkan Klik tombol <u>Konfirmasi</u> dibawah</li>
                        </ul>
                        </a>
                        <div style="padding-top: 10px;">
                        	<button data-toggle="modal" data-target="#konfirmasi-'.$data['billing_id'].'" class="btn btn-primary btn-sm bold btn-block"><i class="fa fa-send"></i> Konfirmasi</button>
                        </div>
					</div>';
			}else {
		$html.='<td class="info">';
        		if ($data['bayar_st'] == '1') {
        $html.=' 	<label class="label label-success" style="font-size: 12px;">Sudah Bayar</label>';
                }elseif ($data['bayar_st'] == '2') {
        $html.=' 	<label class="label label-warning" style="font-size: 12px;">Belum Bayar</label>';
                }
            }
        $check_kirim_st = $this->checkout_model->check_kirim_st($data['billing_id']);
                if ($check_kirim_st == '') {
        $html.=' 	<label class="label label-success" style="font-size: 12px;">Sudah DiKirim Semua</label>';
                }elseif ($check_kirim_st != '') {
                	if ($data['bayar_st'] == '1') {
        $html.=' 	<label class="label label-danger" style="font-size: 12px;">Belum Dikirim Semua</label>';
        			}
                }
        }
    	}
        $html.='</td></tr>';

        $check_kirim_st = $this->checkout_model->check_kirim_st();
        $list_seller = $this->checkout_model->list_seller_by_billing_id($data['billing_id']);

        // Data Product
        $html.='<tr>
        			<td></td>
        			<td colspan="4">';
        	foreach ($list_seller as $seller) {
        $html.='		<div class="panel panel-default">
							<div class="panel-heading">
								<img src="'.base_url().'/assets/images/customer/'.$seller['customer_img'].'" class="img-circle img-customer-checkout"> <b>'.$seller['customer_nm'].'</b>';
						if ($data['diterima_st'] == '1') {
							if ($seller['bayar_customer_st'] == '1') {
		$html.='				<label class="pull-right label label-success label-heading"><b><i class="fa fa-check"></i> Konfirmasi Berhasil</b></label>';
							}else{
		$html.='				<button data-toggle="modal" data-target="#modal-'.$seller['billing_id'].'-'.$seller['customer_id'].'" class="btn btn-success btn-sm bold pull-right"><i class="fa fa-send"></i> Konfirmasi Sudah Transfer</button>'; 
							}
						}
		$html.='			</div>
							<div class="panel-body">';
						if ($data['diterima_st'] == '1') {
							if ($seller['bayar_customer_st'] == '1') {
		$html.='				<div class="alert alert-green alert-small" style="padding-bottom: 4px; padding-top: 4px;"><i class="fa fa-check"></i> Anda sudah Transfer ke Penjual ('.$seller['customer_nm'].')</div>';
							}else{
		$html.='				<div class="alert alert-red alert-small" style="padding-bottom: 4px;"><i class="fa fa-warning"></i> Anda harus Transfer ke Penjual ('.$seller['customer_nm'].') sebesar <u style="font-size: 16px;">Rp '.digit($seller['jumlah_harga']).'</u></div>';
							}
						}
		$html.='				<table class="table table-bordered">
								    <thead>
								      <tr>
								        <th class="text-center">No</th>
								        <th>Nama Produk</th>
								        <th class="text-center">Jumlah</th>
								        <th class="text-center">Nominal Per Produk</th>
								      </tr>
								    </thead>
								    <tbody>';
									$list_product = $this->checkout_model->list_checkout_by_customer_id($seller['billing_id'], $seller['customer_id']);
									foreach ($list_product as $product) {
		$html.='					  <tr>
								        <td align="center"><b>'.$product['no'].'</b></td>
								        <td>'.$product['product_nm'].'</td>
								        <td align="center">'.$product['product_qty'].' '.$product['product_qty_unit'].'</td>
								        <td align="center"><div class="nominal-product">Rp '.digit($product['product_price']).' x '.$product['product_qty'].' '.$product['product_qty_unit'].' = <u>Rp '.digit($product['product_sub_price']).'</u></div></td>
								      </tr>';
									}
		$html.='					</tbody>
								</table>';
							if ($data['diterima_st'] == '1' && $check_bayar_customer_st['bayar_customer_st'] == '2') {
		$html.='				<div class="bold" style="padding-bottom: 5px;">Data Rekening Bank ('.$seller['customer_nm'].')</div>
								<div class="col-md-5 row">
                                    <div class="panel-content">
                                        <div class="panel panel-default header-panel-bank-rek" style="border: 2px solid blue;">
                                            <div class="panel-body">';
                                            if ($seller['bank_id'] !='') {
		$html.='								<div class="bold" style="color: blue;">'.$seller['bank_nm'].' ';
                                                ($seller['bank_short_nm'] !='') ? $html.='('.$seller['bank_short_nm'].')' : $html.='';
		$html.='								</div>
                                                <div>'.$seller['bank_owner'].'</div>
                                                <div class="bold" id="no-rek-'.$seller['customer_id'].'" style="color: green;">'.$seller['bank_no_rek'].'</div>
                                                <a class="copy-clipboard" onclick="';$html.="copyToClipboard('#no-rek-".$seller['customer_id']."')";$html.='">Salin No. Rekening</a>';
                                            }else{
        $html.='								<div class="bold" style="color: red;">Data Bank belum diatur Penjual</div>';
                                            }
		$html.='							</div>
                                        </div>
                                    </div>  
                                </div>';
                            }
		$html.='			</div>
						</div>';

		// Modal
		$html.='	
				<div class="modal fade" id="modal-'.$seller['billing_id'].'-'.$seller['customer_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <form action="'.site_url('webmin_buyer_data/update_buyer_customer_st/'.$seller['billing_id'].'/'.$seller['customer_id']).'" method="post" enctype="multipart/form-data" id="form-validate">  
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Konfimasi bila Anda sudah Transfer ke Rekening Penjual</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				            <label>Konfirmasi ke Penjual : '.$seller['customer_nm'].'</label>
				            <select class="span3" name="bayar_customer_st" required>
				            	<option value="">-- Pilih Status --</option>
				                <option value="1">Sudah Transfer</option>
				            </select>
				            <span class="alert-product">* Silahkan pilih <u>Sudah Transfer</u> apabila Anda sudah Transfer ke Rekening Penjual</span>
				        </div>
				        <div class="form-group">
				            <label>Bukti Transfer</label>
				            <input type="file" class="form-control span6" name="bayar_customer_img" required>
				            <span class="alert-product">* Silahkan upload bukti Transfer</span>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				';

		$html.='<script>
				function copyToClipboard(element) {
				  var $temp = $("<input>");
				  $("body").append($temp);
				  $temp.val($(element).text()).select();
				  document.execCommand("copy");
				  //alert
				  swal({
				      text: "Berhasil di Copy : " + $temp.val(),
				      icon: "success",
				      timer: 1000
				  });
				  $temp.remove();
				}
				</script>';
			}

		$html.='	
				<div class="modal fade" id="konfirmasi-'.$data['billing_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <form action="'.site_url('webmin_buyer_data/update_bayar_st/'.$data['billing_id']).'" method="post" enctype="multipart/form-data" id="form-validate">  
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Konfirmasi Sudah Bayar ('.$data['billing_id'].')</h4>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				            <label>Konfirmasi Status : </label>
				            <select class="chosen-select span3" name="bayar_st">
				                <option value="2">Belum Bayar</option>
				                <option value="1">Sudah Bayar</option>
				            </select>
				            <span class="alert-product">* Silahkan pilih <u>Sudah Bayar</u> apabila Uang sudah masuk ke Rekening Anda</span>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Simpan</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				';

        $html.='	</td>
        		</tr>';

            }
            if (count($list_buyer) == 0) {
        $html.='<tr>
        			<td colspan="6">Tidak ada data</td>
        		</tr>';
            }

            if(count($list_buyer) > 0){
        $html.='<tr>
	        		<td colspan="6" align="center" style="background-color: white;">
		        		<ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">';
	               	if($paging->start_link){
		$html.='	        <li><a href="'.site_url("webmin_buyer_data/buyer/$paging->c_start_link/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-double-left"></i></span></a></li>';
	                }
	                if($paging->prev){
	    $html.='            <li><a href="'.site_url("webmin_buyer_data/buyer/$paging->prev/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-left"></i></span></a></li>';
	                }

	                for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++){
	                	if ($p == $i) {
	    $html.='			<li class="active">';
	                	}else{
	    $html.='			<li>';
	                	}
	    $html.='				<a href="'.site_url("webmin_buyer_data/buyer/$i/$o").'?status='.$status.'&search='.$search.'" class="link_pagination">'.$i.'</a>
	    					</li>';
	                        }

	                if($paging->next){
	    $html.='            <li><a href="'.site_url("webmin_buyer_data/buyer/$paging->next/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-right"></i></span></a></li>';
	                        }
	                        
	                if($paging->end_link){
	    $html.='            <li><a href="'.site_url("webmin_buyer_data/buyer/$paging->c_end_link/$o").'?status='.$status.'&search='.$search.'" class="link_pagination"><span><i class="fa fa-angle-double-right"></i></span></a></li>';
	                        }
	    $html.='		</ul>
	                </td>
                </tr>
        		';
        		}
        $html.="<script>
					$(function() {
						$('.link_pagination').bind('click',function(e) {
						    e.preventDefault();
						    $(this).each(function() {
						    	var i = $(this).attr('href');
						    	$.get(i,null,function(data) {
						    		$('#box_result').html(data.html); 
						    	}, 'json');
						    })
						});;
					});
				</script>";

		//Data Jumlah Pembeli
		$count_buyer = $this->checkout_model->count_buyer($status,$bulan,$search);
		//
		$count = "";
		$count .= $count_buyer." Orang";
		//
		echo json_encode(array(
			'html' => $html,
			'count' => $count
		));
	}
	
	function index($p=1, $o=0) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');		
		$this->load->view('webmin/buyer_data/index', $data);
		$this->load->view('webmin/main/footer');
	}

	function detail($p=1, $o=0, $billing_id=null) {	
		$data['config'] = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->checkout_model->get_checkout($billing_id,'null');
		$data['list_seller'] = $this->checkout_model->list_seller($billing_id, 'null');
		$data['list_product'] = $this->checkout_model->list_checkout($billing_id);
		$data['sum_checkout'] = $this->checkout_model->sum_checkout($billing_id);
		$data['get_group_checkout'] = $this->checkout_model->get_checkout_group_by($billing_id);
		$data['check_kirim_st'] = $this->checkout_model->check_kirim_st($billing_id);
		$data['get_kirim_date'] = $this->checkout_model->get_kirim_date($billing_id);
		//
		$this->load->view('webmin/main/header', $data);		
		$this->load->view('webmin/main/top-menu');			
		$this->load->view('webmin/buyer_data/detail', $data);
		$this->load->view('webmin/main/footer');
	}

	function update_buyer_customer_st($billing_id, $customer_id) {
		$this->checkout_model->update_buyer_customer_st($billing_id,$customer_id);
		redirect('webmin_buyer_data');
	}

	function update_bayar_st($billing_id) {
		$this->checkout_model->update_status($billing_id);
		redirect('webmin_buyer_data');
	}
	
}