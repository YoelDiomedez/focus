<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Kardex <small class="uppercase">Almacén General</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/kardex');">Kardex</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Historial</span></li>
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
                            <img src="<?= site_url('resources/img/cca-logo.png'); ?>" class="img-responsive" alt="" width="100"/> 
                        </div>
                        <div class="col-xs-6">
                            <p> #<?= $product[0]->productID; ?> / Tarjeta Kardex
                                <span class="muted"> Comisión Central de Admisión </span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-7">
                            <h3>Artículo</h3>
                            <ul class="list-unstyled">
                                <li><strong>Descripción : </strong> <?= $product[0]->detail; ?> </li>
                            
                            </ul>
                        </div>
                        <div class="col-xs-5 invoice-payment">
                            <h3>Ficha Kardex</h3>
                            <ul class="list-unstyled">
                                <li><strong>Método : </strong>PROMEDIO PONDERADO</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th class="text-center" rowspan="2">Fecha</th>
                                    <th class="text-center" rowspan="2">Detalle</th>
                                    <th class="text-center" colspan="3">Entradas</th>
                                    <th class="text-center" colspan="3">Salidas</th>
                                    <th class="text-center" colspan="3">Saldo</th>
                                  </tr>
                                  <tr>
                                    <th class="text-center">Q</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">T</th>
                                    <th class="text-center">Q</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">T</th>
                                    <th class="text-center">Q</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">T</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($kardex as $k): ?>
                                    <?php if ($k->status == 1 && $k->detalle == 'Compra'): ?>
                                    <tr>
                                        <td class="text-center"><?= $k->date; ?></td>
                                        <td class="text-center"><?= $k->detalle; ?></td>

                                        <td class="text-center"><?= $k->quantity; ?></td>
                                        <td class="text-center"><?= $k->unitPrice; ?></td>
                                        <td class="text-center">S/ <?= $k->total; ?></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td class="text-center"><?= $k->SaldoQ; ?></td>
                                        <td class="text-center"><?= $k->SaldoCU; ?></td>
                                        <td>S/ <?= $k->SaldoCT; ?></td>
                                    </tr>    
                                    <?php elseif ($k->status == 0 && $k->detalle == 'Compra Dev'): ?>
                                    <tr>
                                        <td class="text-center"><?= $k->date; ?></td>
                                        <td class="text-center"><?= $k->detalle; ?>uelta</td>

                                        <td class="text-center" style="color:red"><?= $k->quantity; ?></td>
                                        <td class="text-center" style="color:red"><?= $k->unitPrice; ?></td>
                                        <td class="text-center" style="color:red">S/ <?= $k->total; ?></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td class="text-center"><?= $k->SaldoQ; ?></td>
                                        <td class="text-center"><?= $k->SaldoCU; ?></td>
                                        <td >S/ <?= $k->SaldoCT; ?></td>
                                    </tr>
                                    <?php endif; ?>

                                    <?php if ($k->status == 1 && $k->detalle == 'Distribucion'): ?>
                                    <tr>
                                        <td class="text-center"><?= $k->date; ?></td>
                                        <td class="text-center"><?= $k->detalle; ?></td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td class="text-center"><?= $k->quantity; ?></td>
                                        <td class="text-center"><?= $k->SaldoCU; ?></td>
                                        <td class="text-center">S/ <?= $k->total; ?></td>

                                        <td class="text-center"><?= $k->SaldoQ; ?></td>
                                        <td class="text-center"><?= $k->SaldoCU; ?></td>
                                        <td >S/ <?= $k->SaldoCT; ?></td>
                                    </tr>    
                                    <?php elseif ($k->status == 0 && $k->detalle == 'Distribucion Dev'): ?>
                                    <tr>
                                        <td class="text-center"><?= $k->date; ?></td>
                                        <td class="text-center"><?= $k->detalle; ?>uelta</td>

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td class="text-center" style="color:red"><?= $k->quantity; ?></td>
                                        <td class="text-center" style="color:red"><?= $k->SaldoCU; ?></td>
                                        <td class="text-center" style="color:red">S/ <?= $k->total; ?></td>

                                        <td class="text-center"><?= $k->SaldoQ; ?></td>
                                        <td class="text-center"><?= $k->SaldoCU; ?></td>
                                        <td >S/ <?= $k->SaldoCT; ?></td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="well">
                                <strong>Q : </strong>Cantidad<br>
                                <strong>P : </strong>Costo Unitario <br>
                                <strong>T : </strong>Costo Total
                            </div>
                        </div>
                        <div class="col-xs-8 invoice-block">
                        <!--
                            <ul class="list-unstyled amounts">
                                <li>
                                    <strong>Sub - Total amount:</strong> $9265 </li>
                                <li>
                                    <strong>Discount:</strong> 12.9% </li>
                                <li>
                                    <strong>VAT:</strong> ----- </li>
                                <li>
                                    <strong>Grand Total:</strong> $12489 </li>
                            </ul>-->
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

