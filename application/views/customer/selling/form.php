<style type="text/css">
.swal-text {
    color: red;
    font-weight: bold;
    font-size: 18px;
}
.swal-button {
    background-color: red;
    font-weight: bold;
}
</style>
<script type="text/javascript">
$(function() {
    $('input[name="product_nm"]').bind('keyup',function(e) {
        e.preventDefault();
        $.get('<?=site_url("selling/ajax/permalink")?>?product_nm='+$(this).val(),null,function(data) {
            $('input[name="product_url"]').val(data.permalink);
        },'json');      
    });

    $('#add_image').bind('click',function(e) {
        e.preventDefault();
        var image_no = $('#image_no').val();
        __get_image(image_no);
    });
    __get_image('0','<?=@$main["product_id"]?>','<?=count(@$main["product_image"])?>');
    function __get_image(image_no, product_id, count_image) {
        if(count_image == 0) {
            var image_var = '';
        } else {
            var image_var = '&product_id='+product_id;
        }
        //
        $.get('<?=site_url("selling/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
            $('#box_image').append(data.html);
            $('#image_no').val(data.image_no);
        },'json');
    }
    // autonumeric
    $("input[name='price']").autoNumeric({
        aSep: ".", aDec: ",", vMax: "999999999999999", vMin: "0"
    });
});

function SatuanUnit() {
    <?php $product_id = @$main['product_id']; ?>
    <?php foreach ($list_parameter as $parameter) { ?>
        if (document.getElementById('<?=$parameter['parameter_val']?>').checked) {
            document.getElementById('span_stok_<?=$parameter['parameter_val']?>').classList.remove('hide');
            document.getElementById('div_stok_<?=$parameter['parameter_val']?>').classList.remove('hide');
            document.getElementById('span_harga_<?=$parameter['parameter_val']?>').classList.remove('hide');
            document.getElementById('div_harga_<?=$parameter['parameter_val']?>').classList.remove('hide');
            <?php if ($product_id != '') { ?>
                document.getElementById('edit_span_stok').classList.add('hide');
                document.getElementById('edit_div_stok').classList.add('hide');
                document.getElementById('edit_span_harga').classList.add('hide');
                document.getElementById('edit_div_harga').classList.add('hide');
            <?php } ?>
        }
        else {
            document.getElementById('span_stok_<?=$parameter['parameter_val']?>').classList.add('hide');
            document.getElementById('div_stok_<?=$parameter['parameter_val']?>').classList.add('hide');
            document.getElementById('span_harga_<?=$parameter['parameter_val']?>').classList.add('hide');
            document.getElementById('div_harga_<?=$parameter['parameter_val']?>').classList.add('hide');
        }
    <?php } ?>
}

