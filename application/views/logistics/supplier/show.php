<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Proveedores <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/supplier');">Proveedores</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Detalles</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
           <div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form class="form-horizontal" role="form">
                 <div class="form-body">

                    <h3 class="form-section">Información completa proveedor #<?= $s[0]->supplierID; ?></h3>

                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Empresa:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->companyName; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Contacto:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->contactName; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Dirección:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->address; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Provincia:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->country; ?> </p>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Región:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->region; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Pais:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->city; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Código postal:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->postalCode; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Página web:</strong></label>
                             <div class="col-md-9">
                                <?php if ($s[0]->homePage <> ''): ?>
                                    <p class="form-control-static">
                                        <a href="<?= $s[0]->homePage; ?>" target="_blank">
                                                        <?= parse_url($s[0]->homePage, PHP_URL_HOST) ?>
                                        </a>
                                    </p>
                                    <?php else: ?>
                                    <p class="form-control-static"> <?= $s[0]->homePage; ?> </p>
                                <?php endif; ?>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>Telefono:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->phone; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                       <div class="col-md-6">
                          <div class="form-group">
                             <label class="control-label col-md-3"><strong>E-mail:</strong></label>
                             <div class="col-md-9">
                                <p class="form-control-static"> <?= $s[0]->email; ?> </p>
                             </div>
                          </div>
                       </div>
                       <!--/span-->
                    </div>
                    <!--/row-->
                 </div>

                 <div class="form-actions">
                    <div class="row">
                       <div class="col-md-6">
                          <div class="row">
                             <div class="col-md-offset-3 col-md-9">
                                <button 
                                    type="button"
                                    onclick="edit('<?= $s[0]->supplierID; ?>');"
                                    class="btn green btn-outline hidden-print">
                                    <i class="fa fa-edit"></i> Editar
                                </button>
                                <button 
                                    type="button" 
                                    class="btn dark btn-outline hidden-print" 
                                    onclick="window.print();">
                                    <i class="fa fa-print"></i> Imprimir
                                </button>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-6"> </div>
                    </div>
                 </div>

              </form>
              <!-- END FORM-->
           </div>
        </div>
    </div>
</div>