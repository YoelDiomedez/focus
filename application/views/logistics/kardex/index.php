<?php 
    $r = array();
    
    if ($input) {

        for ($j=0; $j < count($input); $j++) {

            $r[$j]['p'] = $input[$j]->productID;
            $r[$j]['d'] = $input[$j]->detail;
            $r[$j]['s'] = $input[$j]->stockMin;
            $r[$j]['i'] = $input[$j]->inputQ;
            $r[$j]['o'] = 0;
        } 

        for ($i=0; $i < count($output); $i++) {
            for ($j=0; $j < count($r); $j++) {

                if ($output[$i]->productID == $r[$j]['p']) {

                    unset($r[$j]['o']);
                    $r[$j]['o'] = $output[$i]->outputQ;
                }
             } 
        }
    }
 ?>
 <!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Kardex <small class="uppercase">Almacén General</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/kardex');">Kardex</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Resumen</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
			<div class="portlet-title">
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover" id="kardex">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Artículo</th>
                            <th>S. Mínimo</th>
                            <th>T. Entradas</th>
                            <th>T. Salidas</th>
                            <th>S. Actual</th>
                            <th class="text-center">Criterio</th>
                            <th>Historial</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($r)): ?>
                        <?php for($i=0; $i<count($r); $i++):?>
                            <tr>
                                <td class="text-center"><?= $r[$i]['p']; ?></td>
                                <td><?= $r[$i]['d']; ?></td>
                                <td class="text-center"><?= $r[$i]['s']; ?></td>
                                <td class="text-center"><?= $r[$i]['i']; ?></td>
                                <td class="text-center"><?= $r[$i]['o']; ?></td>
                                <td class="text-center"><?= $r[$i]['i'] - $r[$i]['o']; ?></td>
                                <td class="text-center">
                                	<?php if (($r[$i]['i'] - $r[$i]['o']) < $r[$i]['s']): ?>
                                		<span class="badge badge-warning uppercase">
                                        Adquirir Bastante
                                    	</span>
                                	<?php else: ?>
                                		<span class="badge badge-info uppercase">
                                        Adquirir lo Necesario
                                    	</span>
                                	<?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button 
                                        onclick="route('logistics/kardex/show/<?= $r[$i]['p']; ?>');" 
                                        class="btn dark btn-outline">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/kardex.js'); ?>"></script>