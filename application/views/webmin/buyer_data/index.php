<script type="text/javascript">
    $(function() {
        var status = ($('#ses_bayar_st').val() != '' ? $('#ses_bayar_st').val() : '');
        $('#btn_buyer_search').bind('click',function(e) {
            e.preventDefault();
            var search = $('#ses_buyer_search').val();
            var status = $('#ses_bayar_st').val();
            __show_result(status,search);
        });
        __show_result('','');
        function __show_result(status,search) {
            $.get('<?=site_url('webmin_buyer_data/buyer')?>?status='+status+'&search='+search,null,function(data) {
                $('#box_result').html(data.html);
                $('#box_count_buyer').html(data.count);
            },'json');
        }
        var auto_refresh = setInterval(function () {
            var status = ($('#ses_bayar_st').val() != '' ? $('#ses_bayar_st').val() : '');
            var search = $('#ses_buyer_search').val();
            __show_result(status,search);
        }, 25000);
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
                    <li>Data Pembeli</li>
                </ul>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b>Data Pembeli</b></div>
                        <div class="panel-body">
                            <?=outp_notification()?>
                            <div class="alert alert-green" style="margin-bottom: 10px;">
                                <ul style="margin-left: -25px;">
                                    <li>Data akan otomatis muncul jika ada pembeli</li>
                                    <li>Data No 1 adalah yang paling terbaru</li>
                                    <li>Jika Status <u>Menunggu Konfirmasi</u> maka segera ubah status menjadi Sudah Bayar</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                            <form name="form_sipatma" method="post" id="form_buyer">
                                <div class="form-inline">
                                    <select class="select-chosen span2" name="ses_bayar_st" id="ses_bayar_st">
                                            <option value="">-- Semua Status --</option>
                                            <option value="sudah_bayar">Sudah Bayar</option>
                                            <option value="belum_bayar">Belum Bayar</option>
                                            <option value="konfirmasi">Menunggu Konfirmasi</option>
                                            <option value="sudah_diterima">Sudah Diterima</option>
                                    </select>
                                    <input type="text" name="ses_buyer_search" id="ses_buyer_search" class="form-control span8" placeholder="Masukkan kata kunci pencarian ...">
                                    <button type="submit" id="btn_buyer_search" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                    <a href="<?=site_url('webmin_buyer_data')?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </div>
                            </form>
                            <table class="table-no-border" style="margin-bottom: -10px; margin-top: 10px;">
                                <tr>
                                    <td># Jumlah Pembeli : <span class="bold" id="box_count_buyer"></span></td>
                                </tr>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th width="2%" class="text-center">No</th>
                                    <th width="8%" class="text-center">Aksi</th>
                                    <th width="19%">Nama Pembeli</th>
                                    <th width="10%" class="text-center">No Transaksi</th>
                                    <th width="8%">Nominal</th>
                                    <th width="26%">Status</th>
                                  </tr>
                                </thead>
                                <tbody id="box_result">                         
                                    <tr><td colspan="5">Loading content ...</td></tr>
                                </tbody>
                            </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>