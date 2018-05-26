<script type="text/javascript">
$(function() {
    $('#id_prov').bind('keyup',function(e) {
        e.preventDefault();
        var i = $(this).val();
        $.get('<?=site_url("webmin_region/ajax/validate_prov_by_id")?>?id_prov='+i,null,function(data) {
            if(data.result == 'false') {
                // alert('Maaf, Kode Provinsi ini sudah digunakan !');
                swal({
                  text: 'Maaf, Kode Provinsi ini sudah digunakan !',
                  icon: "warning",
                  timer: 2000
                });
                $('#id_prov').focus().val('');
            }
        },'json');
    });
    //
    $('#nama').bind('keyup',function(e) {
        e.preventDefault();
        var i = $(this).val();
        $.get('<?=site_url("webmin_region/ajax/validate_prov_by_nama")?>?nama='+i,null,function(data) {
            if(data.result == 'false') {
                // alert('Maaf, Kode Provinsi ini sudah digunakan !');
                swal({
                  text: 'Maaf, Nama Provinsi ini sudah digunakan !',
                  icon: "warning",
                  timer: 2000
                });
                $('#nama').focus().val('');
            }
        },'json');
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
                    <li><a href="#">Master Data</a><span></span></li>
                    <li><a href="<?=site_url('webmin/location/region')?>">Wilayah (Provinsi)</a><span></span></li>
                    <?php if (@$main['id_prov'] != ''): ?>
                        <li>Edit Data Provinsi</li>
                    <?php else: ?>
                        <li>Tambah Data Provinsi</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Master Data <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="<?=site_url('webmin/location/config')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Profil Web</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/parameter')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Parameter</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/region')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png"><b>Wilayah</b></a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/category')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Kategori</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/bank')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Setting Bank</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/slideshow')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Slide Show</a>
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
                        <?php if(@$main['id_prov'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data Provinsi</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data Provinsi</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="18%"><div class="span10">Kode Provinsi</div></td>
                                    <td width="82%">
                                        <div class="span2">
                                            <input type="number" name="id_prov" class="form-control" id="id_prov" value="<?=@$main['id_prov']?>" required="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Provinsi</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="nama" class="form-control" id="nama" value="<?=@$main['nama']?>" required="">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin/location/region')?>">Kembali</a>
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