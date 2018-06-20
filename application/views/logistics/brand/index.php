<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Marcas <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/brand');">Marcas</a>
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
                                    id="newBrand" 
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
				<table class="table table-bordered table-hover" id="brandDataTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Marca</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
                <?php if(!empty($brand)): ?>  
					<?php foreach ($brand as $b):?>
						<tr>
							<td><?= $b->brandID; ?></td>
							<td><?= $b->name; ?></td>
							<td>
								<button 
                                    class="btn yellow btn-outline"
                                    onclick="edit('<?= $b->brandID; ?>');"
                                >
											<i class="fa fa-edit"></i>
								</button>
								<button 
                                    class="btn red btn-outline"
                                    onclick="destroy('<?= $b->brandID; ?>');"
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
<script src="<?= site_url('resources/js/logistics/brand.js'); ?>"></script>
<script>
function create(){
    swal({
        title: 'Nueva marca',
        input: 'text',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Agregar',
        cancelButtonText: 'Cancelar',
        inputAttributes: {
            'maxlength': 50
        },
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    var newBrand = {name:value.toUpperCase().trim()};
                    $.post("<?php echo site_url("logistics/brand/store"); ?>",newBrand,function(data){

                        redirect('logistics/brand');

                        if (data == 1) {
                            swal({
                              title: '¡Éxito!',
                              type: 'success',
                              html: 'Se ha agregado '+data+ ' nueva marca',
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
                } else {
                    reject('¡No has escrito nada!')
                }
            })
        }
    }).catch(swal.noop)
}

function edit(id){

    $.post("<?= site_url(); ?>"+'logistics/brand/edit/'+id, function(data){

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
                title: 'Editar marca #'+id,
                input: 'text',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                inputAttributes: {
                    'maxlength': 50
                },
                inputValue: data[0].name,
                inputValidator: function (value) {
                    return new Promise(function (resolve, reject) {

                        if (value) {

                            var newBrand = {name:value.toUpperCase().trim()};

                            $.post("<?= site_url(); ?>"+'logistics/brand/update/'+id,newBrand,function(answ){

                                redirect('logistics/brand');

                                if (answ == 1) {
                                    swal({
                                      title: '¡Éxito!',
                                      type: 'success',
                                      html: 'Se ha editado '+answ+ ' registro',
                                      timer: 3000
                                    }).catch(swal.noop)
                                }
                                else{
                                    swal({
                                        title: '¡Error!',
                                        type: 'error',
                                        html: 'Se ha editado '+answ+ ' registros'
                                    }).catch(swal.noop)
                                }
                            });
                            resolve()
                        } else {
                            reject('¡No has escrito nada!')
                        }
                    })
                }
            }).catch(swal.noop)
        }
    });
}

function destroy(id){
    swal({
        title: '¿Eliminar marca #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/brand/destroy/'+id, function(data){

            redirect('logistics/brand');

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