var tabla;
// funcion que se ejecuta al inicio
function init() {

    mostrarform(false);
    listar();

    $("#formaulario").on("submit", function (e) {
        guardaryeditar(e);
    })

    //Cargamos los items al select categoria
    $.post("../ajax/articulo.php?op=selectCategoria", function (r) {
       $("#idcategoria").html(r);
       $("#idcategoria").val("");
    });

    $("#imagenMuestra").hide();
}
//funcion limpiar
function limpiar() {

    $("#codigo").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#stock").val("");
    $("#imagenMuestra").attr("src","");
    $("#imagenActual").val("");
    $("#print").hide();
    $("#idarticulo").val("");
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
                    url: '../ajax/articulo.php?op=listar',
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

        url : '../ajax/articulo.php?op=guardaryeditar',
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

function mostrar(idarticulo) {

    $.post("../ajax/articulo.php?op=mostrar",{idarticulo: idarticulo}, function (data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        $("#idcategoria").val(data.idcategoria);
       
        $("#codigo").val(data.codigo);
        $("#nombre").val(data.nombre);
        $("#stock").val(data.stock);
        $("#descripcion").val(data.descripcion);
        $("#imagenMuestra").show();
        $("#imagenMuestra").attr("src","../files/articulos/"+data.imagen);
        $("#imagenActual").val(data.imagen);
        $("#idarticulo").val(data.idarticulo);
        generarbarcode();
    })
}

function desactivar(idarticulo) {
    bootbox.confirm("Estas seguro de desactivar la Artículo?", function (result) {
        if (result)
        {
            $.post("../ajax/articulo.php?op=desactivar", {idarticulo: idarticulo}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            })
        }
    })
}
function activar(idarticulo) {
    bootbox.confirm("Estas seguro de activar la Artículo?", function (result) {
        if (result)
        {
            $.post("../ajax/articulo.php?op=activar", {idarticulo: idarticulo}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            })
        }
    })
}

function generarbarcode() {

    codigo = $("#codigo").val();
    JsBarcode("#barcode",codigo);
    $("#print").show();
}
function imprimir() {
    $("#print").printArea();
}
init();