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
                        <?php if ($main['bayar_st'] == '1'): ?>
                        <div class="alert alert-green alert-small">
                            <li>Anda sudah Transfer ke Admin DKP Jateng pada tanggal <?=convert_date_indo($main['transfer_date'])?> dan dikonfirmasi tanggal <?=convert_date_indo($main['bayar_date'])?></li>
                            <?php if ($main['diterima_st'] == '1'): ?>
                                <!-- Kosong -->
                            <?php else: ?>
                            <li>Jika Anda sudah menerima semua produk, silahkan klik tombol Konfirmasi Sudah Diterima Semua</li>
                            <li>Jika dalam 3 X 24 Jam Anda tidak konfirmasi Sudah Dikirim maka status akan otomatis Sudah Diterima Semua</li>
                            <?php endif; ?>
                        </div>

<?php if ($main['diterima_st'] == ''): ?>
    <div class="hidden">
                        <div id="clockdiv">
<div>
    <span class="days" id="day"></span>
    <div class="smalltext">Days</div>
</div>
<div>
    <span class="hours" id="hour"></span>
    <div class="smalltext">Hours</div>
</div>
<div>
    <span class="minutes" id="minute"></span>
    <div class="smalltext">Minutes</div>
</div>
<div>
    <span class="seconds" id="second"></span>
    <div class="smalltext">Seconds</div>
