<?php if ($validate_account !='' || $validate_address !='' || $validate_bank_account !=''): ?>
    <!-- Modal -->
    <div class="modal fade" id="Validate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Data Belum Lengkap</h4>
          </div>
          <div class="modal-body">
            <ul style="color: red; font-weight: bold;">
              <?php if ($validate_account !=''): ?>    
                <li style="padding-bottom: 5px;">Data Akun Anda belum lengkap <a href="<?=site_url('profile')?>" class="btn btn-sm btn-primary bold"><i class="fa fa-vcard"></i> Lengkapi Akun</a></li>
              <?php endif; ?>
              <?php if($validate_address !=''): ?>
                <li style="padding-bottom: 5px;">Data Alamat Anda belum lengkap <a href="<?=site_url('profile/address')?>" class="btn btn-sm btn-primary bold"><i class="fa fa-home"></i> Lengkapi Alamat</a></li>
              <?php endif; ?>
              <?php if($validate_bank_account !=''): ?>
                <li style="padding-bottom: 5px;">Data Rekening Bank Anda belum lengkap <a href="<?=site_url('profile/bank_account')?>" class="btn btn-sm btn-primary bold"><i class="fa fa-credit-card-alt"></i> Lengkapi Rekening Bank</a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger bold" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        $('#Validate').modal('show');
    </script>
<?php endif;  ?>