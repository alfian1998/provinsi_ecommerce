<div class="background-img">
<div class="container padding-bottom">
	<div class="row">
        <div class="block block-breadcrumbs">
            <ul>
                <li class="home">
                    <a href="<?=site_url('')?>"><i class="fa fa-home" style="font-size: 18px;"></i></a>
                    <span></span>
                </li>
                <li>Kategori</li>
            </ul>
        </div>
		<div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Kategori <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <?php foreach ($list_category_parent as $data): ?>
                            <li>
                                <a href="javascript:void(0)" class="background-font " onclick="openCity(event, '<?=$data["category_id"]?>')" id="defaultOpen"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=rand(1,13)?>.png"><?=$data['category_nm']?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-sm-5 col-md-7">
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title"><!-- Text --></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <?php foreach ($list_category_parent as $data): ?>
                        <div id="<?=$data['category_id']?>" class="tabcontent">
                            <!-- Content -->
                            <img class="img-categories" src="<?=base_url()?>assets/images/icon/category-icon.png" style="width: 100px; margin-top: 13px; margin-right: 30px;">
                            <div class="text-categories-title"><?=$data['category_nm']?></div>
                            <div class="text-categories-count"><?=digit($this->category_model->count_product_by_parent($data['category_id']))?> produk</div>
                            <div class="button-category-all">
                                <a href="<?=site_url('gridview/all/1/0/'.$data['category_id'])?>" class="btn btn-sm btn-success btn-all-categories">Semua produk di kategori ini <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <div class="line"></div>
                            <div class="text-desc">
                                <?php foreach ($data['list_category_by_parent'] as $category): ?>
                                    <a href="<?=site_url('gridview/index/1/0/'.$category['category_id'])?>" class="btn btn-sm btn-primary btn-desc"><?=$category['category_nm']?></a>
                                <?php endforeach; ?>
                            </div>
                            <div class="line"></div>
                            <!-- /Content -->
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-3" style="margin-top: -9px;">
                <div class="block block-top-sellers">
                    <div class="block-head">
                        <div class="block-title">
                            <div class="block-icon">
                                <img src="<?=base_url()?>assets/images/icon/new-icon-1.png" alt="store icon" style="margin-top: -12px;">
                            </div>
                            <div class="block-title-text text-lg new-text">Terbaru</div>
                        </div>
                    </div>
                    <div class="block-inner">
                        <ul class="products kt-owl-carousel" data-margin="10" data-items="1" data-autoplay="true" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":1}}'>
                            <?php foreach($list_produk as $data): ?>
                            <!-- <form method="post" action="<?=$form_action?>" method="post" accept-charset="utf-8"> -->
                            <!-- <form id="form" class="" action="" method="post" accept-charset="utf-8"> -->
                            <li class="product">
                                <div class="product-container">
                                    <div class="product-left">
                                        <div class="product-thumb">
                                            <a class="product-img" href="<?=site_url('web/details/'.$data['product_id'].'/'.$data['product_url'])?>"><img src="<?=base_url()?>assets/images/produk/<?=@$data['first_image']['image_name']?>" alt="" class="img-new"></a>
                                            <a title="Quick View" href="<?=site_url('web/details/'.$data['product_id'].'/'.$data['product_url'])?>" class="btn-quick-view">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-name-price">
                                        <div class="product-name">
                                            <a href="<?=site_url('web/details/'.$data['product_id'].'/'.$data['product_url'])?>"><span class="product-name-grid text-short"><?=$data['product_nm']?></span></a>
                                        </div>
                                        <div class="price-box">
                                            <span class="product-price-grid">Rp <?=digit($data['price'])?></span>
                                            <?php if ($data['price_before'] > $data['price']): ?>
                                                <span class="product-price-old-grid">Rp <?=digit($data['price_before'])?></span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="product-city product-icon text-short">
                                            <img src="<?=base_url()?>assets/images/icon/man-icon-2.png" class="map-marker maps-marker-icon-new"> <span class="address-new"><?=$data['customer_nm']?></span>
                                        </span>
                                        <center>
                                            <div class="button-new-product">
                                                <?php if ($ses_customer_id == $data['customer_id']): ?>
                                                    <a href="<?=site_url('web/details/'.$data['product_id'].'/'.$data['product_url'])?>" class="btn btn-sm btn-primary btn-block"><i class="fa fa-eye"></i> Lihat Ikan/Barang</a>
                                                <?php else: ?>
                                                    <button class="add_cart btn btn-sm btn-primary" data-product_id="<?=$data['product_id']?>" data-product_nm="<?=$data['product_nm']?>" data-product_desc="<?=$data['product_desc']?>" data-price="<?=$data['price']?>" data-price_before="<?=$data['price_before']?>" data-product_img="<?=@$data['first_image']['image_name']?>" data-customer_nm="<?=$data['customer_nm']?>" data-customer_id="<?=$data['customer_id']?>" data-qty_product="<?=$data['qty']?>" data-qty_unit="<?=$data['qty_unit']?>" data-product_url="<?=$data['product_url']?>"><i class="fa fa-shopping-basket"></i> Ke Keranjang</button>
                                                    <a href="<?=site_url('web/details/'.$data['product_id'].'/'.$data['product_url'])?>" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> Beli Sekarang</a>
                                                <?php endif; ?>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </li>
                            <!-- </form> -->
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
</div>