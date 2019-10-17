<?php

require_once '../modelos/Categoria.php';

$categoria = new Categoria();

$idcategoria = isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET['op'])
{
    case 'guardaryeditar':
        if (empty($idcategoria))
        {
            $rspta = $categoria->ingresar($nombre,$descripcion);
            echo $rspta?"se ha ingresado datos": "error al ingresar datos";
        }else
        {
            $rspta = $categoria->editar($idcategoria,$nombre,$descripcion);
            echo $rspta?"se ha actualizado": "error al actualizar";
        }
        break;
    case 'desactivar':
        $rspta = $categoria->desactivar($idcategoria);
        echo $rspta?"se ha desactivado":"error al desactivar";
        break;
    case'activar':
        $rspta = $categoria->activar($idcategoria);
        echo $rspta?"se ha activado":"error al activar";
        break;
    case 'mostrar':
        $rspta = $categoria->mostrar($idcategoria);
        echo json_encode($rspta);
        break;
    case 'listar':
        $rspta = $categoria->listar();
        $data = array();
        while ($reg = $rspta->fetch_object())
        {
            $data[]= array(
                "0"=> ($reg->condicion)?
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
                "1"=> $reg->nombre,
                "2"=> $reg->descripcion,
                "3"=> ($reg->condicion)? '<span class="label bg-green">Activado</span>' :'<span class="label bg-red">Desactivado</span>',
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