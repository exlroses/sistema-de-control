<?php

require_once '../config/Conexion.php';

// consulta de fechas y consulta de tabla de estadisias de escritorio

class Consultas
{
    //metodo para hacer un constructor
    public function __construct()
    {
    }
    //metodo para ingresar datos
    public function comprasFecha($fecha_inicio,$fecha_fin)
    {
        $sql = "SELECT DATE(i.fecha_hora) AS fecha,u.nombre AS usuario, p.nombre AS proveedor, i.tipo_comprobante,i.serie_comprobante,
                i.num_comprobante,i.total_compra,i.impuesto,i.estado
                FROM ingreso i JOIN persona p ON i.idproveedor = p.idpersona
                JOIN usuario u ON i.idusuario = u.idusuario
                WHERE DATE(i.fecha_hora)>='$fecha_inicio' AND DATE(i.fecha_hora)<='$fecha_fin'";
        return ejecutarConsulta($sql);
    }

    public function ventaFechaCliente($fecha_inicio,$fecha_fin,$idcliente)
    {
        $sql = "SELECT DATE(v.fecha_hora) AS fecha,u.nombre AS usuario, p.nombre AS cliente, v.tipo_comprobante,v.serie_comprobante,
                v.num_comprobante,v.total_venta,v.impuesto,v.estado
                FROM venta v JOIN persona p ON v.idcliente = p.idpersona
                JOIN usuario u ON v.idusuario = u.idusuario
                WHERE DATE(v.fecha_hora)>='$fecha_inicio' AND DATE(v.fecha_hora)<='$fecha_fin'
                AND v.idcliente = '$idcliente'";
        return ejecutarConsulta($sql);
    }

    public function totalCompraHoy()
    {
        $sql =" SELECT IFNULL(SUM(total_compra),0) AS total_compra
                FROM ingreso
                WHERE DATE(fecha_hora)=curdate()";
        return ejecutarConsulta($sql);
    }
    public function totalVentaHoy()
    {
        $sql =" SELECT IFNULL(SUM(total_venta),0) AS total_venta
                FROM venta
                WHERE DATE(fecha_hora)=curdate()";
        return ejecutarConsulta($sql);
    }

    // Metodo para las tablas estadisticos

    public function comprasUltimos_10dias()
    {
        $sql = "SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) AS fecha, SUM(total_compra) AS total
                FROM ingreso GROUP BY fecha_hora ORDER BY fecha_hora DESC LIMIT 0,10";

        return ejecutarConsulta($sql);
    }
    public function ventasUltimos_12meses()
    {
        $sql = "SELECT DATE_FORMAT(fecha_hora, '%M') AS fecha, SUM(total_venta) AS total
                FROM venta GROUP BY MONTH(fecha_hora) ORDER BY fecha_hora DESC LIMIT 0,10";

        return ejecutarConsulta($sql);
    }
}