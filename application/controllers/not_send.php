<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Not_Send extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
		$this->load->model('checkout_model');
	}

	function index($p=1, $o=0) {
		// session login
		$data['config'] = $this->config_model->general();
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['p'] = $p;
		$data['o'] = $o;	
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');			
		$this->load->view('customer/status_deposit/not_send', $data);
		$this->load->view('public/main/footer');
	}

	function buyer($p=1, $o=0) {
		$customer_id = $this->session->userdata('ses_customer_id');
		//
		$paging = $this->checkout_model->paging_not_send_pay_customer($p,$o,$customer_id);
		$list_buyer = $this->checkout_model->get_not_send_pay_customer($o, $paging->offset, $paging->per_page,$customer_id);
		//
		$html = '';
			foreach ($list_buyer as $data){
		$html.= '	<tr>
                        <td align="center"><b>'.$data['no'].'</b></td>';
            if ($data['customer_id'] !='') {
        $html.= '		<td colspan="2"><span style="color: blue; font-weight: bold;">'.$data['customer_nm'].'</span></td>';
        	}else{
		$html.= '		<td colspan="2"><span style="color: blue; font-weight: bold;">'.$data['pembeli_nm'].'</span></td>';
			}
		$html.= '		<td align="center"><label class="label label-success" style="font-size: 13px;">'.$data['billing_id'].'</label></td>
                        <td align="center"><label class="label label-primary" style="font-size: 13px;">Rp '.digit($data['nominal_diterima']).'</label></td>
                        <td rowspan="2">
                        	<label class="label label-danger" style="font-size: 13px;"><i class="fa fa-times"></i> Belum Ditransfer</label>
                        </td>
                    </tr>';
        $html.= '	<tr>
						<th></th>
						<th width="3%">No</th>
						<th>Nama Produk</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Nominal Per Produk</th>
					</tr>';
				$list_product = $this->checkout_model->get_product_by_billing_id($data['billing_id'], $customer_id);
				foreach ($list_product as $product) {
		$html.= '	<tr>
						<td></td>
						<td align="center">'.$product['no'].'</td>
						<td>'.$product['product_nm'].'</td>
						<td align="center">'.$product['product_qty'].' '.$product['product_qty_unit'].'</td>
						<td align="center"><div class="nominal-product">Rp '.digit($product['product_price']).' x '.$product['product_qty'].' '.$product['product_qty_unit'].' = <u>Rp '.digit($product['product_sub_price']).'</u></div></td>
					<tr>';
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
		$html.='	        <li><a href="'.site_url("not_send/buyer/$paging->c_start_link/$o").'" class="link_pagination"><span><i class="fa fa-angle-double-left"></i></span></a></li>';
	                }
	                if($paging->prev){
	    $html.='            <li><a href="'.site_url("not_send/buyer/$paging->prev/$o").'" class="link_pagination"><span><i class="fa fa-angle-left"></i></span></a></li>';
	                }

	                for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++){
	                	if ($p == $i) {
	    $html.='			<li class="active">';
	                	}else{
	    $html.='			<li>';
	                	}
	    $html.='				<a href="'.site_url("not_send/buyer/$i/$o").'" class="link_pagination">'.$i.'</a>
	    					</li>';
	                        }

	                if($paging->next){
	    $html.='            <li><a href="'.site_url("not_send/buyer/$paging->next/$o").'" class="link_pagination"><span><i class="fa fa-angle-right"></i></span></a></li>';
	                        }
	                        
	                if($paging->end_link){
	    $html.='            <li><a href="'.site_url("not_send/buyer/$paging->c_end_link/$o").'" class="link_pagination"><span><i class="fa fa-angle-double-right"></i></span></a></li>';
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

		//
		echo json_encode(array(
			'html' => $html
		));
	}
}