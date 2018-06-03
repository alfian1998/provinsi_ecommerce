<script type="text/javascript">
    $(function() {
        var status = ($('#ses_bayar_st').val() != '' ? $('#ses_bayar_st').val() : '');
        var bulan = ($('#ses_bulan').val() != '' ? $('#ses_bulan').val() : '');
        $('#btn_buyer_search').bind('click',function(e) {
            e.preventDefault();
            var search = $('#ses_buyer_search').val();
            var status = $('#ses_bayar_st').val();
            var bulan = $('#ses_bulan').val();
            __show_result(status,bulan,search);
        });
        __show_result('','','');
        function __show_result(status,bulan,search) {
            $.get('<?=site_url('notification/buyer')?>?status='+status+'&bulan='+bulan+'&search='+search,null,function(data) {
                $('#box_result').html(data.html);
                $('#box_count_buyer').html(data.count);
            },'json');
        }
        var auto_refresh = setInterval(function () {
            var status = ($('#ses_bayar_st').val() != '' ? $('#ses_bayar_st').val() : '');
            var bulan = ($('#ses_bulan').val() != '' ? $('#ses_bulan').val() : '');
            var search = $('#ses_buyer_search').val();
            __show_result(status,bulan,search);
        }, 25000);
    });
</script>
<div class="background-img background-bottom">
<div class="container">
	<div class="row">
		<div class="row">
            
            <?php $this->load->view('public/main/sidebar-menu');?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Data Pembeli Produk Anda</div>
                        <div class="panel-body">
                            <div class="alert alert-red alert-small">
                                <li>Status pembelian akan dirubah oleh Admin DKP Jateng apabila pembeli sudah transfer ke rekening Admin DKP Jateng</li>
                                <li>Data akan otomatis berubah jika Admin DKP Jateng sudah merubah status</li>
                                <li>Klik tombol <u>Konfirmasi Sudah Kirim</u> untuk konfirmasi <u>Sudah Dikirim</u></li>
                                <li>Uang Anda akan di transfer oleh Admin DKP Jateng lewat No Rekening Bank Anda setelah produk diterima oleh Pembeli</li>
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
                                        <select class="select-chosen span2" name="ses_bulan" id="ses_bulan">
                                                <option value="">-- Semua Bulan --</option>
                                                <?php foreach (list_bulan() as $id_bulan => $bulan): ?>
                                                <option value="<?=$id_bulan?>"><?=$bulan?></option>
                                                <?php endforeach; ?>
                                        </select>
                                        <input type="text" name="ses_buyer_search" id="ses_buyer_search" class="form-control span6" placeholder="Masukkan kata kunci pencarian ...">
                                        <button type="submit" id="btn_buyer_search" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                        <a href="<?=site_url('notification')?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
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
                                        <th>Nama Pembeli</th>
                                        <th width="15%" class="text-center">No Transaksi</th>
                                        <th width="20%">Nominal yang Diterima</th>
                                        <th width="25%">Status</th>
                                      </tr>
                                    </thead>
                                    <tbody id="box_result">                         
                                        <tr><td colspan="5">Loading content ...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        
                    </div>
                </div>
                
                <!-- /content -->
            </div>
		</div>
	</div>
</div>
</div>
</div>