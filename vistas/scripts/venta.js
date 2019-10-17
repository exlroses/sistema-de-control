var tabla;
// funcion que se ejecuta al inicio
function init() {

    mostrarform(false);
    listar();

    $("#formaulario").on("submit", function (e) {
        guardaryeditar(e);
    });
    //Cargamos los Items al select proveedor
    $.post("../ajax/venta.php?op=selectCliente", function (r) {
        $("#idcliente").html(r);
        
    });

}
//funcion limpiar
function limpiar() {

    $("#idcliente").val("");
    $("#cliente").val("");
    $("#serie_comprobante").val("");
    $("#num_comprobante").val("");
    //$("#fecha_hora").val("");
    $("#impuesto").val("0");

    $("#total_compra").val("");
    $(".filas").remove();
    $("#total").html("0");

    // Obtenemos la fecha actual
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth()+1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day);
    $("#fecha_hora").val(today);

    // Marcamos elprimer tipo_documento
    $("#tipo_comprobante").val("Boleta");
    
}
//funcion mostarr formulario
function mostrarform(flag) {
    limpiar();
    if (flag)
    {

        $("#listadoregistros").hide();
        $("#formularioregistro").show();
        //$("#btnGuardar").prop('disabled',false);
        $("#btnAgregar").hide();
        listarArticulos();

        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        detalles=0;
        $("#btnAgregarArt").show();

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
                    url: '../ajax/venta.php?op=listar',
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

// Funcion listar articlo
function listarArticulos()
{
    tabla=$("#tblarticulos").dataTable(
        {
            "aProcessing": true, //Activamos el procedimiento del data tables
            "aServerSide": true, //Paginacion y filtrado que realizamos por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons:[

            ],

            "ajax":
                {
                    url: '../ajax/venta.php?op=listarArticulosVenta',
                    type : 'get',
                    dataType : "json",
                    error: function (e) {
                        console.log(e.responseText);

                    }
                },
            "bDestroy": true,
            "iDisplayLength": 4 , // paginacion
            "order":[[0,"desc"]] // ordenar (columna orden)
        }
    ).DataTable();

}

// funcion para guardar y editar

function guardaryeditar(e)
{
    e.preventDefault(); // NO se activara la accion predeterminada del evento
    //$("#btnGuardar").prop("disabled", true)
    var formData = new FormData($("#formaulario")[0]);

    $.ajax({

        url : '../ajax/venta.php?op=guardaryeditar',
        type: "POST",
        data : formData,
        contentType : false,
        processData: false,

        success: function (datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            listar();

        }
    });
    limpiar();
}

function mostrar(idventa) {

    $.post("../ajax/venta.php?op=mostrar",{idventa: idventa}, function (data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        $("#idcliente").val(data.idcliente);
        
        $("#tipo_comprobante").val(data.tipo_comprobante);
        
        $("#serie_comprobante").val(data.serie_comprobante);
        $("#num_comprobante").val(data.num_comprobante);
        $("#fecha_hora").val(data.fecha);
        $("#impuesto").val(data.impuesto);
        $("#idventa").val(data.idventa);

        //Ocultar y mostrar los botones

        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        $("#btnAgregarArt").hide();
    });

    $.post("../ajax/venta.php?op=listarDetalle&id="+idventa, function (r) {
        $("#detalles").html(r);
    });
}

function anular(idventa) {
    bootbox.confirm("Estas seguro de anular la venta?", function (result) {
        if (result)
        {
            $.post("../ajax/venta.php?op=anular", {idventa: idventa}, function (e) {
                bootbox.alert(e);
                //tabla.ajax.reload();
                listar();
            })
        }
    })
}

//Declaracion de variables necesarias para trabajar con las compras y sus detalles

var impuesto = 18;
var cont = 0;
var detalles = 0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
{
    var tipo_comprobante= $("#tipo_comprobante option:selected").text();

    if (tipo_comprobante == 'Factura')
    {
        $("#impuesto").val(impuesto);
       
    }else
    {
        $("#impuesto").val("0");
    }
}

function agregarDetalle(idarticulo,articulo,precio_venta)
{
    var cantidad = 1;
    var descuento = 0;

    if (idarticulo !=="")
    {
        var subtotal = cantidad * precio_venta;
        var fila='<tr class="filas" id="fila'+cont+'">' +
            '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>' +
            '<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>' +
            '<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>' +
            '<td><input type="number" name="precio_venta[]" id="precio_venta[]" value="'+precio_venta+'"></td>' +
            '<td><input type="number" name="descuento[]" id="descuento[]" value="'+descuento+'"></td>' +
            '<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>' +
            '<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
            '</tr>';

        cont++;
        detalles=detalles+1;
        $("#detalles").append(fila);
        modificarSubtotales();

    }else
    {
        alert("Error al ingresar el detalle, revisar los datos del Artículo");
    }
}

function modificarSubtotales()
{
    var cant = document.getElementsByName("cantidad[]");
    var prev = document.getElementsByName("precio_venta[]");
    var desc = document.getElementsByName("descuento[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i<cant.length; i++)
    {
        var inpC=cant[i];
        var inpV=prev[i];
        var inpD=desc[i];
        var inpS=sub[i];

        inpS.value=(inpC.value * inpV.value)-inpD.value;
        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;

        calcularTotales();
    }



    var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_venta[]");
    var desc = document.getElementsByName("descuento[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i <cant.length; i++) {
        var inpC=cant[i];
        var inpP=prec[i];
        var inpD=desc[i];
        var inpS=sub[i];

        inpS.value=(inpC.value * inpP.value)-inpD.value;
        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();

}

function calcularTotales()
{
    var sub = document.getElementsByName("subtotal");
    var total = 0.0;

    for (var i=0; i<sub.length; i++)
    {
        total += document.getElementsByName("subtotal")[i].value;
    }

    $("#total").html("S/. "+total);
    $("#total_venta").val(total);

    evaluar();
}

function evaluar()
{
    if (detalles>0)
    {
        $("#btnGuardar").show();
    }else
    {
        $("#btnGuardar").hide();
        cont=0;
    }
}

function eliminarDetalle(indice)
{
    $("#fila" + indice).remove();
    calcularTotales();
    detalles = detalles-1;
    evaluar();
}

init();