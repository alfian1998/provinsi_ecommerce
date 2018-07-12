<div class="background-img">
<div class="container padding-bottom">
	<div class="row">
        <?php if (@$config['profile']['verification_st'] == '2'): ?>
            <div class="alert alert-green" style="margin-top: 12px; margin-bottom: -10px;"><i class="fa fa-check"></i> Permintaan menjadi Penjual sudah dikirim ke Admin DKP Jateng, Silahkan menunggu verifikasi</div>
        <?php elseif (@$config['profile']['verification_st'] == '1'): ?>
            <?php if (@$config['profile']['notification_verification'] !='1'): ?>
                <div class="alert alert-green" style="margin-top: 12px; margin-bottom: -10px;">
                    <a href="<?=site_url('web/remove_notification/'.@$config['profile']['customer_id'])?>" class="close" style="color: white; opacity: 1;"><span aria-hidden="true">&times;</span></a>
                <i class="fa fa-check"></i> Akun Anda sudah diverifikasi oleh Admin DKP, Anda sudah bisa melakukan penjualan produk</div>
            <?php endif; ?>
        <?php elseif (@$config['profile']['verification_st'] == '0' && @$config['profile']['verification_date'] !=''): ?>
            <div class="alert alert-red" style="margin-top: 12px; margin-bottom: -10px;"><i class="fa fa-times"></i> Maaf, Akun Anda tidak diverifikasi oleh Admin DKP Jateng, Anda tidak bisa melakukan penjualan produk</div>
        <?php endif; ?>
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <?php if ($ses_login == '1'): ?>
                <?php if ($config['profile']['verification_st'] == '1'): ?>
                    <div class="selling-button">
                        <a href="<?=site_url('selling/form')?>" class="button-selling button-selling-blue">Jual Ikan/Barang</a>
                    </div>
                <?php elseif ($config['profile']['verification_st'] == '0'): ?>
                    <div class="selling-button">
                        <button type="button" class="button-selling button-selling-green" data-toggle="modal" data-target="#myModal">Ingin Jadi Penjual?</button>
                    </div>
                <?php elseif ($config['profile']['verification_st'] == '2'): ?>
                    <div class="selling-button">
                        <button type="button" class="button-selling button-selling-green" data-toggle="modal" data-target="#myModal" disabled="" style="cursor: not-allowed;">Ingin Jadi Penjual?</button>
                    </div>
                <?php endif; ?>

                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Menu <!-- <span class="pull-right"><i class="fa fa-bars"></i></span> --></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <?php if ($config['profile']['verification_st'] == '1'): ?>
                            <li >
                                <a href="<?=site_url('web/location/notification')?>" class="background-font"><i class="icon-category fa fa-dollar" style="margin-left: 22px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png">Data Pembeli</a>
                            </li>
                            <li>
                                <a href="<?=site_url('web/location/selling')?>" class="background-font"><i class="icon-category fa fa-folder" style="margin-left: 19px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png">Jualan Saya</a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?=site_url('web/location/profile')?>" class="background-font"><i class="icon-category fa fa-user" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-12.png">Profil</a>
                            </li>
                            <li>
                                <a id="logout2" href="#" class="background-font"><i class="icon-category fa fa-power-off" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-9.png">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php else: ?>
                <div class="block block-vertical-menu">
                    <a href="<?=site_url('web/location/categories')?>">
                        <div class="vertical-head">
                            <h5 class="vertical-title">Kategori <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
                        </div>
                    </a>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <?php foreach ($list_category_parent as $data): ?>
                            <li>
                                <a href="javascript:void(0)" class="background-font text-short" title="<?=$data['category_nm']?>"><i class="icon-category fa fa-tag" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=rand(1,14)?>.png"><?=$data['category_nm']?></a>
                                <div class="vertical-dropdown-menu" style="max-width: 200%!important;">
                                    <div class="vertical-groups">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="block-content-vertical-menu border-left">
                                                    <h3 class="head" style="background:#5d8acb;">SUB KATEGORI <?=$data['category_nm']?></h3>
                                                    <div class="inner">
                                                    <ul class="vertical-menu-link">
                                                        <?php foreach ($data['list_category_by_parent'] as $category): ?>
                                                        <li>
                                                            <a href="<?=site_url('gridview/index/1/0/'.$category['category_id'])?>">
                                                                <span class="text bold"><?=$category['category_nm']?></span>
                                                                <span class="count">(<?=digit($this->category_model->count_product_by_category_id($category['category_id']))?>)</span>
                                                            </a>
                                                        </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-sm-9 col-md-7">
                <!-- Home slide -->
                <div class="block block-slider">
                    <?php if($slideshow != false):?>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <?php foreach($slideshow['slideshow_images'] as $skey => $sval):?>
                        <?php if($slideshow['slideshow_url'] != ''):?>
                            <div class="item <?=($sval['no'] == '1') ? 'active' : ''?>">
                              <a href="http://<?=$slideshow['slideshow_url']?>" target="_blank"><img src="<?=base_url($sval['image_path'] . $sval['image_name'])?>" title="<?=$sval['image_description']?>"></a>
                              <div class="carousel-caption">
                                <h3><?=$sval['image_title']?></h3>
                                <p><?=$sval['image_description']?></p>
                              </div>
                            </div>
                        <?php else: ?>
                            <div class="item <?=($sval['no'] == '1') ? 'active' : ''?>">
                              <img src="<?=base_url($sval['image_path'] . $sval['image_name'])?>" title="<?=$sval['image_description']?>">
                              <?php if ($sval['image_description'] !='' || $sval['image_title'] !=''): ?>
                              <div class="carousel-caption">
                                <h3><?=$sval['image_title']?></h3>
                                <p><?=$sval['image_description']?></p>
                              </div>
                              <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                      </div>

                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- ./Home slide -->
            </div>
            <div class="col-sm-9 col-md-3" style="margin-top: -9px;">
                <div class="block block-top-sellers">
                    <div class="block-head">
                        <div class="block-title">
                            <div class="block-icon">
                                <img src="<?=base_url()?>assets/images/icon/most_popular.png" alt="store icon" style="margin-top: -12px; width: 50px; height: 50px;">
                            </div>
                            <div class="block-title-text text-lg new-text">Populer</div>
                        </div>
                    </div>
                    <div class="block-inner">
                        <ul class="products kt-owl-carousel" data-margin="10" data-items="1" data-autoplay="true" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":1}}'>
                            <?php foreach($list_product_popular as $data): ?>
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

            <div class="block block-products-owl">
                <div class="block-head" style="background: #5a88ca;">
                    <div class="block-title">
                        <div class="text-recommended" style="color: white;">Daftar Produk Terbaru</div>
                    </div>
                </div>
                <div class="block-inner">
                    <ul class="products kt-owl-carousel" data-margin="20" data-autoplay="true" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                        <?php foreach($list_produk as $data): ?>
                        <!-- <form method="post" action="<?=$form_action?>" method="post" accept-charset="utf-8"> -->
                        <li class="product">
                            <div class="product-container">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        <a class="product-img" href="<?=site_url('web/details/'.$data['product_id'].'/'.$data['product_url'])?>"><img src="<?=base_url()?>assets/images/produk/<?=$data['first_image']['image_name']?>" alt="" class="img-new"></a>
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
                                        <div class="button-new-product text-short">
                                            <?php if ($ses_customer_id == $data['customer_id']): ?>
                                                <a href="<?=site_url('web/details/'.$data['product_id'].'/'.$data['product_url'])?>" class="btn btn-sm btn-primary btn-block"><i class="fa fa-eye"></i> Lihat Ikan/Barang</a>
                                            <?php else: ?>
                                                <button class="add_cart btn btn-sm btn-primary" data-product_id="<?=$data['product_id']?>" data-product_nm="<?=$data['product_nm']?>" data-product_desc="<?=$data['product_desc']?>" data-price="<?=$data['price']?>" data-price_before="<?=$data['price_before']?>" data-product_img="<?=@$data['first_image']['image_name']?>" data-customer_nm="<?=$data['customer_nm']?>" data-customer_id="<?=$data['customer_id']?>" data-qty_product="<?=$data['qty']?>" data-qty_unit="<?=$data['qty_unit']?>" data-product_url="<?=$data['product_url']?>"><i class="fa fa-shopping-basket"></i> Keranjang</button>
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

            <!-- <div class="row" style="padding-top: 20px;">
              <?php foreach ($list_category as $data): ?>
              <div class="col-md-2">
                <div class="thumbnail">
                  <a href="<?=site_url('listview/index/1/0/'.$data['category_id'])?>" title="<?=$data['category_nm']?>">
                    <img src="<?=base_url()?>assets/images/category/<?=($data['category_img'] != '') ? $data['category_img'] : 'no-img-category.png'?>" alt="Lights" style="height: 100px;">
                    <div class="caption" style="text-align: center;">
                      <div class="text-box-category text-short"><?=$data['category_nm']?></div>
                    </div>
                  </a>
                </div>
              </div>
              <?php endforeach; ?>
            </div> -->

	</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?=site_url('web/verification_seller/'.$config['profile']['customer_id'])?>" method="post" enctype="multipart/form-data" id="form-validate">  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Verifikasi Penjual</h4>
      </div>
      <div class="modal-body">
        <label>Anda ingin menjadi penjual ?</label>
        <label>Silahkan masukkan NIK Anda dan Upload Foto KTP Anda</label>
        <div class="cart-line"></div>
        <div class="form-group">
            <label>Nomor Induk Kependudukan (NIK)</label>
            <input type="text" name="nik" class="form-control" placeholder="NIK" style="width: 70%;">
        </div>
        <div class="cart-line"></div>
        <div class="form-group">
            <label>Foto KTP</label>
            <input type="file" name="ktp_img" class="form-control" style="width: 50%;">
        </div>
        <div class="cart-line"></div>
        <label style="color: red;">* Penjual hanya boleh warga di Wilayah Jawa Tengah</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button type="submit" class="btn btn-primary">Kirim <i class="fa fa-send"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>