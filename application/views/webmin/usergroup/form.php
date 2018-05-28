<script type="text/javascript">
$(function() {
    $('#usergroup_nm').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        var success_usergroup_nm = document.getElementById("check-success-usergroup_nm");
        var danger_usergroup_nm = document.getElementById("check-danger-usergroup_nm");
        //
        $.get('<?=site_url("webmin_usergroup/ajax/validate_usergroup_nm")?>?usergroup_nm='+i,null,function(data) {
            if(data.result == 'false') {
                $('#box-alert-already-usergroup_nm').fadeIn('slow');
                document.getElementById('usergroup_nm').style.borderColor = "red";
                $('#usergroup_nm').focus().val('');
            }else{
                document.getElementById('usergroup_nm').style.borderColor = "green";
                $('#box-alert-already-usergroup_nm').fadeOut('fast');
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
                    <li><a href="<?=site_url('webmin/location/usergroup')?>">Data User Group</a><span></span></li>
                    <?php if (@$main['usergroup_id'] != ''): ?>
                        <li>Edit Data User Group</li>
                    <?php else: ?>
                        <li>Tambah Data User Group</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['usergroup_id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data User Group</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data User Group</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="18%"><div class="span10">Nama User Group</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input type="text" name="usergroup_nm" id="usergroup_nm" class="form-control" value="<?=@$main['usergroup_nm']?>" required="" placeholder="Masukkan Nama Group User">
                                            <span id="check-success-usergroup_nm"></span>
                                            <span id="check-danger-usergroup_nm"></span>
                                            <div id="box-alert-already-usergroup_nm">Nama Group User sudah digunakan</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin_usergroup')?>">Kembali</a>
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