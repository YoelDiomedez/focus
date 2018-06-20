<?php 
    foreach ($supplier as $key => $value) {
        $sk[] = $value->supplierID;
        $sv[] = $value->companyName;
    }

    foreach ($receipt as $key => $value) {
        $rk[] = $value->receiptID;
        $rv[] = $value->type;
    }

    foreach ($product as $key => $value) {
        $pk[] = $value->productID;
        $pv[] = $value->detail;
    }

    $suppliers = array_combine($sk, $sv);
    $receipts  = array_combine($rk, $rv);
    $products  = array_combine($pk, $pv);

    $inputNumber = array(
        'type'     => 'number',
        'name'     => 'number',
        'class'    => 'form-control',
        'required' => 'true',
        'min'      => '0',
        'step'     => '1'
    );

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

    $inputPrice = array(
        'type'     => 'number',
        'name'     => 'price',
        'class'    => 'form-control',
        'min'      => '0',
        'step'     => '1',
        'id'       => 'precio'
    );

 ?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Compras <small class="uppercase">Almacén General</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/input');">Compras</a>
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
                <form id="formInput" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Cabecera</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Proveedor *', 'supplier'); ?>
                                        <?= form_dropdown(
                                            'supplier', 
                                            $suppliers, 
                                            '', 
                                            'class=" select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= form_label('Comprobante *','receipt'); ?>
                                        <?= form_dropdown(
                                            'receipt', 
                                            $receipts, '',
                                            'class="select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?= form_label('Número *','numero'); ?>
                                        <?= form_input($inputNumber);?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <?= form_label('Fecha *','datetime'); ?>
                                        <?= form_input($inputDateTime);?>
                                    </div>
                                </div>
                            </div>
                        <h3 class="form-section">Artículos</h3>    
                            <div class="row">
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Cantidad *', 'quantity'); ?>
                                        <?= form_input($inputQuantity);?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Precio Unitario *', 'price'); ?>
                                        <?= form_input($inputPrice);?>
                                    </div>
                                </div>     
                            </div>
                            <div class="row">
                                <div class="col-md-4">
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
                            <i class="fa fa-save"></i> Registrar
                        </button>
                    </div>
                <?=  form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/input.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formInput").submit(function(e){
        format('#formInput');
        e.preventDefault();
        var formData = new FormData($("#formInput")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/input/store"); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                redirect('logistics/input');

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Éxito!',
                      type: 'success',
                      html: 'Compra #'+data+ ' registrado',
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