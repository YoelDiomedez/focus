        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">
                <?= date('Y'); ?> &copy; Yoel Diomedez, Template 
                <a 
                    href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" 
                    target="_blank"
                >
                    Metronic
                </a> by keenthemes.
            </div>
            <div class="scroll-to-top">
                 <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->

        <!-- BEGIN MODAL LOADING-->
        <div class="modal fade bs-example-modal-sm" id="modal-loading" tabindex="-1"
            role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">
                            Cargando
                         </h4>
                    </div>
                    <div class="modal-body">
                        <div class="progress">
                            <div class="progress-bar progress-bar-info
                            progress-bar-striped active"
                            style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL LOADING- -->

        <!--[if lt IE 9]>
        <script src="<?= site_url('assets/global/plugins/respond.min.js'); ?>"></script>
        <script src=".<?= site_url('assets/global/plugins/excanvas.min.js'); ?>"></script> 
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
        <script src="<?= site_url('assets/global/scripts/datatable.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/select2/js/select2.full.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/select2/js/select2.full.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/morris/morris.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/morris/raphael-min.js'); ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= site_url('assets/global/scripts/app.min.js'); ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= site_url('assets/pages/scripts/table-datatables-managed.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/pages/scripts/form-samples.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/pages/scripts/components-select2.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/counterup/jquery.waypoints.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/global/plugins/counterup/jquery.counterup.min.js'); ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?= site_url('assets/layouts/layout2/scripts/layout.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('assets/layouts/layout2/scripts/demo.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= site_url('resources/js/sweetalert2.js'); ?>"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
        /*
        $(document).ready(function() {
            $('.sub-menu a[href="'+location.href+'"]').parents('li').addClass('active open');
        });*/
        $.ajaxPrefilter(function( options, original_Options, jqXHR ) {
            options.async = true;
        });
        
        function loading(opc){
            if(opc=="open")
                $('#modal-loading').modal('show');
            else if(opc=="close")
                $('#modal-loading').modal('hide');
        }

        function route(func){
            loading("open");
            $.post("<?= site_url(); ?>" + func, function(data){
                loading("close");
                $("#main").html(data);                 
            });
        }

        function redirect(func){
            $.post("<?= site_url(); ?>" + func, function(data){
                $("#main").html(data);                 
            });
        }

        function format(obj){
            $(obj).find(":input").each(function(){
                if($(this).attr("type") == "text"){
                    this.value = this.value.toUpperCase();  
                    this.value = $(this).val().trim();
                }
            });
        }
        
        window.history.forward();

        function sinVueltaAtras(){ 
            window.history.forward(); 
        }
        </script>
    </body>
</html>