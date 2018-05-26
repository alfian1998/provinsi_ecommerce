<!-- footer -->
	<footer>
        <div class="footer-top"></div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="block-coppyright">
                        © <?=$config['config']['copyright']?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	<!-- ./footer -->
    <a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
	<style type="text/css">
        .swal-text {
            font-weight: bold;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#logout").click(function(e) {
              e.preventDefault()
                swal({
                  title: "",
                  text: "Anda yakin ingin keluar ?",
                  icon: "warning",
                  buttons: {
                    cancel: "Batal",
                    danger: {
                      text: "Logout",
                    },
                  },
                  // dangerMode: ["Hapus !",true],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location="<?=site_url('webmin/logout')?>";
                    } else {
                        
                    }
                });
            });

            $("#logout-top").click(function(e) {
              e.preventDefault()
                swal({
                  title: "",
                  text: "Anda yakin ingin keluar ?",
                  icon: "warning",
                  buttons: {
                    cancel: "Batal",
                    danger: {
                      text: "Logout",
                    },
                  },
                  // dangerMode: ["Hapus !",true],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location="<?=site_url('webmin/logout')?>";
                    } else {
                        
                    }
                });
            });
        });
    </script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/owl.carousel/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/lib/easyzoom/easyzoom.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/pace.min.js"></script>
	<!-- COUNTDOWN -->
	<script type="text/javascript" src="<?=base_url()?>assets/lib/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/lib/countdown/jquery.countdown.js"></script>
	<!-- ./COUNTDOWN -->
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.actual.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/script.js"></script>
</body>
</html>