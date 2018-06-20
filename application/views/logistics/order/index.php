<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Pedidos <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/order');">Pedidos</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Lista</span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button 
                                        id="new-input" 
                                        class="btn green btn-outline"
                                        onclick="route('logistics/order/create');"
                                > 
                                    <i class="fa fa-plus"></i> Solicitar 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover" id="orderDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Oficina</th>
                            <th>Fecha de pedido</th>
                            <th>Fecha de llegada</th>
                            <th>Estado</th>

                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($order)): ?>
                        <?php foreach ($order as $o):?>
                            <tr>
                                <td><?= $o->orderID; ?></td>
                                <td><?= $o->name; ?></td>
                                <td><?= $o->orderDate; ?></td>
                                <td> 
                                    <?php if(!$o->shippedDate): ?>
                                        <?= date('Y-m-') ?>
                                        <i class="fa fa-cog fa-spin fa-fw"></i>
                                        <span class="sr-only uppercase">En proceso...</span>
                                    <?php else: ?>    
                                        <?= $o->shippedDate; ?>
                                    <?php endif; ?>    
                                </td>
                                <td>
                                <?php if($o->status == 'PRESENTADO'): ?>
                                    <span class="badge badge-primary uppercase">
                                        Presentado
                                    </span>
                                <?php elseif($o->status == 'ENVIADO'): ?>
                                    <span class="badge badge-success uppercase">
                                        Enviado
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-danger uppercase">
                                        Cancelado
                                    </span>
                                <?php endif; ?>
                                </td>
                                <td>
                                    <button 
                                        onclick="route('logistics/order/show/<?= $o->orderID; ?>');" 
                                        class="btn dark btn-outline">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                <?php if($o->status == 'PRESENTADO'): ?>  
                                    <button 
                                        onclick="route('logistics/order/edit/<?= $o->orderID; ?>');"
                                        class="btn yellow btn-outline">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button
                                        onclick="destroy('<?= $o->orderID; ?>');"
                                        class="btn red btn-outline">
                                        <i class="fa fa-times-circle-o"></i>
                                    </button>
                                <?php else: ?>
                                    <button class="btn yellow btn-outline" disabled="true">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn red btn-outline" disabled="true">
                                        <i class="fa fa-times-circle-o"></i>
                                    </button>
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>            
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url('resources/js/logistics/order.js'); ?>"></script>
<script>
function destroy(id){
    swal({
        title: '¿Cancelar el pedido #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, regresar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/order/destroy/'+id, function(data){

            redirect('logistics/order');

            if (data == 1) {
                swal({
                      title: '¡Atención!',
                      type: 'warning',
                      html: 'Se ha cancelado el pedido #'+id,
                      timer: 5000
                }).catch(swal.noop)
            }
            else{
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: 'No se pudo cancelar el pedido #'+id
                }).catch(swal.noop)
            }             
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal({
                title: 'Aviso',
                text: 'No se realizó ningún cambio',
                type:'info',
                timer: 3000
            }).catch(swal.noop)
        }
    })
}
</script>