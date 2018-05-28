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
                        $('.box_user_photo').hide();
                    }
                },'json');
            }
        });
    //validate username
    $('#user_name').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var success_user_name = document.getElementById("check-success-user_name");
        var danger_user_name = document.getElementById("check-danger-user_name");
        //
        $.get('<?=site_url("webmin_user/ajax/validate_user_name")?>?user_name='+i,null,function(data) {
            if(data.result == 'false') {
                $('#box-alert-already-user_name').fadeIn('slow');
                document.getElementById('user_name').style.borderColor = "red";
                $('#user_name').focus().val('');
            }else{
                document.getElementById('user_name').style.borderColor = "green";
                $('#box-alert-already-user_name').fadeOut('fast');
            }
        },'json');
    });
    //validate realname
    $('#user_realname').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var success_user_realname = document.getElementById("check-success-user_realname");
        var danger_user_realname = document.getElementById("check-danger-user_realname");
        //
        $.get('<?=site_url("webmin_user/ajax/validate_user_realname")?>?user_realname='+i,null,function(data) {
            if(data.result == 'false') {
                $('#box-alert-already-user_realname').fadeIn('slow');
                document.getElementById('user_realname').style.borderColor = "red";
                $('#user_realname').focus().val('');
            }else{
                document.getElementById('user_realname').style.borderColor = "green";
                $('#box-alert-already-user_realname').fadeOut('fast');
            }
        },'json');
    });
    // change password
    $('#change_password').bind('click',function() {
        var c = $(this).is(':checked');
        if(c == true) {
            $('#user_password').removeAttr('disabled').focus().val('');
        } else {
            location.reload(true);
        }
    });
    //
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
                    <?php if (@$main['user_id'] != ''): ?>
                        <li>Edit Data User Admin</li>
                    <?php else: ?>
                        <li>Tambah Data User Admin</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['user_id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data User Admin</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data User Admin</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="18%"><div class="span10">Username</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="user_name" id="user_name" class="form-control" value="<?=@$main['user_name']?>" required="" placeholder="Masukkan Username">
                                            <span id="check-success-user_name"></span>
                                            <span id="check-danger-user_name"></span>
                                            <div id="box-alert-already-user_name">Username sudah digunakan</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Password</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <?php if(@$main['user_id'] != ''):?>
                                            <input type="password" name="user_password" id="user_password" class="form-control" value="<?=@$main['user_password']?>" disabled>
                                            <label style="cursor: pointer;">
                                                <input type="checkbox" name="change_password" id="change_password" value="1"> Klik untuk ubah password
                                            </label>
                                            <?php else:?>
                                            <input type="text" name="user_password" id="user_password" class="form-control" value="<?=@$main['user_password']?>" placeholder="Masukkan Password">  
                                            <?php endif;?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Lengkap</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="user_realname" id="user_realname" class="form-control" value="<?=@$main['user_realname']?>" placeholder="Masukkan Nama Lengkap">
                                            <span id="check-success-user_realname"></span>
                                            <span id="check-danger-user_realname"></span>
                                            <div id="box-alert-already-user_realname">Nama sudah digunakan</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">User Group</div></td>
                                    <td width="82%">
                                        <div class="span3">
                                            <select class="select-chosen" name="user_group">
                                                <option value="">-- Pilih User Group --</option>
                                                <?php foreach ($list_usergroup as $usergroup): ?>
                                                <option value="<?=$usergroup['usergroup_id']?>" <?=($usergroup['usergroup_id'] == @$main['user_group']) ? 'selected' : ''?>><?=$usergroup['usergroup_nm']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Foto</div></td>
                                    <td width="82%">
                                        <?php if(@$main['user_photo'] != ''):?>
                                        <span class="box_user_photo">
                                            <div class="span12" style="margin-bottom: 10px;">
                                                <img class="img-thumbnail img-edit-product" src="<?=base_url()?>assets/images/administrator/<?=$main['user_photo']?>">
                                                <a class="btn btn-sm btn-primary btn-edit-product-img" href="<?=base_url()?>assets/images/administrator/<?=$main['user_photo']?>" target="_blank"><i class="fa fa-eye"></i> Lihat Gambar</a><br>
                                                <a href="javascript:void(0)" class="remove_image btn btn-sm btn-danger btn-edit-product-img" data-id="<?=$main['user_id']?>"><i class="fa fa-times"></i> Hapus Gambar</a>
                                            </div>
                                        </span>
                                        <?php endif;?>
                                        <div class="span5">
                                            <input type="file" name="user_photo" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Status User</div></td>
                                    <td width="82%">
                                        <div class="span3">
                                            <select class="select-chosen" name="user_st">
                                                <option value="1" <?=(@$main['user_st'] == '1') ? 'selected' : ''?>>Aktif</option>
                                                <option value="2" <?=(@$main['user_st'] == '2') ? 'selected' : ''?>>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin_user')?>">Kembali</a>
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