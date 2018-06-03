<div class="col-sm-3 col-md-2">
    <div class="selling-button">
        <a href="<?=site_url('selling/form')?>" class="button-selling button-selling-blue">Jual Ikan/Barang</a>
    </div>
    <!-- Block vertical-menu -->
    <div class="block block-vertical-menu">
        <div class="vertical-head">
            <h5 class="vertical-title">Status Deposit <!-- <span class="pull-right"><i class="fa fa-bars"></i></span> --></h5>
        </div>
        <div class="vertical-menu-content">
            <ul class="vertical-menu-list">
                <li >
                    <a href="<?=site_url('web/location/send')?>" class="background-font <?=active_bold_menu('send')?>"><i class="icon-category fa fa-send"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Sudah Transfer</a>
                </li>
                <li >
                    <a href="<?=site_url('web/location/not_send')?>" class="background-font <?=active_bold_menu('not_send')?>"><i class="icon-category fa fa-arrow-left"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Belum Transfer</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="block block-vertical-menu">
        <div class="vertical-head">
            <h5 class="vertical-title">Menu <!-- <span class="pull-right"><i class="fa fa-bars"></i></span> --></h5>
        </div>
        <div class="vertical-menu-content">
            <ul class="vertical-menu-list">
                <li >
                    <a href="<?=site_url('web/location/notification')?>" class="background-font <?=active_bold_menu('notification')?>"><i class="icon-category fa fa-dollar" style="margin-left: 22px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png">Data Pembeli</a>
                </li>
                <li>
                    <a href="<?=site_url('web/location/selling')?>" class="background-font <?=active_bold_menu('selling')?>"><i class="icon-category fa fa-folder" style="margin-left: 19px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png">Jualan Saya</a>
                </li>
                <li>
                    <a href="<?=site_url('web/location/profile')?>" class="background-font <?=active_bold_menu('profile')?>"><i class="icon-category fa fa-user" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-12.png">Profil</a>
                </li>
                <li>
                    <a id="logout2" href="#" class="background-font"><i class="icon-category fa fa-power-off" style="margin-left: 20px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-9.png">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./Block vertical-menu -->
</div>