$(document).ready(function() {

    $(".select2_single").select2({
        placeholder: "Busque y seleccione",
        allowClear: true
    });

    $(".select2_multiple").select2({
        maximumSelectionLength: 2,
        placeholder: "Busque y seleccione 1 o 2 unidades",
        allowClear: true
    });

    $('#new-product').tooltip({title: 'Artículo'});

    var msg = 'Editar / Cancelar';

    $('#area').tooltip({title: msg});
    $('#marca').tooltip({title: msg});
    $('#medidas').tooltip({title: msg});
    $('#estado').tooltip({title: msg});
    $('#stockMin').tooltip({title: msg});
    $('#detalle').tooltip({title: msg});
    $('#imagen').tooltip({title: msg});
    $('#nivel').tooltip({title: msg});
    $('#mueble').tooltip({title: msg});

    $('#estado').click(function() {
        $("select[name='estado']").each(function() {

            if ($(this).attr('disabled')) {

                $(this).removeAttr('disabled');
                document.getElementById('estado').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('estado').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#area').click(function() {
        $("select[name='area']").each(function() {

            if ($(this).attr('disabled')) {

                $(this).removeAttr('disabled');
                document.getElementById('area').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('area').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#marca').click(function() {
        $("select[name='marca']").each(function() {

            if ($(this).attr('disabled')) {

                $(this).removeAttr('disabled');
                document.getElementById('marca').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('marca').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#medidas').click(function() {
        $("select[name='unidad[]']").each(function() {

            if ($(this).attr('disabled')) {

                $(this).removeAttr('disabled');
                document.getElementById('medidas').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('medidas').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#stockMin').click(function() {
        $("input[name='minimo']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('stockMin').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({ 'disabled': 'disabled'});
                document.getElementById('stockMin').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#detalle').click(function() {
        $("input[name='detalle']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('detalle').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({ 'disabled': 'disabled'});
                document.getElementById('detalle').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#mueble').click(function() {
        $("input[name='mueble']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('mueble').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({ 'disabled': 'disabled'});
                document.getElementById('mueble').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#nivel').click(function() {
        $("input[name='nivel']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('nivel').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({ 'disabled': 'disabled'});
                document.getElementById('nivel').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#imagen').click(function() {
        $("input[name='imagen']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('imagen').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({ 'disabled': 'disabled'});
                document.getElementById('imagen').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
    });

    $('#productDataTable').DataTable( {
    	language: {
            zeroRecords: "No se encontraron resultados",
            info: "",
            infoEmpty: "",
            infoFiltered: "",
            search:"Buscar "
        },
        order: [[ 0, "desc" ]],
        bLengthChange: false,
        buttons: [{
            extend: "print",
            className: "btn purple-plum",
            exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]},
            text: '<i class="icon-printer"></i>',
            titleAttr: 'Imprimir',
            title: 'Lista de artículos'
        }, {
            extend: "pdf",
            className: "btn red-sunglo",
            exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]},
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            title: 'Lista de artículos'
        }, {
            extend: "excel",
            className: "btn green-meadow",
            exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]},
            text: '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            title: 'Lista de artículos'
        },{
            extend: "colvis",
            className: "btn grey-cascade",
            text: '<i class="fa fa-th-list"></i>'
        }],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    });
});