<div class="container product-page">
	<div class="row">
		<div class="block block-breadcrumbs">
            <ul>
                <li class="home">
                    <a href="<?=site_url('')?>"><i class="fa fa-home" style="font-size: 18px;"></i></a>
                    <span></span>
                </li>
                <li><a href="#">Detail</a><span></span></li>
                <li><?=$main['product_nm']?></li>
            </ul>
        </div>
		<div class="row">
			<div class="col-sm-5">
				<div class="block block-product-image">
					<div class="product-image easyzoom easyzoom--overlay easyzoom--with-thumbnails">
						<a href="<?=base_url()?>assets/images/produk/<?=$main['first_image']['image_name']?>">
							<img src="<?=base_url()?>assets/images/produk/<?=$main['first_image']['image_name']?>" alt="Product" width="450" height="450" />
						</a>
					</div>
					<div class="text">Arahkan pada gambar untuk memperbesar</div>
					<div class="product-list-thumb">
						<ul class="thumbnails kt-owl-carousel" data-margin="10" data-nav="true" data-responsive='{"0":{"items":2},"600":{"items":2},"1000":{"items":3}}'>
							<?php foreach ($main['product_image'] as $image): ?>
							<li>
								<a class="selected" href="<?=base_url()?>assets/images/produk/<?=$image['image_name']?>" data-standard="<?=base_url()?>assets/images/produk/<?=$image['image_name']?>">
									<img src="<?=base_url()?>assets/images/produk/<?=$image['image_name']?>" alt="" />
								</a>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<div class="col-sm-12 col-md-7">
					<!-- <form action="www.google.com" method="post"> -->
						<div class="block-product-info">
							<div class="product-name" style="color: #008cba;"><b><?=$main['product_nm']?></b></div>
							<div class="informasi_detail_produk"></div>
							<div class="price-box">
								<span class="product-price">Rp <?=digit($main['price'])?></span>
								<?php if ($main['price_before'] > $main['price']): ?>
                                    <span class="product-price-old">Rp <?=digit($main['price_before'])?></span>
                                <?php endif; ?>
							</div>
	                        <div class="desc table-responsive">
	                        	<table class="table">
	                        		<tr>
	                        			<th style="width: 130px;">Kategori</th>
	                        			<th class="text-center">:</th>
	                        			<td><b>(<?=$main['parent_nm']?>)</b> <?=$main['category_nm']?></td>
	                        		</tr>
	                        		<tr>
	                        			<th>Nama Penjual</th>
	                        			<th class="text-center">:</th>
	                        			<td><?=$main['customer_nm']?></td>
	                        		</tr>
	                        		<tr>
	                        			<th>Alamat Penjual</th>
	                        			<th class="text-center">:</th>
	                        			<td><?=($main['kel_nm'] && $main['kec_nm'] && $main['kab_nm'] && $main['prov_nm'] !='') ? $main['kel_nm'].', '.$main['kec_nm'].', '.$main['kab_nm'].', '.$main['prov_nm'] : '-' ?></td>
	                        		</tr>
	                        		<tr>
	                        			<th>Alamat Lengkap</th>
	                        			<th class="text-center">:</th>
	                        			<td><?=($main['customer_address'] != '') ? $main['customer_address'] : '-'?></td>
	                        		</tr>
	                        		<tr>
	                        			<th>No HP Penjual</th>
	                        			<th class="text-center">:</th>
	                        			<td><?=($main['customer_phone'] != '') ? $main['customer_phone'] : '-'; ?></td>
	                        		</tr>
	                        		<tr>
	                        			<th>Dilihat</th>
	                        			<th class="text-center">:</th>
	                        			<td><?=$main['hit']?>x</td>
	                        		</tr>
	                        	</table>
	                        </div>
							<div class="variations-box">
								<table class="variations-table">
									<tr>
										<td>Jumlah Beli : </td>
										<td>
											<div class="form-inline">
												<?php if ($ses_customer_id == $main['customer_id']): ?>
													<input type="number" class="form-control text-center" id="<?=$main['product_id']?>" value="1" style="width: 80px;" min="1" disabled>
												<?php else: ?>
													<input type="number" class="form-control text-center" id="<?=$main['product_id']?>" value="1" style="width: 80px;" min="1">
												<?php endif; ?>
												<label class="label label-primary label-qty-detail"> Kg</label>
												<span style="padding-left: 10px;">
													<label class="label label-danger label-qty-left">Tersisa <?=$main['qty']?> <?=$main['qty_unit']?></label>
												</span>
											</div>
										</td>
									</tr>
								</table>
							</div>
							<div class="informasi_detail_produk"></div>
							<?php if ($ses_customer_id == $main['customer_id']): ?>
								<div style="margin-top: 10px;">
									<label class="label label-danger" style="padding: 10px; font-size: 13px;"><i class="fa fa-warning"></i> Ini adalah Ikan/Barang yang Anda jual</label>
								</div>
							<?php else: ?>
								<div class="btn-detail">
									<button class="buy_now btn btn-success btn-block btn-buy-now" data-product_id="<?=$main['product_id']?>" data-product_nm="<?=$main['product_nm']?>" data-product_desc="<?=$main['product_desc']?>" data-price="<?=$main['price']?>" data-price_before="<?=$main['price_before']?>" data-product_img="<?=@$main['first_image']['image_name']?>" data-customer_nm="<?=$main['customer_nm']?>" data-customer_id="<?=$main['customer_id']?>" data-qty_product="<?=$main['qty']?>" data-qty_unit="<?=$main['qty_unit']?>" data-product_url="<?=$main['product_url']?>"><i class="fa fa-shopping-cart"></i> Beli Sekarang</button>
									<button class="add_cart_details btn btn-primary" data-product_id="<?=$main['product_id']?>" data-product_nm="<?=$main['product_nm']?>" data-product_desc="<?=$main['product_desc']?>" data-price="<?=$main['price']?>" data-price_before="<?=$main['price_before']?>" data-product_img="<?=@$main['first_image']['image_name']?>" data-customer_nm="<?=$main['customer_nm']?>" data-customer_id="<?=$main['customer_id']?>" data-qty_product="<?=$main['qty']?>" data-qty_unit="<?=$main['qty_unit']?>" data-product_url="<?=$main['product_url']?>"><i class="fa fa-shopping-basket"></i> Tambahkan ke Keranjang</button>
									<?php if ($ses_customer_id != ''): ?>
										<a href="javascript:void(0)" class="btn btn-warning btn-chat" onclick="javascript:chatWith('<?=$main["customer_chat_nm"]?>')"><i class="fa fa-comments"></i> Chat Penjual</a>
									<?php else: ?>
										<a href="#" id="chat" class="btn btn-warning btn-chat"><i class="fa fa-comments"></i> Chat Penjual</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					<!-- </form> -->
					</div>
					<div class="col-sm-12 col-md-5">
						<!-- block  top sellers -->
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
						<!-- block  top sellers -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<!-- Product tab -->
		<div class="block block-tabs tab-left">
			<div class="block-head">
				<ul class="nav-tab">                                   
                    <li class="active"><a data-toggle="tab" href="#tab-1">Deskripsi Ikan/Barang</a></li>
              	</ul>
			</div>
			<div class="block-inner">
				<div class="tab-container">
					<div id="tab-1" class="tab-panel active">
						<p><?=$main['product_desc']?></p>
					</div>
				</div>
			</div>
		</div>
		<!-- Product tab -->
		<!-- Related Products -->
		<div class="block block-products-owl">
			<div class="block-head" style="background: #5a88ca;">
				<div class="block-title">
					<div class="text-recommended" style="color: white;">Rekomendasi Untuk Anda</div>
				</div>
			</div>
			<div class="block-inner">
					<ul class="products kt-owl-carousel" data-margin="20" data-autoplay="true" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
						<?php foreach($list_product_recommendat as $data): ?>
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
		<!-- ./Related Products -->
	</div>
</div>