<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Documentos <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/identity');">Documentos</a>
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
                                	id="new-identity" 
                                	class="btn green btn-outline"
                                	onclick="create();" 
                                > 
                                     <i class="fa fa-plus"></i> Agregar 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
				<table class="table table-bordered table-hover" id="identityDataTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Abreviación</th>
							<th>Denominación</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($identity)): ?>
						<?php foreach ($identity as $i):?>
							<tr>
								<td><?= $i->identityID; ?></td>
								<td><?= $i->abbreviation; ?></td>
								<td><?= $i->name; ?></td>
								<td>
									<button 
                                        class="btn yellow btn-outline"
                                        onclick="edit('<?= $i->identityID; ?>');" 
                                    >
										<i class="fa fa-edit"></i>
									</button>
									<button 
                                        class="btn red btn-outline"
                                        onclick="destroy('<?= $i->identityID; ?>');" 
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
<script src="<?= site_url('resources/js/logistics/identity.js'); ?>"></script>
<script>
function create(){
    swal({
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Agregar',
        cancelButtonText: 'Cancelar',
        title: 'Nuevo documento de identidad',
        html:
        '<input id="swal-input1" class="swal2-input" placeholder="Abreviación ej. (DNI)" maxlength="10">' +
        '<input id="swal-input2" class="swal2-input" placeholder="Denominación ej. (Documento Nacional de Identidad)" maxlength="50">',
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#swal-input1').val() != '' && $('#swal-input2').val() != '') {

                    var a = $('#swal-input1').val().toUpperCase().trim()
                    var n = $('#swal-input2').val().toUpperCase().trim()

                    var i = {abbreviation:a, name: n};

                    $.post("<?= site_url(); ?>"+'logistics/identity/store/', i, function(data){

                        redirect('logistics/identity');

                        if (data == 1) {
                            swal({
                              title: '¡Éxito!',
                              type: 'success',
                              html: 'Se ha agregado '+data+ ' nuevo documento',
                              timer: 3000
                            }).catch(swal.noop)
                        }
                        else{
                            swal({
                                title: '¡Error!',
                                type: 'error',
                                text: 'No se agregó ningun registro, intente de nuevo'
                            }).catch(swal.noop)
                        } 
                    });
                    resolve()

                }else {
                    reject('Debes llenar ambos los campos')
                }

            })
        },
        onOpen: function () {
            $('#swal-input1').focus()
      }
    }).catch(swal.noop)
}

function edit(id){

    $.post("<?= site_url(); ?>"+'logistics/identity/edit/'+id, function(data){

        if (data === 'false') {
            swal({
                title: '¡Error!',
                type: 'error',
                html: 'What the hell r u trying to do?'
            }).catch(swal.noop)

            return;
        }
        else{
            data = eval(data);

            swal({
                showCancelButton: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                title: 'Editar documento #'+id,
                html:
                '<input id="swal-input1" class="swal2-input" value="'+data[0].abbreviation+'" maxlength="10">' +
                '<input id="swal-input2" class="swal2-input" value="'+data[0].name+'" maxlength="50">',
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        if ($('#swal-input1').val() != '' && $('#swal-input2').val() != '') {

                            var a = $('#swal-input1').val().toUpperCase().trim()
                            var n = $('#swal-input2').val().toUpperCase().trim()

                            var i = {abbreviation:a, name: n};

                            $.post("<?= site_url(); ?>"+'logistics/identity/update/'+id, i, function(data){

                                redirect('logistics/identity');

                                if (data == 1) {
                                    swal({
                                      title: '¡Éxito!',
                                      type: 'success',
                                      html: 'Se ha editado '+data+ ' registro',
                                      timer: 3000
                                    }).catch(swal.noop)
                                }
                                else{
                                    swal({
                                        title: '¡Error!',
                                        type: 'error',
                                        html: 'Se ha editado '+data+ ' registros'
                                    }).catch(swal.noop)
                                } 
                            });
                            resolve()

                        }else {
                            reject('Debes llenar ambos los campos')
                        }

                    })
                },
                onOpen: function () {
                    $('#swal-input1').focus()
              }
            }).catch(swal.noop)
        }
    });
}

function destroy(id){
    swal({
        title: '¿Eliminar documento #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/identity/destroy/'+id, function(data){

            redirect('logistics/identity');

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
                timer: 2500
            }).catch(swal.noop)
        }
    })
}
</script>