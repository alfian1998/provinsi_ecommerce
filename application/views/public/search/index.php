<script type="text/javascript">
    $(function() {
        $('#ses_urutan,#ses_kabupaten,#ses_kecamatan,#ses_kelurahan').bind('change',function() {
            $('#form-search').attr('action','<?=site_url("search/search/".$p."/".$o)?>').submit();
        });
        //
        <?php if(@$ses_kabupaten != ''):?>
        ses_kecamatan('<?=$ses_kabupaten?>','<?=$ses_kecamatan?>');
        <?php endif;?>
        //
        $('#ses_kabupaten').bind('change',function(e) {
            e.preventDefault();
            var i = $(this).val();
            ses_kecamatan(i);
        });
        function ses_kecamatan(i,k) {
            $.get('<?=site_url("search/ajax/ses_kecamatan/".$p."/".$o)?>?ses_kabupaten='+i+'&ses_kecamatan='+k,null,function(data) {
                $('#box_kecamatan').html(data.html);
            },'json');
        }
    });
</script>
<div class="background-img">
<div class="container padding-bottom">
	<div class="row">
        <div class="block block-breadcrumbs">
            <ul>
                <li class="home">
                    <a href="<?=site_url('')?>"><i class="fa fa-home" style="font-size: 18px;"></i></a>
                    <span></span>
                </li>
                <li><a href="<?=site_url('web/location/categories')?>">Kategori View</a><span></span></li>
                <li>Pencarian (<?=$ses_search?>)</li>
            </ul>
        </div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-3">
                <!-- filter -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Filter Data</h5>
                    </div>
                    <div class="vertical-menu-content">
                        <form class="form-inline" name="form-search" id="form-search" method="post" action="<?=site_url('search/search/'.$p.'/'.$o)?>">
                        <table class="no-border">
                            <tr>
                                <td class="no-border">Urutan</td>
                                <td class="no-border">:</td>
                                <td class="no-border">
                                    <select name="ses_urutan" id="ses_urutan" style="width: 96%">
                                        <option value="">-- Semua Urutan</option>
                                        <option value="terbaru" <?php if(@$ses_urutan == 'terbaru') echo 'selected'?>>Terbaru</option>
                                        <option value="termurah" <?php if(@$ses_urutan == 'termurah') echo 'selected'?>>Termurah</option>
                                        <option value="termahal" <?php if(@$ses_urutan == 'termahal') echo 'selected'?>>Termahal</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="no-border">Kabupaten</td>
                                <td class="no-border">:</td>
                                <td class="no-border">
                                    <select class="select-chosen ses_kabupaten" name="ses_kabupaten" id="ses_kabupaten" style="width: 100%;">
                                        <option value="">-- Semua Kabupaten --</option>
                                        <?php foreach ($list_kabupaten as $data): ?>
                                            <option value="<?=$data['id_kab']?>" <?php if(@$ses_kabupaten == $data['id_kab']) echo 'selected'?>><?=$data['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="no-border">Kecamatan</td>
                                <td class="no-border">:</td>
                                <td class="no-border">
                                    <div id="box_kecamatan">
                                        <select class="select-chosen" name="ses_kecamatan" id="ses_kecamatan" style="width: 96%;">
                                            <option value="">-- Semua Kecamatan --</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="no-border">Kelurahan</td>
                                <td class="no-border">:</td>
                                <td class="no-border">
                                    <div id="box_kelurahan">
                                        <select class="select-chosen" name="ses_kelurahan" id="ses_kelurahan" style="width: 96%;">
                                            <option value="">-- Semua Kelurahan --</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="no-border" colspan="3">
                                    <button class="btn btn-primary" type="submit" style="width: 49%">Search <i class="fa fa-search"></i></button>
                                    <a href="<?=site_url('web/location')?>" class="btn btn-danger" style="width: 49%">Batal <i class="fa fa-refresh"></i></a>
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                <!-- /filter -->
				<!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Kategori</h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <?php foreach ($list_category as $data): ?>
                            <li>
                                <a href="<?=site_url('gridview/index/1/0/'.$data['category_id'])?>" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=rand(1,14)?>.png"><?=$data['category_nm']?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9">
				<div class="box-panel" style="margin-bottom: -20px;">
					<div class="panel panel-primary">
						<div class="panel-heading text-box-panel"><i class="fa fa-th"></i> Pencarian</div>
					</div>
				</div>
				<div class="category-products" style="margin-top: -15px;">
					<ul class="products row">
                        <?php foreach ($list_product as $data): ?>
                        <li class="product col-xs-12 col-sm-6 col-md-3">
                            <div class="product-container" style="border: 1px solid blue; background: white;">
                                <div class="inner" style="margin-bottom: -18px;">
                                    <div class="product-left">
                                        <div class="product-thumb product-grid">
                                            <a class="product-img" href="<?=site_url('web/details/'.md5(md5(md5(md5(md5($data['product_id']))))))?>"><img class="img-thumbnail img-grid-product" src="<?=base_url()?>assets/images/produk/<?=@$data['first_image']['image_name']?>" alt="Nama Ikan"></a>
                                            <a title="Quick View" href="<?=site_url('web/details/'.md5(md5(md5(md5(md5($data['product_id']))))))?>" class="btn-quick-view">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-name-price">
                                        <div class="product-name">
                                            <a href="<?=site_url('web/details/'.md5(md5(md5(md5(md5($data['product_id']))))))?>"><span class="product-name-grid text-short"><?=$data['product_nm']?></span></a>
                                        </div>
                                        <div class="price-box">
                                            <span class="product-price-grid">Rp <?=digit($data['price'])?></span>
                                            <?php if ($data['price_before'] > $data['price']): ?>
                                                <span class="product-price-old-grid">Rp <?=digit($data['price_before'])?></span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="product-city product-icon text-short text-white">
                                            <img src="<?=base_url()?>assets/images/icon/map-marker.png" class="map-marker maps-marker-icon-new"> <span class="address-new label label-success"><?=($data['kel_nm'] && $data['kec_nm'] && $data['kab_nm'] && $data['prov_nm'] !='') ? $data['kel_nm'].', '.$data['kec_nm'].', '.$data['kab_nm'].', '.$data['prov_nm'] : '-' ?></span>
                                        </span>
                                        <span class="product-city product-icon text-short text-white">
                                            <img src="<?=base_url()?>assets/images/icon/man-icon-2.png" class="map-marker maps-marker-icon-new"> <span class="address-new label label-primary"><?=$data['customer_nm']?></span>
                                        </span>
                                        <center>
                                            <div class="button-new-product">
                                                <?php if ($ses_customer_id == $data['customer_id']): ?>
                                                    <a href="<?=site_url('web/details/'.md5(md5(md5(md5(md5($data['product_id']))))))?>" class="btn btn-sm btn-primary" style="width: 100%"><i class="fa fa-eye"></i> Lihat Ikan/Barang</a>
                                                <?php else: ?>
                                                    <button class="add_cart btn btn-sm btn-primary" data-product_id="<?=$data['product_id']?>" data-product_nm="<?=$data['product_nm']?>" data-product_desc="<?=$data['product_desc']?>" data-price="<?=$data['price']?>" data-price_before="<?=$data['price_before']?>" data-product_img="<?=@$data['first_image']['image_name']?>" data-customer_nm="<?=$data['customer_nm']?>" data-customer_id="<?=$data['customer_id']?>" data-qty_product="<?=$data['qty']?>" data-qty_unit="<?=$data['qty_unit']?>"><i class="fa fa-shopping-basket"></i> Keranjang</button>
                                                    <a href="<?=site_url('web/details/'.md5(md5(md5(md5(md5($data['product_id']))))))?>" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> Beli</a>
                                                <?php endif; ?>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php if(count($list_product) == ''): ?>
                        <li class="product product-width" style="margin-bottom: 10px; padding-right: 15px; padding-left: 15px;">
                            <div class="product-container" style="background: white;">
                                <div class="inner row">
                                    <center>
                                        <img src="<?=base_url()?>assets/images/icon/not-found-icon.png" style="width: 200px;">
                                        <br>
                                        <span class="text-not-found-list">Produk dengan kata kunci <u><?=$ses_search?></u> tidak ada</span>
                                    </center>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
				</div>
                <?php if(count($list_product) > 0):?>
                    <div style="text-align: right;">
                        <ul class="pagination" style="margin-top: 17px; margin-bottom: 0px;">
                            <?php if($paging->start_link): ?>
                                <li><a href="<?=site_url("search/index/$paging->c_start_link/$o") ?>"><span><i class="fa fa-angle-double-left"></i></span></a></li>
                            <?php endif; ?>
                            <?php if($paging->prev): ?>
                                <li><a href="<?=site_url("search/index/$paging->prev/$o") ?>"><span><i class="fa fa-angle-left"></i></span></a></li>
                            <?php endif; ?>

                            <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
                                <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("search/index/$i/$o") ?>"><?=$i ?></a></li>
                            <?php endfor; ?>

                            <?php if($paging->next): ?>
                                <li><a href="<?=site_url("search/index/$paging->next/$o") ?>"><span><i class="fa fa-angle-right"></i></span></a></li>
                            <?php endif; ?>
                            <?php if($paging->end_link): ?>
                                <li><a href="<?=site_url("search/index/$paging->c_end_link/$o") ?>"><span><i class="fa fa-angle-double-right"></i></span></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif;?>
			</div>
		</div>
	</div>
</div>
</div>