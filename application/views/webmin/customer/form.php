<script type="text/javascript">
$(function() {
    //user photo
    $('.remove_image').bind('click',function(e) {
        e.preventDefault();
        if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
            var i = $(this).attr('data-id');
            $.get('<?=site_url("webmin_user/delete_image")?>/'+i,null,function(data) {
                if(data.result == 'true') {
                    //location.reload(true);
                    $('.box_customer_img').hide();
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
                    <li><a href="<?=site_url('webmin/location/user')?>">Master User</a><span></span></li>
                    <?php if (@$main['customer_id'] != ''): ?>
                        <li>Edit Data User Customer</li>
                    <?php else: ?>
                        <li>Tambah Data User Customer</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['customer_id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data User Customer</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data User Customer</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="18%"><div class="span10">Username</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" class="form-control" value="<?=@$main['customer_username']?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Password</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="password" class="form-control" value="<?=@$main['customer_password']?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Lengkap</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" class="form-control" value="<?=@$main['customer_nm']?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Email</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" class="form-control" value="<?=@$main['customer_email']?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">No Telpon</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" class="form-control" value="<?=@$main['customer_phone']?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Jenis Kelamin</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" class="form-control" value="<?=(@$main['customer_sex'] == '1') ? 'Laki-laki' : 'Perempuan'?>" disabled>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Foto</div></td>
                                    <td width="82%">
                                        <?php if(@$main['customer_img'] != ''):?>
                                        <span class="box_customer_img">
                                            <div class="span12" style="margin-bottom: 10px;">
                                                <img class="img-thumbnail img-edit-product" src="<?=base_url()?>assets/images/customer/<?=$main['customer_img']?>">
                                                <a class="btn btn-sm btn-primary btn-edit-product-img" href="<?=base_url()?>assets/images/customer/<?=$main['customer_img']?>" target="_blank"><i class="fa fa-eye"></i> Lihat Gambar</a><br>
                                            </div>
                                        </span>
                                        <?php else: ?>
                                        <span class="box_customer_img">
                                            <div class="span12" style="margin-bottom: 10px;">
                                                <img class="img-thumbnail img-edit-product" src="<?=base_url()?>assets/images/icon/no-customer-img.jpg">
                                            </div>
                                        </span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Status User</div></td>
                                    <td width="82%">
                                        <div class="span3">
                                            <select class="select-chosen" name="customer_st">
                                                <option value="1" <?=(@$main['customer_st'] == '1') ? 'selected' : ''?>>Aktif</option>
                                                <option value="2" <?=(@$main['customer_st'] == '2') ? 'selected' : ''?>>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin_user/customer')?>">Kembali</a>
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