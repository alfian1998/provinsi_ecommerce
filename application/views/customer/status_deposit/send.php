<script type="text/javascript">
    $(function() {
        __show_result();
        function __show_result() {
            $.get('<?=site_url('send/buyer')?>',null,function(data) {
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
                                <a href="<?=site_url('web/location/send')?>" class="background-font"><i class="icon-category fa fa-send"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png"><b>Sudah Dikirim</b></a>
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
                                <a href="<?=site_url('web/location/notification')?>" class="background-font"><i class="icon-category fa fa-bell"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png">Data Pembeli</a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/selling')?>" class="background-font"><i class="icon-category fa fa-folder" style="margin-left: 19px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png">Jualan Saya</a>
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
                        <div class="panel-heading">Data Sudah Dikirim</div>
                        <div class="panel-body">
                            <div class="alert alert-green alert-small"><i class="fa fa-warning"></i> Menu Sudah Dikirim menunjukan bahwa Admin DKP Jateng sudah transfer ke Rekening Anda, Silahkan cek saldo di Rekening Anda</div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="2%">No</th>
                                    <th colspan="2" width="26%">Nama Pembeli</th>
                                    <th class="text-center" width="13%">No Transaksi</th>
                                    <th width="35%" class="text-center">Nominal yang Diterima</th>
                                    <th width="20%">Status & Tgl Transfer</th>
                                  </tr>
                                </thead>
                                <tbody id="box_result">                         
                                    <tr><td colspan="6">Loading content ...</td></tr>
                                </tbody>
                            </table>
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