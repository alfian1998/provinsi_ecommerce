<div class="col-sm-3 col-md-2">
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
                    <a href="<?=site_url('web/location/notification')?>" class="background-font <?=active_bold_menu('notification')?>"><i class="icon-category fa fa-dollar" style="margin-left: 22px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-8.png">Data Pembeli</a>
                </li>
                <li>
                    <a href="<?=site_url('web/location/selling')?>" class="background-font <?=active_bold_menu('selling')?>"><i class="icon-category fa fa-folder" style="margin-left: 19px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png">Jualan Saya</a>
                </li>
                <?php endif; ?>
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