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
                                        <div class="span6">
                                            <input type="text" name="usergroup_nm" id="usergroup_nm" class="form-control" value="<?=@$main['usergroup_nm']?>" required="" placeholder="Masukkan Nama Group User">
                                            <span id="check-success-usergroup_nm"></span>
                                            <span id="check-danger-usergroup_nm"></span>
                                            <div id="box-alert-already-usergroup_nm">Nama Group User sudah digunakan</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Hak Akses Menu</div></td>
                                    <td width="82%">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <ul class="check-box-list">
                                                    <li>
                                                        <input type="checkbox" id="is_profil_web" name="is_profil_web" value="1" <?php if(@$main['is_profil_web'] == '1') echo 'checked'?>>
                                                        <label for="is_profil_web">
                                                        <span class="button"></span>
                                                        Profil Web
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_user_group" name="is_user_group" value="1" <?php if(@$main['is_user_group'] == '1') echo 'checked'?>>
                                                        <label for="is_user_group">
                                                        <span class="button"></span>
                                                        User Group
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_master_user" name="is_master_user" value="1" <?php if(@$main['is_master_user'] == '1') echo 'checked'?>>
                                                        <label for="is_master_user">
                                                        <span class="button"></span>
                                                        Master User
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_parameter" name="is_parameter" value="1" <?php if(@$main['is_parameter'] == '1') echo 'checked'?>>
                                                        <label for="is_parameter">
                                                        <span class="button"></span>
                                                        Parameter
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_wilayah" name="is_wilayah" value="1" <?php if(@$main['is_wilayah'] == '1') echo 'checked'?>>
                                                        <label for="is_wilayah">
                                                        <span class="button"></span>
                                                        Wilayah
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_kategori" name="is_kategori" value="1" <?php if(@$main['is_kategori'] == '1') echo 'checked'?>>
                                                        <label for="is_kategori">
                                                        <span class="button"></span>
                                                        Kategori
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_setting_bank" name="is_setting_bank" value="1" <?php if(@$main['is_setting_bank'] == '1') echo 'checked'?>>
                                                        <label for="is_setting_bank">
                                                        <span class="button"></span>
                                                        Setting Bank
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="check-box-list">
                                                    <li>
                                                        <input type="checkbox" id="is_slide_show" name="is_slide_show" value="1" <?php if(@$main['is_slide_show'] == '1') echo 'checked'?>>
                                                        <label for="is_slide_show">
                                                        <span class="button"></span>
                                                        Slide Show
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_syarat_pembayaran" name="is_syarat_pembayaran" value="1" <?php if(@$main['is_syarat_pembayaran'] == '1') echo 'checked'?>>
                                                        <label for="is_syarat_pembayaran">
                                                        <span class="button"></span>
                                                        Syarat Pembayaran
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_petunjuk_pembayaran" name="is_petunjuk_pembayaran" value="1" <?php if(@$main['is_petunjuk_pembayaran'] == '1') echo 'checked'?>>
                                                        <label for="is_petunjuk_pembayaran">
                                                        <span class="button"></span>
                                                        Petunjuk Pembayaran
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_rekening_bank" name="is_rekening_bank" value="1" <?php if(@$main['is_rekening_bank'] == '1') echo 'checked'?>>
                                                        <label for="is_rekening_bank">
                                                        <span class="button"></span>
                                                        Rekening Bank
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_data_pembeli" name="is_data_pembeli" value="1" <?php if(@$main['is_data_pembeli'] == '1') echo 'checked'?>>
                                                        <label for="is_data_pembeli">
                                                        <span class="button"></span>
                                                        Data Pembeli
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="is_laporan" name="is_laporan" value="1" <?php if(@$main['is_laporan'] == '1') echo 'checked'?>>
                                                        <label for="is_laporan">
                                                        <span class="button"></span>
                                                        Laporan
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
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