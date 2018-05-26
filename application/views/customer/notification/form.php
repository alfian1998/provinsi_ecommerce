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
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Menu <!-- <span class="pull-right"><i class="fa fa-bars"></i></span> --></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="<?=site_url('web/location/notification')?>" class="background-font"><i class="icon-category fa fa-bell"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png"><b>Notifikasi</b></a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/selling')?>" class="background-font"><i class="icon-category fa fa-folder" style="margin-left: 19px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Jualan Saya</a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/profile')?>" class="background-font"><i class="icon-category fa fa-user" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-12.png">Profil</a>
                            </li>
                            <li>
                                <a id="logout2" href="#" class="background-font"><i class="icon-category fa fa-power-off" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-9.png">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->

                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Detail Data Pembeli</div>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <div class="alert alert-red">
                                    <i class="fa fa-warning"></i> Jika Anda sudah mengirimkan Produk Anda ke Pembeli sikahkan ubah Status Menjadi <u>Sudah Terkirim</u>
                                </div>
                                <tr>
                                    <td width="18%"><div class="span10">No Transaksi</div></td>
                                    <td width="82%">
                                        <div class="span3">
                                            <input type="text" name="" class="form-control" value="<?=@$billing['billing_id']?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Pembeli</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="" class="form-control" value="<?=(@$billing['customer_id'] !='') ?  @$billing['customer_nm'] : @$billing['pembeli_nm']?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nominal yang Diterima</div></td>
                                    <td width="82%">
                                        <div class="span2">
                                            <input type="text" name="" class="form-control" value="Rp <?=digit($jumlah_harga['jumlah_harga'])?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Status</div></td>
                                    <td width="82%">
                                        <div class="span2">
                                            <select class="select-chosen" name="kirim_st">
                                                <option value="1" <?php if($check_kirim_st =='') echo 'selected'?>>Sudah Kirim</option>
                                                <option value="2" <?php if($check_kirim_st !='') echo 'selected'?>>Belum Kirim</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Jasa</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="jasa_nm" class="form-control" value="<?=$get_checkout['jasa_nm']?>">
                                        </div>
                                        <span class="alert-product">* Jika Anda menggunakan Jasa Pengiriman Barang, silahkan isi kolom Nama Jasa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nomor Resi</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="no_resi" class="form-control" value="<?=$get_checkout['no_resi']?>">
                                        </div>
                                        <span class="alert-product">* Jika Anda menggunakan Jasa Pengiriman Barang, silahkan isi kolom Nomor Resi</span>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url("notification")?>">Kembali</a>
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