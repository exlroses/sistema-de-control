<?php

require_once '../config/Conexion.php';

class Usuario
{
    //metodo para hacer un constructor
    public function __construct()
    {
    }
   //Implementamos un método para insertar registros
    public function ingresar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos)
    {
        $sql="INSERT INTO usuario (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,login,clave,imagen,condicion)
        VALUES ('$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$login','$clave','$imagen','1')";
        //return ejecutarConsulta($sql);
        $idusuarionew=ejecutarConsulta_retornaID($sql);

        $num_elementos=0;
        $sw=true;

        while ($num_elementos < count($permisos))
        {
            $sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos=$num_elementos + 1;
        }

        return $sw;
    }
    public function editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos)
    {
        $sql = "UPDATE usuario SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen'
                WHERE idusuario='$idusuario'";
        ejecutarConsulta($sql);

        //Eliminando todos los permisos asinados para volver a rgistrar
        $sqldel = "DELETE FROM usuario_permiso WHERE idusuario = '$idusuario'";
        ejecutarConsulta($sqldel);

        $num_elementos = 0;
        $sw = true;

        while ($num_elementos< count($permisos))
        {
            $sql_detalle = "INSERT INTO usuario_permiso(idusuario,idpermiso) VALUES('$idusuario','$permisos[$num_elementos]')";

            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos = $num_elementos +1;
        }

        return $sw;
    }
    public function desactivar($idusuario)
    {
        $sql = "UPDATE usuario SET condicion='0'
                WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
    public function activar($idusuario)
    {
        $sql = "UPDATE usuario SET condicion='1'
                WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
    public function mostrar($idusuario)
    {
        $sql = "SELECT * FROM usuario
                WHERE idusuario='$idusuario'";
        return ejecutarConsultasSimpleFila($sql);
    }
    public function listar()
    {
        $sql = "SELECT * FROM usuario";
        return ejecutarConsulta($sql);
    }
    //Meodo para listar los usuarios marcados
    public function listarMarcados($idusuario)
    {
        $sql = "SELECT * FROM usuario_permiso WHERE idusuario ='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //funcion para  verificar el acceso al sistema
    public function verificar($login,$clave)
    {
        $sql = "SELECT idusuario,nombre,tipo_documento,num_documento,telefono,email,cargo,imagen,login
                FROM usuario 
                WHERE login = '$login' AND clave = '$clave' AND condicion = '1'";

        return ejecutarConsulta($sql);
    }
}