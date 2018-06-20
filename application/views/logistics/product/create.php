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

    $inputDetail = array(

        'type'     => 'text',
        'name'     => 'detalle',
        'class'    => 'form-control',
        'required' => 'true'
    );

    $inputStockMin = array(

        'type'     => 'number',
        'name'     => 'minimo',
        'class'    => 'form-control',
        'required' => 'true',
        'min'      => '0',
        'step'     => '1'

    );

    $inputShelf = array(

        'type'     => 'text',
        'name'     => 'mueble',
        'class'    => 'form-control',
        'maxlength'=> '50'
    );

    $inputBin = array(

        'type'     => 'text',
        'name'     => 'nivel',
        'class'    => 'form-control',
        'maxlength'=> '50'
    );

    $inputImage = array(

        'type'   => 'file',
        'name'   => 'imagen',
        'class'  => 'form-control',
        'accept' => '.jpg, .png'
    );
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
        <li><span>Registrar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body form">
                <form id="formP" accept-charset="utf-8" class="horizontal-form" enctype="multipart/form-data">
                    <div class="form-body">
                        <h3 class="form-section">Información requerida</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Categoría *','area'); ?>
                                        <?= form_dropdown('area', $areas, '','class="select2_single form-control" required'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Marca *','marca'); ?>
                                        <?= form_dropdown('marca', $marcas, '', 'class="select2_single form-control" required'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Unidad Pedido / Distribución *', 'medidas'); ?>
                                        <?= form_dropdown('unidad[]', $medidas, '', 'class="select2_multiple form-control" multiple="multiple" required'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Stock Minimo *','stockMin'); ?>
                                        <?= form_input($inputStockMin);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <?= form_label('Descripción *', 'detalle'); ?>
                                        <?= form_input($inputDetail);?>
                                    </div>
                                </div>
                            </div>

                        <h3 class="form-section">Información adicional</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Estante (mueble)', 'estante'); ?>
                                        <?= form_input($inputShelf);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Compartimiento (nivel)', 'compartimiento'); ?>
                                        <?= form_input($inputBin);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?= form_label('Imagen referencial', 'imagen'); ?>
                                        <?= form_input($inputImage);?>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="form-actions right">
                        <button type="reset" class="btn default">
                            <i class="fa fa-times-circle-o"></i> Cancelar
                        </button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-save"></i> Registrar
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
            url: "<?php echo site_url("logistics/product/store"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                redirect('logistics/product/create');

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Éxito!',
                      type: 'success',
                      html: 'Artículo #'+data+ ' registrado',
                      timer: 5000
                    }).catch(swal.noop)
                }
                else{
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