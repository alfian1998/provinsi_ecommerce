<script type="text/javascript">
    $(function() {
        //customer_img
        $('.remove_image').bind('click',function(e) {
            e.preventDefault();
            if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
                var i = $(this).attr('data-id');
                $.get('<?=site_url("profile/delete_image")?>/'+i,null,function(data) {
                    if(data.result == 'true') {
                        //location.reload(true);
                        $('.box_customer_img').hide();
                    }
                },'json');
            }
        });
        //
        $('#change_password').bind('click',function() {
            var c = $(this).is(':checked');
            if(c == true) {
                $('#customer_password').removeAttr('disabled').focus().val('');
            } else {
                location.reload(true);
            }
        });
        //validasi form
        $('#email').bind('change',function(e) {
            e.preventDefault();
            var i = $(this).val();
            var atpos=i.indexOf("@");
            var dotpos=i.lastIndexOf(".");
            var success = document.getElementById("check-success");
            var danger = document.getElementById("check-danger");
            //
            $.get('<?=site_url("profile/ajax/validate_email")?>?email='+i,null,function(data) {
                if(data.result == 'false') {
                    $('#box-alert-email-name').fadeOut('fast');
                    $('#box-alert-already-email').fadeIn('slow');
                    document.getElementById('email').style.borderColor = "red";
                    $('#email').focus().val('');
                    success.className = "";
                    danger.className += "fa fa-times form-control-feedback check-danger";
                }else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= i.length) {
                    $('#box-alert-already-email').fadeOut('fast');
                    $('#box-alert-email-name').fadeIn('slow');
                    document.getElementById('email').style.borderColor = "red";
                    $('#email').focus().val('');
                    success.className = "";
                    danger.className += "fa fa-times form-control-feedback check-danger";
                }else{
                    document.getElementById('email').style.borderColor = "green";
                    $('#box-alert-already-email').fadeOut('fast');
                    $('#box-alert-email-name').fadeOut('fast');
                    success.className += "glyphicon glyphicon-ok form-control-feedback check-success";
                    danger.className = "";
                }
            },'json');
        });

        $('#username').bind('change',function(e) {
            e.preventDefault();
            var i = $(this).val();
            var success_username = document.getElementById("check-success-username");
            var danger_username = document.getElementById("check-danger-username");
            //
            $.get('<?=site_url("profile/ajax/validate_username")?>?username='+i,null,function(data) {
                if(data.result == 'false') {
                    $('#box-alert-already-username').fadeIn('slow');
                    document.getElementById('username').style.borderColor = "red";
                    $('#username').focus().val('');
                    success_username.className = "";
                    danger_username.className += "fa fa-times form-control-feedback check-danger-username";
                }else{
                    document.getElementById('username').style.borderColor = "green";
                    $('#box-alert-already-username').fadeOut('fast');
                    success_username.className += "glyphicon glyphicon-ok form-control-feedback check-success-username";
                    danger_username.className = "";
                }
            },'json');
        });

        $('#customer_nm').bind('change',function(e) {
            e.preventDefault();
            var i = $(this).val();
            var success_customer_nm = document.getElementById("check-success-customer_nm");
            var danger_customer_nm = document.getElementById("check-danger-customer_nm");
            //
            $.get('<?=site_url("profile/ajax/validate_customer_nm")?>?customer_nm='+i,null,function(data) {
                if(data.result == 'false') {
                    $('#box-alert-already-customer_nm').fadeIn('slow');
                    document.getElementById('customer_nm').style.borderColor = "red";
                    $('#customer_nm').focus().val('');
                    success_customer_nm.className = "";
                    danger_customer_nm.className += "fa fa-times form-control-feedback check-danger-customer_nm";
                }else{
                    document.getElementById('customer_nm').style.borderColor = "green";
                    $('#box-alert-already-customer_nm').fadeOut('fast');
                    success_customer_nm.className += "glyphicon glyphicon-ok form-control-feedback check-success-customer_nm";
                    danger_customer_nm.className = "";
                }
            },'json');
        });
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
                                <a href="<?=site_url('web/location/send')?>" class="background-font"><i class="icon-category fa fa-send"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Sudah Dikirim</a>
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
                                <a href="<?=site_url('web/location/notification')?>" class="background-font"><i class="icon-category fa fa-dollar" style="margin-left: 22px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png">Data Pembeli</a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/selling')?>" class="background-font"><i class="icon-category fa fa-folder" style="margin-left: 19px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png">Jualan Saya</a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/profile')?>" class="background-font"><i class="icon-category fa fa-user" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-12.png"><b>Profil</b></a>
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
                        <div class="panel-heading">Data Akun Profil</div>
                        <div class="panel-body">

                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li ><a href="#" class="active">Akun<?=($validate_account !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                    <li><a href="<?=site_url('web/location/profile/address')?>">Alamat<?=($validate_address !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                    <li><a href="<?=site_url('web/location/profile/bank_account')?>">Rekening Bank<?=($validate_bank_account !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                </ul>
                            </div>
                            <!-- Body -->
                            <div class="body-profile">
                                <?=outp_notification()?>
                                <div class="alert alert-red">
                                    <i class="fa fa-warning"></i> Informasi pribadi Anda akan kami rahasiakan
                                </div>
                                <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                <table width="100%" class="table-no-border">
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Foto Profil</b></div></td>
                                        <td width="80%">
                                            <?php if(@$main['customer_img'] != ''):?>
                                            <span class="box_customer_img">
                                                <div class="span12" style="margin-bottom: 10px;">
                                                    <img class="img-thumbnail img-edit-product" src="<?=base_url()?>assets/images/customer/<?=$main['customer_img']?>">
                                                    <a class="btn btn-sm btn-primary btn-edit-product-img" href="<?=base_url()?>assets/images/customer/<?=$main['customer_img']?>" target="_blank"><i class="fa fa-eye"></i> Lihat Gambar</a><br>
                                                    <a href="javascript:void(0)" class="remove_image btn btn-sm btn-danger btn-edit-product-img" data-id="<?=$main['customer_id']?>"><i class="fa fa-times"></i> Hapus Gambar</a>
                                                </div>
                                            </span>
                                            <?php else: ?>
                                                <div class="span12" style="margin-bottom: 10px;">
                                                    <img class="img-thumbnail img-photo-profile" src="<?=base_url()?>assets/images/icon/no-customer-img.jpg">
                                                </div>
                                            <?php endif;?>
                                            <div class="span6">
                                                <input type="file" name="customer_img" class="form-control" value="<?=@$main['customer_img']?>">
                                                <label class="alert-product">* Gambar ini akan dijadikan Foto Profil</label>
                                                <label class="alert-product">* Untuk mengganti Foto Profil upload Foto Anda</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Username</b></div></td>
                                        <td width="80%">
                                            <div class="span12">
                                                <input type="text" id="username" name="customer_username" class="span5 form-control" value="<?=@$main['customer_username']?>">
                                                <span id="check-success-username"></span>
                                                <span id="check-danger-username"></span>
                                                <div id="box-alert-already-username">Username ini sudah digunakan</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Password</b></div></td>
                                        <td width="80%">
                                            <div class="span12 form-inline">
                                                <?php if(@$main['customer_id'] != ''):?>
                                                <input type="password" name="customer_password" id="customer_password" class="span5 form-control" value="<?=@$main['customer_password']?>" disabled>
                                                <label style="cursor: pointer;">
                                                    <input type="checkbox" name="change_password" id="change_password" value="1"> Klik untuk ubah password
                                                </label>
                                                <?php else:?>
                                                <input type="text" name="customer_password" id="customer_password" class="span6" value="<?=@$main['customer_password']?>">  
                                                <?php endif;?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Nama Lengkap</b></div></td>
                                        <td width="80%">
                                            <div class="span12">
                                                <input type="text" id="customer_nm" name="customer_nm" class="span5 form-control" value="<?=@$main['customer_nm']?>">
                                                <span id="check-success-customer_nm"></span>
                                                <span id="check-danger-customer_nm"></span>
                                                <div id="box-alert-already-customer_nm">Nama ini sudah digunakan</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Email</b></div></td>
                                        <td width="80%">
                                            <div class="span12">
                                                <input type="text" id="email" name="customer_email" class="span5 form-control" value="<?=@$main['customer_email']?>">
                                                <span id="check-success"></span>
                                                <span id="check-danger"></span>
                                                <div id="box-alert-email-name">Form isian Email tidak benar, mohon isi Email dengan benar</div>
                                                <div id="box-alert-already-email">Email ini sudah digunakan</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>No Telpon</b></div></td>
                                        <td width="80%"><div class="span12"><input type="text" name="customer_phone" class="span5 form-control" value="<?=@$main['customer_phone']?>"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Jenis Kelamin</b></div></td>
                                        <td width="80%"><div class="span12">
                                            <select class="select-chosen span3" name="customer_sex">
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="1" <?php if(@$main['customer_sex'] == '1') echo 'selected'?>>Laki-laki</option>
                                                <option value="2" <?php if(@$main['customer_sex'] == '2') echo 'selected'?>>Perempuan</option>
                                            </select>
                                        </div></td>
                                    </tr>
                                </table>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                </form>
                            </div>
                            <!-- /Body -->
                    </div>
                </div>
                
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>
</div>