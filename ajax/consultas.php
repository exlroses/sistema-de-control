<?php

require_once '../modelos/Consultas.php';

$consulta = new Consultas();

switch ($_GET['op'])
{

    case 'comprasFecha':

        $fecha_inicio = $_REQUEST["fecha_inicio"];
        $fecha_fin = $_REQUEST["fecha_fin"];
        $rspta = $consulta->comprasFecha($fecha_inicio, $fecha_fin);
        $data = array();
        while ($reg = $rspta->fetch_object())
        {
            $data[]= array(
                "0"=> $reg->fecha,
                "1"=> $reg->usuario,
                "2"=> $reg->proveedor,
                "3"=> $reg->tipo_comprobante,
                "4"=> $reg->serie_comprobante.' '. $reg->num_comprobante,
                "5"=> $reg->total_compra,
                "6"=> $reg->impuesto,
                "7"=> ($reg->estado=='Aceptado')? '<span class="label bg-green">Aceptado</span>' :'<span class="label bg-red">Anulado</span>',
            );
        }
        $result = array(
            "seEcho"=>1, //Informacion para el data tables
            "iTotalRecords" =>count($data), //enviamos el total de registros al tadatables
            "iTotalDisplayRecords" =>count($data), // enviamos el total registro a visualizar
            "aaData" => $data);
        echo json_encode($result);
        break;
    case 'ventasFechaCliente':

        $fecha_inicio = $_REQUEST["fecha_inicio"];
        $fecha_fin = $_REQUEST["fecha_fin"];
        $idcliente = $_REQUEST["idcliente"];
        $rspta = $consulta->ventaFechaCliente($fecha_inicio, $fecha_fin, $idcliente);
        $data = array();
        while ($reg = $rspta->fetch_object())
        {
            $data[]= array(
                "0"=> $reg->fecha,
                "1"=> $reg->usuario,
                "2"=> $reg->cliente,
                "3"=> $reg->tipo_comprobante,
                "4"=> $reg->serie_comprobante.' '. $reg->num_comprobante,
                "5"=> $reg->total_venta,
                "6"=> $reg->impuesto,
                "7"=> ($reg->estado=='Aceptado')? '<span class="label bg-green">Aceptado</span>' :'<span class="label bg-red">Anulado</span>',
            );
        }
        $result = array(
            "seEcho"=>1, //Informacion para el data tables
            "iTotalRecords" =>count($data), //enviamos el total de registros al tadatables
            "iTotalDisplayRecords" =>count($data), // enviamos el total registro a visualizar
            "aaData" => $data);
        echo json_encode($result);
        break;
}