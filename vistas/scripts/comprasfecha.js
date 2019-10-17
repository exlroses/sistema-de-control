var tabla;
// funcion que se ejecuta al inicio
function init() {
    listar();

    // manipula las fecha para que se actualien

    $("#fecha_inicio").change(listar);
    $("#fecha_fin").change(listar);
}
//funcion listar
function listar()
{
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    tabla=$("#tbllistado").dataTable(
        {
            "aProcessing": true, //Activamos el procedimiento del data tables
            "aServerSide": true, //Paginacion y filtrado que realizamos por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons:[
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf',
            ],

            "ajax":
                {
                    url: '../ajax/consultas.php?op=comprasFecha',
                    data: {fecha_inicio: fecha_inicio, fecha_fin: fecha_fin},
                    type : 'get',
                    dataType : "json",
                    error: function (e) {
                        console.log(e.responseText);

                    }
                },
            "bDestroy": true,
            "iDisplayLength": 5 , // paginacion
            "order":[[0,"desc"]] // ordenar (columna orden)
        }
    ).DataTable();

// funcion para guardar y editar

}
init();