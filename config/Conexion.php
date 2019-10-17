<?php

require_once 'global.php';

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query($conexion,'SET NAMES"'.DB_ENCODE.'"');

// validaos si hay error en la conexion
if (mysqli_connect_error())
{
    print ("error en la conexion de la DB %s\n".mysqli_connect_error());
}
if (!function_exists('ejecutarConsulta'))
{
    function ejecutarConsulta($sql)
    {
        global $conexion;
        $query = $conexion->query($sql);
        
        return $query;
    }
    function ejecutarConsultasSimpleFila($sql)
    {
        global $conexion;
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }
    function ejecutarConsulta_retornaID($sql)
    {
        global $conexion;
        $query = $conexion->query($sql);
        return $conexion->insert_id;
    }
    function limpiarCadena($str)
    {
        global $conexion;
        $str= mysqli_real_escape_string($conexion, trim($str));
        return $str;
    }
}