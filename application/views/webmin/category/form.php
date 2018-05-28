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
                    <?php if (@$main['category_id'] != ''): ?>
                        <li>Edit Data Parameter</li>
                    <?php else: ?>
                        <li>Tambah Data Parameter</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['category_id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data Kategori</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data Kategori</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <?php if(@$main['category_id'] ==''): ?>
                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li ><a href="javascript:void(0)" class="active">Tambah Data Kategori</a></li>
                                    <li><a href="<?=site_url('webmin_category/form_group')?>">Tambah Group Kategori</a></li>
                                </ul>
                            </div>
                            <?php endif; ?>
                            
                            <?php if(@$cek_category !=''): ?>
                            <div class="alert alert-red">
                                <i class="fa fa-warning"></i> Kategori ini sudah digunakan Penjual
                            </div>
                            <?php endif; ?>

                            <div style="margin-top: 20px;">
                                <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                <table width="100%" class="table-no-border">
                                    <tr>
                                        <td width="18%"><div class="span10">Group Kategori</div></td>
                                        <td width="82%">
                                            <div class="span4">
                                                <select class="form-control select-chosen" name="category_parent" id="category_parent" required="">
                                                    <option value="">-- Pilih Group Kategori --</option>
                                                    <?php foreach ($list_category_parent as $data): ?>
                                                        <option value="<?=$data['category_id']?>" <?php if(@$data['category_id'] == @$main['category_parent']) echo 'selected'?>><?=$data['category_nm']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span10">Kategori ID</div></td>
                                        <td width="82%">
                                            <div id="box_category">
                                            <div class="span2">
                                                    <input type="text" name="category_id" class="form-control" value="<?=@$main['category_id']?>" readonly>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span10">Nama Kategori</div></td>
                                        <td width="82%">
                                            <div class="span6">
                                                <input type="text" name="category_nm" class="form-control" value="<?=@$main['category_nm']?>" required="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="18%"><div class="span10">Deskripsi Kategori</div></td>
                                        <td width="82%">
                                            <div class="span6">
                                                <textarea name="category_desc" class="form-control"><?=@$main['category_desc']?></textarea>
                                                <label class="alert-product">* Deskripsi Kategori Opsional (Tidak wajib diisi)</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php if(@$main['category_id'] != ''): ?>
                                    <tr>
                                        <td width="18%"><div class="span10">Status Kategori</div></td>
                                        <td width="82%">
                                            <div class="span3">
                                                <select class="form-control select-chosen" name="category_st" id="category_st" required="">
                                                    <option value="">-- Pilih Status Kategori --</option>
                                                        <option value="1" <?php if(@$main['category_st'] == '1') echo 'selected'?>>Aktif</option>
                                                        <option value="0" <?php if(@$main['category_st'] == '0') echo 'selected'?>>Tidak Aktif</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td width="18%"><div class="span10">Gambar Kategori</div></td>
                                        <td width="82%">
                                            <?php if(@$main['category_img'] != ''):?>
                                            <span class="box_category_img">
                                                <div class="span12" style="margin-bottom: 10px;">
                                                    <img class="img-thumbnail img-edit-product" src="<?=base_url()?>assets/images/category/<?=$main['category_img']?>">
                                                    <a class="btn btn-sm btn-primary btn-edit-product-img" href="<?=base_url()?>assets/images/category/<?=$main['category_img']?>" target="_blank"><i class="fa fa-eye"></i> Lihat Gambar</a><br>
                                                    <a href="javascript:void(0)" class="remove_image btn btn-sm btn-danger btn-edit-product-img" data-id="<?=$main['category_id']?>"><i class="fa fa-times"></i> Hapus Gambar</a>
                                                </div>
                                            </span>
                                            <?php endif;?>
                                            <div class="span6">
                                                <input type="file" name="category_img" class="form-control" value="<?=@$main['category_img']?>">
                                                <label class="alert-product">* Gambar Kategori akan dijadikan icon dikategori</label>
                                                <?php if (@$main['category_img'] != ''): ?>
                                                <label class="alert-product">* Jika Gambar Kategori ingin dirubah, silahkan upload Gambar lagi</label>
                                                <?php endif; ?>
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