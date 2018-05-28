<script type="text/javascript">
$(function() {
   $('#bank_owner').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var success_bank_owner = document.getElementById("check-success-bank_owner");
        var danger_bank_owner = document.getElementById("check-danger-bank_owner");
        //
        $.get('<?=site_url("profile/ajax/validate_bank_owner")?>?bank_owner='+i,null,function(data) {
            if(data.result == 'false') {
                $('#box-alert-already-bank_owner').fadeIn('slow');
                document.getElementById('bank_owner').style.borderColor = "red";
                $('#bank_owner').focus().val('');
            }else{
                document.getElementById('bank_owner').style.borderColor = "green";
                $('#box-alert-already-bank_owner').fadeOut('fast');
            }
        },'json');
    }); 
});

function validateForm() {
    var bank_id = document.forms["myForm"]["bank_id"].value;
    var bank_owner = document.forms["myForm"]["bank_owner"].value;
    var bank_no_rek = document.forms["myForm"]["bank_no_rek"].value;
    if (bank_id == "") {
        swal({
          text: "Nama Bank belum dipilih",
          icon: "warning",
          button: "OK",
        });
        return false;
    } else if (bank_owner == "") {
        swal({
          text: "Atas Nama/Pemilik Bank belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    } else if (bank_no_rek == "") {
        swal({
          text: "Nomor Rekening belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    } 
}
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
                        <div class="panel-heading">Data Akun Bank</div>
                        <div class="panel-body">

                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li ><a href="<?=site_url('web/location/profile')?>">Akun<?=($validate_account !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                    <li><a href="<?=site_url('web/location/profile/address')?>">Alamat<?=($validate_address !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                    <li><a href="#" class="active">Rekening Bank<?=($validate_bank_account !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                </ul>
                            </div>
                            <!-- Body -->
                            <div class="body-profile">
                                <?=outp_notification()?>
                                <div class="alert alert-red">
                                    <i class="fa fa-warning"></i> <span>Rekening Bank digunakan untuk menerima dana dari Admin DKP yang berasal dari Pembeli produk dan telah terverifikasi oleh Admin DKP</span>
                                </div>
                                <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate" name="myForm" onsubmit="return validateForm()">  
                                <table width="100%" class="table-no-border">
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Nama Bank</b></div></td>
                                        <td width="80%"><div class="span12">
                                            <select class="select-chosen span4" name="bank_id" id="bank_id">
                                                <option value="">-- Pilih Bank --</option>
                                                <?php foreach ($list_bank as $data): ?>
                                                    <option value="<?=$data['bank_id']?>" <?php if(@$main['bank_id'] == $data['bank_id']) echo 'selected'?>><?=$data['bank_nm']?> <?=($data['bank_short_nm'] !='') ? '('.$data['bank_short_nm'].')' : ''?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Atas Nama</b></div></td>
                                        <td width="80%">
                                            <div class="span12">
                                                <input type="text" name="bank_owner" id="bank_owner" class="span6 form-control" value="<?=@$main['bank_owner']?>" placeholder="Pastikan nama sesuai dengan yang tercantum di Bank">
                                                <span id="check-success-bank_owner"></span>
                                                <span id="check-danger-bank_owner"></span>
                                                <div id="box-alert-already-bank_owner">Nama ini sudah digunakan</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Nomor Rekening</b></div></td>
                                        <td width="80%"><div class="span12"><input type="text" name="bank_no_rek" class="span6 form-control" value="<?=@$main['bank_no_rek']?>" placeholder="Pastikan nomor rekening valid"></div></td>
                                    </tr>
                                </table>
                                <button class="btn btn-primary">Simpan</button>
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