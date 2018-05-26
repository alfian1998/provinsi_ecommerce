<!-- main menu-->
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
                                <li class="<?php echo activate_menu('webmin'); ?>"><a href="<?=site_url('webmin')?>">Home</a></li>
                                <li class="dropdown <?php echo activate_menu('webmin_config'); ?><?php echo activate_menu('webmin_parameter'); ?><?php echo activate_menu('webmin_region'); ?><?php echo activate_menu('webmin_category'); ?><?php echo activate_menu('webmin_bank'); ?><?php echo activate_menu('webmin_slideshow'); ?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu mega_dropdown container-fluid">
                                        <li class="block-container">
                                            <ul class="block-megamenu-link">
                                                <li class="link_container"><a href="<?=site_url('webmin/location/config')?>">Profil Web</a></li>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/parameter')?>">Parameter</a></li>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/region')?>">Wilayah</a></li>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/category')?>">Kategori</a></li>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/bank')?>">Setting Bank</a></li>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/slideshow')?>">Slide Show</a></li>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>
                                <li class="dropdown <?php echo activate_menu('webmin_payment_terms'); ?><?php echo activate_menu('webmin_payment_instructions'); ?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pembayaran <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu mega_dropdown container-fluid">
                                        <li class="block-container">
                                            <ul class="block-megamenu-link">
                                                <li class="link_container"><a href="<?=site_url('webmin/location/payment_terms')?>">Syarat Pembayaran</a></li>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/payment_instructions')?>">Petunjuk Pembayaran &nbsp;</a></li>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>
                                <li class="<?php echo activate_menu('webmin_bank_account'); ?>"><a href="<?=site_url('webmin/location/bank_account')?>">Rekening Bank</a></li>
                                <li class="<?php echo activate_menu('webmin_buyer_data'); ?>"><a href="<?=site_url('webmin/location/buyer_data')?>">Data Pembeli</a></li>
                                <li><a id="logout" href="#">Logout</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- ./main menu-->
</header>
<!-- ./header -->
