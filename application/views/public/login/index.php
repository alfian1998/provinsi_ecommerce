<script type="text/javascript">
$(function() {
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
      $.post('<?=site_url("login/ajax/auth_login")?>',$('#form-login').serialize(),function(data) {
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
});
</script>

<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="block block-breadcrumbs">
			<ul>
				<li class="home">
					<a href="#"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li>Login</li>
			</ul>
		</div>
		<div class="main-page">
			<div class="page-content">
	            <div class="row">
	            	<div class="col-sm-4">
	            	<div class="block box-border">
	            		<div class="title-form-login">BELUM TERDAFTAR MENJADI MEMBER ?</div>
	            		<div class="sub-title-form-login">Silahkan mendaftar pada halaman Register. Anda harus terdaftar menjadi anggota agar dapat melakukan penjualan produk secara online. Silahkan klik tombol Register</div>
	            		<a href="<?=site_url('web/location/register')?>" class="btn btn-primary btn-block"><i class="fa fa-unlock"></i> Register</a>
	            	</div>
	            	</div>
	            	<div class="col-sm-8">
	            		<form class="form-signin" id="form-login" method="post">
	            		<div class="block box-border">
	            			<div class="title-form-login">LOGIN MEMBER</div>
	            			<div class="sub-title-form-login">Bila anda sudah terdaftar menjadi anggota, silakan Login pada form dibawah ini.</div>
	            			<p>
	            				<label>Email atau Username</label>
	            				<input type="text" name="t_akun" id="t_akun" class="form-control input-login" autofocus="" placeholder="Email atau Username">
	            			</p>
	            			<p>
	            				<label>Password</label>
	            				<input type="password" name="t_password" id="t_password" class="form-control input-login" placeholder="Password">
	            			</p>
	            			<p>
	            				<a href="#">Forgot your password?</a>
	            			</p>
	            			<p>
	            				<button type="submit" class="btn btn-success input-login" id="btn-login"><i class="fa fa-unlock-alt"></i> Login</button>
	            			</p>
	            			<div id="body-message"><span id="txt-message"></span></div>
	            		</div>
	            		</form>
	            	</div>
	            </div>
	        </div>
		</div>
	</div>
</div>
</div>