<script type="text/javascript">
$(function() {
  $('#btn-login').bind('click',function(e) {
    e.preventDefault();
    var u = $('input[name="t_username"]');
    var p = $('input[name="t_password"]');
    if(u.val() == '') {
      u.focus();
      $('#body-message').fadeIn('slow');
      $('#txt-message').html('<i class="fa fa-user"></i> Maaf, Username harap diisi !');
    } else if(p.val() == '') {
      p.focus();
      $('#body-message').fadeIn('slow');
      $('#txt-message').html('<i class="fa fa-lock"></i> Maaf, Password harap diisi !');
    } else {
      $.post('<?=site_url("webmin/ajax/auth_login")?>',$('#form-login').serialize(),function(data) {
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

<body class="background-img">
<div class="container">
	<div class="row" style="margin-top:130px;">
		<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<form id="form-login" method="post">
						<fieldset>
							<center>
								<div class="text-login-lg">LOGIN</div>
								<div class="text-login-sm">Admin E-Commerce Dinas Kelautan dan Perikanan</div>
								<div class="text-login-sm">Provinsi Jawa Tengah</div>
							</center>
							<hr class="colorgraph">
							<div class="form-group">
								<label class="label-login">Username</label>
			                    <input type="text" name="t_username" id="t_username" class="form-control" placeholder="Username" autofocus="">
							</div>
							<div class="form-group">
								<label class="label-login">Password</label>
			                    <input type="password" name="t_password" id="t_password" class="form-control" placeholder="Password">
							</div>
							<hr class="colorgraph">
							<div class="row">
								<div class="col-xs-5 col-sm-5 col-md-5">
			                        <button type="submit" class="btn btn-success btn-block" id="btn-login">Log In</button>
								</div>
							</div>
							<div id="body-message"><span id="txt-message"></span></div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>