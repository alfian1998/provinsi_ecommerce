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
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
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