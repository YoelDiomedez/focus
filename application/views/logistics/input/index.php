<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Compras <small class="uppercase">Almacén General</small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/input');">Compras</a>
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
                                        onclick="route('logistics/input/create');"
                                > 
                                    <i class="fa fa-plus"></i> Registrar 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover" id="inputDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Proveedor</th>
                            <th>Comprobante</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($input)): ?>
                        <?php foreach ($input as $i):?>
                            <tr>
                                <td><?= $i->inputID; ?></td>
                                <td><?= $i->companyName; ?></td>
                                <td><?= $i->type; ?> : <?= $i->numberReceipt; ?></td>
                                <td><?= $i->date; ?></td>
                                <td>S/ <?= $i->total; ?></td>
                                <td>
                                <?php if($i->status == 1): ?>
                                    <span class="badge badge-primary uppercase">
                                        Aceptado
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-danger uppercase">
                                        Cancelado
                                    </span>
                                <?php endif; ?>
                                </td>
                                <td>
                                    <button 
                                        onclick="route('logistics/input/show/<?= $i->inputID; ?>');" 
                                        class="btn dark btn-outline">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                <?php if($i->status == 1): ?>
                                    <button
                                        onclick="destroy('<?= $i->inputID; ?>');"
                                        class="btn red btn-outline">
                                        <i class="fa fa-times-circle-o"></i>
                                    </button>
                                <?php else: ?>
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
<script src="<?= site_url('resources/js/logistics/input.js'); ?>"></script>
<script>
function destroy(id){
    swal({
        title: '¿Cancelar la compra #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, regresar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/input/destroy/'+id, function(data){

            redirect('logistics/input');

            if (data == id) {
                swal({
                      title: '¡Atención!',
                      type: 'warning',
                      html: 'Se ha cancelado la compra #'+data,
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