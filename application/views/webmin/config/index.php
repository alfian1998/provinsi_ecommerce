<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
            <div class="col-md-12">
            <div class="block block-breadcrumbs">
                <ul>
                    <li class="home">
                        <a href="<?=site_url('webmin/location/')?>"><i class="fa fa-home" style="font-size: 18px;"></i></a>
                        <span></span>
                    </li>
                    <li><a href="#">Master Data</a><span></span></li>
                    <li>Profil Web</li>
                </ul>
            </div>
            </div>
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Master Data <span class="pull-right"><i class="fa fa-bars"></i></span></h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="#" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-6.png"><b>Profil Web</b></a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/parameter')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Parameter</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/region')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Wilayah</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/category')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Kategori</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/bank')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Setting Bank</a>
                            </li>
                            <li >
                                <a href="<?=site_url('webmin/location/slideshow')?>" class="background-font"><i class="icon-category fa fa-chevron-right" style="margin-left: 21px;"></i><img class="icon-menu" src="<?=base_url()?>assets/images/icon/bg-7.png">Slide Show</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Profil Website</b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="20%"><div class="span10">Judul Website</div></td>
                                    <td width="80%"><div class="span12"><input type="text" name="app_title" class="span9 form-control" value="<?=@$main['app_title']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Judul Website Singkat</div></td>
                                    <td><div class="span12"><input type="text" name="app_shorttitle" class="span9 form-control" value="<?=@$main['app_shorttitle']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Sub Domain</div></td>
                                    <td>
                                        <div class="form-inline">
                                            <div class="span12">http:// <input type="text" name="subdomain" class="span8 form-control" value="<?=@$main['subdomain']?>"></div>
                                        </div>
                                    </td>
                                </tr>   
                                <tr>
                                    <td><div class="span10">Deskripsi Website</div></td>
                                    <td><div class="span12"><input type="text" name="app_subtitle" class="span9 form-control" value="<?=@$main['app_subtitle']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Nama Dinas</div></td>
                                    <td><div class="span12"><input type="text" name="dinas_name" class="span9 form-control" value="<?=@$main['dinas_name']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Copyright</div></td>
                                    <td><div class="span12"><input type="text" name="copyright" class="span9 form-control" value="<?=@$main['copyright']?>"></div></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="widget-head"><h5><b>Informasi Alamat</b></h5></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Kabupaten</div></td>
                                    <td><div class="span12"><input type="text" name="kabupaten" class="span9 form-control" value="<?=@$main['kabupaten']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Alamat Lengkap</div></td>
                                    <td><div class="span12"><input type="text" name="alamat" class="span9 form-control" value="<?=@$main['alamat']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Telpon</div></td>
                                    <td><div class="span12"><input type="text" name="telp" class="span9 form-control" value="<?=@$main['telp']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Fax</div></td>
                                    <td><div class="span12"><input type="text" name="fax" class="span9 form-control" value="<?=@$main['fax']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Email</div></td>
                                    <td><div class="span12"><input type="text" name="email" class="span9 form-control" value="<?=@$main['email']?>"></div></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="widget-head"><h5><b>Social Media</b></h5></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Facebook</div></td>
                                    <td><div class="span12"><input type="text" name="fb" class="span9 form-control" value="<?=@$main['fb']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Twitter</div></td>
                                    <td><div class="span12"><input type="text" name="twitter" class="span9 form-control" value="<?=@$main['twitter']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Instagram</div></td>
                                    <td><div class="span12"><input type="text" name="instagram" class="span9 form-control" value="<?=@$main['instagram']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Goggle Plus</div></td>
                                    <td><div class="span12"><input type="text" name="gplus" class="span9 form-control" value="<?=@$main['gplus']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Youtube</div></td>
                                    <td><div class="span12"><input type="text" name="youtube" class="span9 form-control" value="<?=@$main['youtube']?>"></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Linkedin</div></td>
                                    <td><div class="span12"><input type="text" name="linkedin" class="span9 form-control" value="<?=@$main['linkedin']?>"></div></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="widget-head"><h5><b>Search Engine</b></h5></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Meta Description</div></td>
                                    <td><div class="span12"><textarea class="span9 form-control" style="height: 80px;" name="meta_description"><?=$main['meta_description']?></textarea></div></td>
                                </tr>
                                <tr>
                                    <td><div class="span10">Meta Keywords</div></td>
                                    <td><div class="span12"><textarea class="span9 form-control" style="height: 80px;" name="meta_keywords"><?=$main['meta_keywords']?></textarea></div></td>
                                </tr>
                            </table>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>