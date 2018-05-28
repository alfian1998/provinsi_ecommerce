<div class="col-sm-3 col-md-2">
    <!-- Block vertical-menu -->
    <div class="block block-vertical-menu">
        <div class="vertical-head">
            <h5 class="vertical-title">Master Data <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
        </div>
        <div class="vertical-menu-content">
            <ul class="vertical-menu-list">
                <?php if ($config['profile']['is_profil_web'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/config')?>" class="background-font <?=active_bold_menu('webmin_config')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_config')?>.png">Profil Web</a>
                </li>
                <?php endif; ?>

                <?php if ($config['profile']['is_user_group'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/usergroup')?>" class="background-font <?=active_bold_menu('webmin_usergroup')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_usergroup')?>.png">User Group</a>
                </li>
                <?php endif; ?>

                <?php if ($config['profile']['is_master_user'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/user')?>" class="background-font <?=active_bold_menu('webmin_user')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_user')?>.png">Master User</a>
                </li>
                <?php endif; ?>

                <?php if ($config['profile']['is_parameter'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/parameter')?>" class="background-font <?=active_bold_menu('webmin_parameter')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_parameter')?>.png">Parameter</a>
                </li>
                <?php endif; ?>

                <?php if ($config['profile']['is_wilayah'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/region')?>" class="background-font <?=active_bold_menu('webmin_region')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_region')?>.png">Wilayah</a>
                </li>
                <?php endif; ?>

                <?php if ($config['profile']['is_kategori'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/category')?>" class="background-font <?=active_bold_menu('webmin_category')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_category')?>.png">Kategori</a>
                </li>
                <?php endif; ?>

                <?php if ($config['profile']['is_setting_bank'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/bank')?>" class="background-font <?=active_bold_menu('webmin_bank')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_bank')?>.png">Setting Bank</a>
                </li>
                <?php endif; ?>

                <?php if ($config['profile']['is_slide_show'] == '1'): ?>
                <li >
                    <a href="<?=site_url('webmin/location/slideshow')?>" class="background-font <?=active_bold_menu('webmin_slideshow')?>"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-<?=active_img_menu('webmin_slideshow')?>.png">Slide Show</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <!-- ./Block vertical-menu -->
</div>