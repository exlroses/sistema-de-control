<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1)
    session_start();

if (!isset($_SESSION["nombre"]))
{
    echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
    if ($_SESSION['ventas']==1)
    {
        //INCLUIMOS EL ARCHIVO FACTURA.php
        require ('Factura.php');

        // ESTABLECEMOS LOS DATOS DE LA EMPRESA
        $logo = "logo.jpg";
        $ext_logo = "jpg";
        $empresa = "Soluciones Innovadoras Perú S.A.C.";
        $documento = "204771577772";
        $direccion = "Laureles, Lima 673";
        $telefono = "993620746";
        $email = "Prueba@gmail.com";

        //OBTENEMOS LOS DATOS DE LA CABECERA DE LA VENTA ACTUAL
        require_once "../modelos/Venta.php";
        $venta = new Venta();
        $rsptav = $venta->ventaCabecera($_GET["id"]);
        //RECORREMOS TODOS LOS VALORES OBTENIDOS
        $regv = $rsptav->fetch_object();

        // Establcemos las configuracion de la factura
        $pdf = new PDF_Invoice('P','mm','A4');
        $pdf->AddPage();

        // Enviamos los datos de la empresa al metodo ( addSociete) de la clase Factura
        $pdf->addSociete(
            utf8_decode($empresa),
            $documento."\n".
            utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
            utf8_decode("Teléfono: ").$telefono."\n".
            "Email: ".$email, $logo, $ext_logo
        );

        $pdf->fact_dev(
            "$regv->tipo_comprobante",
            "$regv->serie_comprobante-$regv->num_comprobante"
            );
        $pdf->temporaire("");
        $pdf->addDate($regv->fecha);

        //Enviarmos los datos del cliente al metodo addClientAdresse de la clase factura

        $pdf->addClientAdresse(
            utf8_decode($regv->cliente), "Domicilio: ".
            utf8_decode($regv->direccion), $regv->tipo_documento.": ".
            $regv->num_documento,"Email: ".$regv->email, "Telefono: ".
            $regv->telefono
        );

        //establecemos las columnas que va a tener la seccion  donde mostramoslos detalles de la venta

        $cols = array(
            "CODIGO" => 23,
            "DESCRIPCION" => 78,
            "CANTIDAD" => 22,
            "P.U." => 25,
            "DSCTO" => 20,
            "SUBTOTAL" => 23);
        $pdf->addCols($cols);
        $cols = array(
            "CODIGO" => "L",
            "DESCRIPCION" => "L",
            "CANTIDAD" => "C",
            "P.U." => "R",
            "DSCTO" => "R",
            "SUBTOTAL" => "C");

        $pdf->addLineFormat($cols);
        $pdf->addLineFormat($cols);

        // Actualizamos el valor de la coodenada "Y" , que sera la ubicacion desde donde empezaremos a mostrar os datos

        $y = 89;

        //Obtenemos todos los detalles de la venta Actual
        $rsptad = $venta->ventaDetalle($_GET["id"]);

        while ($regd = $rsptad->fetch_object())
        {
            $line = array(
                "CODIGO"=>"$regd->codigo",
                "DESCRIPCION"=>utf8_decode("$regd->articulo"),
                "CANTIDAD"=>"$regd->cantidad",
                "P.U."=>"$regd->precio_venta",
                "DSCTO"=>"$regd->descuento",
                "SUBTOTAL"=>"$regd->subtotal");

                $size = $pdf->addLine($y, $line);
                $y   +=$size +2 ;
        }
        // COnvertimos el total e Letras
        require_once "Letras.php";
        $V = new EnLetras();
        $con_letra = strtoupper($V->ValorEnLetras($regv->total_venta,"NUEVOS SOLES"));
        $pdf->addCadreTVAs("---".$con_letra);

        //Mostramos el Impuesto

        $pdf->addTVAs($regv->impuesto, $regv->total_venta, "S/ ");
        $pdf->addCadreEurosFrancs("IGV"." $regv->impuesto %");
        $pdf->Output('Reporte de Venta','I');
    }
    else
        {
        echo 'No tiene permiso para visualizar el reporte';
    }

}
ob_end_flush();

