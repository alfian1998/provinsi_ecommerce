<script type="text/javascript">
    $(function() {
        
    });
</script>
<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="panel-left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel-body-center">
                                <img src="http://localhost:8080/jts/simtel/assets/images/user/default.png" width="100px">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel-body-center">
                                <div><b>Username</b></div>
                                <div><?=$config['profile']['user_name']?></div>
                                <div><b>Realname</b></div>
                                <div><?=$config['profile']['user_realname']?></div>
                                <div><b>Last Login</b></div>
                                <div><?=convert_date_indo($config['profile']['last_login'])?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b><i class="fa fa-pencil"></i> Edit Status Pembelian</b></div>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table style="width: 100%" class="table-no-border">
                                <div class="alert alert-red">
                                    <i class="fa fa-warning"></i> Silahkan cek Rekening Anda dahulu apakah transfer sudah masuk sebelum mengganti Status menjadi <u>Sudah Dibayar</u>
                                </div>
                                <tr>
                                    <td width="18%"><div class="span10">No Transaksi</div></td>
                                    <td width="82%">
                                        <div class="span3">
                                            <input type="text" name="" class="form-control" value="<?=@$main['billing_id']?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Pembeli</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="" class="form-control" value="<?=(@$main['customer_id'] !='') ?  @$main['customer_nm'] : @$main['pembeli_nm']?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nominal</div></td>
                                    <td width="82%">
                                        <div class="span2">
                                            <input type="text" name="" class="form-control" value="Rp <?=digit(@$main['product_total_price'])?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <?php if (@$main['transfer_st'] == '2'): ?>
                                <tr>
                                    <td width="18%"><div class="span10">Bukti Transfer</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <a href="<?=site_url('assets/images/transfer/'.@$main['transfer_img'])?>" target="_blank">
                                            <img src="<?=base_url()?>assets/images/transfer/<?=@$main['transfer_img']?>" style="width: 200px;" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <span class="alert-product">* Klik Gambar untuk memperbesar</span>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td width="18%"><div class="span10">Status</div></td>
                                    <td width="82%">
                                        <div class="span2">
                                            <select class="select-chosen" name="bayar_st">
                                                <option value="1" <?php if(@$main['bayar_st'] == 1) echo 'selected'?>>Sudah Bayar</option>
                                                <option value="2" <?php if(@$main['bayar_st'] == 2) echo 'selected'?>>Belum Bayar</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url("webmin")?>">Kembali</a>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>