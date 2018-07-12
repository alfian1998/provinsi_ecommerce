<script type="text/javascript">
    $(function() {
        $('#ses_status').bind('change',function() {
            $('#form-search').attr('action','<?=site_url("webmin_user/search_customer")?>').submit();
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
                    <li>Master Customer</li>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data User Customer</b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li><a href="<?=site_url('webmin/location/user')?>">User Admin <span class="badge badge-active"><?=$count_user?></span></a></li>
                                    <li><a href="javascript:void(0)" class="active">User Customer <span class="badge badge-active"><?=$count_customer?></span></a></li>
                                </ul>
                            </div>
                            <div class="body-profile">
                            <form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_user/search_customer')?>" class="form-inline">
                                <div class="filter-data">
                                    <div class="form-group" style="margin-top: 3px;">
                                        <select class="form-control select-chosen" name="ses_status" id="ses_status" style="width: 160px;">
                                            <option value="">-- Semua Status --</option>
                                            <option value="1" <?php if('1' == @$ses_status) echo 'selected'?>>Aktif</option>
                                            <option value="2" <?php if('2' == @$ses_status) echo 'selected'?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="input-group input-filter-product pull-right">
                                    <input type="text" class="form-control" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?=site_url('webmin/location/user/customer')?>" class="btn btn-danger" title="Hapus Filter"><i class="fa fa-times"></i></a>
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
                                        <th>Username</th>
                                        <th>Nama Lengkap</th>
                                        <th width="25%">Last Login</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_customer as $data): ?>
                                    <tr>
                                        <td align="center"><?=$data['no']?></td>
                                        <td align="center">
                                            <a href="<?=site_url("webmin_user/form_customer/$p/$o/$data[customer_id]")?>" class="btn btn-xs btn-success" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=site_url("webmin_user/delete_customer/$p/$o/$data[customer_id]")?>"  class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td><?=$data['customer_username']?></td>
                                        <td><?=$data['customer_nm']?></td>
                                        <td><?=convert_date_indo($data['last_login'])?></td>
                                        <td align="center"><?=($data['customer_st'] == '1') ? '<label class="label label-success">Aktif</label>' : '<label class="label label-danger">Tidak Aktif</label>'?></td>
                                        <td align="center">
                                            <?php if ($data['verification_st'] == '0'): ?>
                                                <label class="label label-danger">Tidak Verifikasi</label>
                                            <?php elseif($data['verification_st'] == '1'): ?>
                                                <label class="label label-success">Sudah Diverifikasi</label>
                                            <?php elseif ($data['verification_st'] == '2'): ?>
                                                <label class="label label-primary">Belum Diverifikasi</label>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if($count_customer == 0): ?>
                                    <tr>
                                        <td colspan="6"><b>Data tidak ditemukan.</b></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <?php if(count($list_customer) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("webmin_user/customer/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("webmin_user/customer/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_user/customer/$i/$o") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("webmin_user/customer/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("webmin_user/customer/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif;?>
                            </div>
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