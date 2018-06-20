<?php 
    if ($location and $product) {
        # code...

        foreach ($location as $key => $value) {
            $lk[] = $value->locationID;
            $lv[] = $value->name;
        }

        foreach ($product as $key => $value) {
            $pk[] = $value->productID;
            $pv[] = $value->detail;
        }

        $locations = array_combine($lk, $lv);
        $products  = array_combine($pk, $pv);

        $inputDateTime = array(
            'type'     => 'date',
            'name'     => 'fecha',
            'class'    => 'form-control',
            'required' => 'true'
        );

        $inputQuantity = array(
            'type'     => 'number',
            'name'     => 'quantity',
            'class'    => 'form-control',
            'min'      => '0',
            'step'     => '1',
            'id'       => 'cantidad'
        );
    }
 ?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Pedidos <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/order');">Pedidos</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Solicitar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body form">
                <form id="formOrder" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Solicitante</h3>    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Oficina *', 'location'); ?>
                                        <?= form_dropdown(
                                            'location', 
                                            $locations, 
                                            '', 
                                            'class=" select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Fecha *','datetime'); ?>
                                        <?= form_input($inputDateTime);?>
                                    </div>
                                </div>
                            </div>
                            <h3 class="form-section">Artículos</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Artículo *', 'product'); ?>
                                        <?= form_dropdown(
                                            'product', 
                                            $products, 
                                            '', 
                                            'class="select-2-single form-control" id="pidarticulo"'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Cantidad *', 'quantity'); ?>
                                        <?= form_input($inputQuantity);?>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button  type="button" id="btn_add" class="btn btn-primary btn-block">
                                        Agregar artículo
                                    </button>
                                </div>
                            </div>
                        <h3 class="form-section">Detalles</h3>    
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-scrollable">
                                    <table id="detalles" class="table table-bordered table-hover">
                                        <thead>
                                            <th>Quitar</th>
                                            <th>Artículo</th>
                                            <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                 </div>
                            </div>
                    </div>
                    <div class="form-actions right" id="guardar">
                        <button type="reset" class="btn default">
                            <i class="fa fa-times-circle-o"></i> Cancelar
                        </button>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-save"></i> Solicitar
                        </button>
                    </div>
                <?=  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/order.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formOrder").submit(function(e){
        format('#formOrder');
        e.preventDefault();
        var formData = new FormData($("#formOrder")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/order/store"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                redirect('logistics/order');

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Éxito!',
                      type: 'success',
                      html: 'Pedido #'+data+ ' registrado',
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