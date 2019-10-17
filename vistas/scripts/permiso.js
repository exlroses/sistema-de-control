var tabla;
// funcion que se ejecuta al inicio
function init() {

    mostrarform(false);
    listar();
}

//funcion mostarr formulario
function mostrarform(flag) {

    if (flag)
    {

        $("#formularioregistro").show();
        $("#btnGuardar").prop('disabled',false);
        $("#btnAgregar").hide();

    }else
    {
        $("#formularioregistro").hide();
        $("#btnAgregar").hide();
    }
}
//funcion listar
function listar()
{
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
                    url: '../ajax/permiso.php?op=listar',
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
}


init();