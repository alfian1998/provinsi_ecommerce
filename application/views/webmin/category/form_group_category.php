<script type="text/javascript">
$(function() {
    $('#category_parent').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        category_id(i);
    });
    function category_id(i,k) {
        $.get('<?=site_url("webmin_category/ajax/category_id")?>?category_parent='+i+'&category_id='+k,null,function(data) {
            $('#box_category').html(data.html);
        },'json');
    }

    //Image
    $('.remove_image').bind('click',function(e) {
        e.preventDefault();
        if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
            var i = $(this).attr('data-id');
            $.get('<?=site_url("webmin_category/delete_image")?>/'+i,null,function(data) {
                if(data.result == 'true') {
                    //location.reload(true);
                    $('.box_category_img').hide();
                }
            },'json');
        }
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
                    <li><a href="<?=site_url('webmin/location/parameter')?>">Parameter</a><span></span></li>
                    <li>Tambah Group Kategori</li>
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
                                <a href="<?=site_url('webmin/location/region')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Wilayah</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/category')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png"><b>Kategori</b></a>
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
                        <div class="panel-heading"><b>Tambah Group Kategori</b></div>
                        <div class="panel-body">
                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li ><a href="<?=site_url('webmin_category/form')?>">Tambah Data Kategori</a></li>
                                    <li><a href="javascript:void(0)" class="active">Tambah Group Kategori</a></li>
                                </ul>
                            </div>
                            
                            <div style="margin-top: 20px;">
                                <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                <table width="100%" class="table-no-border">
                                    <tr>
                                        <td width="18%"><div class="span10">Kategori ID</div></td>
                                        <td width="82%">
                                            <div id="box_category">
                                            <div class="span2">
                                                    <input type="text" name="category_id" class="form-control" value="0<?=$last_category_id?>" readonly>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span12">Nama Group Kategori</div></td>
                                        <td width="82%">
                                            <div class="span6">
                                                <input type="text" name="category_nm" class="form-control" value="<?=@$main['category_nm']?>" required="">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <a class="btn btn-success" href="<?=site_url('webmin_category')?>">Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                </form>
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