<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Accesos <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/access');">Accesos</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Lista </span></li>
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
                                            id="newAccess" 
                                            class="btn green btn-outline"
                                            onclick="route('logistics/access/create');"
                                        > 
                                        	<i class="fa fa-plus"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="portlet-body">
				<table class="table table-bordered table-hover" id="accessDatatable">
					<thead>
						<tr>
                            <th>#</th>
							<th>Oficina</th>
							<th>Usuario</th>
                            <th>Tipo</th>
                            <th>Fecha de Registro</th>
                            <th>Opciones</th>
						</tr>
					</thead>
					<tbody>
                    <?php if(!empty($acceso)): ?>  
					<?php foreach ($acceso as $a):?>
						<tr>
                            <td><?= $a->roleID; ?></td>
							<td><?= $a->l; ?></td>
							<td><?= $a->u; ?></td>
                            <td><?= $a->type; ?></td>
                            <td><?= $a->modifiedDate; ?></td>
							<td>
								<button 
                                    class="btn yellow btn-outline"
                                    onclick="edit('<?= $a->roleID; ?>');"
                                >
									<i class="fa fa-edit"></i>
								</button>
								<button 
                                    class="btn red btn-outline"
                                    onclick="destroy('<?= $a->roleID; ?>');"
                                >
									<i class="fa fa-trash"></i>
								</button>
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
<script src="<?= site_url('resources/js/logistics/access.js'); ?>"></script>
<script>
function edit(id) {

    $.post("<?= site_url(); ?>"+'logistics/access/edit/'+id, function(data){

        if (data == '') {
            swal({
                title: '¡Error!',
                type: 'error',
                html: 'What the hell r u trying to do?'
            }).catch(swal.noop)

            redirect('logistics/access');
        } else {
            loading('open');
            $('#main').html(data);
            loading('close');
        }
    });
}

function destroy(id){
    swal({
        title: '¿Eliminar el acceso #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/access/destroy/'+id, function(data){

            redirect('logistics/access');

            if (data == 1) {
                swal({
                      title: '¡Atención!',
                      type: 'warning',
                      html: 'Se ha eliminado '+data+ ' registro',
                      timer: 5000
                }).catch(swal.noop)
            }
            else{
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: 'Se ha eliminado '+data+ ' registros'
                }).catch(swal.noop)
            }             
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal({
                title: 'Cancelado',
                text: 'No se realizó ningún cambio',
                type:'info',
                timer: 3000
            }).catch(swal.noop)
        }
    })
}
</script>