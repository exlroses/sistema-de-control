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
    if  ($_SESSION['almacen']==1)
    {
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <h2 class="box-title">Categoria <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Agregar</button>
                        
                        </h2>
                     <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped">
                                   <thead>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    </tfoot>
                        </table>
                    </div>

                         <div class="panel-body" style="height: 400px;" id="formularioregistro">
                                <form name="formaulario" id="formaulario" method="post"  class="form-horizontal form-label-left">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Nombre:<span class="required">*</span></label>
                                        <input type="hidden" name="idcategoria" id="idcategoria">
                                        <input type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre"
                                               class="form-control" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">descripcion:</label>
                                        <input type="text" name="descripcion" id="descripcion" maxlength="256"
                                               class="form-control" placeholder="Descripción" required>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i
                                                    class="fa fa-save">
                                                Guardar</i></button>
                                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i
                                                    class="fa fa-arrow-circle-left"> Cancelar</i></button>
                                    </div>
                                </form>
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
    <script src="scripts/categoria.js"></script>

    <?php
}
ob_end_flush();
