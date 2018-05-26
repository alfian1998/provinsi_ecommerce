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
                    <li><a href="<?=site_url('webmin/location/region')?>">Wilayah (Provinsi)</a><span></span></li>
                    <li>Wilayah (Kabupaten)</li>
                </ul>
            </div>
            </div>
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Master Data <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="<?=site_url('webmin/location/config')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Profil Web</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/parameter')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Parameter</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/region')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png"><b>Wilayah</b></a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/category')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Kategori</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/bank')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Setting Bank</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/slideshow')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Slide Show</a>
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
                        <div class="panel-heading"><b>Data Kabupaten dari Provinsi <u><?=$get_provinsi['nama']?></u></b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <form name="form-search" method="post" action="<?=site_url('webmin_region/search_kabupaten/'.$p.'/'.$o.'/'.$get_provinsi['id_prov'])?>" class="form-inline">
                                <div class="filter-data">
                                    <a href="<?=site_url("webmin_region/form_kabupaten/$p/$o/$get_provinsi[id_prov]")?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                                    <div class="input-group input-filter-product pull-right">
                                    <input type="text" class="form-control" name="ses_txt_search_kabupaten" value="<?=@$ses_txt_search_kabupaten?>" placeholder="Pencarian ...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?=site_url('webmin_region/location_kab/'.$p.'/'.$o.'/'.$get_provinsi['id_prov'])?>" class="btn btn-danger" title="Hapus Filter"><i class="fa fa-times"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div style="padding-bottom: 10px;">
                                <label class="label label-danger" style="font-size: 13px;">Keterangan : Klik salah satu Kode Kabupaten Untuk melihat Kecamatan</label>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-boostrap">
                                    <tr>
                                        <th width="2%" class="text-center">No</th>
                                        <th width="7%" class="text-center">Aksi</th>
                                        <th width="15%" class="text-center">Kode Kabupaten</th>
                                        <th>Kabupaten</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_kabupaten as $data): ?>
                                    <tr>
                                        <td align="center"><?=$data['no']?></td>
                                        <td align="center">
                                            <a href="<?=site_url("webmin_region/form_kabupaten/$p/$o/$get_provinsi[id_prov]/$data[id_kab]")?>" class="btn btn-xs btn-success" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=site_url("webmin_region/delete_kab/$p/$o/$get_provinsi[id_prov]/$data[id_kab]")?>" id="delete_parameter" class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td align="center"><a style="color: blue" href="<?=site_url("webmin_region/kecamatan/$p/$o/$data[id_prov]/$data[id_kab]")?>"><b><?=$data['id_kab']?></b></a></td>
                                        <td><?=$data['nama']?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="pull-left">
                                <label class="label label-primary" style="font-size: 13px;">Terdapat <?=$count_kabupaten?> Data Kabupaten</label>
                            </div>
                            <?php if(count($list_kabupaten) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("webmin_region/kabupaten/$paging->c_start_link/$o/$get_provinsi[id_prov]") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("webmin_region/kabupaten/$paging->prev/$o/$get_provinsi[id_prov]") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_region/kabupaten/$i/$o/$get_provinsi[id_prov]") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("webmin_region/kabupaten/$paging->next/$o/$get_provinsi[id_prov]") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("webmin_region/kabupaten/$paging->c_end_link/$o/$get_provinsi[id_prov]") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
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