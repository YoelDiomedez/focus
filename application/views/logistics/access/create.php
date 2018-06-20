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

    $medidas = array(
        'name' => 'medidas',
        'value' => '1'
    );

    $marcas = array(
        'name' => 'marcas',
        'value' => '1'
    );

    $areas = array(
        'name' => 'areas',
        'value' => '1'
    );

    $comprobantes = array(
        'name' => 'comprobantes',
        'value' => '1'
    );

    $documentos = array(
        'name' => 'documentos',
        'value' => '1'
    );

    $sucursales = array(
        'name' => 'sucursales',
        'value' => '1'
    );

    $usuarios = array(
        'name' => 'usuarios',
        'value' => '1'
    );
    $accesos = array(
        'name' => 'accesos',
        'value' => '1'
    );

    $productos = array(
        'name' => 'productos',
        'value' => '1'
    );

    $proveedores = array(
        'name' => 'proveedores',
        'value' => '1'
    );

    $pedidos = array(
        'name' => 'pedidos',
        'value' => '1'
    );

    $compras = array(
        'name' => 'compras',
        'value' => '1'
    );

    $distribuciones = array(
        'name' => 'distribuciones',
        'value' => '1'
    );

    $kardex = array(
        'name' => 'kardex',
        'value' => '1'
    );

    $estadisticas = array(
        'name' => 'estadisticas',
        'value' => '1'
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
        <li><span>Registrar </span></li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body form">
                <form id="formAccess" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">
                        <h3 class="form-section">Acceso</h3>    
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?= form_label('Oficina *', 'location'); ?>
                                        <?= form_dropdown(
                                            'location', 
                                            $locations, 
                                            '', 
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
                                            '', 
                                            'class=" select-2-single form-control" required'); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <?= form_label('Tipo de Usuario *', 'tipo'); ?>
                                        <select class="form-control" name="type" required="true">
                                          <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                          <option value="USUARIO">USUARIO</option>
                                          <option value="INVITADO">INVITADO</option>
                                        </select>
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
                            <i class="fa fa-save"></i> Registar
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

    $("#formAccess").submit(function(e){
        format('#formAccess');
        e.preventDefault();
        var formData = new FormData($("#formAccess")[0]);
        $.ajax({
            url: "<?php echo site_url("logistics/access/store"); ?>",  
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
                      html: 'Nuevo acceso registrado',
                      timer: 5000
                    }).catch(swal.noop)

                    redirect('logistics/access');
                }
                else{
                    swal({
                      title: '¡Error!',
                      type: 'error',
                      html: 'Algo salió mal, intente de nuevo'
                    }).catch(swal.noop)
                    redirect('logistics/access/create');
                }
            }
        });
    });
});
</script>