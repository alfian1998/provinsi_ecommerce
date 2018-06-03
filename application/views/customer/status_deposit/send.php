<script type="text/javascript">
    $(function() {
        __show_result();
        function __show_result() {
            $.get('<?=site_url('send/buyer')?>',null,function(data) {
                $('#box_result').html(data.html);
            },'json');
        }
        var auto_refresh = setInterval(function () {
            __show_result();
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
                        <div class="panel-heading">Data Sudah Dikirim</div>
                        <div class="panel-body">
                            <div class="alert alert-green alert-small"><i class="fa fa-warning"></i> Menu Sudah Dikirim menunjukan bahwa Admin DKP Jateng sudah transfer ke Rekening Anda, Silahkan cek saldo di Rekening Anda</div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th class="text-center" width="2%">No</th>
                                    <th colspan="2" width="26%">Nama Pembeli</th>
                                    <th class="text-center" width="13%">No Transaksi</th>
                                    <th width="35%" class="text-center">Nominal yang Diterima</th>
                                    <th width="20%">Status & Tgl Transfer</th>
                                  </tr>
                                </thead>
                                <tbody id="box_result">                         
                                    <tr><td colspan="6">Loading content ...</td></tr>
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