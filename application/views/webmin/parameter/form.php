<script type="text/javascript">
$(function() {
    $('#parameter_group').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        parameter_nm(i);
    });
    function parameter_nm(i,k) {
        $.get('<?=site_url("webmin_parameter/ajax/parameter_nm")?>?parameter_group='+i+'&parameter_nm='+k,null,function(data) {
            $('#box_parameter').html(data.html);
        },'json');
    }
    $('#parameter_id').bind('change',function(e) {
        e.preventDefault();
        var  i = $(this).val();
        var pg = $('#parameter_group').val();
        var pf = $('#parameter_nm').val();
        $.get('<?=site_url("webmin_parameter/ajax/validate_id")?>?parameter_group='+pg+'&parameter_nm='+pf+'&parameter_id='+i,null,function(data) {
            if(data.result == 'false') {
                alert('Maaf, Parameter ID ini sudah digunakan !');
                $('#parameter_id').focus().val('');
            }
        },'json');
    });
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
                    <li><a href="<?=site_url('webmin/location/parameter')?>">Parameter</a><span></span></li>
                    <?php if (@$main['parameter_group'] != ''): ?>
                        <li>Edit Data Parameter</li>
                    <?php else: ?>
                        <li>Tambah Data Parameter</li>
                    <?php endif; ?>
                </ul>
            </div>
            </div>
            
            <?php $this->load->view('webmin/sub_menu/index');   ?>
            
            <div class="col-xs-12 col-sm-12 col-md-10">
                <!-- content -->
                <div class="panel-content">
                    <div class="panel panel-primary">
                        <?php if(@$main['parameter_group'] !=''): ?>
                            <div class="panel-heading"><b>Edit Data Parameter</b></div>
                        <?php else: ?>
                            <div class="panel-heading"><b>Tambah Data Parameter</b></div>
                        <?php endif; ?>
                        <div class="panel-body">
                            <form action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">  
                            <table width="100%" class="table-no-border">
                                <tr>
                                    <td width="18%"><div class="span10">Parameter Group</div></td>
                                    <td width="82%">
                                        <div class="span4">
                                            <select class="form-control select-chosen" name="parameter_group" id="parameter_group" required="">
                                                <option value="">-- Pilih Parameter Group --</option>
                                                <?php foreach ($parameter_group as $data): ?>
                                                    <option value="<?=$data['parameter_group']?>" <?php if(@$data['parameter_group'] == @$main['parameter_group']) echo 'selected'?>><?=$data['parameter_group']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Parameter Nama</div></td>
                                    <td width="82%">
                                        <div id="box_parameter">
                                        <div class="span4">
                                            <select class="form-control select-chosen" name="parameter_nm" id="parameter_nm" required="">
                                                <option value="">-- Pilih Parameter Nama --</option>
                                                <?php if(@$main['parameter_nm'] != ''): ?>
                                                    <option value="<?=@$main['parameter_nm']?>" <?php if(@$main['parameter_nm'] != '') echo 'selected' ?>><?=@$main['parameter_nm']?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="18%"><div class="span10">Parameter Value</div></td>
                                    <td width="82%">
                                        <div class="span4">
                                            <input type="text" name="parameter_val" class="form-control" value="<?=@$main['parameter_val']?>" required="">
                                        </div>
                                    </td>
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