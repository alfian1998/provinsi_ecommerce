<script type="text/javascript">
    $(function() {
        __show_result();
        function __show_result() {
            $.get('<?=site_url('notification/buyer')?>',null,function(data) {
                $('#box_result').html(data.html);
            },'json');
        }
        var auto_refresh = setInterval(function () {
            __show_result();
        }, 25000);
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
                        <h5 class="vertical-title">Status Deposit <!-- <span class="pull-right"><i class="fa fa-bars"></i></span> --></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="<?=site_url('web/location/send')?>" class="background-font"><i class="icon-category fa fa-send"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Sudah Dikirim</a>
                            </li>
                            <li >
                                <a href="<?=site_url('web/location/not_send')?>" class="background-font"><i class="icon-category fa fa-arrow-left"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Belum Dikirim</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Menu <!-- <span class="pull-right"><i class="fa fa-bars"></i></span> --></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="<?=site_url('web/location/notification')?>" class="background-font"><i class="icon-category fa fa-dollar" style="margin-left: 22px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png"><b>Data Pembeli</b></a>
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
                        <div class="panel-heading">Data Pembeli Produk Anda</div>
                        <div class="panel-body">
                            <div class="alert alert-red alert-small">
                                <li>Status pembelian akan dirubah oleh Admin DKP Jateng apabila pembeli sudah transfer ke rekening Admin DKP Jateng</li>
                                <li>Data akan otomatis berubah jika Admin DKP Jateng sudah merubah status</li>
                                <li>Klik tombol <u>Konfirmasi Sudah Kirim</u> untuk konfirmasi <u>Sudah Dikirim</u></li>
                                <li>Uang Anda akan di transfer oleh Admin DKP Jateng lewat No Rekening Bank Anda setelah produk diterima oleh Pembeli</li>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th width="2%" class="text-center">No</th>
                                        <th width="8%" class="text-center">Aksi</th>
                                        <th>Nama Pembeli</th>
                                        <th width="15%" class="text-center">No Transaksi</th>
                                        <th width="20%">Nominal yang Diterima</th>
                                        <th width="25%">Status</th>
                                      </tr>
                                    </thead>
                                    <tbody id="box_result">                         
                                        <tr><td colspan="5">Loading content ...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        
                    </div>
                </div>
                
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>
</div>