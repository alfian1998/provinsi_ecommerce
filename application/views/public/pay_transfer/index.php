<script>
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
</script>
<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Pembayaran Via Transfer</b></div>
                        <div class="panel-body">
                            <center>
                                <div class="ammount-title">Nomor Transaksi</div>
                                <div class="billing-info" id="no_transaksi"><?=$get_billing['billing_id']?></div>
                                <a class="copy-clipboard" onclick="copyToClipboard('#no_transaksi')">Salin No Transaksi</a>
                            </center>
                            <div class="cart-line"></div>
                            <div>
                                <div style="font-weight: bold;">Petunjuk Pembayaran :</div>
                                <?php foreach ($list_petunjuk_pembayaran as $data): ?>
                                <?=$data['text']?>
                                <?php endforeach; ?>
                            </div>
                            <div class="cart-line"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Detail Pembelian dan Nomor Rekening Penjual</b></div>
                        <div class="panel-body row">
                            <?php foreach ($list_all_transaksi as $data): ?>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <img src="<?=base_url('assets/images/customer/'.$data['customer_img'])?>" class="img-circle img-customer-checkout"> <b><?=$data['customer_nm']?></b> 
                                    </div>
                                    <div class="panel-body">

                                        <?php 
                                        $list_all_product = $this->checkout_model->get_all_product_transaksi($data['billing_id'], $data['customer_id']);
                                        $total_payment = 0;
                                        foreach ($list_all_product as $product): 
                                        $total_payment += $product['product_sub_price'];
                                        ?>
                                        <div class="body-detail-shopping">
                                            <a href="javascript:void(0)"><img src="<?=base_url()?>assets/images/produk/<?=$product['first_image']['image_name']?>" class="img-thumbnail img-detail-shopping"></a>
                                            <div>
                                                <span class="title-product-detail"><?=$product['product_nm']?></span>
                                                <label class="pull-right label label-danger" style="font-size: 14px;">Rp <?=digit($product['product_sub_price'])?></label>
                                            </div>
                                            <label class="label label-primary">Jumlah : <?=$product['product_qty']?> <?=$product['product_qty_unit']?></label>
                                            <div class="customer-detail-shopping"><br></div>
                                        </div>
                                        <?php endforeach; ?>

                                        <div class="bold" style="padding-bottom: 5px;">Data Rekening Bank (<?=$data['customer_nm']?>)</div>
                                        <div class="col-md-7 row">
                                            <div class="panel-content">
                                                <div class="panel panel-default header-panel-bank-rek" style="border: 2px solid blue;">
                                                    <div class="panel-body">
                                                        <center>
                                                            <img src="<?=base_url()?>assets/images/logo_bank/<?=$data['bank_img']?>" style="height: 30px;">
                                                        </center>
                                                        <div class="bold" style="color: blue;"><?=$data['bank_nm']?> (<?=$data['bank_short_nm']?>)</div>
                                                        <div><?=$data['bank_owner']?></div>
                                                        <div class="bold" id="no-rek-<?=$data['bank_no_rek']?>" style="color: green;"><?=$data['bank_no_rek']?></div>
                                                        <a class="copy-clipboard" onclick="copyToClipboard('#no-rek-<?=$data['bank_no_rek']?>')">Salin No. Rekening</a>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="col-md-5">
                                            <div class="panel-content">
                                                <div class="panel panel-default header-panel-bank-rek" style="border: 2px solid blue;">
                                                    <div class="panel-body">
                                                        <center>
                                                            <div class="bold" style="color: black;">Total Pembayaran Anda Ke Penjual ini</div>
                                                            <div class="bold" style="color: red; font-size: 20px;">Rp <?=digit($total_payment)?></div>
                                                            <div class="hide" id="total-<?=$total_payment?>"><?=$total_payment?></div>
                                                            <a class="copy-clipboard" onclick="copyToClipboard('#total-<?=$total_payment?>')">Salin Jumlah</a>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <!-- <div class="panel-footer"></div> -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="alert alert-green">Jika Anda sudah transfer ke Rekening Penjual, silahkan upload bukti transfer Anda, klik Tombol dibawah</div>
                <a href="<?=site_url('transactions/invoices/'.$get_billing['billing_id'].'/null')?>" class="btn btn-primary btn-block faa-bounce animated"><b>Lanjut Cek Transaksi & Upload Bukti Transfer</b></a>
            </div>

		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#show_cart').hide();
    });
</script>