function validateForm() {
    var product_nm = document.forms["myForm"]["product_nm"].value;
    var category_id = document.forms["myForm"]["category_id"].value;
    var image_source_1 = document.forms["myForm"]["image_source_1"].value;
    var price = document.forms["myForm"]["price"].value;
    var qty_unit = document.forms["myForm"]["qty_unit"].value;
    var qty = document.forms["myForm"]["qty"].value;
    var product_desc = document.forms["myForm"]["product_desc"].value;
    <?php if (@$main['product_id'] != '') { ?>
        var product_id = <?=@$main['product_id']?>;
    <?php }else{ ?>
        var product_id = 0;
    <?php } ?>
    if (product_nm == "") {
        swal({
          text: "Nama Ikan/Barang belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    } else if (category_id == "") {
        swal({
          text: "Silahkan pilih Kategori",
          icon: "warning",
          button: "OK",
        });
        return false;
    } else if (image_source_1 == "") {
        if (product_id == '0') {
            swal({
              text: "Silahkan upload Gambar",
              icon: "warning",
              button: "OK",
            });
            return false;
        }
    } else if (price == "0") {
        swal({
          text: "Harga Ikan/Barang belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    } else if (qty_unit == "") {
        swal({
          text: "Satuan unit belum dipilih",
          icon: "warning",
          button: "OK",
        });
        return false;
    } else if (qty == "") {
        swal({
          text: "Stok Ikan/Barang belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    } else if (product_desc == "") {
        swal({
          text: "Deskripsi Ikan/Barang belum diisi",
          icon: "warning",
          button: "OK",
        });
        return false;
    }
}
</script>

<?php $this->load->view('webmin/plugins/wysiwyg');?>

<div class="background-img background-bottom">
<div class="container">
    <div class="row">
        <div class="row">
            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate" name="myForm" onsubmit="return validateForm()">  
            <!-- <form name="form1" action="#" onsubmit="required()">                 -->
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
                                    <input type="text" class="form-control input-form-control" name="product_nm" value="<?=@$main['product_nm']?>">
                                    <input type="hidden" name="product_url" value="<?=@$main['product_url']?>" readonly="1">
                                </div>
                                <div class="alert-product">* Nama Ikan/Barang masih dapat diubah</div>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <div class="span9">
                                    <select name="category_id" class="form-control select-chosen">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach($list_category as $category):?>
                                            <?php if($category['category_parent'] == ''):?>
                                            <optgroup label="<?=$category['category_nm']?>">
                                            <?php else:?>
                                            <option value="<?=$category['category_id']?>" <?php if(@$main['category_id'] == $category['category_id']) echo 'selected'?>><?=$category['category_nm']?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select><br>
                                    <div class="alert-product">* Pilih salah satu Kategori</div>
                                </div>
                            </div>
                            <?php if(@$main['category_id'] != ''): ?>
                            <div class="form-group">
                                <label>Status Produk</label>
                                <div class="span9">
                                    <select name="product_st" class="form-control select-chosen span3">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="1" <?php if(@$main['product_st'] == '1') echo 'selected'?>>Dijual</option>
                                        <option value="2" <?php if(@$main['product_st'] == '2') echo 'selected'?>>Draft</option>
                                        <option value="3" <?php if(@$main['product_st'] == '3') echo 'selected'?>>Tidak Dijual</option>
                                    </select><br><br>
                                    <div class="alert-product">* Jika memilih Status Produk <u>Draft</u> & <u>Tidak Dijual</u>, maka produk tidak akan muncul di halaman publik</div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="font-weight: bold;">Detail Ikan/Barang</div>
                        <div class="panel-body">
                            <div class="detail-form-product">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Satuan Unit</label>
                                            <div class="form-inline">
                                                <?php foreach ($list_parameter as $parameter): ?>
                                                <div class="radio radio-primary">
                                                    <input type="radio" name="qty_unit" value="<?=$parameter['parameter_val']?>" onClick="javascript:SatuanUnit();" id="<?=$parameter['parameter_val']?>" <?php if($parameter['parameter_val'] == @$main['qty_unit']) echo 'checked'?>>
                                                    <label for="<?=$parameter['parameter_val']?>"><?=$parameter['parameter_val']?></label>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <span class="alert-product">* Digunakan untuk satuan Harga dan Stok Ikan/Barang</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-form-product">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Harga Ikan/Barang</label>
                                            <div class="input-group span10">
                                                <div class="input-group-addon">Rp </div>
                                                <input type="text" class="form-control input-form-control" name="price" value="<?=digit(@$main['price'])?>" style="text-align: right;">
                                                <input type="hidden" name="price_before" value="<?=@$main['price']?>">
                                                <?php foreach ($list_parameter as $parameter): ?>
                                                    <div class="input-group-addon hide" id="div_harga_<?=$parameter['parameter_val']?>">Per <?=$parameter['parameter_val']?></div>
                                                <?php endforeach; ?>
                                                <?php if (@$main['product_id']): ?>
                                                    <div class="input-group-addon" id="edit_div_harga">Per <?=@$main['qty_unit']?></div>
                                                <?php endif; ?>
                                            </div>
                                            <?php foreach ($list_parameter as $parameter): ?>
                                                <span class="alert-product qty-product hide" id="span_harga_<?=$parameter['parameter_val']?>">* Harga Ikan/Barang per <?=$parameter['parameter_val']?></span>
                                            <?php endforeach; ?>
                                            <?php if (@$main['product_id']): ?>
                                                <span class="alert-product qty-product" id="edit_span_harga">* Harga Ikan/Barang per <?=@$main['qty_unit']?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Stok Ikan/Barang</label>
                                            <div class="input-group span8">
                                                <input type="number" name="qty" class="form-control" value="<?=@$main['qty']?>">
                                                <?php foreach ($list_parameter as $parameter): ?>
                                                    <div class="input-group-addon hide" id="div_stok_<?=$parameter['parameter_val']?>"><?=$parameter['parameter_val']?></div>
                                                <?php endforeach; ?>
                                                <?php if (@$main['product_id']): ?>
                                                    <div class="input-group-addon" id="edit_div_stok"><?=@$main['qty_unit']?></div>
                                                <?php endif; ?>
                                            </div>
                                            <?php foreach ($list_parameter as $parameter): ?>
                                                <span class="alert-product qty-product hide" id="span_stok_<?=$parameter['parameter_val']?>">* Stok Ikan/Barang per <?=$parameter['parameter_val']?></span>
                                            <?php endforeach; ?>
                                            <?php if (@$main['product_id']): ?>
                                                <span class="alert-product qty-product" id="edit_span_stok">* Stok Ikan/Barang per <?=@$main['qty_unit']?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Ikan/Barang</label>
                                <div class="span9">
                                    <textarea id="product_desc" class="form-control input-form-control" name="product_desc"><?=@$main['product_desc']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a href="<?=site_url('web/location/selling')?>" class="btn btn-sell btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-sell btn-primary">Jual <i class="fa fa-shopping-basket"></i></button>
                </div>
                <!-- /content -->
            </div>
            </form>
        </div>
    </div>
</div>
</div>