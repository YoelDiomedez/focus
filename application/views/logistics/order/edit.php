<?php 
    foreach ($location as $key => $value) {
        $lk[] = $value->locationID;
        $lv[] = $value->name;
    }

    $locations = array_combine($lk, $lv);

    $inputDateTime = array(
        'type'     => 'date',
        'name'     => 'fecha',
        'class'    => 'form-control',
        'required' => 'true',
        'value'    => $o[0]->orderDate,
        'disabled' => 'disabled'
    );

    $inputQuantity = array(
        'type'     => 'number',
        'name'     => 'quantity',
        'class'    => 'form-control',
        'min'      => '0',
        'step'     => '1',
        'id'       => 'cantidad',
        'disabled' => 'disabled'
    );
    
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
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Pedido #<?= $o[0]->orderID; ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="formOrderEdit" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">
                            Solicitante
                            <small>
                                <a href="javascript:;" id="solicitante"><i class="fa fa-pencil"></i></a>
                            </small>
                        </h3>    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Oficina * ', 'location'); ?>
                                        <?= form_dropdown(
                                            'location', 
                                            $locations, 
                                            $o[0]->locationID, 
                                            'class=" select-2-single form-control" disabled="disabled" required'); 
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
                        <h3 class="form-section">
                            Detalles
                            <small>
                                <a href="javascript:;" id="details"><i class="fa fa-pencil"></i></a>
                            </small>
                        </h3>    
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-scrollable">
                                    <table id="detalles" class="table table-bordered table-hover">
                                        <thead>
                                            <th>Artículo</th>
                                            <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach($d as $d): ?>
                                            <tr>
                                                <td>
                                                    <input 
                                                        type="hidden" 
                                                        name="p[]" 
                                                        value="<?= $d->productID; ?>" 
                                                        class="form-control" readonly>
                                                        <?= $d->detail; ?>
                                                </td>
                                                <td>
                                                    <input 
                                                        type="number" 
                                                        name="q[]" 
                                                        value="<?= $d->quantity; ?>" 
                                                        class="form-control" disabled="disabled">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?> 
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
                            <i class="fa fa-save"></i> Guardar
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

    $("#formOrderEdit").submit(function(e){
        format('#formOrderEdit');
        e.preventDefault();
        var formData = new FormData($("#formOrderEdit")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/order/update/".$o[0]->orderID); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#main').html(data);

                if ($.isNumeric(data)) {
                    swal({
                      title: '¡Información!',
                      type: 'info',
                      html: 'Pedido #'+data+ ' actualizado correctamente',
                      timer: 5000
                    }).catch(swal.noop)

                    redirect('logistics/order/show/'+data);
                }
                else{
                    redirect('logistics/order/edit/<?= $o[0]->orderID; ?>');
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