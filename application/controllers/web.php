<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		// $this->config_model->validate_login();
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('slideshow_model');
		$this->load->model('customer_model');
	}

	function index() {	
		$data['config'] = $this->config_model->general();
		// session login
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		//
		$data['form_action'] = site_url('web/input');
		$data['list_produk'] = $this->product_model->list_product_new();
		$data['list_product_popular'] = $this->product_model->list_product_popular();
		$data['cart'] = $this->cart->contents();
		$data['list_category'] = $this->category_model->list_category_no_paging();
		$data['list_category_rand'] = $this->category_model->list_category_rand();
		$data['slideshow'] = $this->slideshow_model->get_slideshow_active();
		// cek customer_id jika membeli di produk sendiri
		foreach ($data['cart'] as $key) {
			if ($key['customer_id'] == $data['ses_customer_id']) {
				$this->delete_cart_customer_same($key['rowid']);
			}
		}
		//validate
		$data['validate_account'] = $this->customer_model->validate_account($data['ses_customer_id']);
		$data['validate_address'] = $this->customer_model->validate_address($data['ses_customer_id']);
		$data['validate_bank_account'] = $this->customer_model->validate_bank_account($data['ses_customer_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/home/index', $data);
		$this->load->view('public/main/footer');
		$this->load->view('public/main/validate-modal', $data);
	}

	function details($product_id=null, $product_url=null) {	
		// session login
		// $product_id_md5 = $this->product_model->get_product_id($product_id_raw);
		// print_r($product_id_md5);
		// exit();
		$data['config'] = $this->config_model->general();
		//
		if($this->product_model->validate_product($product_id,$product_url) == false) {
			redirect('');
		}
		//
		$data['ses_login'] = $this->session->userdata('ses_login');
		$data['ses_customer_id'] = $this->session->userdata('ses_customer_id');
		$data['ses_customer_chat_nm'] = $this->session->userdata('ses_customer_chat_nm');
		//
		$data['product_id'] = $product_id;
		$data['product_url'] = $product_url;
		$data['cart'] = $this->cart->contents();
		$data['main'] = $this->product_model->get_product($product_id,$product_url);
		$data['list_produk'] = $this->product_model->list_product_new();
		$data['list_product_recommendat'] = $this->product_model->list_product_recommendat($data['main']['category_id']);
		//
		$this->product_model->update_hit($data['main']['product_id']);
		//
		$this->load->view('public/main/header', $data);		
		$this->load->view('public/main/top-menu');		
		$this->load->view('public/details/index', $data);
		$this->load->view('public/main/footer');
	}

	function input() {
		$qty_product = $this->input->post('qty_product');
		//
		$data= array('id' => $this->input->post('product_id'),
					'name' => $this->input->post('product_nm'),
					'price' => $this->input->post('price'),
					'product_url' => $this->input->post('product_url'),
					'product_desc' => $this->input->post('product_desc'),
					'price_before' => $this->input->post('price_before'),
					'product_img' => $this->input->post('product_img'),
					'customer_nm' => $this->input->post('customer_nm'),
					'customer_id' => $this->input->post('customer_id'),
					'qty_product' => $this->input->post('qty_product'),
					'qty_unit' => $this->input->post('qty_unit'),
					'qty' => 1
					);
		if ($qty_product !='0') {
			$this->cart->insert($data);
		}
		echo $this->show_cart();
		// echo $fefe = count($this->cart->contents());
		// redirect('web');
	}

	function insert_cart_details() {
		$session = $this->session->userdata('cart_contents');
		$product_id = $this->input->post('product_id');
		$md5_product_id = md5($product_id);
		$session_qty = @$session[$md5_product_id]['qty'];
		$price = $this->input->post('price');
		$amount = $price * $this->input->post('quantity');
		$quantity = $this->input->post('quantity');
		$qty_product = $this->input->post('qty_product');
		$if_qty = $session_qty + $quantity;
		if ($quantity < $session_qty) {
			$quantity_final = $session_qty + $quantity;
		}else{
			$quantity_final = $quantity;
		}
		//
		$insert= array('id' => $this->input->post('product_id'),
					'name' => $this->input->post('product_nm'),
					'price' => $this->input->post('price'),
					'product_url' => $this->input->post('product_url'),
					'product_desc' => $this->input->post('product_desc'),
					'price_before' => $this->input->post('price_before'),
					'product_img' => $this->input->post('product_img'),
					'customer_nm' => $this->input->post('customer_nm'),
					'customer_id' => $this->input->post('customer_id'),
					'qty_product' => $this->input->post('qty_product'),
					'qty_unit' => $this->input->post('qty_unit'),
					'qty' => $this->input->post('quantity'),
					);
		$update = array('rowid' => $md5_product_id,
						'price' => $price,
						'product_img' => $this->input->post('product_img'),
						'amount' => $amount,
						'qty' => $quantity_final);
		if ($session_qty > 0) {
			if ($session_qty > $qty_product) {
				echo "<script>swal({
                  text: 'Maaf, jumlah tidak boleh melebihi stok',
                  icon: 'warning',
                  timer: 4000
                });</script>";
			}else{
				if ($if_qty > $qty_product) {
					echo "<script>swal({
	                  text: 'Maaf, jumlah tidak boleh melebihi stok',
	                  icon: 'warning',
	                  timer: 4000
	                });</script>";
				}else{
					$this->cart->update($update);
				}
			}
		}else{
			if ($session_qty > $qty_product) {
				echo "<script>swal({
                  text: 'Maaf, jumlah tidak boleh melebihi stok',
                  icon: 'warning',
                  timer: 4000
                });</script>";
			}else{
				$this->cart->insert($insert);
			}
		}
		echo $this->show_cart();
		// echo $fefe = count($this->cart->contents());
		// redirect('web');
	}

	function show_cart() {
		$cart = $this->cart->contents();
		//
		$result = '';
		$result .='
				<a href="'.site_url('web/location/shoppingcart').'">
				';
			if (empty($cart)) {
		$result .='
					<span class="icon icon-header"><i class="fa fa-shopping-basket fa-2x "></i></span>
					<span class="cart-quantity">0</span>
				';
			}else{
		$result .='
                    <span class="icon icon-header"><i class="fa fa-shopping-basket fa-2x faa-bounce animated"></i></span>
                    <span class="cart-quantity faa-bounce animated">'.count_cart($cart).'</span>    
                ';
			}
        $result .='
        		<span class="line1">Keranjang Belanja<br><strong>Rp '.cart_total($cart).'</strong></span>
        		</a>
        		<div class="block-mini-cart column-cart">
        			<div class="mini-cart-content">
        		';
       	$result .='
       			<div class="cart-shopping">
                    <p class="icon-cart-shopping">
                        <i class="fa fa-shopping-basket fa-2x" style="color: blue;"></i> 
                        <span class="text-icon-cart-shopping">Keranjang Belanja</span>
                        <span class="bag-cart-count cartcount">'.count_cart($cart).'</span>
                    </p>
                </div>
                <div class="cart-line-top"></div>
       			';
       	$result .='
       			<div class="mini-cart-list">
       				<ul>
       			';
       		$grand_total = 0;
            foreach ($cart as $item) {
            $grand_total+=$item['subtotal'];    
        $result .='
        		<li class="product-info">
                    <div class="p-left">
                        <a href="#" class="remove_link"></a>
                        <a href="'.site_url('web/details/'.$item['id'].'/'.$item['product_url']).'">
                        <img class="img-thumbnail cart-img" src="'.base_url().'assets/images/produk/'.$item['product_img'].'" alt="Product">
                        </a>
                    </div>
                    <div class="p-right">
                        <a href="'.site_url('web/details/'.$item['id'].'/'.$item['product_url']).'"><p class="cart-name">'.$item['name'].'</p></a>
                        <p class="cart-price">Rp '.digit($item['price']).'</p>';
            if ($item['price_before'] != '') {
        $result .='		<p class="cart-price-old">Rp '.digit($item['price_before']).'</p>';
            }else{
		$result .='		<p class="cart-price-old"><br></p>';            	
            }
        $result .='		<p class="cart-qty">Jumlah : '.$item['qty'].' '.$item['qty_unit'].'</p>
                    </div>
                </li>
        		';
            } 

       	$result .='
       				</ul>
       			<div>
       			';

       		if (empty($cart)) {
       	$result .='
       			<div class="toal-cart">
                    <span>Keranjang belanja Anda masih kosong</span>
                    <div class="cart-line"></div>
                </div>
       			';
       		}else{
       	$result .='
       			<div class="toal-cart">
                    <span><b>Total Belanja :</b></span>
                    <span class="cart-total-price pull-right">Rp '.digit($grand_total).'</span>
                    <div class="cart-line"></div>
                </div>
                <div class="cart-buttons">
                    <a href="'.site_url('web/location/shoppingcart').'" class="btn btn-sm btn-success cart-btn"><i class="fa fa-eye"></i> Lihat / Ubah isi Keranjang</a>
                    <a href="'.site_url('checkout').'" class="btn btn-sm btn-primary cart-btn"><i class="fa fa-arrow-right"></i> Lanjutkan Pembayaran</a>
                </div>
       			';
       		}

        $result .='
        			<div>
        		<div>
        		';
        return $result;
	}

	function shopping_cart() {
		$cart = $this->cart->contents();
		//
		$result ='';

			if(empty($cart)){

		$result .='
				<div class="page-content page-order">
					<div class="alert alert-blue text-center">Keranjang Belanja Anda Masih Kosong</div>
					<div class="order-detail-content">
						<center>
						<img src="'.base_url().'assets/images/icon/empty-cart.png"><br>
						<a href="'.site_url('web/location/').'" class="btn btn-success bold">Belanja Sekarang</a>
						</center>
					</div>
				</div>
				';

			}else{

		$result .='
				<div class="page-content page-order">
					<div class="alert alert-blue">Keranjang belanja Anda berisi : '.count_cart($cart).'</div>
					<div class="order-detail-content">
						<div class="table-responsive">
						<table class="table table-hover cart_summary" style="min-width: 1000px;">
							<thead>
		                        <tr>
		                        	<th class="text-center" width="2%">No</th>
		                            <th class="cart_product text-center">Produk</th>
		                            <th>Deskripsi</th>
		                            <th class="text-center">Harga Per Unit</th>
		                            <th class="text-center" width="17%">Jumlah (Qty)</th>
		                            <th class="text-center" width="17%">Total</th>
		                            <th></th>
		                        </tr>
		                    </thead>
		                    <tbody>
				';
        	$grand_total = 0;
			$i = 1;
			foreach ($cart as $item){
			$grand_total = $grand_total + $item['subtotal'];

		$result .='
				<tr>
                	<td align="center">'.$i++.'</td>
                    <td class="cart_product">
                        <a href="'.site_url('web/details/'.$item['id'].'/'.$item['product_url']).'"><img class="img-responsive img-thumbnail img-product-cart" src="'.base_url().'assets/images/produk/'.$item['product_img'].'"></a>
                    </td>
                    <td class="cart_description">
                        <a href="'.site_url('web/details/'.$item['id'].'/'.$item['product_url']).'" class="product-title">'.$item['name'].'</a><br>
                        <small><img style="width: 13px;" src="'.base_url().'assets/images/icon/man-icon-2.png"> '.$item['customer_nm'].'</small><br>
                    </td>
                    <td class="price td-middle">
                    	<span class="product-price-grid">Rp '.digit($item['price']).'</span>&nbsp;&nbsp;';
            if ($item['price_before'] !='') {
        $result .='		<span class="product-price-old-grid">Rp '.digit($item['price_before']).'</span></td>';
            }
        $result .=' <td class="td-middle">
        				<div class="form-inline">
                    	<div class="input-group" style="width: 100px;">
                    		<input type="number" name="quantity" id="'.$item['id'].'" min="1" value="'.$item['qty'].'" class="quantity form-control qty_'.$item['id'].'">
							<span class="input-group-btn">
								<button class="update_cart btn btn-primary" data-product_id="'.$item['id'].'" data-row_id="'.$item['rowid'].'" data-price="'.$item['price'].'" data-product_img="'.$item['product_img'].'" data-qty_product="'.$item['qty_product'].'" title="Perbarui"><i class="fa fa-refresh"></i></button>
							</span>
						</div>
						<label class="label label-primary" style="font-size: 12px;">'.$item['qty_unit'].'</label>
						</div>
                    </td>
                    <td class="price td-middle">
                        <span class="subtotal product-price-grid">Rp '.digit($item['subtotal']).'</span>
                    </td>
                    <td align="center" class="td-middle">
                        <button data-row_id="'.$item['rowid'].'" class="delete_cart btn btn-sm btn-danger text-icon" title="Hapus"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
				';
			}
		$result .='	
						</tbody>
						<tfoot>
	                        <tr>
	                            <td colspan="5" class="td-middle"><strong>Total</strong></td>
	                            <td class="td-middle"><span class="total-price">Rp '.digit($grand_total).'</span></td>
	                            <td></td>
	                        </tr>
	                    </tfoot> 
						</table>
						</div>
						<div class="cart_navigation">
		                    <a class="btn btn-primary" href="'.site_url('web/location/').'"><i class="fa fa-angle-double-left"></i> <b>Belanja Lagi</b> </a>
		                    <a class="btn btn-primary pull-right" href="'.site_url('checkout').'"><b>Lanjut Pembayaran</b> <i class="fa fa-angle-double-right"></i></a>
		                </div>
					</div>
				</div>
				';
		$result .="
				<style>
					.swal-text{
						font-weight: bold;
					};
				</style>
				<script type='text/javascript'>
					$(document).ready(function(){
						//Update Item Cart
						$('.update_cart').click(function(){
							var product_id   = $(this).data('product_id');
							var row_id   	= $(this).data('row_id');
							var price   	= $(this).data('price');
							var product_img  = $(this).data('product_img');
							var qty_product  = $(this).data('qty_product');
							var qty     	= $('#' + product_id).val();
							if(qty > qty_product) {
								var qty_final = qty_product;
							}else {
								var qty_final = qty;
							}
							$.ajax({
								url : '".site_url('web/update_cart')."',
								method : 'POST',
								data : {row_id : row_id, price : price, product_img : product_img, qty_final : qty_final},
								success :function(data){
									if(qty > qty_product) {
										swal({
					                          text: 'Maaf, jumlah tidak boleh melebihi stok',
					                          icon: 'warning',
					                          timer: 4000
					                        });
					                    $('.qty_'+product_id).val(qty_product);
					                    $('#shopping_cart').html(data);
									}else{
										swal({
					                          text: 'Produk telah diupdate',
					                          icon: 'success',
					                          timer: 4000
					                        });
										$('#shopping_cart').html(data);
									}
								}
							});
						});

						//Delete Item Cart
						$('.delete_cart').click(function(){
							var row_id   = $(this).data('row_id');
							$.ajax({
								url : '".site_url('web/delete')."',
								method : 'POST',
								data : {row_id : row_id},
								success :function(data){
									swal({
				                          text: 'Produk telah dihapus',
				                          icon: 'success',
				                          timer: 4000
				                        });
									$('#shopping_cart').html(data);
								}
							});
						});
					});
				</script>
				";
			}
		return $result;
	}

	function load_cart(){ //load data cart
		echo $this->show_cart();
	}

	function load_shopping_cart(){
		echo $this->shopping_cart();
	}

	function count_cart() {
		$result = '';
		$result = count($this->cart->contents());
		return $result;
	}

	function price_cart() {
		$cart = $this->cart->contents();
		//
		$grand_total = 0;
	    foreach ($cart as $item):
	        $grand_total+=$item['subtotal'];                            
	    endforeach;
	    $result = digit($grand_total);
	    return $result;
	}

	function update_cart(){ //fungsi untuk menghapus item cart
		$rowid = $this->input->post('row_id');
		$price = $this->input->post('price');
		$product_img = $this->input->post('product_img');
		$amount = $price * $this->input->post('qty');
		$qty_final = $this->input->post('qty_final');
		$data = array('rowid' => $rowid,
						'price' => $price,
						'product_img' => $product_img,
						'amount' => $amount,
						'qty' => $qty_final);
		$this->cart->update($data);
		echo $this->load_shopping_cart();
	}

	function update() {
		$cart_info = $_POST['cart'] ;
		foreach($cart_info as $id => $cart)
		{
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$product_img = $cart['product_img'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];
			$data = array('rowid' => $rowid,
							'price' => $price,
							'product_img' => $product_img,
							'amount' => $amount,
							'qty' => $qty);
			$this->cart->update($data);
		}
		redirect('shoppingcart');
	}

	function delete() {
		$rowid = $this->input->post('row_id');
		$data = array('rowid' => $rowid,
	  				  'qty' =>0);
		$this->cart->update($data);
		echo $this->load_shopping_cart();
		// redirect('shoppingcart');
	}

	function delete_cart_customer_same($rowid = null) {
		$data = array('rowid' => $rowid,
	  				  'qty' =>0);
		$this->cart->update($data);
		redirect('');
	}

	function location($act=null,$id=null) {
		//
		unset_session('ses_txt_search,ses_category,ses_qty_unit,ses_urutan,ses_search');
		//
		if($id != '') {
			redirect($act.'/'.$id);
		} else {
			redirect($act);	
		}
	}	
}