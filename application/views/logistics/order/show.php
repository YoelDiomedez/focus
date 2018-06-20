<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Pedidos <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/order');">Pedidos</a>
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
                <div class="invoice-content-2 ">
                    <div class="row invoice-head">
                        <div class="col-md-7 col-xs-6">
                            <div class="invoice-logo">
                                <img src="<?= site_url('resources/img/cca-logo.png'); ?>" class="img-responsive" alt="" width="100"/>
                                <h1 class="uppercase">Pedido #<?= $order[0]->orderID; ?></h1>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-6">
                            <div class="company-address">
                                <span class="bold uppercase">Comisión Central de Admisión</span>
                                <br/> Av. Sesquicentenario Nº 1150,
                                <br> C. U. Puno, Perú
                                <br/>
                                <span class="bold">T</span> (+51) 36-9757
                                <br/>
                                <span class="bold">W</span> www.unap.edu.pe/cca </div>
                        </div>
                    </div>
                    <div class="row invoice-cust-add">
                        <div class="col-xs-3">
                            <h2 class="invoice-title uppercase">Oficina</h2>
                            <p class="invoice-desc"><?= $order[0]->name; ?></p>
                        </div>
                        <div class="col-xs-4">
                            <h2 class="invoice-title uppercase">Dirección</h2>
                            <p class="invoice-desc inv-address"><?= $order[0]->address; ?></p>
                        </div>
                        <div class="col-xs-3">
                            <h2 class="invoice-title uppercase">Fecha de pedido</h2>
                            <p class="invoice-desc uppercase">
                                <?= date('d / M / Y', strtotime($order[0]->orderDate)); ?>
                            </p>
                        </div>
                        <div class="col-xs-2">
                            <h2 class="invoice-title uppercase">Estado</h2>
                            <?php if($order[0]->status == 'PRESENTADO'): ?>
                                <span class="label label-primary uppercase">
                                    Presentado
                                </span>
                            <?php elseif($order[0]->status == 'ENVIADO'): ?>
                                <span class="label label-success uppercase">
                                    Enviado
                                </span>
                            <?php else: ?>
                                <span class="label label-danger uppercase">
                                    Cancelado
                                </span>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    <div class="row invoice-body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="invoice-title uppercase">Artículo</th>
                                        <th class="invoice-title uppercase text-center">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($detail as $d): ?>
                                    <tr>
                                        <td><?= $d->detail; ?></td>
                                        <td class="text-center sbold"><?= $d->quantity; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Imprimir <i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
