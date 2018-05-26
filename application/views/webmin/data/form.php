<script type="text/javascript">
$(function() {
    $('#add_image').bind('click',function(e) {
        e.preventDefault();
        var image_no = $('#image_no').val();
        __get_image(image_no);
    });
    __get_image('0','<?=@$main["id_produk"]?>','<?=count(@$main["product_image"])?>');
    function __get_image(image_no, id_produk, count_image) {
        if(count_image == 0) {
            var image_var = '';
        } else {
            var image_var = '&id_produk='+id_produk;
        }
        //
        $.get('<?=site_url("webmin_data/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
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

<?php $this->load->view('webmin/plugins/wysiwyg');?>

<div class="container">
    <div class="row">
        <div class="row">
            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
            <div class="col-xs-12 col-sm-12 col-md-4">
                <!-- content -->
                <div class="panel-content" style="margin-bottom: -20px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="font-weight: bold;">Gambar Ikan/Barang</div>
                        <div class="panel-body">
                            <table class="table-no-border">              
                                <tbody id="box_image">                                      
                                </tbody>            
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="hidden" name="image_no" id="image_no" value="0">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="add_image"><i class="fa fa-plus"></i> Tambah Item Gambar</a>
                                    </td>
                                </tr>  
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /content -->
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8">
                <!-- content -->
                <div class="panel-content" style="margin-bottom: -20px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="font-weight: bold;">Data Ikan/Barang</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Nama Ikan/Barang</label>
                                <div class="span9">
                                    <input type="text" class="form-control input-form-control" name="produk_nm" value="<?=@$main['produk_nm']?>">
                                </div>
                                <div class="alert-product">* Nama Ikan/Barang masih dapat diubah</div>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <div class="span9">
                                    <select class="form-control select-chosen">
                                        <option>Kategori 1</option>
                                        <option>Kategori 2</option>
                                        <option>Kategori 3</option>
                                        <option>Kategori 4</option>
                                        <option>Kategori 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="font-weight: bold;">Detail Ikan/Barang</div>
                        <div class="panel-body">
                            <div class="form-group">
                            <label>Harga</label>
                                <div class="input-group span3">
                                    <div class="input-group-addon">Rp </div>
                                    <input type="text" class="form-control input-form-control" name="produk_harga" value="<?=digit(@$main['produk_harga'])?>" style="text-align: right;">
                                </div>
                            </div>
                            <div class="form-group">
                            <label>Berat</label>
                                <div class="input-group span3">
                                    <input type="number" class="form-control">
                                    <div class="input-group-addon">Kg</div>
                                </div>
                                <span class="alert-product">* Berat harus dibulatkan</span>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Ikan/Barang</label>
                                <div class="span9">
                                    <textarea id="product_desc" class="form-control input-form-control" name="produk_desc"><?=@$main['produk_desc']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a href="<?=site_url('webmin/location/data')?>" class="btn btn-sell btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-sell btn-primary">Jual <i class="fa fa-shopping-basket"></i></button>
                </div>
                <!-- /content -->
            </div>
            </form>
        </div>
    </div>
</div>