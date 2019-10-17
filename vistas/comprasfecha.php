<?php

// Activar el almacenamiento del  BUFFER

ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
    header("location: login.html");
}
else
    {
    require 'header.php';
    if  ($_SESSION['consultac']==1)
    {
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <h2 class="box-title">Consulta de Compras por Fecha </h2>
                     <div class="panel-body table-responsive" id="listadoregistros">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                    <label for="">Fecha Inicio</label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                                    <label for="">Fecha Fin</label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                        <table id="tbllistado" class="table table-striped">
                                   <thead>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Proveedor</th>
                                    <th>Comprobante</th>
                                    <th>Número</th>
                                    <th>Total Compra</th>
                                    <th>Impuesto</th>
                                    <th>Estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Proveedor</th>
                                    <th>Comprobante</th>
                                    <th>Número</th>
                                    <th>Total Compra</th>
                                    <th>Impuesto</th>
                                    <th>Estado</th>
                                    </tfoot>
                        </table>
                    </div>
                </div>
              </div>
            </div>


          </div>
        </div>
        <!-- /page content -->

 <?php
    }
    else
    {
        require 'noacceso.php';
    }
    require 'footer.php';
    ?>
    <script src="scripts/comprasfecha.js"></script>

    <?php
}
ob_end_flush();
