<script type="text/javascript">
    $(function() {
        $('#ses_parameter_group').bind('change',function() {
            $('#form-search').attr('action','<?=site_url("webmin_parameter/search")?>').submit();
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
                    <li>Parameter</li>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data Parameter</b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_parameter/search')?>" class="form-inline">
                                <div class="filter-data">
                                    <a href="<?=site_url('webmin_parameter/form')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                                    <div class="form-group" style="margin-top: 4px;">
                                        <select class="form-control select-chosen" name="ses_parameter_group" id="ses_parameter_group" style="width: 220px;">
                                            <option value="">-- Semua Parameter Group --</option>
                                            <?php foreach ($parameter_group as $parameter): ?>
                                            <option value="<?=$parameter['parameter_group']?>" <?php if($parameter['parameter_group'] == @$ses_parameter_group) echo 'selected'?>><?=$parameter['parameter_group']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="input-group input-filter-product pull-right">
                                    <input type="text" class="form-control" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?=site_url('webmin/location/parameter')?>" class="btn btn-danger" title="Hapus Filter"><i class="fa fa-times"></i></a>
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
                                        <th>Parameter Group</th>
                                        <th>Parameter Nama</th>
                                        <th>Parameter Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_parameter as $data): ?>
                                    <tr>
                                        <td align="center"><?=$data['no']?></td>
                                        <td align="center">
                                            <a href="<?=site_url("webmin_parameter/form/$p/$o/$data[parameter_group]/$data[parameter_nm]/$data[parameter_id]")?>" class="btn btn-xs btn-success" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=site_url("webmin_parameter/delete/$p/$o/$data[parameter_group]/$data[parameter_nm]/$data[parameter_id]")?>" id="delete_parameter" class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td><?=$data['parameter_group']?></td>
                                        <td><?=$data['parameter_nm']?></td>
                                        <td><?=$data['parameter_val']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <?php if(count($list_parameter) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("webmin_parameter/index/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("webmin_parameter/index/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_parameter/index/$i/$o") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("webmin_parameter/index/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("webmin_parameter/index/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
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