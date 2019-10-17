var tabla;
// funcion que se ejecuta al inicio
function init() {

    mostrarform(false);
    listar();

    $("#formaulario").on("submit", function (e) {
        guardaryeditar(e);
    })
}
//funcion limpiar
function limpiar() {

    $("#nombre").val("");
    $("#num_documento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#idpersona").val("");
}
//funcion mostarr formulario
function mostrarform(flag) {
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistro").show();
        $("#btnGuardar").prop('disabled',false);
        $("#btnAgregar").hide();

    }else
    {
        $("#listadoregistros").show();
        $("#formularioregistro").hide();
        $("#btnAgregar").show();
    }
}
// funcion ancelarform
function cancelarform() {

    limpiar();
    mostrarform(false);
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
                    url: '../ajax/persona.php?op=listarC',
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

// funcion para guardar y editar

function guardaryeditar(e)
{
    e.preventDefault(); // NO se activara la accion predeterminada del evento
    $("#btnGuardar").prop("disabled", true)
    var formData = new FormData($("#formaulario")[0]);

    $.ajax({

        url : '../ajax/persona.php?op=guardaryeditar',
        type: "POST",
        data : formData,
        contentType : false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();

        }
    });
    limpiar();
}

function mostrar(idpersona) {

    $.post("../ajax/persona.php?op=mostrar",{idpersona: idpersona}, function (data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        $("#nombre").val(data.nombre);
        $("#tipo_documento").val(data.tipo_documento);
        $("#tipo_documento").selectpicker('refresh');
        $("#num_documento").val(data.num_documento);
        $("#direccion").val(data.direccion);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#idpersona").val(data.idpersona);
    })
}

function eliminar(idpersona) {
    bootbox.confirm("Estas seguro de eliminar el Cliente?", function (result) {
        if (result)
        {
            $.post("../ajax/persona.php?op=eliminar", {idpersona: idpersona}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            })
        }
    })
}

init();