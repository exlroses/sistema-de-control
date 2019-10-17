<?php

require_once '../config/Conexion.php';

class Ingreso
{
    //metodo para hacer un constructor
    public function __construct()
    {
    }
    //metodo para ingresar datos
    public function ingresar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$idarticulo,$cantidad,$precio_compra,$precio_venta)
    {
        $sql = "INSERT INTO ingreso(idproveedor,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado)
                VALUES ('$idproveedor','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_compra','Aceptado')";
        //return ejecutarConsulta($sql);

        $idingresonew= ejecutarConsulta_retornaID($sql);

        $num_elementos = 0;
        $sw = true;

        while ($num_elementos< count($idarticulo))
        {
            $sql_detalle = "INSERT INTO detalle_ingreso(idingreso,idarticulo,cantidad,precio_compra,precio_venta)
                            VALUES ('$idingresonew','$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]',$precio_venta[$num_elementos])";

            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos = $num_elementos +1;
        }

        return $sw;
    }

    public function anular($idingreso)
    {
        $sql = "UPDATE ingreso SET estado='Anulado'
                WHERE idingreso='$idingreso'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idingreso)
    {
        $sql = "SELECT i.idingreso,DATE(i.fecha_hora) AS fecha,i.idproveedor,p.nombre AS proveedor, u.idusuario,u.nombre AS usuario,
                i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado 
                FROM ingreso i JOIN persona p
                ON i.idproveedor = p.idpersona
                JOIN usuario u
                ON i.idusuario = u.idusuario
                WHERE i.idingreso='$idingreso'";
        return ejecutarConsultasSimpleFila($sql);
    }
    public function listar()
    {
        $sql = "SELECT i.idingreso,DATE(i.fecha_hora) AS fecha,i.idproveedor,p.nombre AS proveedor, u.idusuario,u.nombre AS usuario,
                i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado 
                FROM ingreso i JOIN persona p
                ON i.idproveedor = p.idpersona
                JOIN usuario u
                ON i.idusuario = u.idusuario
                ORDER BY i.idingreso DESC ";
        return ejecutarConsulta($sql);
    }

    public function listarDetalles($idingreso)
    {
        $sql = "SELECT di.idingreso,di.idarticulo,a.nombre,di.cantidad,di.precio_compra,di.precio_venta 
                FROM  detalle_ingreso di JOIN articulo a 
                ON di.idarticulo = a.idarticulo
                WHERE di.idingreso = '$idingreso'";

        return ejecutarConsulta($sql);
    }
}