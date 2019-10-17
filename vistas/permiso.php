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
    if  ($_SESSION['acceso']==1)
    {
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <h2 class="box-title">Permiso <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Agregar</button>
                        
                        </h2>
                     <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped">
                                   <thead>
                                  <th>Nombre</th>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                  <tfoot>
                                  <th>Nombre</th>
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
<script src="scripts/permiso.js"></script>


<?php
}
ob_end_flush();