</div>
</div>
</div>
<?php endif; ?>

                        <?php if ($main['diterima_st'] == '1'): ?>
                        <div class="alert alert-blue alert-small"><i class="fa fa-check"></i> Produk sudah Anda terima, Terima Kasih</div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="row">
                            <?php if ($main['bayar_st'] == '2'): ?>
                            <div style="width: 100%; float: left;">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bold">Nomor Rekening Admin DKP Jawa Tengah</div>
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

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bold">Bukti Transfer</div>
                                        <div class="panel-body">
                                            <?php if ($main['transfer_st'] == '2'): ?>
                                            <div class="alert alert-green alert-small">Anda Sudah mengirimkan Bukti Transfer, harap menunggu konfirmasi dari Admin DKP Jateng</div>
                                            <?php endif; ?>
                                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                            <div class="form-group">
                                                <label>Upload Bukti Transfer</label>
                                                <?php if ($main['transfer_st'] == '2'): ?>
                                                <input type="file" class="form-control" name="transfer_img" value="<?=$main['transfer_img']?>" readonly="">
                                                <?php else: ?>
                                                <input type="file" class="form-control" name="transfer_img" required="">
                                                <?php endif; ?>
                                                <span class="alert-product">* Jika Anda telah Transfer ke Rekening Admin DKP Jateng, silahkan Foto bukti Transfer lalu upload</span>
                                            </div>
                                            <?php if ($main['transfer_st'] == '2'): ?>
                                            <button class="btn btn-primary" disabled=""><b><i class="fa fa-upload"></i> Upload</b></button>
                                            <?php else: ?>
                                            <button type="submit" class="btn btn-primary"><b><i class="fa fa-upload"></i> Upload</b></button>
                                            <?php endif; ?>
                                            </form>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading bold">Daftar Pembelian 
                                        <?php if ($get_checkout_kirim_st == '0'): ?>
                                            <?php if ($main['diterima_st'] == '1'): ?>
                                                <!-- Kosong -->
                                            <?php else: ?>
                                                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-primary pull-right bold faa-pulse animated faa-fast">Konfirmasi Sudah Diterima Semua</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-body">
                                        <?php 
                                        foreach ($list_seller as $data): 
                                        //
                                        $check_kirim_st = $this->checkout_model->check_kirim_st($data['billing_id'], $data['customer_id']);
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <img src="<?=base_url()?>/assets/images/customer/<?=$data['customer_img']?>" class="img-circle img-customer-checkout"> <b><?=$data['customer_nm']?></b> 
                                                <?php if ($check_kirim_st == ''): ?>
                                                <label class="pull-right label label-success label-heading"><b>Sudah Kirim</b></label>
                                                <?php elseif ($check_kirim_st != ''): ?>
                                                <label class="pull-right label label-danger label-heading"><b>Belum Kirim</b></label>
                                                <?php endif; ?>
                                            </div>
                                            <div class="panel-body">
                                                <?php if ($check_kirim_st ==''): ?>
                                                <div class="alert alert-green alert-small">Tanggal Kirim : <?=convert_date_indo($data['kirim_date'])?></div>
                                                <?php endif; ?>
                                                <?php
                                                $list_product = $this->checkout_model->list_checkout_by_customer_id($data['billing_id'], $data['customer_id']);
                                                //
                                                foreach ($list_product as $product):
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
                                            </div>
                                            <div class="panel-footer">
                                                <table class="no-border" style="margin-bottom: -20px; margin-top: -5px;">
                                                    <tr>
                                                        <td class="no-border" style="width: 50%;">
                                                            <div class="form-group">
                                                                <label>Jasa Pengiriman</label>
                                                                <div><?=($data['jasa_nm'] !='') ? $data['jasa_nm'] : '-'?></div>
                                                            </div>
                                                        </td>
                                                        <td class="no-border" style="width: 50%;">
                                                            <div class="form-group">
                                                                <label>No. Resi</label>
                                                                <div><?=($data['no_resi'] !='') ? $data['no_resi'] : '-'?></div>
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
                            <div class="col-md-6">
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
                                            <div class="text-invoice"><?=($main['customer_id_pembeli'] !='') ? $main['customer_nm'] : $main['pembeli_nm']?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tgl Pembelian</label>
                                            <div class="text-invoice"><?=convert_date_indo($main['billing_date'])?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Pembayaran</label>
                                            <div class="text-invoice-price">Rp <?=digit($main['product_total_price'])?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Catatan Pembeli</label>
                                            <div class="text-invoice"><?=($main['billing_desc'] !='') ? $main['billing_desc'] : '-'?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Bayar</label>
                                            <div class="text-invoice">
                                                <?php if ($main['transfer_st'] == '2'): ?>
                                                <label class="label label-primary">Menunggu Konfirmasi Admin</label>
                                                <?php else: ?>
                                                <?=($main['bayar_st'] =='2') ? '<label class="label label-warning">Belum Bayar</label>' : '<label class="label label-success">Sudah Bayar</label>'?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <?php if ($main['bayar_st'] == '1'): ?>
                                        <div class="form-group">
                                            <label>Tgl Bayar</label>
                                            <div class="text-invoice"><?=convert_date_indo($main['transfer_date'])?></div>
                                            <div class="cart-line"></div>
                                        </div>
                                        <?php endif; ?>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?=site_url('transactions/update_confirm/'.$main['billing_id'])?>" method="post" enctype="multipart/form-data" id="form-validate">  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfimasi bila produk sudah Anda terima Semua</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Konfirmasi</label>
            <select class="chosen-select span3" name="diterima_st">
                <option value="1">Sudah Diterima</option>
                <option value="2">Belum Diterima</option>
            </select>
            <span class="alert-product">* Silahkan pilih <u>Sudah Diterima</u> apabila produk sudah Anda terima semua</span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="myButtonId">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php if ($main['diterima_st'] == ''): ?>
<?php
$date = date_create($get_kirim_date['kirim_date']);
date_add($date, date_interval_create_from_date_string('4 days'));
$finish_date = date_format($date, 'M d, Y H:i:s');
?>
<script>
    var deadline = new Date("<?=$finish_date?>").getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var t = deadline - now;
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        document.getElementById("day").innerHTML =days ;
        document.getElementById("hour").innerHTML =hours;
        document.getElementById("minute").innerHTML = minutes; 
        document.getElementById("second").innerHTML =seconds; 
            if (t < 0) {
                clearInterval(x);
                document.getElementById("myButtonId").click();
                document.getElementById("day").innerHTML ='0';
                document.getElementById("hour").innerHTML ='0';
                document.getElementById("minute").innerHTML ='0' ; 
                document.getElementById("second").innerHTML = '0'; 
            }
    }, 1000);
</script>
<?php endif; ?>