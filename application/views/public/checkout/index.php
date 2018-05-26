<script type="text/javascript">
$(function() {
    //
    $('#pembeli_provinsi').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        pembeli_kabupaten(i);
    });
    function pembeli_kabupaten(i,k) {
        $.get('<?=site_url("checkout/ajax/pembeli_kabupaten")?>?pembeli_provinsi='+i+'&pembeli_kabupaten='+k,null,function(data) {
            $('#box_kabupaten').html(data.html);
        },'json');
    }
    // auth login
    $('#btn-login').bind('click',function(e) {
        e.preventDefault();
        var u = $('input[name="t_akun"]');
        var p = $('input[name="t_password"]');
        if(u.val() == '') {
          u.focus();
          $('#body-message').fadeIn('slow');
          $('#txt-message').html('<i class="fa fa-envelope"></i> Maaf, Email atau Username harap diisi !');
        } else if(p.val() == '') {
          p.focus();
          $('#body-message').fadeIn('slow');
          $('#txt-message').html('<i class="fa fa-lock"></i> Maaf, Password harap diisi !');
        } else {
          $.post('<?=site_url("checkout/ajax/auth_login")?>',$('#form-login').serialize(),function(data) {
            if(data.result == 'false') {
              u.focus();
              $('#body-message').fadeIn('slow');
              $('#txt-message').html(data.message);
            } else {
              location.href = data.redirect;
            }
          },'json');
        }
      });
    //
    $('#email').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var atpos=i.indexOf("@");
        var dotpos=i.lastIndexOf(".");
        var success = document.getElementById("check-success");
        var danger = document.getElementById("check-danger");
        //
        $.get('<?=site_url("checkout/ajax/validate_email")?>?email='+i,null,function(data) {
            if(data.result == 'false') {
                $('#box-alert-email-name').fadeOut('fast');
                $('#alert-product').fadeOut('fast');
                $('#box-alert-already-email').fadeIn('slow');
                document.getElementById('email').style.borderColor = "red";
                $('#email').focus().val('');
                success.className = "";
                danger.className += "fa fa-times form-control-feedback check-danger";
            }else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= i.length) {
                $('#box-alert-already-email').fadeOut('fast');
                $('#alert-product').fadeOut('fast');
                $('#box-alert-email-name').fadeIn('slow');
                document.getElementById('email').style.borderColor = "red";
                $('#email').focus().val('');
                success.className = "";
                danger.className += "fa fa-times form-control-feedback check-danger";
            }else{
                document.getElementById('email').style.borderColor = "green";
                $('#box-alert-already-email').fadeOut('fast');
                $('#box-alert-email-name').fadeOut('fast');
                $('#alert-product').fadeIn('fast');
                success.className += "glyphicon glyphicon-ok form-control-feedback check-success";
                danger.className = "";
            }
        },'json');
    });
    //
    $('#phone').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var success_username = document.getElementById("check-success-username");
        var danger_username = document.getElementById("check-danger-username");
        //
        $.get('<?=site_url("checkout/ajax/validate_phone")?>?phone='+i,null,function(data) {
            if(data.result == 'false') {
                $('#box-alert-already-username').fadeIn('slow');
                $('#alert-product-phone').fadeOut('fast');
                document.getElementById('phone').style.borderColor = "red";
                $('#phone').focus().val('');
                success_username.className = "";
                danger_username.className += "fa fa-times form-control-feedback check-danger-username";
            }else{
                document.getElementById('phone').style.borderColor = "green";
                $('#box-alert-already-username').fadeOut('fast');
                $('#alert-product-phone').fadeIn('fast');
                success_username.className += "glyphicon glyphicon-ok form-control-feedback check-success-username";
                danger_username.className = "";
            }
        },'json');
    });
});

