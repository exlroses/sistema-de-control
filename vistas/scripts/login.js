$("#frmacceso").on('submit', function (e)
{
    e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();

    $.post("../ajax/usuario.php?op=verificar",
        {"logina":logina, "clavea":clavea},

        function (data) {
            if (data!="null")
            {
                //alert("logeo exitoso");
                //bootbox.alert("Usuario y/o Password son incorrectos");
                $(location).attr("href","Escritorio.php");
            }else
            {
                bootbox.alert("Usuario y/o Password son incorrectos");
            }
        });
})