<!--
<table border="1">
  <tr>
    <th rowspan="2">Fecha</th>
    <th rowspan="2">Detalle</th>
    <th colspan="3">Entradas</th>
    <th colspan="3">Salidas</th>
    <th colspan="3">Saldo</th>
  </tr>
  <tr>
    <td>Q</td>
    <td>P</td>
    <td>T</td>
    <td>Q</td>
    <td>P</td>
    <td>T</td>
    <td>Q</td>
    <td>P</td>
    <td>T</td>
  </tr>

<?php foreach ($kardex as $k): ?>
  	<?php if ($k->status == 1 && $k->detalle == 'Compra'): ?>
  	<tr>
	    <td><?= $k->date; ?></td>
	    <td><?= $k->detalle; ?></td>

	    <td><?= $k->quantity; ?></td>
	    <td><?= $k->unitPrice; ?></td>
	    <td><?= $k->total; ?></td>

	    <td></td>
	    <td></td>
	    <td></td>

	    <td><?= $k->SaldoQ; ?></td>
	    <td><?= $k->SaldoCU; ?></td>
	    <td><?= $k->SaldoCT; ?></td>
	</tr>    
  	<?php elseif ($k->status == 0 && $k->detalle == 'Compra Dev'): ?>
  	<tr>
	    <td><?= $k->date; ?></td>
	    <td><?= $k->detalle; ?></td>

	    <td style="color:red"><?= $k->quantity; ?></td>
	    <td style="color:red"><?= $k->unitPrice; ?></td>
	    <td style="color:red"><?= $k->total; ?></td>

	    <td></td>
	    <td></td>
	    <td></td>

	    <td><?= $k->SaldoQ; ?></td>
	    <td><?= $k->SaldoCU; ?></td>
	    <td><?= $k->SaldoCT; ?></td>
  	</tr>
	<?php endif; ?>

  	<?php if ($k->status == 1 && $k->detalle == 'Distribucion'): ?>
  	<tr>
	    <td><?= $k->date; ?></td>
	    <td><?= $k->detalle; ?></td>

	    <td></td>
	    <td></td>
	    <td></td>

	    <td><?= $k->quantity; ?></td>
	    <td><?= $k->SaldoCU; ?></td>
	    <td><?= $k->total; ?></td>

	    <td><?= $k->SaldoQ; ?></td>
	    <td><?= $k->SaldoCU; ?></td>
	    <td><?= $k->SaldoCT; ?></td>
	</tr>    
  	<?php elseif ($k->status == 0 && $k->detalle == 'Distribucion Dev'): ?>
  	<tr>
	    <td><?= $k->date; ?></td>
	    <td><?= $k->detalle; ?></td>

	    <td></td>
	    <td></td>
	    <td></td>

	    <td style="color:red"><?= $k->quantity; ?></td>
	    <td style="color:red"><?= $k->SaldoCU; ?></td>
	    <td style="color:red"><?= $k->total; ?></td>

	    <td><?= $k->SaldoQ; ?></td>
	    <td><?= $k->SaldoCU; ?></td>
	    <td><?= $k->SaldoCT; ?></td>
  	</tr>
	<?php endif; ?>

<?php endforeach; ?>
</table>
-->