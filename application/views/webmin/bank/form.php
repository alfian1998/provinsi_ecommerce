<script type="text/javascript">
$(function() {
    $('#bank_nm').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var success_bank_nm = document.getElementById("check-success-bank_nm");
        var danger_bank_nm = document.getElementById("check-danger-bank_nm");
        //
        $.get('<?=site_url("webmin_bank/ajax/validate_bank_nm")?>?bank_nm='+i,null,function(data) {
            if(data.result == 'false') {
                $('#box-alert-already-bank_nm').fadeIn('slow');
                document.getElementById('bank_nm').style.borderColor = "red";
                $('#bank_nm').focus().val('');
            }else{
                document.getElementById('bank_nm').style.borderColor = "green";
                $('#box-alert-already-bank_nm').fadeOut('fast');
            }
        },'json');
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
                    <li><a href="<?=site_url('webmin/location/bank')?>">Setting Bank</a><span></span></li>
                    <?php if (@$main['bank_id'] != ''): ?>
                        <li>Edit Data Bank</li>
                    <?php else: ?>
                        <li>Tambah Data Bank</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['bank_id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data Bank</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data Bank</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <!-- Input hidden -->
                            <input type="hidden" name="post_date" value="<?=@$main['post_date']?>">
                            <!-- /Input hidden -->
                            <table width="100%" class="table-no-border">
                                <div class="alert alert-green">
                                    <i class="fa fa-warning"></i> Data Bank digunakan untuk transaksi dari Admin DKP ke Penjual
                                </div>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Bank</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="bank_nm" id="bank_nm" class="form-control" value="<?=@$main['bank_nm']?>" required="" placeholder="Masukkan Nama Bank">
                                            <span id="check-success-bank_nm"></span>
                                            <span id="check-danger-bank_nm"></span>
                                            <div id="box-alert-already-bank_nm">Nama Bank sudah digunakan</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Singkatan Bank</div></td>
                                    <td width="82%">
                                        <div class="span3">
                                            <input type="text" name="bank_short_nm" class="form-control" value="<?=@$main['bank_short_nm']?>" placeholder="Contoh : BRI">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin_bank')?>">Kembali</a>
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