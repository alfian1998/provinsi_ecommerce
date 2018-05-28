<script type="text/javascript">
    $(function() {
        $('#ses_category_parent').bind('change',function() {
            $('#form-search').attr('action','<?=site_url("webmin_category/search")?>').submit();
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
                    <li>Category</li>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data Kategori Produk</b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_category/search')?>" class="form-inline">
                                <div class="filter-data">
                                    <a href="<?=site_url('webmin_category/form')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                                    <div class="form-group" style="margin-top: 4px;">
                                        <select class="form-control select-chosen" name="ses_category_parent" id="ses_category_parent" style="width: 200px;">
                                            <option value="">-- Semua Group Kategori --</option>
                                            <?php foreach ($list_category_parent as $data): ?>
                                            <option value="<?=$data['category_id']?>" <?php if($data['category_id'] == @$ses_category_parent) echo 'selected'?>><?=$data['category_nm']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="input-group input-filter-product pull-right">
                                    <input type="text" class="form-control" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?=site_url('webmin/location/category')?>" class="btn btn-danger" title="Hapus Filter"><i class="fa fa-times"></i></a>
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
                                        <th width="15%" class="text-center">Kategori ID</th>
                                        <th width="18%" class="text-center">Group Kategori ID</th>
                                        <th>Nama Kategori</th>
                                        <th class="text-center">Status di Penjualan</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_category as $data): ?>
                                    <tr>
                                        <td align="center"><?=$data['no']?></td>
                                        <td align="center">
                                            <a href="<?=site_url("webmin_category/form/$p/$o/$data[category_id]")?>" class="btn btn-xs btn-success" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=site_url("webmin_category/delete/$p/$o/$data[category_id]")?>" id="delete_parameter" class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td align="center"><?=$data['category_id']?></td>
                                        <td align="center"><?=$data['category_parent']?></td>
                                        <td><?=$data['category_nm']?></td>
                                        <td align="center">
                                            <?=($data['cek_category']['product_id'] !='') ? '<label class="label label-primary">Sudah digunakan penjual</label>' : '<label class="label label-warning">Belum digunakan penjual</label>'?>
                                        </td>
                                        <td align="center">
                                            <?=($data['category_st'] == '1') ? '<label class="label label-success">Aktif</label>' : '<label class="label label-danger">Tidak Aktif</label>'?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if($count_category == 0): ?>
                                    <tr>
                                        <td colspan="6"><b>Data tidak ditemukan.</b></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <div class="pull-left">
                                <label class="label label-primary" style="font-size: 13px;">Terdapat <?=$count_category?> Data Kabupaten</label>
                            </div>
                            <?php if(count($list_category) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("webmin_category/index/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("webmin_category/index/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_category/index/$i/$o") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("webmin_category/index/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("webmin_category/index/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
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