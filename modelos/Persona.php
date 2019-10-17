<?php

require_once '../config/Conexion.php';
class Persona
{

    //metodo para hacer un constructor
    public function __construct()
    {
    }

    //metodo para ingresar datos
    public function ingresar($tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email)
    {
        $sql = "INSERT INTO persona (tipo_persona,nombre,tipo_documento,num_documento,direccion,telefono,email)
                VALUES ('$tipo_persona','$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email')";
        return ejecutarConsulta($sql);
    }

    public function editar($idpersona,$tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email)
    {
        $sql = "UPDATE persona SET tipo_persona='$tipo_persona',nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email'
                WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }

    public function eliminar($idpersona)
    {
        $sql = "DELETE FROM persona
                WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idpersona)
    {
        $sql = "SELECT * FROM persona
                WHERE idpersona='$idpersona'";
        return ejecutarConsultasSimpleFila($sql);
    }

    public function listarP()
    {
        $sql = "SELECT * FROM persona
                WHERE tipo_persona = 'Proveedor'";
        return ejecutarConsulta($sql);
    }

    public function listarC()
    {
        $sql = "SELECT * FROM persona
                WHERE tipo_persona = 'Cliente'";
        return ejecutarConsulta($sql);
    }

}