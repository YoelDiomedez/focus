<?php 
    $formAttribs = array('class' => 'horizontal-form');

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
    
    $g = 'Estante (mueble) <a href="javascript:;" id="mueble"><i class="fa fa-pencil"></i></a>';
    $h = 'Compartimiento (nivel) <a href="javascript:;" id="nivel"><i class="fa fa-pencil"></i></a>';
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
                        <h3 class="form-section">Información adicional</h3>
                            <div class="row">
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