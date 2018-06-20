<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Compras <small class="uppercase">Almacén General</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/input');">Compras</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Detalles</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body">
                <div class="invoice">
                    <div class="row invoice-logo">
                        <div class="col-xs-6 invoice-logo-space">
                            <img src="<?= site_url('resources/img/cca-logo.png'); ?>" class="img-responsive" alt="Logo" width="100"/> 
                        </div>
                        <div class="col-xs-6">
                            <p> #<?= $input[0]->inputID; ?> /
                                <?= date('d M Y', strtotime($input[0]->date)); ?>
                                <span class="muted"> Comisión Central de Admisión </span>
                            </p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 nvoice-payment">
                            <h3>Detalles de compra</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Comprobante :</strong>
                                    <?= $input[0]->type; ?> 
                                </li>
                                <li>
                                    <strong>Número :</strong>
                                    <?= $input[0]->numberReceipt; ?>
                                </li>
                                <li><strong>Estado :</strong> 
                                    <?php if($input[0]->status == 1): ?>
                                        <span class="label label-primary uppercase">
                                            Aceptado
                                        </span>
                                    <?php else: ?>
                                        <span class="label label-danger uppercase">
                                            Cancelado
                                        </span>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <h3>Acerca del proveedor</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <strong><?= $input[0]->abbreviation; ?> : </strong> 
                                    <?= $input[0]->numberIdentity; ?> 
                                </li>
                                <li><strong>Empresa : </strong> <?= $input[0]->companyName; ?> </li>
                                <li><strong>Contacto : </strong> <?= $input[0]->contactName; ?> </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th> Artículo </th>
                                        <th class="hidden-xs"> Cantidad </th>
                                        <th class="hidden-xs"> Precio unitario </th>
                                        <th> Sub total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($detail as $d): ?>
                                    <tr>
                                        <td> <?= $d->detail; ?> </td>
                                        <td class="hidden-xs"> <?= $d->quantity; ?> </td>
                                        <td class="hidden-xs"> S/ <?= $d->unitPrice; ?> </td>
                                        <td> S/ <?= ($d->quantity * $d->unitPrice) ?> </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="well">
                                <address>
                                    <strong>Comisión Central de Admisión</strong>
                                    <br> Av. Sesquicentenario Nº 1150,
                                    <br> C. U. Puno, Perú
                                    <br> <abbr title="Teléfono">T:</abbr> (+51) 36-9757
                                </address>
                            </div>
                        </div>
                        <div class="col-xs-7 invoice-block">
                            <ul class="list-unstyled amounts">
                                <li><strong>Total incluido IGV : </strong> S/ <?= $input[0]->total; ?> </li>
                            </ul>
                            <br>
                            <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Imprimir
                                    <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
