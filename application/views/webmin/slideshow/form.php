<script type="text/javascript">
$(function() {
    $('#add_image').bind('click',function(e) {
        e.preventDefault();
        var image_no = $('#image_no').val();
        __get_image(image_no);
    });
    __get_image('0','<?=@$main["slideshow_id"]?>','<?=count(@$main["slideshow_images"])?>');
    function __get_image(image_no, slideshow_id, count_image) {
        if(count_image == 0) {
            var image_var = '';
        } else {
            var image_var = '&slideshow_id='+slideshow_id;
        }
        //
        $.get('<?=site_url("webmin_slideshow/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
            $('#box_slideshow_photo').append(data.html);
            $('#image_no').val(data.image_no);
        },'json');
    }
});
</script>
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
                    <li><a href="<?=site_url('webmin/location/slideshow')?>">Manajemen Slideshow</a><span></span></li>
                    <?php if (@$main['bank_id'] != ''): ?>
                        <li>Edit Data Slideshow</li>
                    <?php else: ?>
                        <li>Tambah Data Slideshow</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['bank_id'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data Slideshow</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data Slideshow</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <!-- Input hidden -->
                            <input type="hidden" name="post_date" value="<?=@$main['post_date']?>">
                            <!-- /Input hidden -->
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="18%"><div class="span10">Judul</div></td>
                                    <td width="82%">
                                        <div class="span8">
                                            <input type="text" name="slideshow_title" class="form-control" value="<?=@$main['slideshow_title']?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Deskripsi</div></td>
                                    <td width="82%">
                                        <div class="span8">
                                            <textarea class="form-control" name="slideshow_description" style="height: 90px;"><?=@$main['slideshow_description']?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Link Tautan</div></td>
                                    <td width="82%">
                                        <div class="span8">
                                            <div class="form-inline">
                                                <div class="span12">http:// <input type="text" name="slideshow_url" value="<?=@$main['slideshow_url']?>" class="span10 form-control"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Status</div></td>
                                    <td width="82%">
                                        <div class="span8">
                                            <select class="select-chosen span3" name="slideshow_st">
                                                <option value="1" <?php if(@$main['slideshow_st'] == '1') echo 'selected'?>>Aktif</option>
                                                <option value="0" <?php if(@$main['slideshow_st'] == '0') echo 'selected'?>>Tidak</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="widget-head"><h5><b>Upload Gambar</b></h5></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="alert-product">Ukuran gambar untuk slideshow adalah, Width : 640px, Height : 380px</div>
                                    </td>
                                </tr>
                                <tbody id="box_slideshow_photo">                          
                                </tbody>            
                                <tr class="box_slideshow_photo">
                                    <td></td>
                                    <td colspan="2">
                                        <input type="hidden" name="image_no" id="image_no" value="0">
                                        <a href="javascript:void(0)" id="add_image" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Item Gambar</a>
                                    </td>
                                </tr>   
                            </table>
                            <a class="btn btn-success" href="<?=site_url('webmin_slideshow')?>">Kembali</a>
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