function validateForm() {
    var pembeli_nm = document.forms["myForm"]["pembeli_nm"].value;
    var pembeli_email = document.forms["myForm"]["pembeli_email"].value;
    var pembeli_phone = document.forms["myForm"]["pembeli_phone"].value;
    var pembeli_provinsi = document.forms["myForm"]["pembeli_provinsi"].value;
    var pembeli_kabupaten = document.forms["myForm"]["pembeli_kabupaten"].value;
    var pembeli_kecamatan = document.forms["myForm"]["pembeli_kecamatan"].value;
    var pembeli_kelurahan = document.forms["myForm"]["pembeli_kelurahan"].value;
    var pembeli_kodepos = document.forms["myForm"]["pembeli_kodepos"].value;
    var pembeli_address = document.forms["myForm"]["pembeli_address"].value;
    if (pembeli_nm == "") {
        swal({
          text: "Nama Pembeli belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_email == "") {
        swal({
          text: "Email Pembeli belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_phone == "") {
        swal({
          text: "Telepon/No HP belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_provinsi == "") {
        swal({
          text: "Provinsi Pembeli belum dipilih",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_kabupaten == "") {
        swal({
          text: "Kabupaten Pembeli belum dipilih",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_kecamatan == "") {
        swal({
          text: "Kecamatan Pembeli belum dipilih",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_kelurahan == "") {
        swal({
          text: "Kelurahan Pembeli belum dipilih",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_kodepos == "") {
        swal({
          text: "Kode Pos Pembeli belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    }else if (pembeli_address == "") {
        swal({
          text: "Alamat Lengkap belum diisi",
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
           
            <div class="col-xs-12 col-sm-12 col-md-7">
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data Pembelian</b></div>
                        <div class="panel-body">
                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <?php if (empty($cart)): ?>
                                    <li ><a href="#">Login</a></li>
                                    <li class="active"><a href="#">Beli Tanpa Login/Daftar</a></li>
                                    <?php else: ?>
                                    <li class="<?=(@$ses_login == '1') ? 'active' : ''?>"><a data-toggle="tab" href="#with_login">Login</a></li>
                                    <li class="<?=(@$ses_login == '1') ? '' : 'active'?>"><a <?=(@$ses_login == '1') ? 'href="#"' : 'data-toggle="tab" href="#not_login"'?>>Beli Tanpa Login/Daftar</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div id="with_login" class="tab-pane fade <?=(@$ses_login == '1') ? 'in active' : ''?>">
                                    <div class="tab-body">
                                        <?php if (@$ses_login == '1'): ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><img src="<?=base_url()?><?=($customer['customer_img'] != '') ? 'assets/images/customer/'.$customer['customer_img'].'' : 'assets/images/icon/no-customer-img.jpg'?>" class="img-circle img-customer-checkout"> <b><?=$customer['customer_nm']?> <label class="pull-right label label-primary" style="font-size: 13px; margin-top: 2px; padding-top: 6px; padding-bottom: 6px;"><b><i class="fa fa-home"></i> Informasi Alamat</b></label></b></div>
                                            <div class="panel-body">
                                                <?php if ($validate_address != ''): ?>
                                                <center>
                                                    <div class="alert alert-red"><i class="fa fa-warning"></i> Informasi Alamat Anda belum lengkap, silahkan melengkapi terlebih dahulu</div>
                                                    <a href="<?=site_url('profile/address')?>" class="btn btn-primary"><b><i class="fa fa-check"></i> Lengkapi Alamat</b></a>
                                                </center>
                                                <?php else: ?>
                                                <div class="col-md-6 row">
                                                    <p><?=$customer['customer_address']?></p>
                                                    <p>Kelurahan <?=$customer['kelurahan_nm']?>, <?=$customer['kecamatan_nm']?>, <?=$customer['kabupaten_nm']?>, <?=$customer['provinsi_nm']?>, <?=$customer['customer_kodepos']?></p>
                                                    <p><?=$customer['customer_phone']?></p>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <form class="form-signin" id="form-login" method="post">
                                        <div class="form-group">
                                            <label class="bold">Email atau Username</label>
                                            <input type="text" name="t_akun" id="t_akun" class="form-control" placeholder="Email atau Username" autofocus="">
                                        </div>
                                        <div class="form-group">
                                            <label class="bold">Password</label>
                                            <input type="password" name="t_password" id="t_password" class="form-control" placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit" id="btn-login"><i class="fa fa-unlock-alt"></i> <b>Login</b></button>
                                        <div id="body-message" style="width: 100%!important"><span id="txt-message"></span></div>
                                        </form> 
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div id="not_login" class="tab-pane fade <?=(@$ses_login == '1') ? '' : 'in active'?>">
                                    <?php if (empty($cart) OR @$ses_login == '1'): ?>
                                    <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                    <div class="tab-body">
                                        <div class="widget-head"><h5><b>Informasi Identitas</b></h5></div>
                                        <div class="form-group">
                                            <label class="bold">Nama Pembeli</label>
                                            <input type="text" name="pembeli_nm" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="bold">Email Pembeli</label>
                                                    <input type="text" name="pembeli_email" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="bold">Telepon/No HP</label>
                                                    <input type="number" name="pembeli_phone" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-head"><h5><b>Informasi Alamat</b></h5></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="bold">Provinsi Pembeli</label>
                                                    <select class="select-chosen" name="pembeli_provinsi" readonly>
                                                        <option value="">-- Pilih Provinsi --</option>
                                                        <?php foreach ($list_provinsi as $data): ?>
                                                            <option value="<?=$data['id_prov']?>" <?php if(@$main['customer_provinsi'] == $data['id_prov']) echo 'selected'?>><?=$data['nama']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="bold">Kabupaten Pembeli</label>
                                                    <div id="box_kabupaten">
                                                    <select class="select-chosen" name="pembeli_kabupaten" readonly>
                                                        <option value="">-- Pilih Kabupaten --</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="bold">Kecamatan Pembeli</label>
                                                    <div id="box_kecamatan">
                                                    <select class="select-chosen" name="pembeli_kecamatan" readonly>
                                                        <option value="">-- Pilih Kecamatan --</option>
                                                    </select>
                                                    </div>  
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="bold">Kelurahan Pembeli</label>
                                                    <div id="box_kelurahan">
                                                    <select class="select-chosen" name="pembeli_kelurahan" readonly>
                                                        <option value="">-- Pilih Kelurahan --</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="bold">Kode Pos Pembeli</label>
                                                    <input type="number" name="pembeli_kodepos" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="bold">Alamat Lengkap</label>
                                                    <textarea class="form-control" name="pembeli_address" style="height: 130px;" readonly=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate" name="myForm" onsubmit="return validateForm()">  
                                    <div class="tab-body">
                                        <div class="widget-head"><h5><b>Informasi Identitas</b></h5></div>
                                        <div class="form-group">
                                            <label class="bold">Nama Pembeli</label>
                                            <input type="text" name="pembeli_nm" class="form-control">
                                            <label class="alert-product">* Wajib Diisi</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="has-feedback">
                                                        <label class="bold">Email Pembeli</label>
                                                        <input type="text" id="email" name="pembeli_email" class="form-control">
                                                        <span id="check-success"></span>
                                                        <span id="check-danger"></span>
                                                        <div id="box-alert-email-name">Form isian Email tidak benar, mohon isi Email dengan benar</div>
                                                        <div id="box-alert-already-email">Email ini sudah digunakan</div>
                                                        <label id="alert-product" class="alert-product">* Wajib Diisi</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="has-feedback">
                                                        <label class="bold">Telepon/No HP</label>
                                                        <input type="number" id="phone" name="pembeli_phone" class="form-control">
                                                        <span id="check-success-username"></span>
                                                        <span id="check-danger-username"></span>
                                                        <div id="box-alert-already-username">Telepon/No HP ini sudah digunakan</div>
                                                        <label id="alert-product-phone" class="alert-product">* Wajib Diisi</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-head"><h5><b>Informasi Alamat</b></h5></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="bold">Provinsi Pembeli</label>
                                                    <select class="select-chosen" name="pembeli_provinsi" id="pembeli_provinsi">\
                                                        <option value="">-- Pilih Provinsi --</option>
                                                        <?php foreach ($list_provinsi as $data): ?>
                                                            <option value="<?=$data['id_prov']?>" <?php if(@$main['customer_provinsi'] == $data['id_prov']) echo 'selected'?>><?=$data['nama']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="alert-product">* Wajib Dipilih</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="bold">Kabupaten Pembeli</label>
                                                    <div id="box_kabupaten">
                                                    <select class="select-chosen" name="pembeli_kabupaten" id="pembeli_kabupaten">\
                                                        <option value="">-- Pilih Kabupaten --</option>
                                                    </select>
                                                    </div>
                                                    <div class="alert-product">* Wajib Dipilih</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="bold">Kecamatan Pembeli</label>
                                                    <div id="box_kecamatan">
                                                    <select class="select-chosen" name="pembeli_kecamatan" id="pembeli_kecamatan">\
                                                        <option value="">-- Pilih Kecamatan --</option>
                                                    </select>
                                                    </div>  
                                                    <div class="alert-product">* Wajib Dipilih</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="bold">Kelurahan Pembeli</label>
                                                    <div id="box_kelurahan">
                                                    <select class="select-chosen" name="pembeli_kelurahan" id="pembeli_kelurahan">\
                                                        <option value="">-- Pilih Kelurahan --</option>
                                                    </select>
                                                    </div>
                                                    <div class="alert-product">* Wajib Dipilih</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="bold">Kode Pos Pembeli</label>
                                                    <input type="number" name="pembeli_kodepos" class="form-control">
                                                    <label class="alert-product">* Wajib Diisi</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="bold">Alamat Lengkap</label>
                                                    <textarea class="form-control" name="pembeli_address" style="height: 130px;" placeholder="Isi nama jalan, nomor rumah, nama gedung, dsb"></textarea>
                                                    <label class="alert-product">* Wajib Diisi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-5">
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Detail Belanja</b></div>
                        <div class="panel-body">
                            <?php 
                            $grand_total = 0;
                            foreach ($cart as $data): 
                            $grand_total = $grand_total + $data['subtotal'];
                            ?>
                            <div class="body-detail-shopping">
                                <a href="<?=site_url('web/details/'.md5(md5(md5(md5(md5($data['id']))))))?>"><img src="<?=base_url()?>assets/images/produk/<?=$data['product_img']?>" class="img-thumbnail img-detail-shopping"></a>
                                <div>
                                    <span class="title-product-detail"><?=$data['name']?></span>
                                    <label class="pull-right label label-danger" style="font-size: 14px;">Rp <?=digit($data['subtotal'])?></label>
                                </div>
                                <label class="label label-primary">Jumlah : <?=$data['qty']?> <?=$data['qty_unit']?></label>
                                <div class="customer-detail-shopping"><img src="<?=base_url()?>assets/images/icon/man-icon-2.png" style="width: 13px;"> <?=$data['customer_nm']?></div>
                            </div>
                            <!-- Input hidden -->
                            <input type="hidden" name="customer_id[]" value="<?=$data['customer_id']?>">
                            <input type="hidden" name="product_id[]" value="<?=$data['id']?>">
                            <input type="hidden" name="product_qty[]" value="<?=$data['qty']?>">
                            <input type="hidden" name="product_qty_unit[]" value="<?=$data['qty_unit']?>">
                            <input type="hidden" name="product_price[]" value="<?=$data['price']?>">
                            <input type="hidden" name="product_sub_price[]" value="<?=$data['subtotal']?>">
                            <!-- /Input hidden -->
                            <?php endforeach; ?>
                            <?php if(empty($cart)): ?>
                                <center>
                                    <label class="label label-danger" style="font-size: 15px;"><i class="fa fa-warning"></i> Keranjang Belanja Anda Kosong</label>
                                    <img src="<?=base_url()?>assets/images/icon/empty-cart.png"><br>
                                    <a href="<?=site_url('')?>" class="btn btn-success btn-block"><b>Belanja Sekarang</b></a>
                                </center>
                            <?php endif; ?>
                            <div class="cart-line"></div>
                            <div class="form-group">
                                <label class="bold">Catatan Transaksi</label>
                                <?php if (empty($cart)): ?>
                                <textarea class="form-control" name="billing_desc" style="height: 80px;" placeholder="Catatan Transaksi" readonly=""></textarea>
                                <?php else: ?>
                                <textarea class="form-control" name="billing_desc" style="height: 80px;" placeholder="Catatan Transaksi"></textarea>
                                <?php endif; ?>
                            </div>
                            <div class="cart-line"></div>
                            <div class="form-inline">
                                <div class="pull-left total-shopping">
                                    Total Belanja
                                </div>
                                <div class="pull-right total-price-shopping">
                                    Rp <?=digit($grand_total)?>
                                </div>
                            </div>
                            <!-- Input hidden -->
                            <input type="hidden" name="customer_id_pembeli" value="<?=$ses_customer_id?>">
                            <input type="hidden" name="pembeli_id" value="<?=$get_pembeli_id?>">
                            <input type="hidden" name="billing_id" value="<?=$get_billing_id?>">
                            <input type="hidden" name="product_total_price" value="<?=$grand_total?>">
                            <!-- /Input hidden -->
                            <div class="button-checkout">
                                <?php if(empty($cart)): ?>
                                <button class="btn btn-primary btn-block" disabled=""><b>Lanjut Ke Transfer Bank</b></button>
                                <?php else: ?>
                                    <?php if ($validate_address != ''): ?>
                                    <button class="btn btn-primary btn-block" disabled=""><b>Lanjut Ke Transfer Bank</b></button>
                                    <?php else: ?>
                                    <button class="btn btn-primary btn-block"><b>Lanjut Ke Transfer Bank</b></button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#show_cart').hide();
    });
</script>