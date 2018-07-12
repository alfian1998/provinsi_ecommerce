<script type="text/javascript">
$(function() {
    
});
</script>
<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
           
            <div class="col-xs-12 col-sm-12 col-md-7">
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Informasi Pembayaran</b></div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Informasi Transfer Ke Penjual</b></div>
                                <div class="panel-body">
                                    <?php foreach ($list_payment_terms as $data): ?>
                                        <li><?=$data['text']?></li>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-5">
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Detail Belanja</b></div>
                        <div class="panel-body">
                            <?php 
                            $grand_total = 0;
                            foreach ($list_checkout as $data): 
                            $grand_total = $grand_total + $data['product_sub_price'];
                            ?>
                            <div class="body-detail-shopping">
                                <a href="<?=site_url('web/details/'.md5(md5(md5(md5(md5($data['product_id']))))))?>"><img src="<?=base_url()?>assets/images/produk/<?=$data['first_image']['image_name']?>" class="img-thumbnail img-detail-shopping"></a>
                                <div>
                                    <span class="title-product-detail"><?=$data['product_nm']?></span>
                                    <label class="pull-right label label-danger" style="font-size: 14px;">Rp <?=digit($data['product_sub_price'])?></label>
                                </div>
                                <label class="label label-primary">Jumlah : <?=$data['product_qty']?> <?=$data['product_qty_unit']?></label>
                                <div class="customer-detail-shopping"><img src="<?=base_url()?>assets/images/icon/man-icon-2.png" style="width: 13px;"> <?=$data['customer_nm']?></div>
                            </div>
                            <?php endforeach; ?>
                            <div class="cart-line"></div>
                            <div class="form-group">
                                <label class="bold">Catatan Transaksi</label>
                                <textarea class="form-control" name="billing_desc" style="height: 80px;" readonly=""><?=$billing['billing_desc']?></textarea>
                            </div>
                            <div class="cart-line"></div>
                            <div class="form-inline">
                                <div class="pull-left total-shopping">
                                    Total Belanja
                                </div>
                                <div class="pull-right total-price-shopping">
                                    Rp <?=digit($grand_total)?>
                                </div>
                            </div>
                            <div class="button-checkout">
                                <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate"> 
                                    <?php foreach ($list_checkout as $data): ?>
                                    <input type="hidden" name="product_id[]" value="<?=$data['product_id']?>">
                                    <input type="hidden" name="qty[]" value="<?=$data['product_qty']?>">
                                    <?php endforeach; ?>
                                    <button type="submit" class="btn btn-primary btn-block"><b>Bayar</b></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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