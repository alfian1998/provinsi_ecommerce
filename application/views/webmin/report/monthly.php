<style type="text/css">
.swal-text {
    color: red;
    font-weight: bold;
    font-size: 16px;
}
.swal-button {
    background-color: red;
    font-weight: bold;
}
</style>
<script type="text/javascript">
$(function() {
    $(".checkbox-option").change(function() {
        $(".checkbox-option").prop('checked',false);
        $(this).prop('checked',true);
    });
});
</script>
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
                    <li>Laporan Data</li>
                </ul>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Cetak Laporan Data</b></div>
                        <div class="panel-body">
                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li><a href="<?=site_url('webmin/location/report')?>">Laporan Harian</a></li>
                                    <li><a href="javascript:void(0)" class="active">Laporan Bulanan</a></li>
                                </ul>
                            </div>
                            <div class="body-profile">
                                <form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                <table width="100%" class="table-no-border">
                                    <tr>
                                        <td width="18%"><div class="span10">Bulan Pembelian</div></td>
                                        <td width="82%">
                                            <div class="span2">
                                                <select class="select-chosen" name="ses_bulan">
                                                    <option value="">-- Semua Bulan --</option>
                                                    <?php foreach (list_bulan() as $id_bulan => $bulan): ?>
                                                        <option value="<?=$id_bulan?>" <?php if($id_bulan == @$ses_bulan) echo 'selected'?>><?=$bulan?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span10">Tahun Pembelian</div></td>
                                        <td width="82%">
                                            <div class="span2">
                                                <select class="select-chosen" name="ses_tahun">
                                                    <option value="">-- Semua Tahun --</option>
                                                    <?php foreach ($list_tahun as $tahun): ?>
                                                        <option value="<?=$tahun['tahun']?>" <?php if($tahun['tahun'] == @$ses_tahun) echo 'selected'?>><?=$tahun['tahun']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span10">Status Pembelian</div></td>
                                        <td width="82%">
                                            <div class="span4">
                                                <select class="select-chosen" name="ses_status">
                                                    <option value="">-- Semua Status --</option>
                                                    <option value="sudah_bayar" <?php if('sudah_bayar' == @$ses_status) echo 'selected'?>>Sudah Bayar</option>
                                                    <option value="belum_bayar" <?php if('belum_bayar' == @$ses_status) echo 'selected'?>>Belum Bayar</option>
                                                    <option value="konfirmasi" <?php if('konfirmasi' == @$ses_status) echo 'selected'?>>Menunggu Konfirmasi</option>
                                                    <option value="sudah_diterima" <?php if('sudah_diterima' == @$ses_status) echo 'selected'?>>Sudah Diterima</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span10">Pencarian</div></td>
                                        <td width="82%">
                                            <div class="span4">
                                                <input type="text" name="ses_txt_search" class="form-control" placeholder="Kata kunci Nama Pembeli atau No Transaksi" value="<?=@$ses_txt_search?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span10">Tampilan Data</div></td>
                                        <td width="82%">
                                            <div class="span4">
                                                <ul class="check-box-list">
                                                    <li>
                                                        <input type="checkbox" id="ses_tampilan_data_1" name="ses_tampilan_data_1" class="checkbox-option" value="1" <?php if('1' == @$ses_tampilan_data_1) echo 'checked'?>>
                                                        <label for="ses_tampilan_data_1">
                                                        <span class="button"></span>
                                                        Hanya Pembeli
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="ses_tampilan_data_2" name="ses_tampilan_data_2" class="checkbox-option" value="1" <?php if('1' == @$ses_tampilan_data_2) echo 'checked'?>>
                                                        <label for="ses_tampilan_data_2">
                                                        <span class="button"></span>
                                                        Pembeli dan Produk yang Dibeli
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <button type="submit" class="btn btn-primary bold" onclick="if(!this.form.ses_tampilan_data_1.checked && !this.form.ses_tampilan_data_2.checked){swal('', 'Tampilan Data belum Dipilih, Silahkan Pilih Salah satu', 'warning');return false}"><i class="fa fa-search"></i> Proses</button>
                                <a href="<?=site_url('webmin/location/report/monthly')?>" class="btn btn-danger bold"><i class="fa fa-times"></i> Clear</a>
                                <span style="margin-left: 20px;"><b>Keterangan : </b> Kolom Filter di Atas Optional</span>
                                <?php if($filter_search == 'true'):?>
                                    <a href="<?=site_url('webmin_report/export_excel_bulanan')?>" class="btn btn-success bold pull-right"><i class="fa fa-download"></i> Export Excel</a>
                                <?php endif; ?>
                                </form>
                            </div>

                            <?php if($filter_search == 'true'):?>
                            <br>
                            <div class="alert alert-green">
                                <strong>Terdapat : <?=count($list_buyer)?> Pembeli | Untuk Export Dalam Bentuk Excel Klik Tombol Export Excel </strong>
                            </div>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table style="width: 1500px;" class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="2%">No</th>
                                            <th colspan="3">Nama Pembeli</th>
                                            <th class="text-center">No Transaksi</th>
                                            <th class="text-center" width="8%">Nominal</th>
                                            <th class="text-center">Tgl Pembelian</th>
                                            <th class="text-center">Tgl Bayar</th>
                                            <th class="text-center">Tgl Diterima</th>
                                            <th class="text-center">Status Pembelian</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_buyer as $buyer): 
                                            $check_kirim_st = $this->checkout_model->check_kirim_st($buyer['billing_id']);
                                            $list_seller = $this->checkout_model->list_seller_by_billing_id($buyer['billing_id']);
                                            ?>
                                            <tr>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?> align="center"><b><?=$buyer['no']?></b></td>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?> colspan="3"><?=($buyer['customer_id'] !='') ? $buyer['customer_nm'] : $buyer['pembeli_nm'] ?></td>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?> align="center"><b><?=$buyer['billing_id']?></b></td>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?> align="center"><b>Rp <?=digit($buyer['product_total_price'])?></b></td>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?> align="center"><?=convert_date_indo($buyer['billing_date'])?></td>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?> align="center"><?=($buyer['bayar_st'] == '1') ? convert_date_indo($buyer['bayar_date']) : '-' ?></td>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?> align="center"><?=($buyer['diterima_st'] == '1') ? convert_date_indo($buyer['diterima_date']) : '-'?></td>
                                                <td <?=($ses_tampilan_data_2 == '1') ? 'class="info"' : ''?>>
                                                    <?php if ($buyer['diterima_st'] == '1'){ ?>
                                                        (<b><u>Sudah Diterima Pembeli</u></b>)
                                                    <?php }else{ ?>
                                                        <?php if ($buyer['transfer_st'] == '2'){ ?>
                                                            (<b><u>Menunggu Konfirmasi Admin</u></b>)
                                                        <?php }else{ ?>
                                                            <?php if ($buyer['bayar_st'] == '1'){ ?>
                                                                (<b><u>Sudah Bayar</u></b>)
                                                            <?php }elseif($buyer['bayar_st'] == '2'){ ?>
                                                                (<b><u>Belum Bayar</u></b>)
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if ($check_kirim_st == '') { ?>
                                                            (<b><u>Sudah Dikirim Semua</u></b>)
                                                        <?php }elseif($check_kirim_st !='') { ?>
                                                            <?php if ($buyer['bayar_st'] == '1') { ?>
                                                                (<b><u>Belum Dikirim Semua</u></b>)
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <?php if ($ses_tampilan_data_2 == '1'): ?>
                                            <?php foreach ($list_seller as $seller): 
                                            $kirim_st = $this->checkout_model->kirim_st($buyer['billing_id'], $seller['customer_id']);
                                            $list_product = $this->checkout_model->list_checkout_by_customer_id($seller['billing_id'], $seller['customer_id']);
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td class="success" colspan="2"><b><?=$seller['customer_nm']?></b></td>
                                                <td class="success" colspan="6"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="6">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th width="2%">No</th>
                                                                <th>Nama Produk</th>
                                                                <th class="text-center">Jumlah</th>
                                                                <th class="text-center">Nominal Per Produk</th>
                                                                <th class="text-center">Status Pengiriman</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($list_product as $product): ?>
                                                            <tr>
                                                                <td align="center"><?=$product['no']?></td>
                                                                <td><?=$product['product_nm']?></td>
                                                                <td align="center"><?=$product['product_qty']?> <?=$product['product_qty_unit']?></td>
                                                                <td align="center">Rp <?=digit($product['product_price'])?> x <?=$product['product_qty']?> <?=$product['product_qty_unit']?> = <u>Rp <?=digit($product['product_sub_price'])?></u></td>
                                                                <td align="center"><?=($kirim_st['kirim_st'] == '1') ? 'Sudah Dikirim' : 'Belum Dikirim'?></td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>

                                            <?php endforeach; ?>
                                            <?php if(count($list_buyer) == 0):?>
                                                <tr>
                                                    <td colspan="8">Data Tidak Ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
$('#datepicker').datepicker({
    autoclose: true,
    format: "dd-mm-yyyy",
    language: "id",
    todayHighlight: true
});
</script>