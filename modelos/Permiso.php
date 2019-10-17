<?php

require_once '../config/Conexion.php';

class Permiso
{
    //metodo para hacer un constructor
    public function __construct()
    {
    }


    public function listar()
    {
        $sql = "SELECT * FROM permiso";
        return ejecutarConsulta($sql);
    }

}