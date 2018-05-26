<script type="text/javascript">
    $(function() {
        $('#ses_category,#ses_qty_unit').bind('change',function() {
            $('#form-search').attr('action','<?=site_url("selling/search")?>').submit();
        });
    });
</script>
<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
            <div class="col-sm-3 col-md-2">
                <div class="selling-button">
                    <a href="<?=site_url('selling/form')?>" class="button-selling button-selling-blue">Jual Ikan/Barang</a>
                </div>
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Menu <!-- <span class="pull-right"><i class="fa fa-bars"></i></span> --></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="<?=site_url('web/location/notification')?>" class="background-font"><i class="icon-category fa fa-bell"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png">Notifikasi</a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/selling')?>" class="background-font"><i class="icon-category fa fa-folder" style="margin-left: 19px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png"><b>Jualan Saya</b></a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/profile')?>" class="background-font"><i class="icon-category fa fa-user" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-12.png">Profil</a>
                            </li>
                            <li>
                                <a id="logout2" href="#" class="background-font"><i class="icon-category fa fa-power-off" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-9.png">Logout</a>
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
                        <div class="panel-heading">Data Ikan/Barang Dijual</div>
                        <div class="panel-body">

                            <div class="navs-product nav-border-bottom">
                                <ul class="nav nav-tabs">
                                    <li ><a href="#" class="active">Ikan/Barang Dijual <span class="badge badge-active"><?=$count_on_sale?></span></a></li>
                                    <li><a href="<?=site_url('web/location/selling/draft')?>">Ikan/Barang Draft <span class="badge badge-default"><?=$count_draft?></span></a></li>
                                    <li><a href="<?=site_url('web/location/selling/not_sold')?>">Ikan/Barang Tidak Dijual <span class="badge badge-default"><?=$count_not_sold?></span></a></li>
                                </ul>
                            </div>

                            <div class="filter-product" style="margin-top: 15px;">
                                <form class="form-inline" name="form-search" id="form-search" method="post" action="<?=site_url('selling/search')?>">
                                    <div class="input-group input-filter-product form-filter">
                                    <input type="text" class="form-control" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Cari Ikan/Barang">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            <a href="<?=site_url('web/location/selling')?>" class="btn btn-danger" title="Hapus Filter"><i class="fa fa-times"></i></a>
                                        </span>
                                    </div>
                                    <div class="form-group form-filter">
                                        <select class="form-control select-chosen" name="ses_category" id="ses_category" style="width: 200px;">
                                            <option value="">-- Semua Kategori --</option>
                                            <?php foreach($list_category as $category):?>
                                                <?php if($category['category_parent'] == ''):?>
                                                <optgroup label="<?=$category['category_nm']?>">
                                                <?php else:?>
                                                <option value="<?=$category['category_id']?>" <?php if($category['category_id'] == @$ses_category) echo 'selected'?>><?=$category['category_nm']?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group form-filter">
                                        <select class="form-control select-chosen" name="ses_qty_unit" id="ses_qty_unit" style="width: 177px;">
                                            <option value="">-- Semua Satuan Unit --</option>
                                            <?php foreach($list_qty_unit as $unit):?>
                                                <option value="<?=$unit['parameter_val']?>" <?php if($unit['parameter_val'] == @$ses_qty_unit) echo 'selected'?>><?=$unit['parameter_val']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <div class="category-products">
                                <ul class="products row">
                                    <?php foreach ($list_product as $data): ?>
                                    <li class="product col-xs-12 col-sm-6 col-md-3">
                                        <div class="product-container" style="border: 1px solid blue;">
                                            <div class="inner" style="margin-bottom: -18px;">
                                                <div class="product-left">
                                                    <div class="product-thumb product-grid">
                                                        <a class="product-img" href="#"><img class="img-thumbnail img-customer-product" src="<?=base_url()?>assets/images/produk/<?=@$data['first_image']['image_name']?>" alt="Nama Ikan"></a>
                                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                    </div>
                                                </div>
                                                <div class="product-name-price">
                                                    <div class="product-name">
                                                        <a href="#"><span class="product-name-grid text-short"><?=$data['product_nm']?></span></a>
                                                    </div>
                                                    <div class="price-box">
                                                        <span class="product-price-grid">Rp <?=digit($data['price'])?></span>
                                                        <?php if ($data['price_before'] > $data['price']): ?>
                                                            <span class="product-price-old-grid">Rp <?=digit($data['price_before'])?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <!-- <span class="product-city product-icon text-short text-white">
                                                        <img src="<?=base_url()?>assets/images/icon/map-marker.png" class="map-marker maps-marker-icon-new"> <span class="address-new label label-success">Kebumen</span>
                                                    </span>
                                                    <span class="product-city product-icon text-short text-white">
                                                        <img src="<?=base_url()?>assets/images/icon/man-icon-2.png" class="map-marker maps-marker-icon-new"> <span class="address-new label label-primary">Alfian Muhammad Ardianto</span>
                                                    </span> -->
                                                    <label class="label label-primary" style="font-size: 11px;"><?=$data['qty']?> <?=$data['qty_unit']?></label> 
                                                    <?php if ($data['qty'] <= 4): ?>
                                                        <?php if ($data['qty'] == '0'): ?>
                                                            <label class="label label-danger faa-flash animated" style="font-size: 11px;"><i class="fa fa-warning"></i> STOK HABIS</label>
                                                        <?php else: ?>
                                                            <label class="label label-danger faa-flash animated" style="font-size: 11px;"><i class="fa fa-warning"></i> Stok Hampir Kosong</label>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <center>
                                                        <div class="button-new-product">
                                                            <a href="<?=site_url("selling/form/$p/$o/$data[product_id]")?>" class="btn btn-sm btn-primary bold" style="width: 93px;"><i class="fa fa-edit"></i> Edit</a>
                                                            <a href="#" class="btn btn-sm btn-danger bold" data-p="<?=$p?>" data-o="<?=$o?>" data-product_id="<?=$data['product_id']?>" id="delete_on_sale" style="width: 93px;"><i class="fa fa-times"></i> Hapus</a>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if(count($list_product) == 0):?>
                                    <ul class="products row">
                                        <li class="product col-md-12">
                                            <center>
                                                <img src="<?=base_url()?>assets/images/icon/not-found-icon.png" style="width: 200px;"><br>
                                                <span class="text-not-found">Data tidak ditemukan</span>
                                            </center>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <?php if(count($list_product) > 0):?>
                            <div style="text-align: right;">
                                <ul class="pagination" style="margin-top: 0px; margin-bottom: 0px;">
                                    <?php if($paging->start_link): ?>
                                        <li><a href="<?=site_url("selling/index/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->prev): ?>
                                        <li><a href="<?=site_url("selling/index/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                                    <?php endif; ?>

                                    <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                        <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("selling/index/$i/$o") ?>"><?=$i ?></a></li>
                                    <?php endfor; ?>

                                    <?php if($paging->next): ?>
                                        <li><a href="<?=site_url("selling/index/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                                    <?php endif; ?>
                                    <?php if($paging->end_link): ?>
                                        <li><a href="<?=site_url("selling/index/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif;?>
                        
                    </div>
                </div>
                
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>
</div>