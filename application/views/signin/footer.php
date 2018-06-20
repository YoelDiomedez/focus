<div class="copyright"><?= date('Y'); ?> &copy; Yoel Diomedez, Metronic Admin Dashboard Template</div>
<!--[if lt IE 9]>
    <script src="<?= site_url('assets/global/plugins/respond.min.js'); ?>"></script>
    <script src="<?= site_url('assets/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
    <script src="<?= site_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?= site_url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/jquery-validation/js/additional-methods.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= site_url('assets/global/plugins/select2/js/select2.full.min.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?= site_url('assets/global/scripts/app.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?= site_url('assets/pages/scripts/login.min.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script>
        function access(locationID){
            $(location).attr('href', '<?= site_url('logistics/main/index/'); ?>'+'/'+locationID);
        }

        window.history.forward();

        function sinVueltaAtras(){ 
            window.history.forward(); 
        }
    </script>
<!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>