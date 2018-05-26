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
                                <div class="ammount-title">Jumlah Bayar / Tagihan</div>
                                <div class="ammount-bill">Rp <?=digit($get_billing['product_total_price'])?></div>
                                <div class="hide" id="jumlah"><?=$get_billing['product_total_price']?></div>
                                <a class="copy-clipboard" onclick="copyToClipboard('#jumlah')">Salin Jumlah</a>

                                <div style="padding-top: 20px;">
                                    <div class="ammount-title">Nomor Transaksi</div>
                                    <div class="billing-info" id="no_transaksi"><?=$get_billing['billing_id']?></div>
                                    <a class="copy-clipboard" onclick="copyToClipboard('#no_transaksi')">Salin No Transaksi</a>
                                </div>
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
                        <div class="panel-heading"><b>Nomor Rekening Admin DKP Jawa Tengah</b></div>
                        <div class="panel-body row">
                            <?php foreach ($list_bank_account as $data): ?>
                            <div class="col-md-6 panel-bank-rek">
                                <div class="panel-content">
                                    <div class="panel panel-default header-panel-bank-rek">
                                        <div class="panel-body">
                                            <div>
                                                <img src="<?=base_url()?>assets/images/logo/bank/<?=$data['bank_id']?>.png" class="img-bank-rek">
                                            </div>
                                            <div><?=$data['bank_nm']?>, <?=$data['bank_address']?></div>
                                            <div class="bold" id="no-rek"><?=$data['no_rek']?></div>
                                            <a class="copy-clipboard" onclick="copyToClipboard('#no-rek')">Salin No. Rek</a>
                                        </div>
                                    </div>
                                </div>  
                            </div>    
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="alert alert-green">Jika Anda sudah transfer ke Rekening Admin DKP Jateng, silahkan upload bukti transfer Anda, klik Lanjut Cek Transaksi</div>
                <a href="<?=site_url('transactions/invoices/'.$get_billing['billing_id'].'/null')?>" class="btn btn-primary btn-block faa-bounce animated"><b>Lanjut Cek Transaksi</b></a>
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