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
                    <li>Master User</li>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data User Group</b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_usergroup/search')?>" class="form-inline">
                                <div class="filter-data">
                                    <a href="<?=site_url('webmin_usergroup/form')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                                    <div class="input-group input-filter-product pull-right">
                                    <input type="text" class="form-control" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?=site_url('webmin/location/usergroup')?>" class="btn btn-danger" title="Hapus Filter"><i class="fa fa-times"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-boostrap">
                                    <tr>
                                        <th width="2%" class="text-center">No</th>
                                        <th width="7%" class="text-center">Aksi</th>
                                        <th>Nama Group User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_usergroup as $data): ?>
                                    <tr>
                                        <td align="center"><?=$data['no']?></td>
                                        <td align="center">
                                            <a href="<?=site_url("webmin_usergroup/form/$p/$o/$data[usergroup_id]")?>" class="btn btn-xs btn-success" title="Edit Data" <?=($data['usergroup_id'] == '1' ? 'disabled' : '')?>><i class="fa fa-pencil"></i></a>
                                            <a href="<?=site_url("webmin_usergroup/delete/$p/$o/$data[usergroup_id]")?>"  class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" <?=($data['usergroup_id'] == '1' ? 'disabled' : '')?>><i class="fa fa-times"></i></a>
                                        </td>
                                        <td><?=$data['usergroup_nm']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if($count_usergroup == 0): ?>
                                    <tr>
                                        <td colspan="6"><b>Data tidak ditemukan.</b></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <?php if(count($list_usergroup) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("webmin_usergroup/index/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("webmin_usergroup/index/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_usergroup/index/$i/$o") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("webmin_usergroup/index/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("webmin_usergroup/index/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
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