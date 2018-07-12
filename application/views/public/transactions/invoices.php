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
<div class="background-img">
<div class="container padding-bottom">
	<div class="row">
		<div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <a href="<?=site_url('web/location/categories')?>">
                        <div class="vertical-head">
                            <h5 class="vertical-title">Kategori <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
                        </div>
                    </a>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <?php foreach ($list_category_rand as $data): ?>
                            <li>
                                <a href="<?=site_url('gridview/index/1/0/'.$data['category_id'])?>" class="background-font text-short" title="<?=$data['category_nm']?>"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=rand(1,14)?>.png"><?=$data['category_nm']?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-sm-9 col-md-10" style="margin-top: 22px;">
                <div class="panel panel-primary">
                    <div class="panel-heading bold">Cek Transaksi</div>
                    <div class="panel-body">
                    <?php if ($main['billing_id'] !=''): ?>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="panel panel-default">
                                    <div class="panel-heading bold">Daftar Pembelian 
                                        <?php if ($get_checkout_kirim_st == '0'): ?>
                                            <?php if ($main['diterima_st'] == '1'): ?>
                                                <!-- Kosong -->
                                            <?php else: ?>
                                                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-xs 
                                                btn-primary pull-right bold faa-pulse animated faa-fast">Konfirmasi Sudah Diterima Semua</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-body">
                                        <?php 
                                        foreach ($list_seller as $data): 
                                        //
                                        $check_kirim_st = $this->checkout_model->check_kirim_st($data['billing_id'], $data['customer_id']);
                                        ?>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <img src="<?=base_url()?>/assets/images/customer/<?=$data['customer_img']?>" class="img-circle img-customer-checkout"> <b style="color: black;"><?=$data['customer_nm']?></b> 
                                                <?php if ($data['kirim_st'] == '1'): ?>
                                                    <?php if ($data['diterima_st'] == '1'): ?>
                                                        <label class="pull-right label label-success" style="font-size: 13px; margin-top: 2px; padding-top: 6px; padding-bottom: 6px;"><b><i class="fa fa-check"></i> Transaksi Selesai</b></label>
                                                    <?php else: ?>
                                                        <a id="clear-<?=$data['customer_id']?>" href="#" class="btn btn-sm btn-danger bold pull-right">Sudah Terima?</a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($data['bayar_customer_st'] == '2'): ?>
                                                    <button type="button" class="btn btn-primary btn-sm pull-right bold" data-toggle="modal" data-target="#Modal-<?=$data['customer_id']?>"><i class="fa fa-upload"></i> Upload Foto</button>
                                                <?php endif; ?>
                                            </div>
                                            <div class="panel-body">
                                                <div class="panel-notification">
                                                    <?php if ($data['bayar_customer_st'] == '2'): ?>
                                                        <div class="alert alert-red alert-small alert-notification">Silahkan membayar ke Penjual (<?=$data['customer_nm']?>), dengan Total Pembayaran dan No Rekening Penjual ada dibawah</div>
                                                    <?php endif; ?>
                                                    <?php if ($data['bayar_customer_st'] == '1'): ?>
                                                        <div class="alert alert-green alert-small alert-notification"><i class="fa fa-credit-card-alt"></i> Anda sudah membayar ke Penjual ini</div>
                                                        <?php if ($check_kirim_st == ''): ?>
                                                            <div class="alert alert-green alert-small alert-notification"><i class="fa fa-check-square-o"></i> Penjual sudah memverifikasi pembayaran Anda</div>
                                                        <?php else: ?>
                                                            <div class="alert alert-green alert-small alert-notification"><i class="fa fa-check-square-o"></i> Penjual sedang memverifikasi pembayaran Anda</div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php 
                                                    if ($check_kirim_st == ''): 
                                                    //
                                                    $estimasi_tgl = date('Y-m-d', strtotime('+'.$data['estimasi_sampai'].' days', strtotime($data['kirim_date'])));
                                                    ?>
                                                    <div class="alert alert-green alert-small alert-notification"><i class="fa fa-truck"></i> Produk Anda Sudah di Kirim | Pada : <?=convert_date_indo($data['kirim_date'])?></div>
                                                    <div class="alert alert-green alert-small alert-notification"><i class="fa fa-clock-o"></i> Estimasi Sampai <?=$data['estimasi_sampai']?> Hari | Perkiraan Tiba Pada : <?=convert_date_indo($estimasi_tgl)?></div>
                                                        <?php if ($data['diterima_st'] == '1'): ?>
                                                            <div class="alert alert-green alert-small alert-notification"><i class="fa fa-check"></i> Transaksi Selesai</div>
                                                        <?php else: ?>
                                                            <div class="alert alert-blue alert-small alert-notification"><i class="fa fa-check"></i> Silahkan Konfirmasi jika produk sudah sampai, klik <u>Sudah Terima?</u></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php
                                                $list_product = $this->checkout_model->list_checkout_by_customer_id($data['billing_id'], $data['customer_id']);
                                                //
                                                $total_payment = 0;
                                                foreach ($list_product as $product):
                                                $total_payment += $product['product_sub_price'];
                                                ?>
                                                <div class="body-detail-shopping">
                                                    <a href="javascript:void(0)"><img src="<?=base_url()?>assets/images/produk/<?=$product['first_image']['image_name']?>" class="img-thumbnail img-detail-shopping"></a>
                                                    <div>
                                                        <span class="title-product-detail"><?=$product['product_nm']?></span>
                                                        <label class="pull-right label label-danger" style="font-size: 14px;">Rp <?=digit($product['product_sub_price'])?></label>
                                                    </div>
                                                    <label class="label label-primary">Jumlah : <?=$product['product_qty']?> <?=$product['product_qty_unit']?></label>
                                                    <div class="customer-detail-shopping"><br>
                                                        <!-- <img src="<?=base_url()?>assets/images/icon/man-icon-2.png" style="width: 13px;"> Nama Penjual -->
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>

                                                <?php if($data['bayar_customer_st'] == '2'): ?>
                                                <div class="bold" style="padding-bottom: 5px;">Data Rekening Bank (<?=$data['customer_nm']?>)</div>
                                                <div class="col-md-6 row">
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
                                                <div class="col-md-6">
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
                                                <?php endif; ?>
                                            </div>
                                            <div class="panel-footer">
                                                <table class="no-border" style="margin-bottom: -20px; margin-top: -5px;">
                                                    <tr>
                                                        <td class="no-border" style="width: 50%;">
                                                            <div class="form-group">
                                                                <label>Jasa Pengiriman</label>
                                                                <div style="color: green; font-weight: bold;"><?=($data['jasa_nm'] !='') ? $data['jasa_nm'] : '-'?></div>
                                                            </div>
                                                        </td>
                                                        <td class="no-border" style="width: 50%;">
                                                            <div class="form-group">
                                                                <label>No. Resi</label>
                                                                <div style="color: green; font-weight: bold;"><?=($data['no_resi'] !='') ? $data['no_resi'] : '-'?></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading bold">Data Transaksi</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>No Transaksi</label>
                                            <div class="text-invoice"><b><?=$main['billing_id']?></b></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pembeli</label>
                                            <div class="text-invoice bold" style="color: blue;"><?=($main['customer_id_pembeli'] !='') ? $main['customer_nm'] : $main['pembeli_nm']?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tgl Pembelian</label>
                                            <div class="text-invoice"><?=convert_date_indo($main['billing_date'])?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Catatan Pembeli</label>
                                            <div class="text-invoice"><?=($main['billing_desc'] !='') ? $main['billing_desc'] : '-'?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Pengiriman</label>
                                            <div style="font-size: 15px;">
                                                <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_address'] : $main['pembeli_address'] ?></p>
                                                <p>Kelurahan <?=$main['kelurahan']?>, Kecamatan <?=$main['kecamatan']?>, <?=$main['kabupaten']?>, <?=$main['provinsi']?>, <?=($main['customer_id_pembeli'] !='') ? $main['customer_kodepos'] : $main['pembeli_kodepos'] ?></p>
                                                <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_phone'] : $main['pembeli_phone'] ?></p>
                                            </div>
                                            <div class="cart-line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <center>
                            <div class="alert alert-red">Transaksi yang Anda Cari Tidak Ada</div>
                            <a href="<?=site_url('web/location/transactions')?>" class="btn btn-primary bold" style="margin-top: -8px;"><i class="fa fa-search"></i> Cari Lagi</a>
                        </center>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
