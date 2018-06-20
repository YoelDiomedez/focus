<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Oficinas <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/location');">Oficinas</a>
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
                                	id="new-location" 
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
				<table class="table table-bordered table-hover" id="locationDataTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Oficinas</th>
							<th>Dirección</th>
                            <th>Teléfono</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($location)): ?>
						<?php foreach ($location as $l):?>
							<tr>
								<td><?= $l->locationID; ?></td>
								<td><?= $l->name; ?></td>
								<td><?= $l->address; ?></td>
                                <td><?= $l->phone; ?></td>
								<td>
									<button 
                                        class="btn yellow btn-outline"
                                        onclick="edit('<?= $l->locationID; ?>');"
                                    >
										<i class="fa fa-edit"></i>
									</button>
									<button 
                                        class="btn red btn-outline"
                                        onclick="destroy('<?= $l->locationID; ?>');"
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
<script src="<?= site_url('resources/js/logistics/location.js'); ?>"></script>
<script>
function create(){
    swal({
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Agregar',
        cancelButtonText: 'Cancelar',
        title: 'Nueva Oficina',
        html:
        '<input id="swal-input1" class="swal2-input" placeholder="Nombre" maxlength="50">' +
        '<input id="swal-input2" class="swal2-input" placeholder="Dirección" maxlength="50">'+
        '<input id="swal-input3" class="swal2-input" placeholder="Telefono" maxlength="24">',
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#swal-input1').val() != '') {

                    var n = $('#swal-input1').val().toUpperCase().trim()
                    var a = $('#swal-input2').val().toUpperCase().trim()
                    var p = $('#swal-input3').val().toUpperCase().trim()

                    var i = {name:n, address: a, phone:p};

                    $.post("<?= site_url(); ?>"+'logistics/location/store/', i, function(data){

                       redirect('logistics/location');

                        if (data == 1) {
                            swal({
                              title: '¡Éxito!',
                              type: 'success',
                              html: 'Una nueva oficina se ha agregado',
                              timer: 3000
                            }).catch(swal.noop)
                        }
                        else{
                            swal({
                                title: '¡Error!',
                                type: 'error',
                                text: 'Algo salió mal, vuelve a intentar'
                            }).catch(swal.noop)
                        }
                    });

                    resolve()

                }else {
                    reject('El campo Nombre es indispensable')
                }

            })
        },
        onOpen: function () {
            $('#swal-input1').focus()
      }
    }).catch(swal.noop)
}

function edit(id){

    $.post("<?= site_url(); ?>"+'logistics/location/edit/'+id, function(data){

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
                title: 'Editar oficina #'+id,
                html:
                '<input id="swal-input1" class="swal2-input" value="'+data[0].name+'" maxlength="50">' +
                '<input id="swal-input2" class="swal2-input" value="'+data[0].address+'" maxlength="50">'+
                '<input id="swal-input3" class="swal2-input" value="'+data[0].phone+'" maxlength="24">',
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        if ($('#swal-input1').val() != '') {

                            var n = $('#swal-input1').val().toUpperCase().trim()
                            var a = $('#swal-input2').val().toUpperCase().trim()
                            var p = $('#swal-input3').val().toUpperCase().trim()

                            var i = {name:n, address: a, phone:p};

                            $.post("<?= site_url(); ?>"+'logistics/location/update/'+id, i, function(data){

                                redirect('logistics/location');

                                if (data == 1) {
                                    swal({
                                      title: '¡Éxito!',
                                      type: 'success',
                                      html: data+ ' registro ha sido editado',
                                      timer: 3000
                                    }).catch(swal.noop)
                                }
                                else{
                                    swal({
                                        title: '¡Error!',
                                        type: 'error',
                                        html: data+ ' registros han sido editados'
                                    }).catch(swal.noop)
                                } 
                            });
                            resolve()

                        }else {
                            reject('El campo Nombre es indispensable')
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
        title: '¿Eliminar oficina #'+id+'?',
        text: "Recuerde que los cambios serán irreversibles",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/location/destroy/'+id, function(data){

            redirect('logistics/location');

            if (data == 1) {
                swal({
                      title: '¡Atención!',
                      type: 'warning',
                      html: data+ ' registro ha sido eliminado',
                      timer: 5000
                }).catch(swal.noop)
            }
            else{
                swal({
                    title: '¡Error!',
                    type: 'error',
                    html: data+ ' registros han sido eliminados'
                }).catch(swal.noop)
            }             
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal({
                title: 'Información',
                text: 'No se realizó ningun cambio',
                type:'info',
                timer: 2500
            }).catch(swal.noop)
        }
    })
}
</script>