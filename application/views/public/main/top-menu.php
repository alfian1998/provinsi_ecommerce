    <div class="main-menu">
        <div class="container">
            <div class="row">
                <nav class="navbar" id="main-menu">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-bars" style="color: white;"></i>
                            </button>
                            <a class="navbar-brand menu-responsive" href="#">MENU</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="<?php echo activate_menu('web'); ?>"><a href="<?=site_url('web/location/')?>">Home</a></li>
                                <!-- <li class="dropdown">
                                    <a href="category-list2.html" class="dropdown-toggle" data-toggle="dropdown">Produk <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu mega_dropdown container-fluid">
                                        <li class="block-container">
                                            <ul class="block-megamenu-link">
                                                <li class="link_container"><a href="#">Ikan 1</a></li>
                                                <li class="link_container"><a href="#">Ikan 2</a></li>
                                                <li class="link_container"><a href="#">Ikan 3</a></li>
                                                <li class="link_container"><a href="#">Ikan 4</a></li>
                                                <li class="link_container"><a href="#">Ikan 5</a></li>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li> -->
                                <li class="<?php echo activate_menu('categories'); ?><?php echo activate_menu('gridview'); ?><?php echo activate_menu('listview'); ?>"><a href="<?=site_url('web/location/categories')?>">Kategori</a></li>
                                <li class="<?php echo activate_menu('transactions'); ?>"><a href="<?=site_url('web/location/transactions')?>">Cek Transaksi</a></li>
                                <?php if (@$ses_login == '1'): ?>
                                <li><a id="logout" href="#">Logout</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>