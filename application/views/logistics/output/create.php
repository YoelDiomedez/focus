<?php 

    if ($product and $order) {

        foreach ($product as $key => $value) {
            $pk[] = $value->productID."_".$value->quantity."_".$value->price;
            $pv[] = $value->detail;
        }

        foreach ($order as $key => $value) {
            $ok[] = $value->orderID."_".$value->locationID."_".$value->name;
            $ov[] = $value->orderID;
        }

        $products  = array_combine($pk, $pv);
        $orders    = array_combine($ok, $ov);
    }
    
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

    $inputStock = array(
        'type'     => 'number',
        'name'     => 'stock',
        'class'    => 'form-control',
        'id'       => 'stock',
        'disabled'  => 'disabled',
        'placeholder' => '0'
    );

    $inputPrice = array(
        'type'     => 'number',
        'name'     => 'price',
        'class'    => 'form-control',
        'min'      => '0',
        'step'     => '1',
        'id'       => 'precio',
        'disabled'  => 'disabled',
        'placeholder' => 'S/'
    );

    $inputOrderID = array(
        'type'     => 'hidden',
        'name'     => 'orderID',
        'class'    => 'form-control',
        'id'       => 'order',
        'readonly'  => 'true'
    );

    $inputLocID = array(
        'type'     => 'hidden',
        'name'     => 'locationID',
        'class'    => 'form-control',
        'id'       => 'locID',
        'readonly'  => 'true'
    );

    $inputLocation = array(
        'type'     => 'text',
        'name'     => 'locationID',
        'class'    => 'form-control',
        'id'       => 'location',
        'disabled'  => 'disabled',
        'required' => 'true'
    );

    
 ?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Distribuciones <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/output');">Distribuciones</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Registar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body form">
                <form id="formOutput" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Distribuir a</h3>    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= form_label('Número de Pedido *', 'order'); ?>
                                        <?= form_dropdown(
                                            'o', 
                                            $orders, 
                                            '', 
                                            'class="select-2-single form-control" id="idorder" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= form_label('Fecha *','datetime'); ?>
                                        <?= form_input($inputDateTime);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Oficina', 'stock'); ?>
                                        <?= form_input($inputLocation);?>
                                        <?= form_input($inputOrderID);?>
                                        <?= form_input($inputLocID);?>
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?= form_label('Cantidad *', 'quantity'); ?>
                                        <?= form_input($inputQuantity);?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?= form_label('Precio Unitario', 'price'); ?>
                                        <?= form_input($inputPrice);?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?= form_label('Stock Actual', 'stock'); ?>
                                        <?= form_input($inputStock);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button  type="button" id="btn_add" class="btn btn-primary btn-block">
                                        Agregar producto
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
                                            <th>Precio</th>
                                            <th>Sub Total</th>
                                        </thead>
                                        <tfoot>
                                            <th>TOTAL</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th><h4 id="total">S/ 0.00</h4></th>  
                                        </tfoot>
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
                            <i class="fa fa-save"></i> Distribuir
                        </button>
                    </div>
                <?=  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/output.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formOutput").submit(function(e){
        format('#formOutput');
        e.preventDefault();
        var formData = new FormData($("#formOutput")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/output/store"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                if ($.isNumeric(data)) {
                    redirect('logistics/output/show/'+data);
                    swal({
                      title: '¡Éxito!',
                      type: 'success',
                      html: 'Distribución #'+data+ ' registrado',
                      timer: 5000
                    }).catch(swal.noop)
                }
                else{
                    redirect('logistics/output/create');
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