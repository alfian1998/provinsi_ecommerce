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
                    <li>Rekening Bank</li>
                </ul>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data Rekening Bank Admin DKP Jateng</b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_bank_account/search')?>" class="form-inline">
                                <div class="filter-data">
                                    <a href="<?=site_url('webmin_bank_account/form')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                                    <div class="input-group input-filter-product pull-right">
                                    <input type="text" class="form-control" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?=site_url('webmin/location/bank_account')?>" class="btn btn-danger" title="Hapus Filter"><i class="fa fa-times"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="alert alert-green" style="margin-bottom: 10px;">
                                <i class="fa fa-warning"></i> Data Rekening Bank akan digunakan untuk transfer bank dari pembeli ke Admin DKP Jateng
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-boostrap">
                                    <tr>
                                        <th width="2%" class="text-center">No</th>
                                        <th width="7%" class="text-center">Aksi</th>
                                        <th width="22%">Nama Bank</th>
                                        <th width="18%" class="text-center">No Rekening</th>
                                        <th>Cabang/Pusat Bank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_bank_account as $data): ?>
                                    <tr>
                                        <td align="center"><?=$data['no']?></td>
                                        <td align="center">
                                            <a href="<?=site_url("webmin_bank_account/form/$p/$o/$data[bank_account_id]")?>" class="btn btn-xs btn-success" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=site_url("webmin_bank_account/delete/$p/$o/$data[bank_account_id]")?>"  class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td><?=$data['bank_nm']?> <?=($data['bank_short_nm'] != '') ? '('.$data['bank_short_nm'].')' : '';?></td>
                                        <td align="center"><b><?=$data['no_rek']?></b></td>
                                        <td><?=$data['bank_address']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if($count_bank_account == 0): ?>
                                    <tr>
                                        <td colspan="6"><b>Data tidak ditemukan.</b></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <?php if(count($list_bank_account) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("webmin_bank_account/index/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("webmin_bank_account/index/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_bank_account/index/$i/$o") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("webmin_bank_account/index/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("webmin_bank_account/index/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>