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
                    <li><a href="<?=site_url('webmin/location/bank_account')?>">Rekening Bank</a><span></span></li>
                    <?php if (@$main['bank_account_id'] != ''): ?>
                        <li>Edit Data Rekening Bank</li>
                    <?php else: ?>
                        <li>Tambah Data Rekening Bank</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['bank_account_id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data Rekening Bank</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data Rekening Bank</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <div class="alert alert-green">
                                    <i class="fa fa-warning"></i> Data Rekening Bank akan digunakan untuk transfer bank dari pembeli ke Admin DKP Jateng
                                </div>
                                <tr>
                                    <td width="18%"><div class="span10">Nama Bank</div></td>
                                    <td width="82%">
                                        <div class="span3" style="margin-top: 10px;">
                                            <select class="select-chosen span12" name="bank_id" required="">
                                                <option value="">-- Pilih Nama Bank --</option>
                                                <?php foreach ($list_bank as $data): ?>
                                                <option value="<?=$data['bank_id']?>"><?=$data['bank_nm']?> <?=($data['bank_short_nm'] != '') ? '('.$data['bank_short_nm'].')' : '';?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="alert-product">* Wajib Dipilih</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">No Rekening Bank</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input class="form-control span9" type="text" name="no_rek" value="<?=@$main['no_rek']?>" placeholder="Masukkan No Rekening" required>
                                            <span class="alert-product">* Wajib Diisi dengan No Rekening yang benar</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Cabang/Pusat Bank</div></td>
                                    <td width="82%">
                                        <div class="span5">
                                            <input class="form-control span9" type="text" name="bank_address" value="<?=@$main['bank_address']?>" required>
                                            <span class="alert-product">* Wajib Diisi</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin_bank_account')?>">Kembali</a>
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