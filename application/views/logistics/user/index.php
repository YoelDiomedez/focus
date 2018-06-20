<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Usuarios <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/user');">Usuarios</a>
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
                                    id="new-user" 
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
                <table class="table table-bordered table-hover" id="userDataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>E-mail</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($user)): ?>
                        <?php foreach ($user as $u):?>
                            <tr>
                                <td><?= $u->userID; ?></td>
                                <td><?= $u->name; ?></td>
                                <td><?= $u->email; ?></td>
                                <td>
                                    <button 
                                        class="btn yellow btn-outline"
                                        onclick="edit('<?= $u->userID; ?>');"
                                    >
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button 
                                        class="btn red btn-outline"
                                        onclick="destroy('<?= $u->userID; ?>');"
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
<script src="<?= site_url('resources/js/logistics/user.js'); ?>"></script>
<script>
function create(){
    swal({
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Registrar',
        cancelButtonText: 'Cancelar',
        title: 'Nuevo Usuario',
        html:
        '<input id="n" class="swal2-input" placeholder="User Name" maxlength="16">' +
        '<input id="e" class="swal2-input" placeholder="Email@Address.com" maxlength="255">'+
        '<input id="p" class="swal2-input" placeholder="Password" type="password">',
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#n').val() != '' && $('#e').val() != '' && $('#p').val() != '') {

                    var n = $('#n').val().toUpperCase().trim()
                    var e = $('#e').val().trim()
                    var p = $('#p').val()

                    var i = {
                        name:n, 
                        email: e, 
                        password:p
                    };

                    $.post("<?= site_url(); ?>"+'logistics/user/store/', i, function(data){

                       redirect('logistics/user');

                        if (data == 1) {
                            swal({
                              title: '¡Atención!',
                              type: 'success',
                              html: 'Nuevo usuario registrado',
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
                    reject('Todos los campos son requeridos')
                }

            })
        },
        onOpen: function () {
            $('#n').focus()
      }
    }).catch(swal.noop)
}

function edit(id){

    $.post("<?= site_url(); ?>"+'logistics/user/edit/'+id, function(data){

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
                title: 'Edit user #'+id,
                html:
                '<input id="swal-input1" class="swal2-input" value="'+data[0].name+'" maxlength="16" placeholder="Nombre">' +
                '<input id="swal-input2" class="swal2-input" value="'+data[0].email+'" maxlength="255" placeholder="E-mail">'+
                '<input id="swal-input3" class="swal2-input" type="password" placeholder="Password">',
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        if ($('#swal-input1').val() != '' && $('#swal-input2').val() != '') {

                            var n = $('#swal-input1').val().toUpperCase().trim()
                            var e = $('#swal-input2').val().trim()
                            var p = $('#swal-input3').val()

                            var i = {
                                name:n, 
                                email: e, 
                                password:p,
                            };

                            $.post("<?= site_url(); ?>"+'logistics/user/update/'+id, i, function(data){

                                redirect('logistics/user');

                                if (data == 1) {
                                    swal({
                                      title: '¡Exito!',
                                      type: 'success',
                                      html: data+ ' registro ha sido editado',
                                      timer: 3000
                                    }).catch(swal.noop)
                                }
                                else{
                                    swal({
                                        title: '¡Error!',
                                        type: 'error',
                                        html: data+ ' registros ha sido editado'
                                    }).catch(swal.noop)
                                }
                            });
                            resolve()

                        }else {
                            reject('El campo Nombre y E-mail son requeridos')
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
        title: '¿Eliminar usuario #'+id+'?',
        text: "Recuerde que no podrá revertir los cambios",
        type: 'question',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'

    }).then(function () {

        $.post("<?= site_url(); ?>"+'logistics/user/destroy/'+id, function(data){

            redirect('logistics/user');

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