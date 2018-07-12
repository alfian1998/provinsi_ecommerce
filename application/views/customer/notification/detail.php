<script type="text/javascript">
    $(function() {
        
    });
</script>
<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">

            <?php $this->load->view('public/main/sidebar-menu');?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->

                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Detail Data Pembeli</div>
                        <div class="panel-body">
                            
                            <div class="col-md-12">
                                <?php if ($get_data_checkout['diterima_st'] == '1'): ?>
                                    <div class="alert alert-green">
                                        <i class="fa fa-check"></i> Produk sudah diterima oleh Pembeli
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-red">
                                        <li>Anda akan menerima uang sebesar <u>Rp <?=digit($jumlah_harga['jumlah_harga'])?></u>, dari Pembeli</li>
                                        <li>Jika Uang sudah masuk ke Rekening Bank Anda maka Anda harus segera mengirim produk yang telah di pesan Pembeli</li>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <div class="panel-content" style="margin-top: -26px;">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading bold"> Data Transaksi</div>
                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th width="35%">No Transaksi</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><b><?=$main['billing_id']?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Pembeli</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><font class="bold" style="color: blue;"><?=($main['customer_id'] !='') ? $main['customer_nm'] : $main['pembeli_nm']?></font></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nominal yang Diterima</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><div class="bold" style="color: red; font-size: 18px;">Rp <?=digit($jumlah_harga['jumlah_harga'])?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tgl Pembelian</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=convert_date_indo($main['billing_date'])?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Catatan Pembeli</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=$main['billing_desc']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Bayar</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td>
                                                            <?php if ($get_data_checkout['bayar_customer_st'] == '1'): ?>
                                                            <label class="label label-success label-font">Sudah Bayar</label>
                                                            <?php elseif ($get_data_checkout['bayar_customer_st'] == '2'): ?>
                                                            <label class="label label-warning label-font">Belum Bayar</label>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tgl Bayar</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=($get_data_checkout['bayar_customer_date'] !='') ? convert_date_indo($get_data_checkout['bayar_customer_date']) : '-'?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bukti Transfer Pembeli</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td>
                                                            <?php if ($get_data_checkout['bayar_customer_st'] == '1'): ?>
                                                            <a target="_blank" href="<?=site_url('assets/images/transfer_pembeli/'.$get_data_checkout['bayar_customer_img'])?>"><img src="<?=base_url()?>assets/images/transfer_pembeli/<?=$get_data_checkout['bayar_customer_img']?>" class="img-thumbnail"></a>
                                                            <?php else: ?>
                                                            -
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Kirim</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td>
                                                            <?php if ($check_kirim_st !=''): ?>
                                                                <label class="label label-danger label-font">Belum Kirim</label>
                                                            <?php else: ?>
                                                                <label class="label label-success label-font">Sudah Kirim</label>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tgl Kirim</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=($get_kirim_date['kirim_date'] !='') ? convert_date_indo($get_kirim_date['kirim_date']) : '-' ?></td>
                                                    </tr>
                                                    <?php if ($get_data_checkout['diterima_st'] == '1'): ?>
                                                    <tr>
                                                        <th>Status Transaksi</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><font class="bold" style="color: green; text-decoration: underline;">Transaksi SELESAI</font></td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <a class="btn btn-success" href="<?=site_url("notification")?>">Kembali</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel-content" style="margin-top: -26px;">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading bold">Data Produk yang dibeli</div>
                                        <div class="panel-body">
                                            <?php if ($main['bayar_st'] == '1'): ?>
                                                <?php if($check_kirim_st !=''): ?>
                                                <div class="alert alert-red alert-small faa-vertical animated">Harap segera kirim Produk di bawah ini ke Alamat Pembeli</div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php foreach ($list_product as $data): ?>
                                            <div class="body-detail-shopping">
                                                <a href="javascript:void(0)"><img src="<?=base_url()?>assets/images/produk/<?=$data['first_image']['image_name']?>" class="img-thumbnail img-detail-shopping"></a>
                                                <div>
                                                    <span class="title-product-detail"><?=$data['product_nm']?></span>
                                                    <label class="pull-right label label-danger" style="font-size: 14px;">Rp <?=digit($data['product_sub_price'])?></label>
                                                </div>
                                                <label class="label label-primary">Jumlah : <?=$data['product_qty']?> <?=$data['product_qty_unit']?></label>
                                                <div class="customer-detail-shopping"><img src="<?=base_url()?>assets/images/icon/man-icon-2.png" style="width: 13px;"> <?=($data['customer_nm'] == $config['profile']['customer_nm']) ? '<b><u>Ini Adalah Produk Anda</u></b>' : $data['customer_nm']?></div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-content" style="margin-top: -26px;">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading bold">Data Pembeli</div>
                                        <div class="panel-body">
                                            <?php if ($main['bayar_st'] == '1'): ?>
                                                <?php if($check_kirim_st !=''): ?>
                                                <div class="alert alert-red alert-small">Jika Anda sudah mengirimkan barang ke Alamat pembeli, segera Konfirmasi disini <a href="<?=site_url('notification/form/'.$main['billing_id'])?>" class="btn btn-xs btn-default" style="color: black; font-weight: bold;">Konfirmasi</a></div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th width="35%">Email Pembeli</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><b><?=($main['customer_id_pembeli'] !='') ? $main['customer_email'] : $main['pembeli_email'] ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">No Telp Pembeli</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><b><?=($main['customer_id_pembeli'] != '') ? $main['customer_phone'] : $main['pembeli_phone']?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="panel panel-default">
                                                <div class="panel-heading"><img src="<?=base_url()?>assets/images/<?=($main['customer_id_pembeli'] !='') ? 'customer/'.$main['customer_img'] : 'icon/no-customer-img.jpg' ?>" class="img-circle img-customer-checkout"> <b><?=$main['customer_nm']?> <label class="pull-right label label-primary" style="font-size: 13px; margin-top: 2px; padding-top: 6px; padding-bottom: 6px;"><b><i class="fa fa-home"></i> Informasi Alamat</b></label></b></div>
                                                <div class="panel-body">
                                                    <div class="col-md-12 row">
                                                        <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_address'] : $main['pembeli_address'] ?></p>
                                                        <p>Kelurahan <?=$main['kelurahan']?>, Kecamatan <?=$main['kecamatan']?>, <?=$main['kabupaten']?>, <?=$main['provinsi']?>, <?=($main['customer_id_pembeli'] !='') ? $main['customer_kodepos'] : $main['pembeli_kodepos'] ?></p>
                                                        <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_phone'] : $main['pembeli_phone'] ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /content -->
		    </div>
	    </div>
    </div>
</div>
</div>