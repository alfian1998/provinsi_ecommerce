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
                                                        <td><?=($main['customer_id'] !='') ? $main['customer_nm'] : $main['pembeli_nm']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Nominal</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td>
                                                            <label class="label label-primary label-font">Rp <?=digit($main['product_total_price'])?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Tgl Pembelian</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=convert_date_indo($main['checkout_date'])?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Status Bayar</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td>
                                                            <?php if ($main['transfer_st'] == '2'): ?>
                                                            <label class="label label-primary label-font">Menunggu Konfirmasi Admin</label>
                                                            <?php else: ?>
                                                                <?php if ($main['bayar_st'] == '1'): ?>
                                                                <label class="label label-success label-font">Sudah Bayar</label>
                                                                <?php elseif ($main['bayar_st'] == '2'): ?>
                                                                <label class="label label-warning label-font">Belum Bayar</label>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Tgl Bayar</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=($main['bayar_date'] !='') ? convert_date_indo($main['transfer_date']) : '-'?></td>
                                                    </tr>
                                                    <tr>
                                                        <th width="35%">Status Kirim</th>
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
                                                        <th width="35%">Tgl Kirim</th>
                                                        <td align="center" width="6%"><b>:</b></td>
                                                        <td><?=($get_kirim_date['kirim_date'] !='') ? convert_date_indo($get_kirim_date['kirim_date']) : '-' ?></td>
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