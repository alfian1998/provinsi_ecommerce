<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Kategori</h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Ikan Laut</a>
                            </li>
                            <li >
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-5.png">Ikan Tambak</a>
                            </li>
                            <li>
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png">Ikan Budidaya</a>
                            </li>
                            <li>
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png">Ikan Hias</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Data Ikan</div>
                        <div class="panel-body">
                            <div style="margin-bottom: 15px;">
                                <a href="<?=site_url('webmin_data/form')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-boostrap">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center" width="15%">Image</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_data as $data): ?>
                                    <tr>
                                        <td align="center"><?=$data['no']?></td>
                                        <td><img class="img-thumbnail" src="<?=base_url()?>assets/images/produk/<?=@$data['first_image']['image_name']?>" style="width: 130px; height: 100px;"></td>
                                        <td><?=$data['produk_nm']?></td>
                                        <td><?=$data['produk_desc']?></td>
                                        <td>Rp <?=digit($data['produk_harga'])?></td>
                                        <td align="center">
                                            <a href="<?=site_url("webmin_data/form/$p/$o/$data[id_produk]")?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=site_url("webmin_data/delete/$p/$o/$data[id_produk]")?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <?php if(count($list_data) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("webmin_data/index/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("webmin_data/index/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_data/index/$i/$o") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("webmin_data/index/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("webmin_data/index/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
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