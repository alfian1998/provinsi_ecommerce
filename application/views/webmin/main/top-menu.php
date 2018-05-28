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
                                <?php if ($config['profile']['is_profil_web'] == '1' || $config['profile']['is_user_group'] == '1' || $config['profile']['is_master_user'] == '1' || $config['profile']['is_parameter'] == '1' || $config['profile']['is_wilayah'] == '1' || $config['profile']['is_kategori'] == '1' || $config['profile']['is_setting_bank'] == '1' || $config['profile']['is_slide_show'] == '1'): ?>
                                <li class="dropdown <?php echo activate_menu('webmin_config'); ?><?php echo activate_menu('webmin_parameter'); ?><?php echo activate_menu('webmin_region'); ?><?php echo activate_menu('webmin_category'); ?><?php echo activate_menu('webmin_bank'); ?><?php echo activate_menu('webmin_slideshow'); ?><?php echo activate_menu('webmin_user'); ?><?php echo activate_menu('webmin_user_group'); ?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu mega_dropdown container-fluid">
                                        <li class="block-container">
                                            <ul class="block-megamenu-link">
                                                <?php if ($config['profile']['is_profil_web'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/config')?>">Profil Web</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_user_group'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/usergroup')?>">User Group</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_master_user'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/user')?>">Master User</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_parameter'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/parameter')?>">Parameter</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_wilayah'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/region')?>">Wilayah</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_kategori'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/category')?>">Kategori</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_setting_bank'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/bank')?>">Setting Bank</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_slide_show'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/slideshow')?>">Slide Show</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>
                                <?php endif; ?>
                                <?php if ($config['profile']['is_syarat_pembayaran'] == '1' || $config['profile']['is_petunjuk_pembayaran']): ?>
                                <li class="dropdown <?php echo activate_menu('webmin_payment_terms'); ?><?php echo activate_menu('webmin_payment_instructions'); ?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pembayaran <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu mega_dropdown container-fluid">
                                        <li class="block-container">
                                            <ul class="block-megamenu-link">
                                                <?php if ($config['profile']['is_syarat_pembayaran'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/payment_terms')?>">Syarat Pembayaran</a></li>
                                                <?php endif; ?>

                                                <?php if ($config['profile']['is_petunjuk_pembayaran'] == '1'): ?>
                                                <li class="link_container"><a href="<?=site_url('webmin/location/payment_instructions')?>">Petunjuk Pembayaran &nbsp;</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>
                                <?php endif; ?>
                                <?php if ($config['profile']['is_rekening_bank'] == '1'): ?>
                                <li class="<?php echo activate_menu('webmin_bank_account'); ?>"><a href="<?=site_url('webmin/location/bank_account')?>">Rekening Bank</a></li>
                                <?php endif; ?>

                                <?php if ($config['profile']['is_data_pembeli'] == '1'): ?>
                                <li class="<?php echo activate_menu('webmin_buyer_data'); ?>"><a href="<?=site_url('webmin/location/buyer_data')?>">Data Pembeli</a></li>
                                <?php endif; ?>

                                <?php if ($config['profile']['is_laporan'] == '1'): ?>
                                <li class="<?php echo activate_menu('webmin_report'); ?>"><a href="<?=site_url('webmin/location/report')?>">Laporan</a></li>
                                <?php endif; ?>
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
<!-- ./header -->
