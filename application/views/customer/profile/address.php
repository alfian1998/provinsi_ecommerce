<script type="text/javascript">
$(function() {
    //
    <?php if(@$main['customer_kabupaten'] != ''):?>
    customer_kabupaten('<?=$main["customer_provinsi"]?>','<?=$main["customer_kabupaten"]?>');
    <?php elseif(@$main['customer_kabupaten'] == ''):?>
    customer_kabupaten('<?=$main["customer_provinsi"]?>','<?=$main["customer_kabupaten"]?>');
    <?php endif;?>
    //
    $('#customer_provinsi').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        customer_kabupaten(i);
    });
    function customer_kabupaten(i,k) {
        $.get('<?=site_url("profile/ajax/customer_kabupaten")?>?customer_provinsi='+i+'&customer_kabupaten='+k,null,function(data) {
            $('#box_kabupaten').html(data.html);
        },'json');
    }
});

</script>
<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
            
            <?php $this->load->view('public/main/sidebar-menu');?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Data Alamat</div>
                        <div class="panel-body">

                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li ><a href="<?=site_url('web/location/profile')?>">Akun<?=($validate_account !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                    <li><a href="#" class="active">Alamat<?=($validate_address != '') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                    <?php if ($config['profile']['verification_st'] == '1'): ?>
                                    <li><a href="<?=site_url('web/location/profile/bank_account')?>">Rekening Bank<?=($validate_bank_account !='') ? '<span class="check-data-empty"></span>' : '' ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!-- Body -->
                            <div class="body-profile">
                                <?=outp_notification()?>
                                <!-- <div class="alert alert-red">
                                    <i class="fa fa-warning"></i> Penjual hanya boleh menjual di wilayah Provinsi Jawa Tengah
                                </div> -->
                                <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                                <table width="100%" class="table-no-border">
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Provinsi</b></div></td>
                                        <td width="80%"><div class="span12">
                                            <select class="select-chosen span4" name="customer_provinsi" id="customer_provinsi">
                                                <option value="">-- Pilih Provinsi --</option>
                                                <?php foreach ($list_provinsi as $data): ?>
                                                    <option value="<?=$data['id_prov']?>" <?php if(@$main['customer_provinsi'] == $data['id_prov']) echo 'selected'?>><?=$data['nama']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Kabupaten</b></div></td>
                                        <td width="80%"><div class="span12">
                                            <div id="box_kabupaten">
                                                <select class="select-chosen span4" name="customer_kabupaten" id="customer_kabupaten">
                                                    <option value="">-- Pilih Kabupaten --</option>
                                                </select>
                                            </div>
                                        </div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Kecamatan</b></div></td>
                                        <td width="80%"><div class="span12">
                                            <div id="box_kecamatan">
                                                <select class="select-chosen span4" name="customer_kecamatan" id="customer_kecamatan">
                                                    <option value="">-- Pilih Kecamatan --</option>
                                                </select>
                                            </div>
                                        </div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Kelurahan</b></div></td>
                                        <td width="80%"><div class="span12">
                                            <div id="box_kelurahan">
                                                <select class="select-chosen span4" name="customer_kelurahan" id="customer_kelurahan">
                                                    <option value="">-- Pilih Kelurahan --</option>
                                                </select>
                                            </div>
                                        </div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Kode Pos</b></div></td>
                                        <td width="80%"><div class="span12"><input type="text" name="customer_kodepos" class="span2 form-control" value="<?=@$main['customer_kodepos']?>" placeholder="Isikan Kode Pos"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><div class="span10"><b>Alamat Lengkap</b></div></td>
                                        <td width="80%"><div class="span12"><textarea class="form-control span6" style="height: 100px;" name="customer_address" placeholder="Isi nama jalan, nomor rumah, nama gedung, dsb"><?=@$main['customer_address']?></textarea></div></td>
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