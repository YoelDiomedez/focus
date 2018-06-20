<?php 
    foreach ($area as $key => $value) {
        $ark[] = $value->areaID;
        $arv[] = $value->name;
    }

    foreach ($brand as $key => $value) {
        $brk[] = $value->brandID;
        $brv[] = $value->name;
    }

    foreach ($measure as $key => $value) {
        $mek[] = $value->measureID;
        $mev[] = $value->unit;
    }

    $areas = array_combine($ark, $arv);
    $marcas = array_combine($brk, $brv);
    $medidas = array_combine($mek, $mev);

    $formAttribs = array('class' => 'horizontal-form');

    $inputDetail = array(

        'type'     => 'text',
        'name'     => 'detalle',
        'class'    => 'form-control',
        'required' => 'true',
        'disabled' => 'disabled',
        'value'    => $p[0]->detail
    );

    $inputStockMin = array(

        'type'     => 'number',
        'name'     => 'minimo',
        'class'    => 'form-control',
        'required' => 'true',
        'min'      => '0',
        'step'     => '1',
        'disabled' => 'disabled',
        'value'    => $p[0]->stockMin

    );

    $inputShelf = array(

        'type'     => 'text',
        'name'     => 'mueble',
        'class'    => 'form-control',
        'disabled' => 'disabled',
        'value'    => $p[0]->shelf,
        'maxlength'=> '50'
    );

    $inputBin = array(

        'type'     => 'text',
        'name'     => 'nivel',
        'class'    => 'form-control',
        'disabled' => 'disabled',
        'value'    => $p[0]->bin,
        'maxlength'=> '50'
    );

    $inputImage = array(

        'type'     => 'file',
        'name'     => 'imagen',
        'class'    => 'form-control',
        'accept'   => '.jpg, .png',
        'disabled' => 'disabled'
    );

    $status = array(
        'Bueno'   => 'BUENO',
        'Regular' => 'REGULAR',
        'Malo'    => 'MALO'
    );

    $measures = array();

    $m = explode(',', $p[0]->measure);

    if (count($m) == 1) {
        $measures[] = $m[0];
    }
    else{
        $measures[] = $m[0];
        $measures[] = $m[1];
    }

    $a = 'Estado * <a href="javascript:;" id="estado"><i class="fa fa-pencil"></i></a>';
    $b = 'Categoría * <a href="javascript:;" id="area"><i class="fa fa-pencil"></i></a>';
    $c = 'Marca * <a href="javascript:;" id="marca"><i class="fa fa-pencil"></i></a>';
    $d = 'Unidad Pedido / Distribución * <a href="javascript:;" id="medidas"><i class="fa fa-pencil"></i></a>';

    $e = 'Stock Minimo * <a href="javascript:;" id="stockMin"><i class="fa fa-pencil"></i></a>';
    $f = 'Descripción * <a href="javascript:;" id="detalle"><i class="fa fa-pencil"></i></a>';
    $g = 'Estante (mueble) <a href="javascript:;" id="mueble"><i class="fa fa-pencil"></i></a>';
    $h = 'Compartimiento (nivel) <a href="javascript:;" id="nivel"><i class="fa fa-pencil"></i></a>';
    $i = 'Imagen referencial <a href="javascript:;" id="imagen"><i class="fa fa-pencil"></i></a>';

 ?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Artículos <small><?= $this->session->userdata('0')->name; ?></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/product');">Artículos</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Editar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Artículo #<?= $p[0]->productID; ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="formP" accept-charset="utf-8" class="horizontal-form" enctype="multipart/form-data">
                    <div class="form-body">
                        <h3 class="form-section">Información requerida</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($b,'area'); ?>
                                        <?= form_dropdown(
                                            'area', 
                                            $areas, 
                                            $p[0]->areaID,
                                            'class="select2_single form-control" disabled="disabled" required'
                                            ); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($c,'marca'); ?>
                                        <?= form_dropdown(
                                            'marca', 
                                            $marcas, 
                                            $p[0]->brandID, 
                                            'class="select2_single form-control" disabled="disabled" required'
                                            ); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($d, 'medidas'); ?>
                                        <?= form_dropdown(
                                            'unidad[]', 
                                            $medidas, 
                                            $measures, 
                                            'class="select2_multiple form-control" multiple="multiple" disabled="disabled" required'
                                            ); 
                                        ?>
                                        <?= form_hidden('tipo', $p[0]->type); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($e,'stockMin'); ?>
                                        <?= form_input($inputStockMin);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <?= form_label($f, 'detalle'); ?>
                                        <?= form_input($inputDetail);?>
                                    </div>
                                </div>
                            </div>

                        <h3 class="form-section">Información adicional</h3>
                            <div class="row">
                                <div class="col-md-6">
                                <?php if(is_null($p[0]->imagePath)): ?>
                                        <img 
                                        src="<?= site_url('resources/img/logistics/product/default.png'); ?>" 
                                        width="250" 
                                        height="250" 
                                        class="center-block"
                                        >
                                <?php else: ?>
                                    <img 
                                        src="<?= site_url('resources/img/logistics/product/'.$p[0]->imagePath); ?>" 
                                        width="250" 
                                        height="250" 
                                        class="center-block img-thumbnail"
                                    >
                                <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($a, 'estado'); ?>
                                        <?= form_dropdown(
                                            'estado', 
                                            $status, 
                                            $p[0]->status,
                                            'class="select2_single form-control" disabled="disabled" required'
                                            );
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($g, 'estante'); ?>
                                        <?= form_input($inputShelf);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($h, 'compartimiento'); ?>
                                        <?= form_input($inputBin);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label($i, 'imagen'); ?>
                                        <?= form_input($inputImage);?>
                                        <?= form_hidden('oldimg', $p[0]->imagePath); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                    </div>
                    <div class="form-actions right">
                        <button type="reset" class="btn default">
                            <i class="fa fa-times-circle-o"></i> Cancelar
                        </button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>
                <?=  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/product.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formP").submit(function(e){
        format('#formP');
        e.preventDefault();
        var formData = new FormData($("#formP")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/product/update/".$p[0]->productID); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Información!',
                      type: 'info',
                      html: 'Artículo #'+data+ ' actualizado correctamente',
                      timer: 5000
                    }).catch(swal.noop)

                    redirect('logistics/product/show/'+data);
                }
                else{
                    redirect('logistics/product/edit/<?= $p[0]->productID; ?>');
                    swal({
                      title: '¡Error!',
                      type: 'error',
                      html: data
                    }).catch(swal.noop)
                }
            }
        });
    });
});
</script>