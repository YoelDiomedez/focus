<?php 
    foreach ($location as $key => $value) {
        $lk[] = $value->locationID;
        $lv[] = $value->name;
    }

    foreach ($user as $key => $value) {
        $uk[] = $value->userID;
        $uv[] = $value->name;
    }

    $locations = array_combine($lk, $lv);
    $users  = array_combine($uk, $uv);

    $options = array(
            'ADMINISTRADOR' => 'ADMINISTRADOR',
            'USUARIO'       => 'USUARIO',
            'INVITADO'      => 'INVITADO'
    );

    $medidas = array(
        'name' => 'medidas',
        'value' => '1',
        'checked' => $role[0]->measures
    );

    $marcas = array(
        'name' => 'marcas',
        'value' => '1',
        'checked' => $role[0]->brands
    );

    $areas = array(
        'name' => 'areas',
        'value' => '1',
        'checked' => $role[0]->areas
    );

    $comprobantes = array(
        'name' => 'comprobantes',
        'value' => '1',
        'checked' => $role[0]->receipts
    );

    $documentos = array(
        'name' => 'documentos',
        'value' => '1',
        'checked' => $role[0]->identities
    );

    $sucursales = array(
        'name' => 'sucursales',
        'value' => '1',
        'checked' => $role[0]->locations
    );

    $usuarios = array(
        'name' => 'usuarios',
        'value' => '1',
        'checked' => $role[0]->users
    );
    $accesos = array(
        'name' => 'accesos',
        'value' => '1',
        'checked' => $role[0]->access
    );

    $productos = array(
        'name' => 'productos',
        'value' => '1',
        'checked' => $role[0]->products
    );

    $proveedores = array(
        'name' => 'proveedores',
        'value' => '1',
        'checked' => $role[0]->suppliers
    );

    $pedidos = array(
        'name' => 'pedidos',
        'value' => '1',
        'checked' => $role[0]->orders
    );

    $compras = array(
        'name' => 'compras',
        'value' => '1',
        'checked' => $role[0]->inputs
    );

    $distribuciones = array(
        'name' => 'distribuciones',
        'value' => '1',
        'checked' => $role[0]->outputs
    );

    $kardex = array(
        'name' => 'kardex',
        'value' => '1',
        'checked' => $role[0]->kardex
    );

    $estadisticas = array(
        'name' => 'estadisticas',
        'value' => '1',
        'checked' => $role[0]->statistics
    );
 ?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Accesos <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/access');">Accesos</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><span>Editar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">Acceso #<?= $role[0]->roleID; ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="formAccessUpdate" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Oficina *', 'location'); ?>
                                        <?= form_dropdown(
                                            'location', 
                                            $locations, 
                                            $role[0]->locationID, 
                                            'class=" select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Usuario *', 'user'); ?>
                                        <?= form_dropdown(
                                            'user', 
                                            $users, 
                                            $role[0]->userID, 
                                            'class=" select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?= form_label('Tipo de Usuario *', 'tipo'); ?>
                                    <?= form_dropdown(
                                        'type', 
                                        $options, 
                                        $role[0]->type,
                                        'class="form-control" required'); ?>
                                    </div>
                                </div>
                            </div>
                            <h3 class="form-section">Permisos</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="mt-checkbox-list">
                                            <label class="mt-checkbox"> Medidas
                                                <?= form_checkbox($medidas);?>
                                                <span></span>
                                            </label>

                                            <label class="mt-checkbox"> Marcas
                                                <?= form_checkbox($marcas);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Areas
                                                <?= form_checkbox($areas);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Comprobantes
                                                <?= form_checkbox($comprobantes);?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="mt-checkbox-list">
                                            <label class="mt-checkbox"> Documentos
                                                <?= form_checkbox($documentos);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Sucursales
                                                <?= form_checkbox($sucursales);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Usuarios
                                                <?= form_checkbox($usuarios);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Accesos
                                                <?= form_checkbox($accesos);?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="mt-checkbox-list">
                                            <label class="mt-checkbox"> Productos
                                                <?= form_checkbox($productos);?>
                                                <span></span>
                                            </label>

                                            <label class="mt-checkbox"> Proveedores
                                                <?= form_checkbox($proveedores);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Pedidos
                                                <?= form_checkbox($pedidos);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Compras
                                                <?= form_checkbox($compras);?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="mt-checkbox-list">
                                            <label class="mt-checkbox"> Distribuciones
                                                <?= form_checkbox($distribuciones);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Kardex
                                                <?= form_checkbox($kardex);?>
                                                <span></span>
                                            </label>
                                            <label class="mt-checkbox"> Estadísticas
                                                <?= form_checkbox($estadisticas);?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                            </div>  
                    </div>
                    <div class="form-actions right">
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
<script src="<?= site_url('resources/js/logistics/access.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formAccessUpdate").submit(function(e){
        format('#formAccessUpdate');
        e.preventDefault();
        var formData = new FormData($("#formAccessUpdate")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/access/update/".$role[0]->roleID); ?>",  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                if (data == 1) {
                    swal({
                      title: '¡Éxito!',
                      type: 'success',
                      html: 'Acceso #'+data+' actualizado correctamente',
                      timer: 5000
                    }).catch(swal.noop)
                }
                else{
                    swal({
                      title: '¡Error!',
                      type: 'error',
                      html: 'Algo salió mal, intente de nuevo'
                    }).catch(swal.noop)
                }

                redirect('logistics/access');
            }
        });
    });
});
</script>