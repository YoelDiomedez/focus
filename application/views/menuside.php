<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->

        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">

        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-accordion-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

                <li class="nav-item start">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-dashboard"></i>
                        <span class="title">Logística</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                    <?php if ($this->session->userdata('0')->statistics == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/dashboard');">
                                Estadísticas
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->kardex == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/kardex');">
                                Kardex
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->products == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" 
                            onclick="route('logistics/product');">
                                Artículos
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->inputs == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/input');" >
                                Compras
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->orders == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/order');">
                                Pedidos
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('0')->outputs == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/output');">
                                Distribuciones
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->suppliers == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/supplier');" >
                                Proveedores
                            </a>
                        </li>
                    <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item start">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-wrench"></i>
                        <span class="title">Mantenimiento</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                    <?php if ($this->session->userdata('0')->measures == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/measure');">
                            Medidas
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->brands == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/brand');">
                            Marcas
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->areas == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/area');">
                                Categorías
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->receipts == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;"  onclick="route('logistics/receipt');">
                                Comprobantes
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->identities == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/identity');">
                                Documentos
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->locations == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/location');">
                                Oficinas
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->users == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/user');">
                                Usuarios
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('0')->access == 1): ?>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/access');">
                                Accesos
                            </a>
                        </li>
                    <?php endif; ?>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->