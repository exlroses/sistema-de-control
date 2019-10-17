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
                  <h2 class="box-title">Ingreso <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Agregar</button>
                        
                        </h2>
                     <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped">
                                   <thead>
                                    <th>Opciones</th>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Usuario</th>
                                    <th>Documento</th>
                                    <th>Número</th>
                                    <th>TotalCompra</th>
                                    <th>estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Opciones</th>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Usuario</th>
                                    <th>Documento</th>
                                    <th>Número</th>
                                    <th>TotalCompra</th>
                                    <th>estado</th>
                                    </tfoot>
                        </table>
                    </div>

                       <div class="panel-body" style="height: 400px;" id="formularioregistro">
                                <form name="formaulario" id="formaulario" method="post">
                                    <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <label for="">Proveedor(*):</label>
                                        <input type="hidden" name="idingreso" id="idingreso">
                                        <select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true" required>

                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label for="">Fecha(*):</label>
                                        <input type="date" name="fecha_hora" id="fecha_hora" class="form-control" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="">Tipo Comprobante(*)</label>
                                        <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required>
                                            <option value="Boleta">Boleta</option>
                                            <option value="Factura">Factura</option>
                                            <option value="Ticket">Ticket</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label>Serie:</label>
                                        <input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie">
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label for="">Número(*):</label>
                                        <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required>
                                    </div>
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <label for="">Impuesto(*):</label>
                                        <input type="text" class="form-control" name="impuesto" id="impuesto" required>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a href="#myModal" data-toggle="modal">
                                            <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Agregar Artículo</button>
                                        </a>
                                    </div>
                                    <div class=form-group table-responsive>
                                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                            <thead style="background-color: #A9D0F5">
                                                <th>Opciones</th>
                                                <th>Artículo</th>
                                                <th>Cantidad</th>
                                                <th>Precio Compra</th>
                                                <th>Precio Venta</th>
                                                <th>Subtotal</th>
                                            </thead>
                                            <tfoot>
                                                <th>TOTAL</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <h4 id="total">S/. 0.00</h4>
                                                    <input type="hidden" name="total_compra" id="total_compra">
                                                </th>
                                            </tfoot>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i
                                                class="fa fa-save">
                                                Guardar</i></button>
                                        <button class="btn btn-danger" onclick="cancelarform()" id="btnCancelar" type="button"><i
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
        <!-- MODAL -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Selecciones un Artículo</h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Código</th>
                                <th>Stock</th>
                                <th>Imagen</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Código</th>
                                <th>Stock</th>
                                <th>Imagen</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FIN MODAL -->

 <?php
    }
    else
    {
        require 'noacceso.php';
    }
    require 'footer.php';
    ?>
    <script src="scripts/ingreso.js"></script>

    <?php
}
ob_end_flush();
