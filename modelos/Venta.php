<?php

require_once "../config/Conexion.php";

class Venta
{

    //metodo para hacer un constructor
    public function __construct()
    {
    }

    //Implementamos un metodo para insertar registro
    public function ingresar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_venta,$idarticulo,$cantidad,$precio_venta,$descuento)
    {
        $sql="INSERT INTO venta (idcliente,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_venta,estado)
		VALUES ('$idcliente','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_venta','Aceptado')";
        //return ejecutarConsulta($sql);
        $idventanew=ejecutarConsulta_retornaID($sql);

        $num_elementos=0;
        $sw=true;

        while ($num_elementos < count($idarticulo))
        {
            $sql_detalle = "INSERT INTO detalle_venta(idventa, idarticulo,cantidad,precio_venta,descuento) 
                            VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos=$num_elementos + 1;
        }

        return $sw;
    }

    public function anular($idventa)
    {
        $sql = "UPDATE venta SET estado='Anulado'
                WHERE idventa='$idventa'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idventa)
    {
        $sql = "SELECT v.idventa,DATE(v.fecha_hora) AS fecha,v.idcliente,p.nombre AS cliente, u.idusuario,u.nombre AS usuario,
                v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado 
                FROM venta v JOIN persona p
                ON v.idcliente = p.idpersona
                JOIN usuario u
                ON v.idusuario = u.idusuario
                WHERE v.idventa='$idventa'";
        return ejecutarConsultasSimpleFila($sql);
    }
    public function listar()
    {
        $sql = "SELECT v.idventa,DATE(v.fecha_hora) AS fecha,v.idcliente,p.nombre AS cliente, u.idusuario,u.nombre AS usuario,
                v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado 
                FROM venta v JOIN persona p
                ON v.idcliente = p.idpersona
                JOIN usuario u
                ON v.idusuario = u.idusuario
                ORDER BY v.idventa DESC";
        return ejecutarConsulta($sql);
    }

    public function listarDetalles($idventa)
    {
        $sql = "SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,
                (dv.cantidad*dv.precio_venta-dv.descuento) AS subtotal 
                FROM  detalle_venta dv JOIN articulo a 
                ON dv.idarticulo = a.idarticulo
                WHERE dv.idventa = '$idventa'";

        return ejecutarConsulta($sql);
    }

    // IMPLEMENTACION DE LAS FACTURAS

    public function ventaCabecera($idventa)
    {
        $sql = "SELECT v.idventa, v.idcliente, p.nombre AS cliente, p.direccion, p.tipo_documento,p.num_documento,p.email,p.telefono,v.idusuario,
                u.nombre AS usuario, v.tipo_comprobante,v.serie_comprobante,v.num_comprobante, DATE(v.fecha_hora) AS fecha, v.impuesto, v.total_venta 
                FROM venta v JOIN persona p ON v.idcliente= p.idpersona
                JOIN usuario u ON v.idusuario =u.idusuario
                WHERE v.idventa = '$idventa'";

        return ejecutarConsulta($sql);
    }
    public function ventaDetalle($idventa)
    {
        $sql = "SELECT a.nombre AS articulo, a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) AS subtotal
                FROM detalle_venta d JOIN articulo a
                ON d.idarticulo = a.idarticulo
                WHERE d.idventa = '$idventa'";
        return ejecutarConsulta($sql);
    }
}