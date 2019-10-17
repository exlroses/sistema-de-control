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
    if  ($_SESSION['escritorio']==1)
    {
        require_once '../modelos/Consultas.php';
        $consulta = new Consultas();
        $rspta = $consulta->totalCompraHoy();
        $regc = $rspta->fetch_object();
        $totalc= $regc->total_compra;

        $rsptav = $consulta->totalVentaHoy();
        $regv = $rsptav->fetch_object();
        $totalv= $regv->total_venta;

        //Datos para mostrar el grafico de barra de las compras
        $compras10 = $consulta->comprasUltimos_10dias();
        $fechasc = '';
        $totalesc = '';

        while ($regFechac = $compras10->fetch_object())
        {
            $fechasc = $fechasc.'"'.$regFechac->fecha.'",';
            $totalesc = $totalesc.$regFechac->total.',';
        }
        // funicion para quitar la última coma
        $fechasc = substr($fechasc, 0, -1);
        $totalesc = substr($totalesc, 0, -1);

        //Datos para mostrar el grafico de barra de las VENTAS
        $ventas12 = $consulta->ventasUltimos_12meses();
        $fechasv = '';
        $totalesv = '';

        while ($regFechav = $ventas12->fetch_object())
        {
            $fechasv = $fechasv.'"'.$regFechav->fecha.'",';
            $totalesv = $totalesv.$regFechav->total.',';
        }
        // funicion para quitar la última coma
        $fechasv = substr($fechasv, 0, -1);
        $totalesv = substr($totalesv, 0, -1);
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  
                            <div class="with-border">
                                <h2 class="title">Escritorio
                                </h2>
                                <div class="pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body">
                                <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
                                    <div class="bg-orange tile-stats"  >
                                        <div style="margin: 0px 15px;">
                                            <div class="inner">
                                                <h4 style="font-size: 17px;">
                                                    <strong> S/ <?php echo $totalc; ?></strong>
                                                </h4>
                                                <p> Compras</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            </div>
                                            <center><a href="ingreso.php" class="small-footer" style="color: #f1e6e9;">Compras
                                            <i class="fa fa-arrow-circle-right"></i></a></center>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">

                                    <div class="bg-green tile-stats">
                                        <dir style="margin: 0px -20px;">
                                            <div class="inner">
                                                <h4 style="font-size: 17px;">
                                                    <strong>S/ <?php echo $totalv; ?></strong>
                                                </h4>
                                                <p>Ventas</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                        </dir>
                                            <center><a href="venta.php" class="small-footer" style="color: #f1e6e9;">Ventas
                                                <i class="fa fa-arrow-circle-right"></i></a></center>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="">
                                        <div class="header with-border">
                                            Compras de los últimos 10 días
                                        </div>
                                        <div class="body">
                                            <canvas id="compras" width="400" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="">
                                        <div class="header with-border">
                                            Ventas de los últimos 12 meses
                                        </div>
                                        <div class="box-body">
                                            <canvas id="ventas" width="400" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Fin centro -->
                      
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
    <script src="../public/js/Chart.min.js"></script>
    <script src="../public/js/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        var ctx = document.getElementById("compras").getContext('2d');
        var compras = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $fechasc; ?>],
                datasets: [{
                    label: '# Compras en S/ de los últimos 10 días',
                    data: [<?php echo $totalesc; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("ventas").getContext('2d');
        var ventas = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $fechasv; ?>],
                datasets: [{
                    label: '# Ventas en S/ de los últimos 12 meses',
                    data: [<?php echo $totalesv; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>

    <?php
}
ob_end_flush();

