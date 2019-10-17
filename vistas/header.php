<?php

if (strlen(session_id())<1 )

    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Sistema  | Control </title>

    <!-- Bootstrap -->
    <link href="../public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../public/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->

    <!-- Custom Theme Style -->
    <link href="../public/build/css/custom.min.css" rel="stylesheet">


    <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-shopping-cart"></i> <span>Sistema!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../files/usuarios/<?php echo $_SESSION['imagen'] ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo $_SESSION['nombre'] ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                 <?php
                if ($_SESSION["escritorio"]==1)
                {
                    echo '
                  <li><a href="escritorio.php"><i class="fa fa-line-chart"></i> Escritorio </span></a> </li>

                  ';
                }
                ?>

                  <?php
                if ($_SESSION["almacen"]==1)
                {
                    echo '
                  <li><a><i class="fa fa-edit"></i> Almacén <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="articulo.php">Artículos</a></li>
                      <li><a href="categoria.php">Categorías</a></li>
                  
                    </ul>
                  </li>
                ';
                }
                ?>
                <?php
                if ($_SESSION["compras"]==1)
                {
                    echo '
                  <li><a><i class="fa fa-shopping-cart"></i> Compras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ingreso.php">Nuevo Ingresos</a></li>
                      <li><a href="proveedor.php">Proveedores</a></li>
                      
                    </ul>
                  </li>
                  ';
                }
                ?>
                <?php
                if ($_SESSION["ventas"]==1)
                {
                    echo '
                  <li><a><i class="fa fa-credit-card"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="venta.php">Nueva Venta</a></li>
                      <li><a href="cliente.php">Clientes</a></li>
                    </ul>
                  </li>
                   ';
                }
                ?>
                <?php
                if ($_SESSION["acceso"]==1)
                {
                    echo '

                  <li><a><i class="fa fa-user"></i> Acceso <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="usuario.php"> Usuarios</a></li>
                      <li><a href="permiso.php">Permisos</a></li>
    
                    </ul>
                  </li>
                  ';
                }
                ?>
                <?php
                if ($_SESSION["consultac"]==1)
                {
                    echo '
                  <li><a><i class="fa fa-table"></i>Consulta Compras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="comprasfecha.php">Consulta Compras</a></li>
                    </ul>
                  </li>
                  ';
                }
                ?>
                <?php
                if ($_SESSION["consultav"]==1)
                {
                    echo '
                  <li><a><i class="fa fa-table"></i>Consulta Ventas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ventasfechacliente.php">Consulta Ventas</a></li>
                    </ul>
                  </li>
                    ';
                }
                ?>

                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Salir" href="../ajax/usuario.php?op=salir">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

         <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagen'] ?>" alt=""><?php echo $_SESSION['nombre'] ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                   
                    <li><a href="javascript:;">Ayuda</a></li>
                    <li><a href="../ajax/usuario.php?op=salir"><i class="fa fa-sign-out pull-right"></i> Cerrar</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  
                  
                </li>
              </ul>
            </nav>
          </div>
        </div>