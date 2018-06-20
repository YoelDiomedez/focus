<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Distribuciones <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/output');">Distribuciones</a>
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
                                        id="new-output" 
                                        class="btn green btn-outline"
                                        onclick="route('logistics/output/create');"
                                > 
                                    <i class="fa fa-plus"></i> Registrar 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover" id="outputDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Oficina</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($output)): ?>
                        <?php foreach ($output as $o):?>
                            <tr>
                                <td>   <?= $o->outputID; ?></td>
                                <td>   <?= $o->name; ?></td>
                                <td>   <?= $o->date; ?></td>
                                <td>S/ <?= $o->total; ?></td>
                                <td>
                                <?php if($o->status == 1): ?>
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
                                        onclick="route('logistics/output/show/<?= $o->outputID; ?>');" 
                                        class="btn dark btn-outline">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                <?php if($o->status == 1): ?>
                                    <button
                                        onclick="destroy('<?= $o->outputID; ?>');"
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
<script src="<?= site_url('resources/js/logistics/output.js'); ?>"></script>
<script>
function destroy(id){
    swal({
        title: '¿Cancelar la distribución #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, regresar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/output/destroy/'+id, function(data){

            redirect('logistics/output');

            if (data == id) {
                swal({
                      title: '¡Atención!',
                      type: 'warning',
                      html: 'Se ha cancelado la distribución #'+data,
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