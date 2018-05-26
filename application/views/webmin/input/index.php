<script type="text/javascript">
$(function() {
    $('#add_image').bind('click',function(e) {
        e.preventDefault();
        var image_no = $('#image_no').val();
        __get_image(image_no);
    });
    __get_image('0','<?=@$main["id_produk"]?>','<?=count(@$main["post_images"])?>');
    function __get_image(image_no, id_produk, count_image) {
        if(count_image == 0) {
            var image_var = '';
        } else {
            var image_var = '&id_produk='+id_produk;
        }
        //
        $.get('<?=site_url("webmin_input/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
            $('#box_image').append(data.html);
            $('#image_no').val(data.image_no);
        },'json');
    }
    // autonumeric
    $("input[name='produk_harga']").autoNumeric({
        aSep: ".", aDec: ",", vMax: "999999999999999", vMin: "0"
    });
});
</script>

<?=$this->load->view('webmin/plugins/wysiwyg');?>

<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Kategori</h5>
                    </div>
                    <div class="vertical-menu-content">
                        <ul class="vertical-menu-list">
                            <li >
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="assets/images/icon/bg-7.png">Ikan Laut</a>
                            </li>
                            <li >
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="assets/images/icon/bg-5.png">Ikan Tambak</a>
                            </li>
                            <li>
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="assets/images/icon/bg-6.png">Ikan Budidaya</a>
                            </li>
                            <li>
                                <a href="#" class="background-font"><i class="icon-category fa fa-check"></i><img class="icon-menu" src="assets/images/icon/bg-8.png">Ikan Hias</a>
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
                        <div class="panel-heading">Panel with panel-primary class</div>
                        <div class="panel-body">
                            <!-- <form>
                              <div class="form-group">
                                <label>Input 1</label>
                                <input type="text" class="form-control" placeholder="Email">
                              </div>
                              <div class="form-group">
                                <label>Input 2</label>
                                <input type="text" class="form-control" placeholder="Password">
                              </div>
                            </form> -->
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table class="table-no-border">
                                <tr>
                                    <td style=" width: 130px;"><label>Nama Ikan</label></td>
                                    <td><label>:</label></td>
                                    <td>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control input-form-control" name="produk_nm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Deskripsi Produk</label></td>
                                    <td><label>:</label></td>
                                    <td>
                                        <div class="col-sm-9">
                                            <textarea id="product_desc" class="form-control input-form-control" name="produk_desc"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Harga Produk</label></td>
                                    <td><label>:</label></td>
                                    <td>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control input-form-control" name="produk_harga" style="text-align: right;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="widget-head"><h4 class="heading"><b>Upload Gambar</b></h4></div>
                                    </td>
                                </tr>               
                                <tbody id="box_image">                                      
                                </tbody>            
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="hidden" name="image_no" id="image_no" value="0">
                                        <a href="javascript:void(0)" id="add_image">+ Tambah Item Gambar</a>
                                    </td>
                                </tr>   
                            </table>
                            <br>
                            <div class="right" style="margin-top:10px">
                                <input type="hidden" name="menu_order" value="0">
                                <button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
                                <a href="<?=site_url('webmin/location/news/')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- /content -->
            </div>
        </div>
    </div>
</div>