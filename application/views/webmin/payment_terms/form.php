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
                    <li><a href="#">Master Data</a><span></span></li>
                    <li><a href="<?=site_url('webmin/location/payment_terms')?>">Syarat Pembayaran</a><span></span></li>
                    <?php if (@$main['id'] != ''): ?>
                        <li>Edit Data Syarat Pembayaran</li>
                    <?php else: ?>
                        <li>Tambah Data Syarat Pembayaran</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Pembayaran <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="<?=site_url('webmin/location/payment_terms')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png"><b>Syarat Pembayaran</b></a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/payment_instructions')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Petunjuk Pembayaran</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Syarat Pembayaran</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Syarat Pembayaran</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <div class="alert alert-green">
                                    <i class="fa fa-warning"></i> Data Syarat Pembayaran akan muncul di halaman pembayaran pembeli
                                </div>
                                <tr>
                                    <td width="20%"><div class="span10">Syarat Pembayaran</div></td>
                                    <td width="80%">
                                        <div class="span5">
                                            <textarea class="form-control" name="text" style="height: 100px;"><?=@$main['text']?></textarea>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin_payment_terms')?>">Kembali</a>
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