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
if  ($_SESSION['compras']==1)
{
?>


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <h2 class="box-title">Permisos <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Agregar</button>
                        
                        </h2>
                     <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped">
                                   <thead>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Número</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Número</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    </tfoot>
                        </table>
                    </div>

                         <div class="panel-body" style="height: 400px;" id="formularioregistro">
                                <form name="formaulario" id="formaulario" method="post">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Nombre(*):</label>
                                        <input type="hidden" name="idpersona" id="idpersona">
                                        <input type="hidden" name="tipo_persona" id="tipo_persona" value="Proveedor">
                                        <input type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del Proveedor" class="form-control" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Tipo Documento:</label>
                                        <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento">
                                            <option value="DNI">DNI</option>
                                            <option value="RUC">RUC</option>
                                            <option value="CEDULA">CEDULA</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Número Documento:</label>
                                        <input type="text" name="num_documento" id="num_documento" maxlength="20" placeholder="Documento" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Dirección:</label>
                                        <input type="text" name="direccion" id="direccion" maxlength="70" placeholder="Dirección" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Teléfono:</label>
                                        <input type="text" name="telefono" id="telefono" maxlength="70" placeholder="Teléfono" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Email:</label>
                                        <input type="email" name="email" id="email" maxlength="50" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
                                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"> Cancelar</i></button>
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
<script src="scripts/proveedor.js"></script>

    <?php
}
ob_end_flush();