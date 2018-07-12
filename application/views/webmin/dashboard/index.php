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
            $.get('<?=site_url('webmin/buyer')?>?status='+status+'&search='+search,null,function(data) {
                $('#box_result').html(data.html);
                $('#box_chart').html(data.chart);
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
            <div class="col-xs-12 col-sm-12 col-md-6">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b><i class="fa fa-users"></i> Data Pembeli Terbaru</b> <a href="<?=site_url('webmin/location/buyer_data')?>" class="pull-right btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Lihat Data Pembeli Lengkap"><b><i class="fa fa-eye"></i> Lihat Lebih Lengkap</b></a></div>
                        <div class="panel-body">
                            <div class="alert alert-green alert-small">
                                <ul style="margin-left: -25px;">
                                    <li>Data akan otomatis memperbarui jika ada pembeli</li>
                                    <li>Data No 1 adalah yang paling terbaru</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <form name="form_sipatma" method="post" id="form_buyer">
                                    <div class="form-inline">
                                        <input type="text" name="ses_buyer_search" id="ses_buyer_search" class="form-control" placeholder="Masukkan kata kunci pencarian ..." style="width: 86%;">
                                        <button type="submit" id="btn_buyer_search" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                    </div>
                                </form>
                                <table class="table-no-border" style="margin-bottom: -10px; margin-top: 10px;">
                                    <tr>
                                        <td># Jumlah Pembeli : <span class="bold" id="box_count_buyer"></span></td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th width="1%" class="text-center">No</th>
                                        <th width="7%" class="text-center">Detail</th>
                                        <th width="30%">Nama</th>
                                        <th width="20%" class="text-center">Nominal</th>
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
            <div class="col-xs-12 col-sm-12 col-md-6">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><b><i class="fa fa-bar-chart"></i> Statistik Pembeli</b></div>
                        <div class="panel-body">
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            <div id="box_chart">
                                <div>Loading content ...</div>
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