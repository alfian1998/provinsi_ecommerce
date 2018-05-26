<script type="text/javascript">
$(function() {
	$('#email').bind('change',function(e) {
		e.preventDefault();
		var i = $(this).val();
		var atpos=i.indexOf("@");
 		var dotpos=i.lastIndexOf(".");
 		var success = document.getElementById("check-success");
 		var danger = document.getElementById("check-danger");
 		//
		$.get('<?=site_url("register/ajax/validate_email")?>?email='+i,null,function(data) {
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
		$.get('<?=site_url("register/ajax/validate_username")?>?username='+i,null,function(data) {
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
		$.get('<?=site_url("register/ajax/validate_customer_nm")?>?customer_nm='+i,null,function(data) {
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

	$('input[name="customer_nm"]').bind('keyup',function(e) {
		e.preventDefault();
		$.get('<?=site_url("register/ajax/permalink")?>?customer_nm='+$(this).val(),null,function(data) {
			$('input[name="customer_chat_nm"]').val(data.permalink);
		},'json');		
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
				<li>Authentication</li>
			</ul>
		</div>
		<div class="main-page">
			<div class="page-content">
	            <div class="row">
	            	<div class="col-sm-4">
	            	<div class="block box-border">
	            		<div class="title-form-login">TELAH MENJADI MEMBER ?</div>
	            		<div class="sub-title-form-login">Bila anda sudah memiliki akun, silakan Login pada halaman Login Member. Silahkan klik tombol Login</div>
	            		<a href="<?=site_url('web/location/login')?>" class="btn btn-success btn-block"><i class="fa fa-unlock-alt"></i> Login</a>
	            	</div>
	            	</div>
	            	<div class="col-sm-8">
	            		<form action="<?=$form_action?>" method="POST" enctype="multipart/form-data">
	            		<div class="block box-border">
	            			<div class="title-form-login">PENDAFTARAN MEMBER</div>
	            			<div class="sub-title-form-login">Silakan isi formulir dibawah ini untuk membuat akun.</div>
		            			<div class="input-login">
		            			<p>
		            				<div class="has-feedback">
			            				<label>Email address</label>
			            				<label class="alert-product label-alert-register">* Wajib Diisi</label>
			            				<input type="text" class="form-control" id="email" name="customer_email" placeholder="Email Address" required="">
			            				<span id="check-success"></span>
			            				<span id="check-danger"></span>
			            				<div id="box-alert-email-name">Form isian Email tidak benar, mohon isi Email dengan benar</div>
			            				<div id="box-alert-already-email">Email ini sudah digunakan</div>
			            			</div>
		            			</p>
		            			<p>
		            				<div class="has-feedback">
			            				<label>Username</label>
			            				<label class="alert-product label-alert-register">* Wajib Diisi</label>
			            				<input type="text" class="form-control" id="username" name="customer_username" placeholder="Username" required="">
			            				<span id="check-success-username"></span>
			            				<span id="check-danger-username"></span>
			            				<div id="box-alert-already-username">Username ini sudah digunakan</div>
			            			</div>
		            			</p>
		            			<p>
		            				<div class="has-feedback">
			            				<label>Nama</label>
			            				<label class="alert-product label-alert-register">* Wajib Diisi</label>
			            				<input type="text" class="form-control" placeholder="Nama Lengkap" id="customer_nm" name="customer_nm" required="">
			            				<input type="hidden" name="customer_chat_nm" class="span12 required" value="<?=@$main['customer_chat_nm']?>" readonly="1">
			            				<span id="check-success-customer_nm"></span>
			            				<span id="check-danger-customer_nm"></span>
			            				<div id="box-alert-already-customer_nm">Nama ini sudah digunakan</div>
			            			</div>
		            			</p>
		            			<p>
		            				<label>Password</label>
		            				<label class="alert-product label-alert-register">* Wajib Diisi</label>
		            				<input type="password" class="form-control" placeholder="Password" name="customer_password" required="">
		            			</p>
		            			<p>
		            				<button  class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock"></i> Buat Akun</button>
		            			</p>
		            		</div>
	            		</div>
	            		</form>
	            	</div>
	            </div>
	        </div>
		</div>
	</div>
</div>
</div>