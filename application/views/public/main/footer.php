<!-- footer -->
	<footer id="footer">
        <div class="footer-social">
            <div class="container">
                <div class="row">
                    <div class="block-social">
                        <ul class="list-social">
                            <?=($config['config']['fb'] !='') ? '<li><a target="_blank" href="https://'.$config['config']['fb'].'"><i class="fa fa-facebook"></i></a></li>' : ''?>
                            <?=($config['config']['twitter'] !='') ? '<li><a target="_blank" href="https://'.$config['config']['twitter'].'"><i class="fa fa-twitter"></i></a></li>' : ''?>
                            <?=($config['config']['instagram'] !='') ? '<li><a target="_blank" href="https://'.$config['config']['instagram'].'"><i class="fa fa-instagram"></i></a></li>' : ''?>
                            <?=($config['config']['gplus'] !='') ? '<li><a target="_blank" href="https://'.$config['config']['gplus'].'"><i class="fa fa-google-plus"></i></a></li>' : ''?>
                            <?=($config['config']['youtube'] !='') ? '<li><a target="_blank" href="https://'.$config['config']['youtube'].'"><i class="fa fa-youtube"></i></a></li>' : ''?>
                            <?=($config['config']['linkedin'] !='') ? '<li><a target="_blank" href="https://'.$config['config']['linkedin'].'"><i class="fa fa-linkedin"></i></a></li>' : ''?>
                        </ul>
                    </div>
                    <div class="block-payment">
                        <ul class="list-logo">
                            <li><a href="#"><img src="<?=base_url()?>assets/images/logo/bank/10.png" alt="Bank Jateng" style="height: 27px;"></a></li>
                            <li><a target="_blank" href="http://dkp.jatengprov.go.id/"><img src="<?=base_url()?>assets/images/logo/logo.png" alt="Dinas Kelautan dan Perikanan Provinsi Jawa Tengah" style="height: 27px;"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="block-coppyright">
                        © <?=$config['config']['copyright']?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	<!-- ./footer -->
    <style type="text/css">
        .swal-text {
            font-weight: bold;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add_cart').click(function(){
                var product_id      = $(this).data("product_id");
                var product_nm      = $(this).data("product_nm");
                var product_desc    = $(this).data("product_desc");
                var price           = $(this).data("price");
                var price_before    = $(this).data("price_before");
                var product_img     = $(this).data("product_img");
                var customer_nm     = $(this).data("customer_nm");
                var customer_id     = $(this).data("customer_id");
                var qty_product     = $(this).data("qty_product");
                var qty_unit        = $(this).data("qty_unit");
                var quantity        = $('#' + product_id).val();
                $.ajax({
                    url : "<?=site_url('web/input')?>",
                    method : "POST",
                    data : {product_id: product_id, product_nm: product_nm, product_desc: product_desc, price: price, price_before: price_before, product_img: product_img, customer_nm: customer_nm, customer_id: customer_id, qty_product: qty_product, qty_unit: qty_unit, quantity: quantity},
                    success: function(data){
                        if (qty_product == 0) {
                            swal({
                              text: 'Maaf, stok tidak kosong',
                              icon: "warning",
                              timer: 4000
                            });
                            $('#show_cart').html(data);
                        }else{
                            swal({
                              text: "Produk telah ditambahkan ke keranjang belanja",
                              icon: "success",
                              timer: 4000
                            });
                            $('#show_cart').html(data);
                        }
                    }
                });
            });

            $('.add_cart_details').click(function(){
                var product_id      = $(this).data("product_id");
                var product_nm      = $(this).data("product_nm");
                var product_desc    = $(this).data("product_desc");
                var price           = $(this).data("price");
                var price_before    = $(this).data("price_before");
                var product_img     = $(this).data("product_img");
                var customer_nm     = $(this).data("customer_nm");
                var customer_id     = $(this).data("customer_id");
                var qty_product     = $(this).data("qty_product");
                var qty_unit        = $(this).data("qty_unit");
                var quantity_before = $('#' + product_id).val();
                if(quantity_before > qty_product) {
                    var quantity = 0;
                }else {
                    var quantity = quantity_before;
                }
                $.ajax({
                    url : "<?=site_url('web/insert_cart_details')?>",
                    method : "POST",
                    data : {product_id: product_id, product_nm: product_nm, product_desc: product_desc, price: price, price_before: price_before, product_img: product_img, customer_nm: customer_nm, customer_id: customer_id, qty_product: qty_product, qty_unit: qty_unit, quantity: quantity},
                    success: function(data){
                        if(quantity_before > qty_product) {
                            swal({
                              text: 'Maaf, jumlah tidak boleh melebihi stok',
                              icon: "warning",
                              timer: 4000
                            });
                            $('#show_cart').html(data);
                        }else{
                            swal({
                              text: "Produk telah ditambahkan ke keranjang belanja",
                              icon: "success",
                              timer: 4000
                            });
                            $('#show_cart').html(data);
                        }
                    }
                });
            });

            $('.buy_now').click(function(){
                var product_id      = $(this).data("product_id");
                var product_nm      = $(this).data("product_nm");
                var product_desc    = $(this).data("product_desc");
                var price           = $(this).data("price");
                var price_before    = $(this).data("price_before");
                var product_img     = $(this).data("product_img");
                var customer_nm     = $(this).data("customer_nm");
                var customer_id     = $(this).data("customer_id");
                var qty_product     = $(this).data("qty_product");
                var qty_unit        = $(this).data("qty_unit");
                var quantity_before = $('#' + product_id).val();
                if(quantity_before > qty_product) {
                    var quantity = 0;
                }else {
                    var quantity = quantity_before;
                }
                $.ajax({
                    url : "<?=site_url('web/insert_cart_details')?>",
                    method : "POST",
                    data : {product_id: product_id, product_nm: product_nm, product_desc: product_desc, price: price, price_before: price_before, product_img: product_img, customer_nm: customer_nm, customer_id: customer_id, qty_product: qty_product, qty_unit: qty_unit, quantity: quantity},
                    success: function(data){
                        if(quantity_before > qty_product) {
                            swal({
                              text: 'Maaf, jumlah tidak boleh melebihi stok',
                              icon: "warning",
                              timer: 4000
                            });
                            $('#show_cart').html(data);
                        }else{
                            swal({
                              text: "Produk telah ditambahkan ke pembayaran",
                              icon: "success",
                              timer: 4000
                            });
                            $('#show_cart').html(data);
                            // 
                            setTimeout(function () {
                                window.location.href = "<?=site_url('checkout')?>";
                            }, 2000);
                        }
                    }
                });
            });

            // Load shopping cart
            $('#show_cart').load("<?=site_url('web/load_cart')?>");
            //
            $('#shopping_cart').load("<?=site_url('web/load_shopping_cart')?>");

            $("#logout,#logout2").click(function(e) {
              e.preventDefault()
                swal({
                  title: "",
                  text: "Anda yakin ingin keluar ?",
                  icon: "warning",
                  buttons: {
                    cancel: "Batal",
                    danger: {
                      text: "Logout",
                    },
                  },
                  // dangerMode: ["Hapus !",true],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location="<?=site_url('login/logout')?>";
                            swal({
                              title: "",
                              text: "Anda berhasil Logout",
                              icon: "success",
                              buttons: "Oke",
                            })
                    } else {
                        
                    }
                });
            });

            //validate_chat
            $("#chat").click(function(e) {
              e.preventDefault()
                swal({
                  title: "",
                  text: "Anda harus login terlebih dahulu",
                  icon: "warning",
                  buttons: {
                    cancel: "Batal",
                    danger: {
                      text: "Login",
                    },
                  },
                  // dangerMode: ["Hapus !",true],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location="<?=site_url('login')?>";
                    } else {
                        
                    }
                });
            });

            //hapus produk
            $("#delete_on_sale,#delete_draft,#delete_not_sold").click(function(e) {
                var p            = $(this).data("p");
                var o            = $(this).data("o");
                var product_id   = $(this).data("product_id");
                //
                e.preventDefault()
                swal({
                  title: "",
                  text: "Anda yakin ingin menghapus ?",
                  icon: "warning",
                  buttons: {
                    cancel: "Batal",
                    danger: {
                      text: "Logout",
                    },
                  },
                  // dangerMode: ["Hapus !",true],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location="<?=site_url('selling/delete/')?>"+p+"/"+o+"/"+product_id;
                    } else {
                        
                    }
                });
            });
        });
    </script>
    <a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
    <script type="text/javascript" src="<?=base_url()?>assets/js/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/owl.carousel/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/lib/easyzoom/easyzoom.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/pace.min.js"></script>
	<!-- COUNTDOWN -->
	<script type="text/javascript" src="<?=base_url()?>assets/lib/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/countdown/jquery.countdown.js"></script>
	<!-- ./COUNTDOWN -->
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.actual.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/script.js"></script>
</body>
</html>