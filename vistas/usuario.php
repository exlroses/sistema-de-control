    <?php require "header.php" ?>


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <h2 class="box-title">Usuario <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)">
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
                                  <th>Login</th>
                                  <th>Foto</th>
                                  <th>Estado</th>
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
                                  <th>Login</th>
                                  <th>Foto</th>
                                  <th>Estado</th>
                                  </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" id="formularioregistro">
                        <form name="formaulario" id="formaulario" method="post">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="">Nombre(*):</label>
                                <input type="hidden" name="idusuario" id="idusuario">
                                <input type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Tipo Documento(*):</label>
                                <select class="form-control selectpicker" name="tipo_documento" id="tipo_documento" required>
                                    <option value="DNI">DNI</option>
                                    <option value="RUC">RUC</option>
                                    <option value="CEDULA">CEDULA</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Número(*):</label>
                                <input type="text" class="form-control" name="num_documento" id="num_documento" maxlength="20" placeholder="Documento" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Dirección:</label>
                                <input type="text" name="direccion" id="direccion" maxlength="70" placeholder="Dirección" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Teléfono:</label>
                                <input type="text" name="telefono" id="telefono" maxlength="70" class="form-control" placeholder="Teléfono">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Email:</label>
                                <input type="email" name="email" id="email" maxlength="50" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Cargo:</label>
                                <input type="text" name="cargo" id="cargo" maxlength="20" class="form-control" placeholder="Cargo">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Login(*):</label>
                                <input type="text" name="login" id="login" maxlength="20" class="form-control" placeholder="Login" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Clave(*):</label>
                                <input type="password" name="clave" id="clave" maxlength="64" class="form-control" placeholder="Clave" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Permisos:</label>
                               
                                <div id="permisos">
                                 
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="">Imagen:</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                                <br>
                                <input type="hidden" name="imagenActual" id="imagenActual">
                                <img src="" width="150px" height="120px" id="imagenMuestra">
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
require 'footer.php';
?>


<script type="text/javascript" src="scripts/usuario.js"></script>