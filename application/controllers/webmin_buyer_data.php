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
        $html.='	<td class="info" align="center"><label class="label label-primary" style="font-size: 12px;">Rp '.digit($data['product_total_price']).'</label></td>';

        
        $html.='</tr>';

        $check_kirim_st = $this->checkout_model->check_kirim_st();
        $list_seller = $this->checkout_model->list_seller_by_billing_id($data['billing_id']);

        // Data Product
        $html.='<tr>
        			<td></td>
        			<td colspan="4">';
        	foreach ($list_seller as $seller) {
        $html.='<div class="col-md-8" style="margin-top: 12px;">';
        $html.='		<div class="panel panel-default">
							<div class="panel-heading">
								<img src="'.base_url().'/assets/images/customer/'.$seller['customer_img'].'" class="img-circle img-customer-checkout"> <b>'.$seller['customer_nm'].'</b>';
			if ($seller['diterima_st'] == '1'){
		$html.='				<label class="pull-right label label-success" style="font-size: 13px; margin-top: 2px; padding-top: 6px; padding-bottom: 6px;"><b><i class="fa fa-check"></i> Transaksi Selesai</b></label>';
			}
		$html.='			</div>
							<div class="panel-body">';
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
									$total_payment = 0;
									foreach ($list_product as $product) {
									$total_payment += $product['product_sub_price'];
		$html.='					  <tr>
								        <td align="center"><b>'.$product['no'].'</b></td>
								        <td>'.$product['product_nm'].'</td>
								        <td align="center">'.$product['product_qty'].' '.$product['product_qty_unit'].'</td>
								        <td align="center"><div class="nominal-product">Rp '.digit($product['product_price']).' x '.$product['product_qty'].' '.$product['product_qty_unit'].' = <u>Rp '.digit($product['product_sub_price']).'</u></div></td>
								      </tr>';
									}
		$html.='					</tbody>
								</table>';
		
		$html.='			</div>
						</div>';
		$html.='	</div>';
		$html.=' 	<div class="col-md-4" style="margin-top: 15px;">';
		$html.='		<div class="panel-content">
                            <div class="panel panel-default header-panel-bank-rek" style="border: 2px solid blue;">
                                <div class="panel-body">
                                    <center>
                                        <div class="bold" style="color: black;">Nominal yang diterima Penjual ini</div>
                                        <div class="bold" style="color: red; font-size: 20px;">Rp '.digit($total_payment).'</div>
                                    </center>
                                </div>
                            </div>
                        </div>';
		$html.=' 	</div>';
			}
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
		// $count_buyer = $this->checkout_model->count_buyer($status,$bulan,$search);
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