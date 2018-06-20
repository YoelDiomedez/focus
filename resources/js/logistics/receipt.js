$(document).ready(function() {

    $('#new-receipt').tooltip({
        title: 'Comprobante'
    });

   $('#receiptDataTable').DataTable( {
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
            exportOptions: { columns: [ 0, 1]},
            text: '<i class="icon-printer"></i>',
            titleAttr: 'Imprimir',
            title: 'Lista de comprobantes de pago'
        }, {
            extend: "pdf",
            className: "btn red-sunglo",
            exportOptions: { columns: [ 0, 1]},
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            title: 'Lista de comprobantes de pago'
        }, {
            extend: "excel",
            className: "btn green-meadow",
            exportOptions: { columns: [ 0, 1]},
            text: '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            title: 'Lista de comprobantes de pago'
        },{
            extend: "colvis",
            className: "btn grey-cascade",
            text: '<i class="fa fa-th-list"></i>'
        }],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    });
});