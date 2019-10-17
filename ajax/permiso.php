<?php

require_once '../modelos/Permiso.php';

$permiso = new Permiso();

switch ($_GET['op'])
{
    case 'listar':
        $rspta = $permiso->listar();
        $data = array();
        while ($reg = $rspta->fetch_object())
        {
            $data[]= array(

                "0"=> $reg->nombre,
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