</div>


<!-- Modal -->
<?php foreach ($list_seller as $data): ?>
<div class="modal fade" id="Modal-<?=$data['customer_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?=site_url('transactions/upload_photo/'.$data['billing_id'].'/'.$data['customer_id'])?>" method="post" enctype="multipart/form-data" id="form-validate">  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Foto Bukti Transfer</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Upload Foto bukti transfer Anda ke Penjual (<font color="blue"><?=$data['customer_nm']?></font>)</label>
            <input type="file" name="bayar_customer_img" class="form-control span6">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger bold" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
        <button type="submit" class="btn btn-primary bold" id="myButtonId">Kirim <i class="fa fa-send"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>
<style type="text/css">
    .swal-button--danger {
        background-color: #5cb85c;
    }
    .swal-button--cancel {
        background-color: #d9534f;
        color: white;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){

        <?php foreach ($list_seller as $data): ?>
        $("#clear-<?=$data['customer_id']?>").click(function(e) {
          e.preventDefault()
            swal({
              title: "",
              text: "Apakah Produk yang Anda beli sudah diterima ?",
              icon: "warning",
              buttons: {
                cancel: "Belum",
                danger: {
                  text: "Sudah",
                },
              },
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location="<?=site_url('transactions/confirm_clear/'.$data['billing_id'].'/'.$data['customer_id'].'/'.$email)?>";
                        swal({
                          title: "",
                          text: "Terimakasih",
                          icon: "success",
                          buttons: "Oke",
                        })
                } else {
                    
                }
            });
        });
        <?php endforeach; ?>

    });
</script>