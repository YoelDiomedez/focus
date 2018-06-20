$(document).ready(function() {

    $(".select-2-single").select2({
        placeholder: "Busque y seleccione",
        allowClear: true
    });

	$('#new-output').tooltip({
	    title: 'Distribución'
	});

   $('#outputDataTable').DataTable( {
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
            title: 'Lista de distribuciones'
        }, {
            extend: "pdf",
            className: "btn red-sunglo",
            exportOptions: { columns: [ 0, 1, 2, 3, 4]},
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            title: 'Lista de distribuciones'
        }, {
            extend: "excel",
            className: "btn green-meadow",
            exportOptions: { columns: [ 0, 1, 2, 3, 4]},
            text: '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            title: 'Lista de distribuciones'
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
    $("#pidarticulo").change(mostrarValores);
    $("#idorder").change(showValues);
});

var cont = 0;
   total = 0;
subtotal = [];


function mostrarValores(){
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $('#precio').val(datosArticulo[2]);
    $('#stock').val(datosArticulo[1]);
}

function showValues(){
    datosPedido=document.getElementById('idorder').value.split('_');
    $('#order').val(datosPedido[0]);
    $('#locID').val(datosPedido[1]);
    $('#location').val(datosPedido[2]);
}

function agregar(){

    datosArticulo=document.getElementById('pidarticulo').value.split('_');

    idarticulo = datosArticulo[0];
    articulo   = $("#pidarticulo option:selected").text();
    cantidad   = $("#cantidad").val();
    precio     = $("#precio").val();
    stock      = $('#stock').val();

    if (idarticulo!="" && cantidad!="" && cantidad > 0 && precio !="" && articulo!="")
    {
        if (Number(stock)>=Number(cantidad))
        {
            subtotal[cont] = (cantidad * precio);
            total          = total + subtotal[cont];

            var fila ='<tr id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');"><i class="fa fa-times-circle-o"></i></button></td><td><input type="hidden" name="product[]" value="'+idarticulo+'" class="form-control" readonly>'+articulo+'</td><td><input type="number" name="quantity[]" value="'+cantidad+'" class="form-control" readonly></td><td><input type="number" name="price[]" value="'+precio+'" class="form-control" readonly></td><td>'+subtotal[cont]+'</td></tr>';

            cont++;
            limpiar();

            $("#total").html("S/ " + total);
            evaluar();
            $('#detalles').append(fila);
        }
        else{
            alert("La cantidad a distribuir, supera el stock");
        }
    }
    else{
        alert("Error al ingresar el detalle de distribución, revise los datos del artículo");
    }
}

function limpiar(){
    $("#cantidad").val("");
    $("#precio").val("");
    $("#stock").val("");
}

function evaluar(){
    if (total > 0){ $("#guardar").show(); }
    else{ $("#guardar").hide(); }
}

function eliminar(index){
    total = total - subtotal[index]; 
    $("#total").html("S/ " + total);   
    $("#fila" + index).remove();
    evaluar();
}