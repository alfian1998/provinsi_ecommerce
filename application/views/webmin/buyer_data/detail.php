<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
            <div class="col-md-12">
            <div class="block block-breadcrumbs">
                <ul>
                    <li class="home">
                        <a href="<?=site_url('webmin/location/')?>"><i class="fa fa-home" style="font-size: 18px;"></i></a>
                        <span></span>
                    </li>
                    <li><a href="<?=site_url('webmin/location/buyer_data')?>">Data Pembeli</a><span></span></li>
                    <li>Detail Data (<?=$main['billing_id']?>)</li>
                </ul>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data Pembeli</b></div>
                        <div class="panel-body">
                            
                            <div class="col-xs-12 col-sm-12 col-md-5">
                                <div class="panel-content panel-style">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading bold">Data Transaksi</div>
                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th width="35%">No Transaksi</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><b><?=$main['billing_id']?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Nama Pembeli</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><div class="bold" style="color: blue;"><?=($main['customer_id'] !='') ? $main['customer_nm'] : $main['pembeli_nm']?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Nominal</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td>
                                                            <div class="bold" style="color: red; font-size: 18px;">Rp <?=digit($main['product_total_price'])?></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Tgl Pembelian</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=convert_date_indo($main['billing_date'])?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Catatan Pembeli</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=$main['billing_desc']?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="panel-content panel-style">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading bold">Data Alamat Pembeli</div>
                                        <div class="panel-body">
                                            <div class="col-md-12 row">
                                                <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_address'] : $main['pembeli_address'] ?></p>
                                                <p>Kelurahan <?=$main['kelurahan']?>, Kecamatan <?=$main['kecamatan']?>, <?=$main['kabupaten']?>, <?=$main['provinsi']?>, <?=($main['customer_id_pembeli'] !='') ? $main['customer_kodepos'] : $main['pembeli_kodepos'] ?></p>
                                                <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_phone'] : $main['pembeli_phone'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="panel-content panel-style">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading bold">Data Pembeli (<?=($main['customer_id'] !='') ? $main['customer_nm'] : $main['pembeli_nm']?>)</div>
                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th width="35%">Email</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=($main['customer_id'] !='') ? $main['customer_email'] : $main['pembeli_email']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">No Telpon</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=($main['customer_id'] !='') ? $main['customer_phone'] : $main['pembeli_phone']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Provinsi</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=$main['provinsi']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Kabupaten</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=$main['kabupaten']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Kecamatan</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=$main['kecamatan']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Kelurahan</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=$main['kelurahan']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Kode Pos</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=($main['customer_id'] !='') ? $main['customer_kodepos'] : $main['pembeli_kodepos']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Alamat Lengkap</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td>
                                                            <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_address'] : $main['pembeli_address'] ?></p>
                                                            <p>Kelurahan <?=$main['kelurahan']?>, Kecamatan <?=$main['kecamatan']?>, <?=$main['kabupaten']?>, <?=$main['provinsi']?>, <?=($main['customer_id_pembeli'] !='') ? $main['customer_kodepos'] : $main['pembeli_kodepos'] ?></p>
                                                            <p><?=($main['customer_id_pembeli'] !='') ? $main['customer_phone'] : $main['pembeli_phone'] ?></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-7">
                                <div class="panel-content panel-style">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading bold">Daftar Pembelian</div>
                                        <div class="panel-body">
                                                <?php 
                                                foreach ($list_seller as $data): 
                                                //
                                                $check_kirim_st = $this->checkout_model->check_kirim_st($data['billing_id'], $data['customer_id']);
                                                $get_data_checkout = $this->checkout_model->get_checkout_by_billing_and_customer_id($data['billing_id'], $data['customer_id']);
                                                ?>
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <img src="<?=base_url()?>/assets/images/customer/<?=$data['customer_img']?>" class="img-circle img-customer-checkout"> <b style="color: #333;"><?=$data['customer_nm']?></b> 
                                                        <?php if ($get_data_checkout['diterima_st'] == '1'): ?>
                                                            <label class="pull-right label label-success label-heading"><b><i class="fa fa-check"></i> Transaksi Selesai</b></label>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="panel-notification">
                                                            <?php if ($get_data_checkout['bayar_customer_st'] == '2'): ?>
                                                                <div class="alert alert-red alert-small alert-notification"><i class=" fa fa-credit-card-alt"></i> Pembeli belum membayar</div>
                                                            <?php endif; ?>
                                                            <?php if ($get_data_checkout['bayar_customer_st'] == '1'): ?>
                                                                <div class="alert alert-green alert-small alert-notification"><i class="fa fa-credit-card-alt"></i> Pembeli sudah membayar ke Penjual ini</div>
                                                                <?php if ($check_kirim_st == ''): ?>
                                                                    <div class="alert alert-green alert-small alert-notification"><i class="fa fa-check-square-o"></i> Penjual sudah memverifikasi pembayaran</div>
                                                                <?php else: ?>
                                                                    <div class="alert alert-green alert-small alert-notification"><i class="fa fa-check-square-o"></i> Penjual sedang memverifikasi pembayaran</div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <?php 
                                                            if ($check_kirim_st == ''): 
                                                            //
                                                            $estimasi_tgl = date('Y-m-d', strtotime('+'.$get_data_checkout['estimasi_sampai'].' days', strtotime($get_data_checkout['kirim_date'])));
                                                            ?>
                                                            <div class="alert alert-green alert-small alert-notification"><i class="fa fa-truck"></i> Produk Sudah di Kirim | Pada : <?=convert_date_indo($get_data_checkout['kirim_date'])?></div>
                                                            <div class="alert alert-green alert-small alert-notification"><i class="fa fa-clock-o"></i> Estimasi Sampai <?=$get_data_checkout['estimasi_sampai']?> Hari | Perkiraan Tiba Pada : <?=convert_date_indo($estimasi_tgl)?></div>
                                                                <?php if ($get_data_checkout['diterima_st'] == '1'): ?>
                                                                    <div class="alert alert-green alert-small alert-notification"><i class="fa fa-check"></i> Transaksi Selesai</div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                        </div>
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
                                                                        <div style="color: green; font-weight: bold;"><?=($get_data_checkout['jasa_nm'] !='') ? $get_data_checkout['jasa_nm'] : '-'?></div>
                                                                    </div>
                                                                </td>
                                                                <td class="no-border" style="width: 50%;">
                                                                    <div class="form-group">
                                                                        <label>No. Resi</label>
                                                                        <div style="color: green; font-weight: bold;"><?=($get_data_checkout['no_resi'] !='') ? $get_data_checkout['no_resi'] : '-'?></div>
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