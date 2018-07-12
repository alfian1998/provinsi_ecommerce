<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		$this->load->model('checkout_model');
	}

	function index($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/notification/index', $data);
		$this->load->view('public/main/footer');
	}	

	function buyer($p=1, $o=0) {
		//get data
		$status = $this->input->get('status');
		$bulan = $this->input->get('bulan');
		$search = $this->input->get('search');
		//
		$customer_id = $this->session->userdata('ses_customer_id');
		//
		$paging = $this->checkout_model->paging_buyer_by_customer_id($p,$o,$customer_id,$status,$bulan,$search);
		$list_buyer = $this->checkout_model->get_buyer_by_customer_id($o, $paging->offset, $paging->per_page,$customer_id,$status,$bulan,$search);
		//
		$html = '';
			foreach ($list_buyer as $data){
		//
		$jumlah_harga = $this->checkout_model->get_jumlah_harga($data['billing_id'],$customer_id);
		//
		$html.= '<tr>
                    <td align="center"><b>'.$data['no'].'</b></td>';
        $html.='	<td align="center">';
        $html.='		<a href="'.site_url('notification/detail/'.$p.'/'.$o.'/'.$data['billing_id']).'" class="btn btn-xs btn-primary bold" title="Detail Data"><i class="fa fa-bars"></i> DETAIL</i></a>
        			</td>';
        		if ($data['customer_id'] !='') {
		$html.='    <td><div style="font-weight: bold; color: blue;">'.$data['customer_nm'].'</div></td>';
                }else{
        $html.='    <td><div style="font-weight: bold; color: blue;">'.$data['pembeli_nm'].'</div></td>';
				}
        $html.='	<td align="center"><label class="label label-success" style="font-size: 13px;">'.$data['billing_id'].'</label></td>';
        $html.='	<td><label class="label label-primary" style="font-size: 12px;">Rp '.digit($jumlah_harga['jumlah_harga']).'</label></td>';

       	// Notifikasi Belum Bayar dan Sudah Bayar
       		if ($data['diterima_st'] == '1') {
       	$html.=' 	<td rowspan="3"><label class="label label-success" style="font-size: 12px;"><i class="fa fa-check"></i> Transaksi Selesai</label>';		
       	$html.='		<div class="alert-product" style="margin-top: 8px; color: green;">* Produk sudah diterima Pembeli</div>'; 
       	$html.='		<div class="alert-product" style="margin-top: 3px; color: green;">* Transaksi dari Pembeli : <u>'; 
       		if ($data['customer_id'] !='') {
		$html.=	$data['customer_nm'];
                }else{
        $html.=	$data['pembeli_nm'];
				}
       	$html.='</u>, telah SELESAI</div></td>';
       		}else{
	        	if ($data['bayar_customer_st'] == '1') {
	        $html.=' 	<td rowspan="3"><label class="label label-success" style="font-size: 12px;">Sudah Bayar</label>';
	        		if ($data['kirim_st'] == '2') {
	        $html.='		<button type="button" class="btn btn-primary btn-xs bold faa-flash animated" data-toggle="modal" data-target="#ModalConfirm-'.$data['billing_id'].'">KONFIRMASI</button>';
	        		}

	        $check_kirim_st = $this->checkout_model->check_kirim_st($data['billing_id'], $customer_id);
	                if ($check_kirim_st == '') {
	        $html.=' 	<label class="label label-success" style="font-size: 12px;">Sudah Kirim</label>';
	                }elseif ($check_kirim_st != '') {
	                	if ($data['bayar_st'] == '1') {
	        $html.=' 	<label class="label label-danger" style="font-size: 12px;">Belum Kirim</label>';
	        			}
	                }

	        $html.='		<div class="alert-product" style="margin-top: 8px;">* Silahkan klik Tombol <a href="'.site_url('notification/detail/'.$p.'/'.$o.'/'.$data['billing_id']).'"><font class="bold" style="color: blue">DETAIL</font></a> untuk melihat bukti transfer</div>';
	        		if ($data['kirim_st'] == '2') {
	        $html.='		<div class="alert-product" style="margin-top: 3px;">* Anda harus segera mengirim produk, dan klik <font class="bold" style="color: blue;">KONFIRMASI</font></div>';
	        		}elseif($data['kirim_st'] == '1') {
	        $html.='		<div class="alert-product" style="margin-top: 3px; color: blue;">* Produk sudah dikirim ke Pembeli</div>';
	        		}
	            }elseif ($data['bayar_customer_st'] == '2') {
	        $html.=' 	<td><label class="label label-warning" style="font-size: 12px;">Belum Bayar</label>';
	            }
	        }

	        $check_kirim_st = $this->checkout_model->check_kirim_st($data['billing_id'], $customer_id);
        	$list_product = $this->checkout_model->get_product_by_billing_id($data['billing_id'], $customer_id);
        	$count_list_product = count($list_product)+1;

        // Modal
        $html.='<div class="modal fade" id="ModalConfirm-'.$data['billing_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				    <form action="'.site_url('notification/update_kirim_st/'.$data['billing_id']).'" method="post" enctype="multipart/form-data">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Konfirmasi Pengiriman Produk</h4>
				      </div>
				      <div class="modal-body">
				      	<div class="alert alert-red alert-notification" style="padding-top: 5px; padding-bottom: 5px; padding-left: 7px; padding-right: 7px;"><i class="fa fa-warning"></i> Jika Anda sudah mengirimkan produk ke Pembeli, silahkan mengisi kolom dibawah ini
				      	</div>
				      	<div class="cart-line-top" style="margin-bottom: 10px; margin-top: 15px;"></div>
				    	<div class="form-group">
				            <label>Status Kirim</label>
				            <select name="kirim_st" style="width: 30%;">
				            	<option value="">-- Pilih Status Kirim --</option>
				            	<option value="1">Sudah Kirim</option>
				            </select>
				            <span class="alert-product">* Jika Anda sudah mengirimkan Produk Anda ke Pembeli sikahkan ubah Status Kirim Menjadi <u>Sudah Kirim</u></span>
				        </div>
				        <div class="cart-line-top" style="margin-bottom: 10px;"></div>
				        <div class="form-group">
				            <label>Nama Jasa Pengiriman</label>
				            <input type="text" name="jasa_nm" class="form-control" value="" style="width: 60%;">
				            <span class="alert-product">* Jika Anda menggunakan Jasa Pengiriman Barang, silahkan isi kolom Nama Jasa Pengiriman</span>
				        </div>
				        <div class="cart-line-top" style="margin-bottom: 10px;"></div>
				        <div class="form-group">
				            <label>Nomor Resi</label>
				            <input type="text" name="no_resi" class="form-control" value="" style="width: 60%;">
				            <span class="alert-product">* Jika Anda menggunakan Jasa Pengiriman Barang, silahkan isi kolom Nomor Resi</span>
				        </div>
				        <div class="cart-line-top" style="margin-bottom: 10px;"></div>
				        <div class="form-group">
				            <label>Estimasi Sampai</label>
				            <div class="input-group" style="width: 25%;">
						      <input type="number" name="estimasi_sampai" class="form-control">
						      <div class="input-group-addon bold">Hari</div>
						    </div>
				            <span class="alert-product">* Silahkan isi Estimasi Sampai barang ke Pembeli berapa hari</span>
				        </div>

				        <div class="panel panel-primary">
                            <div class="panel-heading bold">Produk yang Harus Anda Kirim</div>
                            <div class="panel-body">
                                <div class="col-md-12 row">';
                                foreach ($list_product as $product){
        $html.='					<li><b>'.$product['product_qty'].'&nbsp;'.$product['product_qty_unit'].' : '.$product['product_nm'].'</b></li>';
        						}
		$html.='				</div>
                            </div>
                        </div>

				        <div class="panel panel-primary">
                            <div class="panel-heading bold">Informasi Alamat Pembeli</div>
                            <div class="panel-body">
                                <div class="col-md-12 row">';
                                if ($data['customer_id_pembeli'] !='') {
        $html.='					<p>'.$data['customer_address'].'</p>';
                                }else{
        $html.='					<p>'.$data['pembeli_address'].'</p>';
                                }
		$html.='					<p>Kelurahan '.$data['kelurahan'].', Kecamatan '.$data['kecamatan'].', '.$data['kabupaten'].', '.$data['provinsi'].', ';
								if ($data['customer_id_pembeli'] !='') {
		$html.=						$data['customer_kodepos'];
								}else{
		$html.=						$data['pembeli_kodepos'];									
								}
		$html.=' </p>';
		 						if ($data['customer_id_pembeli'] !='') {
        $html.='					<p>'.$data['customer_phone'].'</p>';
                                }else{
        $html.='					<p>'.$data['pembeli_phone'].'</p>';
                                }
		$html.='				</div>
                            </div>
                        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger bold" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary bold">Simpan</button>
				      </div>
				    </form>
				    </div>
				  </div>
				</div>';

		$html.="<script>
					$(function() {
				        var auto_refresh = setInterval(function () {
				            $('#ModalConfirm-".$data['billing_id']."').modal('hide');
				        }, 79988);
				    });
				</script>";

        $html.='</td></tr>';

        $html.='<tr>';
        $html.='	<td colspan="1"></td>';
        $html.='	<th class="text-center" style="background: #eee;">No</th>';
        $html.='	<th style="background: #eee;">Nama Produk</th>';
        $html.='	<th class="text-center" style="background: #eee;">Jumlah</th>';
        $html.='	<th style="background: #eee;">Nominal</th>';
        		if ($data['bayar_st'] == '1') {
        			if ($check_kirim_st != '') {
        $html.='	<td rowspan="'.$count_list_product.'">
        				<div style="padding-top: 13px;"></div>
        				<label class="label label-danger faa-flash animated" style="font-size: 12px;"><i class="fa fa-warning"></i> PRODUK INI HARUS ANDA KIRIM !</label>';
        		if ($data['bayar_st'] == '1') {
        $html.='		<a href="'.site_url('notification/form/'.$data['billing_id']).'" class="btn btn-primary btn-sm bold" style="margin-top: 15px;"><i class="fa fa-send"></i> Konfirmasi Sudah Kirim</a>';
        		}
        $html.='	</td>';
        			}
        		}
        $html.='</tr>';

        		foreach ($list_product as $product){
        $html.='<tr>';
        $html.='	<td colspan="1"></td>';
        $html.='	<td align="center">'.$product['no'].'</td>';
        $html.='	<td>'.$product['product_nm'].'</td>';
        $html.='	<td align="center">'.$product['product_qty'].' '.$product['product_qty_unit'].'</td>';
        $html.='	<td><div class="nominal-product">Rp '.digit($product['product_sub_price']).'</div></td>';
        $html.='</tr>';
        		}
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
		$html.='	        <li><a href="'.site_url("notification/buyer/$paging->c_start_link/$o").'" class="link_pagination"><span><i class="fa fa-angle-double-left"></i></span></a></li>';
	                }
	                if($paging->prev){
	    $html.='            <li><a href="'.site_url("notification/buyer/$paging->prev/$o").'" class="link_pagination"><span><i class="fa fa-angle-left"></i></span></a></li>';
	                }

	                for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++){
	                	if ($p == $i) {
	    $html.='			<li class="active">';
	                	}else{
	    $html.='			<li>';
	                	}
	    $html.='				<a href="'.site_url("notification/buyer/$i/$o").'" class="link_pagination">'.$i.'</a>
	    					</li>';
	                        }

	                if($paging->next){
	    $html.='            <li><a href="'.site_url("notification/buyer/$paging->next/$o").'" class="link_pagination"><span><i class="fa fa-angle-right"></i></span></a></li>';
	                        }
	                        
	                if($paging->end_link){
	    $html.='            <li><a href="'.site_url("notification/buyer/$paging->c_end_link/$o").'" class="link_pagination"><span><i class="fa fa-angle-double-right"></i></span></a></li>';
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
		$count_buyer = count($list_buyer);
		//
		$count = "";
		$count .= $count_buyer." Orang";
		//
		echo json_encode(array(
			'html' => $html,
			'count' => $count
		));
	}

	function update($p, $o, $product_id) {
		$this->selling_model->update($product_id);
		redirect('selling');
	}

	function detail($p=1, $o=0, $billing_id=null) {	
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->checkout_model->get_checkout($billing_id,'null');
		$data['jumlah_harga'] = $this->checkout_model->get_jumlah_harga($billing_id,$data['ses_customer_id']);
		$data['list_product'] = $this->checkout_model->list_checkout($billing_id, $data['ses_customer_id']);
		$data['sum_checkout'] = $this->checkout_model->sum_checkout($billing_id, $data['ses_customer_id']);
		$data['get_group_checkout'] = $this->checkout_model->get_checkout_group_by($billing_id);
		$data['check_kirim_st'] = $this->checkout_model->check_kirim_st($billing_id, $data['ses_customer_id']);
		$data['get_kirim_date'] = $this->checkout_model->get_kirim_date($billing_id, $data['ses_customer_id']);
		$data['get_data_checkout'] = $this->checkout_model->get_checkout_by_billing_and_customer_id($billing_id, $data['ses_customer_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/notification/detail', $data);
		$this->load->view('public/main/footer');
	}

	function form($billing_id=null) {	
		$data['config'] = $this->config_model->general();
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['form_action'] = site_url('notification/update_kirim_st/'.$billing_id);
		$data['jumlah_harga'] = $this->checkout_model->get_jumlah_harga($billing_id,$data['ses_customer_id']);
		$data['billing'] = $this->checkout_model->get_billing_edit($billing_id);
		$data['checkout'] = $this->checkout_model->get_checkout_by_billing($billing_id);
		$data['check_kirim_st'] = $this->checkout_model->check_kirim_st($billing_id, $data['ses_customer_id']);
		$data['get_checkout'] = $this->checkout_model->get_checkout_by_customer_id($billing_id, $data['ses_customer_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/notification/form', $data);
		$this->load->view('public/main/footer');
	}

	function update_kirim_st($billing_id) {
		$ses_customer_id = $this->session->userdata('ses_customer_id');
		//
		$this->checkout_model->update_kirim_st($billing_id, $ses_customer_id);
		redirect('notification');
	}

	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('notification/index');
	}
}