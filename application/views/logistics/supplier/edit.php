<?php 
    foreach ($i as $key => $value) {
        $idk[] = $value->identityID;
        $idv[] = $value->abbreviation;
    }

    $identities = array_combine($idk, $idv);

    $inputNumberI = array(
        'type'     => 'number',
        'name'     => 'numberI',
        'class'    => 'form-control',
        'required' => 'true',
        'min'      => '0',
        'step'     => '1',
        'value'    => $s[0]->numberIdentity
    );

    $inputCompany = array(
        'type'     => 'text',
        'name'     => 'company',
        'class'    => 'form-control',
        'required' => 'true',
        'maxlength'=> '40',
        'value'    => $s[0]->companyName
    );

    $inputContact = array(
        'type'     => 'text',
        'name'     => 'contact',
        'class'    => 'form-control',
        'required' => 'true',
        'maxlength'=> '30',
        'value'    => $s[0]->contactName
    );

    $inputAddress = array(
        'type'     => 'text',
        'name'     => 'address',
        'class'    => 'form-control',
        'maxlength'=> '60',
        'value'    => $s[0]->address
    );

    $inputCountry = array(
        'type'     => 'text',
        'name'     => 'country',
        'class'    => 'form-control',
        'maxlength'=> '15',
        'value'    => $s[0]->country
    );

    $inputRegion = array(
        'type'     => 'text',
        'name'     => 'region',
        'class'    => 'form-control',
        'maxlength'=> '15',
        'value'    => $s[0]->region
    );

    $inputCity = array(
        'type'     => 'text',
        'name'     => 'city',
        'class'    => 'form-control',
        'maxlength'=> '15',
        'value'    => $s[0]->city
    );

    $inputZip = array(
        'type'     => 'number',
        'name'     => 'zip',
        'class'    => 'form-control',
        'min'      => '0',
        'step'     => '1',
        'value'    => $s[0]->postalCode
    );

    $inputWeb = array(
        'type'     => 'url',
        'name'     => 'web',
        'class'    => 'form-control',
        'value'    => $s[0]->homePage
    );

    $inputPhone = array(
        'type'     => 'tel',
        'name'     => 'phone',
        'class'    => 'form-control',
        'maxlength'=> '24',
        'value'    => $s[0]->phone
    ); 

    $inputMail = array(
        'type'     => 'email',
        'name'     => 'email',
        'class'    => 'form-control',
        'maxlength'=> '50',
        'value'    => $s[0]->email
    );                   
 ?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title"> Proveedores <small></small></h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;" onclick="route('logistics/supplier');">Proveedores</a>
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
                <form id="formSU" accept-charset="utf-8" class="horizontal-form">
                    <div class="form-body">

                        <h3 class="form-section">Información requerida</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Tipo de documento *','identity'); ?>
                                        <?= form_dropdown(
                                            'identity', 
                                            $identities, 
                                            $s[0]->identityID,
                                            'class="select2_s form-control" required'); ?>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Número de documento *','document'); ?>
                                        <?= form_input($inputNumberI); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Nombre de la empresa *','company'); ?>
                                        <?= form_input($inputCompany); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Nombre del contacto *','contact'); ?>
                                        <?= form_input($inputContact); ?>
                                    </div>
                                </div>
                            </div>

                        <h3 class="form-section">Información adicional</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Dirección', 'address'); ?>
                                        <?= form_input($inputAddress);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Provincia', 'country'); ?>
                                        <?= form_input($inputCountry);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Región', 'region'); ?>
                                        <?= form_input($inputRegion);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('País', 'city'); ?>
                                        <?= form_input($inputCity);?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Código postal', 'postalCode'); ?>
                                        <?= form_input($inputZip);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Página web', 'website'); ?>
                                        <?= form_input($inputWeb);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('Telefóno', 'phone'); ?>
                                        <?= form_input($inputPhone);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= form_label('E-mail', 'email'); ?>
                                        <?= form_input($inputMail);?>
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
<script src="<?= site_url('resources/js/logistics/supplier.js'); ?>"></script>
<script>
$(document).ready(function(){

    $("#formSU").submit(function(e){
        format('#formSU');
        e.preventDefault();
        var formData = new FormData($("#formSU")[0]);
        $.ajax({
            url: "<?= site_url(); ?>"+'logistics/supplier/update/<?= $s[0]->supplierID; ?>',  
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

                redirect('logistics/supplier/show/<?= $s[0]->supplierID; ?>');

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
                      html: 'Se ha editado '+data+ ' registros',
                    }).catch(swal.noop)
                }
            }
        });
    });
});
</script>