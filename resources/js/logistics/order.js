$(document).ready(function() {

    $(".select-2-single").select2({
        placeholder: "Busque y seleccione",
        allowClear: true
    });

	$('#new-input').tooltip({
	    title: 'Pedido'
	});

    var msg = 'Editar / Cancelar';

    $('#solicitante').tooltip({title: msg});
    $('#details').tooltip({title: msg});

    $('#solicitante').click(function() {
        $("select[name='location']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('solicitante').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({'disabled': 'disabled'});
                document.getElementById('solicitante').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
        $("input[name='fecha']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('solicitante').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({ 'disabled': 'disabled'});
                document.getElementById('solicitante').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });        
        $('#guardar').toggle();
    });

    $('#details').click(function() {

        $("input[name='q[]']").each(function() {
            if ($(this).attr('disabled')) {
                $(this).removeAttr('disabled');
                document.getElementById('details').innerHTML="<i class='fa fa-remove'></i>";
            }
            else {
                $(this).attr({ 'disabled': 'disabled'});
                document.getElementById('details').innerHTML="<i class='fa fa-pencil'></i>";
            }
        });
        $('#guardar').toggle();
    });

   $('#orderDataTable').DataTable( {
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
            exportOptions: { columns: [ 0, 1, 2, 3, 4]},
            text: '<i class="icon-printer"></i>',
            titleAttr: 'Imprimir',
            title: 'Lista de pedidos'
        }, {
            extend: "pdf",
            className: "btn red-sunglo",
            exportOptions: { columns: [ 0, 1, 2, 3, 4]},
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            title: 'Lista de pedidos'
        }, {
            extend: "excel",
            className: "btn green-meadow",
            exportOptions: { columns: [ 0, 1, 2, 3, 4]},
            text: '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            title: 'Lista de pedidos'
        },{
            extend: "colvis",
            className: "btn grey-cascade",
            text: '<i class="fa fa-th-list"></i>'
        }],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    });

    $('#btn_add').click(function(){
        agregar();
    });

    $("#guardar").hide();
});

var cont = 0;

function agregar(){

    idarticulo = $("#pidarticulo").val();
    articulo   = $("#pidarticulo option:selected").text();
    cantidad   = $("#cantidad").val();

    if (idarticulo!="" && articulo!="" && cantidad!="" && cantidad > 0)
    {
        var fila ='<tr id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');"><i class="fa fa-times-circle-o"></i></button></td><td><input type="hidden" name="product[]" value="'+idarticulo+'" class="form-control" readonly>'+articulo+'</td><td><input type="number" name="quantity[]" value="'+cantidad+'" class="form-control" readonly></td></tr>';

        cont++;
        limpiar();
        evaluar();
        $('#detalles').append(fila);
    }
    else{
        alert("Error al ingresar el detalle de pedido, revise los datos del artículo");
    }
}

function limpiar(){
    $("#cantidad").val("");
}

function evaluar(){
    if (cont > 0){ $("#guardar").show(); }
    else{ $("#guardar").hide(); }
}

function eliminar(index){ 
    $("#fila" + index).remove();
    cont--;
    evaluar();
}