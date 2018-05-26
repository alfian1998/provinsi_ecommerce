<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/reset.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/font-awesome/css/font-awesome-animation.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/global.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/option2.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/focus-box.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/easyzoom/easyzoom.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/pace.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/chosen.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <script src="<?=base_url()?>assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/lib/jquery/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/autonumeric.js"></script>
    <!--  -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!--  -->
    <script type="text/javascript">
    $(document).ready(function(){
        //Chosen
      $(".select-chosen, .productChosen").chosen({});
      //Logic
      $(".select-chosen").change(function(){
        if($(".select-chosen option:selected").val()=="no"){
          $(".productChosen option[value='2']").attr('disabled',true).trigger("chosen:updated");
          $(".productChosen option[value='1']").removeAttr('disabled',true).trigger("chosen:updated");
        } else {
          $(".productChosen option[value='1']").attr('disabled',true).trigger("chosen:updated");
          $(".productChosen option[value='2']").removeAttr('disabled',true).trigger("chosen:updated");
        }
      })
    })
    </script>
    <title>Dashboard - <?=$config['config']['app_title']?></title>
</head>
<body class="option2">

    <!-- header -->
    <header id="header">
        <div class="container">
            <!-- main header -->
            <div class="row">
                <div class="main-header">
                    <div class="row">
                        <div class="col-lg-5 col-md-3 col-sm-12 col-xs-12">
                            <a href="<?=site_url('webmin')?>">
                                <div class="logo-website">
                                    <img src="<?=base_url()?>assets/images/logo/logo.png" alt="Logo" class="img-logo">
                                    <div class="text-logo-top"><font color="red"><?=strtoupper($config['profile']['user_realname'])?></font> - DASHBOARD</div>
                                    <div class="garis"></div>
                                    <div class="text-logo-bottom"><font color="#ffba35">WEBSITE JUAL BELI IKAN - DINAS KELAUTAN PROVINSI JAWA TENGAH</font></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 main-header-banner">
                            <div class="block block-header-right">
                                <ul class="list-link">
                                    <li class="item li-img-user-header" data-toggle="tooltip" data-placement="bottom" title="<?=$config['profile']['user_realname']?>">
                                        <span class="span-img-user-header">
                                            <?php if (@$config['profile']['user_photo'] !=''): ?>
                                                <img src="<?=base_url()?>assets/images/administrator/<?=$config['profile']['user_photo']?>" class="img-circle img-user-header">
                                            <?php else: ?>
                                                <img src="<?=base_url()?>assets/images/icon/no-customer-img.jpg" class="img-circle img-user-header">
                                            <?php endif; ?>
                                        </span>
                                        <span class="line1 line-img-user-header">Selamat Datang<br><strong class="text-short"><?=$config['profile']['user_realname']?></strong></span>
                                    </li>
                                    <li class="item">
                                        <a href="" data-toggle="modal" data-target="#setting-account">
                                            <span class="icon icon-header" data-toggle="tooltip" data-placement="top" title="Setting Akun"><i class="fa fa-gear fa-2x faa-spin animated"></i></span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a id="logout-top" href="#">
                                            <span class="icon icon-header" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-power-off fa-2x" style="color: red;"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./main header -->
        </div>

<!-- Modal -->
<div class="modal fade" id="setting-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Setting Data Akun</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
            <label>Foto Profil</label>
            <?php if(@$config['profile']['user_photo'] == ''):?>
            <span class="box_customer_img">
                <div class="span12" style="margin-bottom: 10px;">
                    <img class="img-thumbnail img-edit-product" src="<?=base_url()?>assets/images/icon/no-customer-img.jpg">
                    <a class="btn btn-sm btn-primary btn-edit-product-img" href="<?=base_url()?>assets/images/customer/<?=@$config['profile']['user_photo']?>" target="_blank"><i class="fa fa-eye"></i> Lihat Gambar</a><br>
                    <a href="javascript:void(0)" class="remove_image btn btn-sm btn-danger btn-edit-product-img" data-id="<?=@$config['profile']['customer_id']?>"><i class="fa fa-times"></i> Hapus Gambar</a>
                </div>
            </span>
            <?php else: ?>
                <div class="span12" style="margin-bottom: 10px;">
                    <img class="img-thumbnail" style="width: 100px;" src="<?=base_url()?>assets/images/icon/no-customer-img.jpg">
                </div>
            <?php endif;?>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger bold" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="button" class="btn btn-primary bold"><i class="fa fa-send"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>