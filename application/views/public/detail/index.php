<div class="container product-page">
	<div class="row">
		<div class="block block-breadcrumbs">
			<ul>
				<li class="home">
					<a href="#"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li><a href="#">Beauty & Perfumes</a><span></span></li>
				<li>Men</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="row">
			<div class="col-sm-5">
				<div class="block block-product-image">
					<div class="product-image easyzoom easyzoom--overlay easyzoom--with-thumbnails">
						<a href="<?=base_url()?>assets/images/produk/1/img-1/cakalang-1.jpg">
							<img src="<?=base_url()?>assets/images/produk/1/img-1/cakalang-1.jpg" alt="Product" width="450" height="450" />
						</a>
					</div>
					<div class="text">Arahkan pada gambar untuk memperbesar</div>
					<div class="product-list-thumb">
						<ul class="thumbnails kt-owl-carousel" data-margin="10" data-nav="true" data-responsive='{"0":{"items":2},"600":{"items":2},"1000":{"items":3}}'>
							<li>
								<a class="selected" href="<?=base_url()?>assets/images/produk/1/img-1/cakalang-1.jpg" data-standard="<?=base_url()?>assets/images/produk/1/img-1/cakalang-1.jpg">
									<img src="<?=base_url()?>assets/images/produk/1/img-1/cakalang-1.jpg" alt="" />
								</a>
							</li>
							<li>
								<a href="<?=base_url()?>assets/images/produk/1/img-2/cakalang-2.jpg" data-standard="<?=base_url()?>assets/images/produk/1/img-2/cakalang-2.jpg">
									<img src="<?=base_url()?>assets/images/produk/1/img-2/cakalang-2.jpg" alt="" />
								</a>
							</li>
							<li>
								<a href="<?=base_url()?>assets/images/produk/1/img-3/cakalang-3.jpg" data-standard="<?=base_url()?>assets/images/produk/1/img-3/cakalang-3.jpg">
									<img src="<?=base_url()?>assets/images/produk/1/img-3/cakalang-3.jpg" alt="" />
								</a>
							</li>
							<li>
								<a href="<?=base_url()?>assets/images/produk/1/img-4/cakalang-4.jpg" data-standard="<?=base_url()?>assets/images/produk/1/img-4/cakalang-4.jpg">
									<img src="<?=base_url()?>assets/images/produk/1/img-4/cakalang-4.jpg" alt="" />
								</a>
							</li>
							<li>
								<a href="<?=base_url()?>assets/images/produk/1/img-5/cakalang-5.jpg" data-standard="<?=base_url()?>assets/images/produk/1/img-5/cakalang-5.jpg">
									<img src="<?=base_url()?>assets/images/produk/1/img-5/cakalang-5.jpg" alt="" />
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="row">
					<div class="col-sm-12 col-md-7">
					<form action="www.google.com" method="post">
						<div class="block-product-info">
							<h2 class="product-name" style="color: #008cba;"><b>Ikan Cakalang</b></h2>
							<div class="informasi_detail_produk"></div>
							<div class="price-box">
								<span class="product-price">Rp 18.000</span>
								<span class="product-price-old">Rp 20.000</span>
							</div>
	                        <div class="desc">
	                        	<table class="border">
	                        		<tr>
	                        			<td style="width: 130px;">Produk No</td>
	                        			<td align="center">:</td>
	                        			<td>240357</td>
	                        		</tr>
	                        		<tr>
	                        			<td>Berat</td>
	                        			<td align="center">:</td>
	                        			<td>2 KG</td>
	                        		</tr>
	                        	</table>
	                        </div>
							<div class="variations-box">
								<table class="variations-table">
									<tr>
										<td>Kuantitas : </td>
										<td>
											<!-- <input type="number" class="form-control text-center" value="1" onchange="autoinsert()" style="width: 80px;" min="1"> -->
											<input type="number" class="form-control text-center" value="1" style="width: 80px;" min="1">
										</td>
										<td>Tersisa 10 buah</td>
									</tr>
								</table>
							</div>
							<div class="informasi_detail_produk"></div>
							<button class="button button-blue button-block display"><i class="fa fa-shopping-basket"></i> Masukkan Keranjang</button>
							<button class="button button-blue button-active-blue button-block"><i class="fa fa-shopping-cart"></i> Beli Sekarang</button>
						</div>
					</form>
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
		                            <form method="post" action="<?=$form_action?>" method="post" accept-charset="utf-8">
		                            <li class="product">
		                                <div class="product-container">
		                                    <div class="product-left">
		                                        <div class="product-thumb">
		                                            <a class="product-img" href="#"><img src="<?=base_url()?>assets/images/produk/1/<?=$data['folder_img']?>/<?=$data['produk_img']?>" alt="" class="img-new"></a>
		                                            <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
		                                        </div>
		                                    </div>
		                                    <div class="product-name-price">
		                                        <div class="product-name">
		                                            <a href="<?=site_url('webmin_detail')?>"><span class="product-name-grid text-short"><?=$data['produk_nm']?></span></a>
		                                        </div>
		                                        <div class="price-box">
		                                            <span class="product-price-grid">Rp <?=digit($data['produk_harga'])?></span>
		                                            <span class="product-price-old-grid">Rp 45.000</span>
		                                        </div>
		                                        <span class="product-city product-icon text-short">
		                                            <img src="<?=base_url()?>assets/images/icon/map-marker.png" class="map-marker maps-marker-icon-new"> <span class="address-new">Kebumen</span>
		                                        </span>
		                                        <span class="product-city product-icon text-short">
		                                            <img src="<?=base_url()?>assets/images/icon/man-icon-2.png" class="map-marker maps-marker-icon-new"> <span class="address-new">Alfian Muhammad Ardianto</span>
		                                        </span>
		                                        <!-- input type hidden -->
		                                        <input type="hidden" name="id" value="<?php echo $data['id_produk']; ?>" />
		                                        <input type="hidden" name="produk_nm" value="<?php echo $data['produk_nm']; ?>" />
		                                        <input type="hidden" name="produk_harga" value="<?php echo $data['produk_harga']; ?>" />
		                                        <input type="hidden" name="produk_desc" value="<?php echo $data['produk_desc']; ?>" />
		                                        <input type="hidden" name="folder_img" value="<?php echo $data['folder_img']; ?>" />
		                                        <input type="hidden" name="produk_img" value="<?php echo $data['produk_img']; ?>" />
		                                        <input type="hidden" name="qty" value="1" />
		                                        <!-- /input type hidden -->
		                                        <center>
		                                            <div class="button-new-product">
		                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-shopping-basket"></i> Keranjang</button>
		                                                <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> Beli Sekarang</a>
		                                            </div>
		                                        </center>
		                                    </div>
		                                </div>
		                            </li>
		                            </form>
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
                    <li class="active"><a data-toggle="tab" href="#tab-1">description</a></li>
                    <li><a data-toggle="tab" href="#tab-2">Additional</a></li>
                    <li><a data-toggle="tab" href="#tab-3">Reviews</a></li>
              	</ul>
			</div>
			<div class="block-inner">
				<div class="tab-container">
					<div id="tab-1" class="tab-panel active">
						<p>
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
						</p>
					</div>
					<div id="tab-2" class="tab-panel">
						<table>
                            <tbody>
                                <tr>
                                    <td>Compositions</td>
                                    <td>Cotton</td>
                                </tr>
                                <tr>
                                    <td>Styles</td>
                                    <td>Girly</td>
                                </tr>
                                <tr>
                                    <td>Properties</td>
                                    <td>Colorful Dress</td>
                                </tr>
                            </tbody>
                        </table>
					</div>
					<div id="tab-3" class="tab-panel">
						<div id="reviews">
							<h4 class="comments-title">1 review for "Cotton Lycra Leggings"</h4>
							<ol class="comment-list">
								<li class="comment">
									<div class="comment-avatar">
										<img src="data/avatar.jpg" alt="Avatar">
									</div>
									<div class="comment-content">
										<div class="comment-meta">
											<a href="#" class="comment-author">jon Conner</a>
											<span class="comment-date">March 14, 2013 at 8:03 am</span>
											<div class="review-rating">
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star-half-o"></i>
					                        </div>
										</div>
										<div class="comment-entry">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
										</div>
										<div class="comment-actions">
											<a class="comment-reply-link" href="#"><i class="fa fa-share"></i> Reply</a>
										</div>
									</div>
								</li>
								<li class="comment">
									<div class="comment-avatar">
										<img src="data/avatar.jpg" alt="Avatar">
									</div>
									<div class="comment-content">
										<div class="comment-meta">
											<a href="#" class="comment-author">jon Conner</a>
											<span class="comment-date">March 14, 2013 at 8:03 am</span>
											<div class="review-rating">
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star"></i>
					                            <i class="fa fa-star-half-o"></i>
					                        </div>
										</div>
										<div class="comment-entry">
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
										</div>
										<div class="comment-actions">
											<a class="comment-reply-link" href="#"><i class="fa fa-share"></i> Reply</a>
										</div>
									</div>
								</li>
							</ol>
							<div class="comment-form">
								<h3 class="comment-reply-title">Leave a Review</h3>
								<small>Your email address will not be published. Required fields are marked *</small>
								<div class="rating">
									<label class="required">Your rating</label>
									<div class="form-rating">
										<label class="radio-inline">
										  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
										</label>
										<label class="radio-inline">
										  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
										</label>
										<label class="radio-inline">
										  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 3
										</label>
										<label class="radio-inline">
										  <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 4
										</label>
										<label class="radio-inline">
										  <input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5"> 5
										</label>
									</div>
								</div>
								<p>
									<label class="required">Name</label>
									<input type="text">
								</p>
								<p>
									<label class="required">Email</label>
									<input type="text">
								</p>
								<p>
									<label>Website</label>
									<input type="text">
								</p>
								<p>
									<label class="required">Comment</label>
									<textarea rows="5"></textarea>	
								</p>
								<p>
									<button class="button">Post review</button>
								</p>
							</div>
						</div>
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
						<?php foreach($list_produk as $data): ?>
						<form method="post" action="<?=$form_action?>" method="post" accept-charset="utf-8">
						<li class="product">
                            <div class="product-container">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        <a class="product-img" href="#"><img src="<?=base_url()?>assets/images/produk/1/<?=$data['folder_img']?>/<?=$data['produk_img']?>" alt="" class="img-new"></a>
                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                    </div>
                                </div>
                                <div class="product-name-price">
                                    <div class="product-name">
                                        <a href="<?=site_url('webmin_detail')?>"><span class="product-name-grid text-short"><?=$data['produk_nm']?></span></a>
                                    </div>
                                    <div class="price-box">
                                        <span class="product-price-grid">Rp <?=digit($data['produk_harga'])?></span>
                                        <span class="product-price-old-grid">Rp 45.000</span>
                                    </div>
                                    <span class="product-city product-icon text-short">
                                        <img src="<?=base_url()?>assets/images/icon/map-marker.png" class="map-marker maps-marker-icon-new"> <span class="address-new">Kebumen</span>
                                    </span>
                                    <span class="product-city product-icon text-short">
                                        <img src="<?=base_url()?>assets/images/icon/man-icon-2.png" class="map-marker maps-marker-icon-new"> <span class="address-new">Alfian Muhammad Ardianto</span>
                                    </span>
                                    <!-- input type hidden -->
                                    <input type="hidden" name="id" value="<?php echo $data['id_produk']; ?>" />
                                    <input type="hidden" name="produk_nm" value="<?php echo $data['produk_nm']; ?>" />
                                    <input type="hidden" name="produk_harga" value="<?php echo $data['produk_harga']; ?>" />
                                    <input type="hidden" name="produk_desc" value="<?php echo $data['produk_desc']; ?>" />
                                    <input type="hidden" name="folder_img" value="<?php echo $data['folder_img']; ?>" />
                                    <input type="hidden" name="produk_img" value="<?php echo $data['produk_img']; ?>" />
                                    <input type="hidden" name="qty" value="1" />
                                    <!-- /input type hidden -->
                                    <center>
                                        <div class="button-new-product text-short">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-shopping-basket"></i> Keranjang</button>
                                            <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> Beli Sekarang</a>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </li>
                   		</form>
                    	<?php endforeach; ?>
					</ul>
				</div>
		</div>
		<!-- ./Related Products -->
	</div>
</div>