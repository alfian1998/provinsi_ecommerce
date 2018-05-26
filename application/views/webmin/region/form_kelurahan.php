<script type="text/javascript">
$(function() {
    $('#id_kel').bind('keyup',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var id_kec = <?=$id_kec?>;
        $.get('<?=site_url("webmin_region/ajax/validate_kel_by_id")?>?id_kel='+i+'&id_kec='+id_kec,null,function(data) {
            if(data.result == 'false') {
                swal({
                  text: 'Maaf, Kode Kelurahan ini sudah digunakan !',
                  icon: "warning",
                  timer: 2000
                });
                $('#id_kel').focus().val('');
            }
        },'json');
    });
    //
    $('#nama').bind('keyup',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var id_kec = <?=$id_kec?>;
        $.get('<?=site_url("webmin_region/ajax/validate_kel_by_nama")?>?nama='+i+'&id_kec='+id_kec,null,function(data) {
            if(data.result == 'false') {
                swal({
                  text: 'Maaf, Nama Kelurahan ini sudah digunakan !',
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
                    <li><a href="<?=site_url('webmin_region/kabupaten/'.$p.'/'.$o.'/'.$id_prov)?>">Wilayah (Kabupaten)</a><span></span></li>
                    <li><a href="<?=site_url('webmin_region/kecamatan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab)?>">Wilayah (Kecamatan)</a><span></span></li>
                    <li><a href="<?=site_url('webmin_region/kelurahan/'.$p.'/'.$o.'/'.$id_prov.'/'.$id_kab.'/'.$id_kec)?>">Wilayah (Kelurahan)</a><span></span></li>
                    <?php if (@$main['id_kel'] != ''): ?>
                        <li>Edit Data Kelurahan</li>
                    <?php else: ?>
                        <li>Tambah Data Kelurahan</li>
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
                        <?php if(@$main['id_kel'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data Kelurahan</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data Kelurahan</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="18%"><div class="span10">Kode Provinsi</div></td>
                                    <td width="82%">
                                        <div class="span1">
                                            <input type="text" class="form-control" value="<?=$id_prov?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Kode Kabupaten</div></td>
                                    <td width="82%">
                                        <div class="span2">
                                            <input type="text" class="form-control" value="<?=$id_kab?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Kode Kecamatan</div></td>
                                    <td width="82%">
                                        <div class="span2">
                                            <input type="text" name="id_kec" class="form-control" value="<?=$id_kec?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Kode Kelurahan</div></td>
                                    <td width="82%">
                                        <div class="span3">
                                            <input type="number" name="id_kel" class="form-control" id="id_kel" value="<?=@$main['id_kel']?>" required="" placeholder="<?=$id_kec?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Kelurahan</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="nama" class="form-control" id="nama" value="<?=@$main['nama']?>" required="">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url("webmin_region/kelurahan/$p/$o/$id_prov/$id_kab/$id_kec")?>">Kembali</a>
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