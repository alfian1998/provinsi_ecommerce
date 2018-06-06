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
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Tambah Group Kategori</b></div>
                        <div class="panel-body">
                            <?php if(@$main['category_id'] ==''): ?>
                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li ><a href="<?=site_url('webmin_category/form')?>">Tambah Data Kategori</a></li>
                                    <li><a href="javascript:void(0)" class="active">Tambah Group Kategori</a></li>
                                </ul>
                            </div>
                            <?php endif; ?>
                            
                            <div <?=(@$main['category_id'] !='') ? '' : 'style="margin-top: 20px;"' ?>>
                                <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                <table width="100%" class="table-no-border">
                                    <tr>
                                        <td width="18%"><div class="span10">Kategori ID</div></td>
                                        <td width="82%">
                                            <div id="box_category">
                                            <div class="span2">
                                                <?php if (@$main['category_id'] !=''): ?>
                                                    <input type="text" name="category_id" class="form-control" value="<?=@$main['category_id']?>" readonly>
                                                <?php else: ?>
                                                    <input type="text" name="category_id" class="form-control" value="0<?=$last_category_id?>" readonly>
                                                <?php endif; ?>
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
                                <a class="btn btn-success" href="<?=site_url('webmin/location/category/category')?>">Kembali</a>
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