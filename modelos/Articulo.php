<?php

require_once "../config/Conexion.php";

class Articulo
{

    //metodo para hacer un constructor
    public function __construct()
    {
    }

    //metodo para ingresar datos
    public function ingresar($idcategoria,$codigo,$nombre,$stock, $descripcion,$imagen)
    {
        $sql = "INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
                VALUES ('$idcategoria','$codigo','$nombre','$stock','$descripcion','$imagen','1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock, $descripcion,$imagen)
    {
        $sql = "UPDATE articulo SET idcategoria='$idcategoria',codigo='$codigo',nombre='$nombre',stock='$stock',descripcion='$descripcion',imagen='$imagen'
                WHERE idarticulo='$idarticulo'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idarticulo)
    {
        $sql = "UPDATE articulo SET condicion='0'
                WHERE idarticulo='$idarticulo'";
        return ejecutarConsulta($sql);
    }

    public function activar($idarticulo)
    {
        $sql = "UPDATE articulo SET condicion='1'
                WHERE idarticulo='$idarticulo'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idarticulo)
    {
        $sql = "SELECT * FROM articulo
                WHERE idarticulo='$idarticulo'";
        return ejecutarConsultasSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT a.idarticulo,a.idcategoria,c.nombre as categoria, a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion 
                FROM articulo a JOIN categoria c 
                ON a.idcategoria = c.idcategoria";
        return ejecutarConsulta($sql);
    }

    //IMPLEMNTAR UN METODO PARA LISTAR LOS REGISTROS ACTIVOS (despues no vamos a ../ajax/ingreso)
    public function listarActivos()
    {
        $sql = "SELECT a.idarticulo,a.idcategoria,c.nombre as categoria, a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion 
                FROM articulo a JOIN categoria c 
                ON a.idcategoria = c.idcategoria
                WHERE a.condicion='1'";
        return ejecutarConsulta($sql);
    }

    //Implementar un metodo para lostar los registros activos, su último precio y el stock()
    // (VAMOS a unir el ultimo registro de la tabla detalle_ingreso)
    public function listarActivosVenta()
    {
        $sql = "SELECT a.idarticulo,a.idcategoria,c.nombre AS categoria,a.codigo,a.nombre,a.stock,
                        (SELECT precio_venta FROM detalle_ingreso WHERE idarticulo = a.idarticulo 
                         ORDER BY iddetalle_ingreso DESC LIMIT 0,1) AS precio_venta,a.descripcion,
                       a.imagen,a.condicion 
                FROM articulo a JOIN categoria c
                ON a.idcategoria=c.idcategoria
                WHERE a.condicion='1'";

        return ejecutarConsulta($sql);
    }
}