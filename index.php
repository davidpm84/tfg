<!DOCTYPE html>
<?php

include("conexion.php");

$url = $_SERVER["REQUEST_URI"];
$urlArray = explode('=', $url);
$id_cliente = $urlArray[1];
// True because $a is empty
if (empty($id_cliente)) {
 $id_cliente="0";
}


?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Gestor de Vulnerabilidades - TFG UNIR</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php

include("header.html");
include("sidebar.html");
?>

  <main id="main" class="main">


      <select id="empresa" class="form-select" style="width: 200px; float: right;" name="empresa" onchange="this.options[this.selectedIndex].value && (window.location = '?cliente='+ this.options[this.selectedIndex].value);">

<?php
if ($id_cliente=="0") {
  $fila['nombre']="Todos";
} else {
  $sentencia = "select nombre from empresas where id=".$id_cliente; 
  $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla empresas");
  $fila=$consulta->fetch_assoc();
?>
  <option value="0">Todos</option>
<?php
}

?>
<option value="<?php echo $id_cliente; ?>" selected><?php echo $fila['nombre'] ?></option>
<?php




                      $sentencia = "select * from empresas order by id";    
                      $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla empresas");

                      //recorrer la consulta y almacenar en variables
                      while($fila= mysqli_fetch_array($consulta)){
                              $id=$fila['id'];
                              $nombre=$fila['nombre'];
                        if ($id!=$id_cliente) {

                        
                      ?>


                    <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                    <?php
                }
              }
              ?>
                  </select>   


    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>

      </nav>
    </div><!-- End Page Title -->
    

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

   

                <div class="card-body">
                <?php
                if ($id_cliente=="0") {
                ?>
                  <h5 class="card-title">Clientes</h5>
                <?php
                } else {
                ?>
                  <h5 class="card-title">Activos/Vulnerab.</h5>
                <?php
                } 

                if ($id_cliente=="0") {
                  $sentencia = "select * from empresas";    
                  $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión");
                  $filas_empresas = 0;
                  while($fila= mysqli_fetch_array($consulta)){
                    $filas_empresas ++;
                  }
                } else {
                  $sentencia3 = "select * from activos where cliente=".$id_cliente;     
                  $consulta3 = mysqli_query($conexion, $sentencia3) or die("Error de conexión");
                  $filas_activos = 0;
                  while($fila= mysqli_fetch_array($consulta3)){
                    $filas_activos ++;
                  }
                  $sentencia2 = "select * from activos where cliente=".$id_cliente." and vulnerabilidades<>''";     
                  $consulta2 = mysqli_query($conexion, $sentencia2) or die("Error de conexión");
                  $filas_vulnerables = 0;
                  while($fila= mysqli_fetch_array($consulta2)){
                    $filas_vulnerables ++;
                  }
                }
                  //Hacer consulta para obtener empresas


                  ?>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                    if ($id_cliente=="0") {
                    ?>
                      <h6><?php echo $filas_empresas; ?></h6>
                    <?php
                    } else {
                      ?>
                      <h6><?php echo $filas_activos."/".$filas_vulnerables; ?></h6>
                    <?php


                    }
                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">
              <?php
                if ($id_cliente=="0") {
                  $sentencia = "select * from vulnerabilidades";    
                  $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla vulnerabilidades");
                  $filas_vulnerabilidades = 0;
                  //obtener vulnerabilidades
                  while($fila2= mysqli_fetch_array($consulta)){
                      $filas_vulnerabilidades ++;
                  }
                } else {
                  $sentencia3 = "select vulnerabilidades from activos where cliente=".$id_cliente." and vulnerabilidades<>''";     
                  $consulta3 = mysqli_query($conexion, $sentencia3) or die("Error de conexión");
                  $filas_vulnerabilidades = 0;
                  while($fila= mysqli_fetch_array($consulta3)){
                    $vuls=$fila['vulnerabilidades'];
                    $vuls_array = explode(",", $vuls);
                    $result = count($vuls_array)-1;
                    $filas_vulnerabilidades=$filas_vulnerabilidades + $result;
                  }

                }








              ?>

                <div class="card-body">
                  <h5 class="card-title">Vulnerabilidades</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bug"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $filas_vulnerabilidades;?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card revenue-card">

              <?php

                if ($id_cliente=="0") {

                  $sentencia = "select * from informes";    
                  $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión");
                  $filas_informes = 0;
                  //obtener informes
                  while($fila3= mysqli_fetch_array($consulta)){
                      $filas_informes ++;
                  }
                } else {
                  $sentencia3 = "select * from informes where id_cliente=".$id_cliente;     
                  $consulta = mysqli_query($conexion, $sentencia3) or die("Error de conexión");
                  $filas_informes = 0;
                  //obtener informes
                  while($fila3= mysqli_fetch_array($consulta)){
                      $filas_informes ++;
                  }

                }



              ?>

                <div class="card-body">
                  <h5 class="card-title">Informes</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clipboard-data"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $filas_informes; ?></h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">



                <div class="card-body">
                  <h5 class="card-title">Informes <span>/ Última Semana</span></h5>
                  <?php
                if ($id_cliente=="0") {
                  $sentencia = "select * from informes";  
                }
                else {
                  $sentencia = "select * from informes where id_cliente=".$id_cliente;  

                }  
$consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión");
$arrayfechas=[];
$arrayfechas[0]=0;
$arrayfechas[1]=0;
$arrayfechas[2]=0;
$arrayfechas[3]=0;
$arrayfechas[4]=0;
$arrayfechas[5]=0;
$arrayfechas[6]=0;
//recorrer la consulta y guardar los datos 
while($fila4= mysqli_fetch_array($consulta)){
  
  for ($x=0; $x<=6; $x++){
    $dia=date('Y-m-d',strtotime("-$x days"));
    if (strcmp($fila4[5],$dia)==0){
     $arrayfechas[$x]++;
     
    } 
  }
 
 
}


?>





                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Informes',
                          data: [<?php echo $arrayfechas[6]; ?>,<?php echo $arrayfechas[5]; ?>,<?php echo $arrayfechas[4]; ?>,<?php echo $arrayfechas[3]; ?>,<?php echo $arrayfechas[2]; ?>,<?php echo $arrayfechas[1]; ?>,<?php echo $arrayfechas[0]; ?>],
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["<?php echo date('Y-m-d',strtotime("-6 days")); ?>","<?php echo date('Y-m-d',strtotime("-5 days")); ?>", "<?php echo date('Y-m-d',strtotime("-4 days")); ?>" ,"<?php echo date('Y-m-d',strtotime("-3 days")); ?>" ,"<?php echo date('Y-m-d',strtotime("-2 days")); ?>", "<?php echo date('Y-m-d',strtotime("-1 days")); ?>" ,"<?php echo date('Y-m-d'); ?>" ]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

            

                <div class="card-body">
                  <h5 class="card-title">Informes y Vulnerabilidades por Cliente</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Web</th>
                        <th scope="col">Informes</th>
                        <th scope="col">Activos</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                                    if ($id_cliente=="0") {
                                      $sentencia = "select * from empresas order by id";  
                                    } else{
                                      $sentencia = "select * from empresas where id=".$id_cliente;  
                                    }

  
                              $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla clientes");
                      
                              //recorrer la consulta y guardar los datos 
                              while($fila3= mysqli_fetch_array($consulta)){
                                  $id=$fila3['id'];
                                  $nombre=$fila3['nombre'];
                                  $web=$fila3['web'];

                                  $sentencia_infor = "select * from informes where id_cliente=".$id;  
                                  $consulta_infor = mysqli_query($conexion, $sentencia_infor) or die("Error de conexión");

                                  $sentencia_activos = "select * from activos where cliente=".$id;  
                                  $consulta_activos = mysqli_query($conexion, $sentencia_activos) or die("Error de conexión");

                                  $cantidad_activos=0;
                                  $cantidad_informes = 0;

                                  while($fila_infor = mysqli_fetch_array($consulta_infor)){
                                    $activos=$fila_infor['activos'];
                                    $arr_activos = explode(",",trim($activos));
                                    $cantidad_activos_informe = count($arr_activos)-1;
                                    $cantidad_informes ++;
                                  }

                                  while($fila_activos= mysqli_fetch_array($consulta_activos)){
         
                                    $cantidad_activos ++;
                                  }


                                  ?>

                                  <tr>
                                  <th scope="row"><a href="#"><?php echo $id; ?></a></th>
                                  <td><?php echo $nombre; ?></td>
                                  <td><?php echo $web; ?></td>
                                  <td><?php echo $cantidad_informes; ?></td>
                                  <td><?php echo $cantidad_activos; ?></td>
                                </tr>
                                <?php
   
                                }
                                  




                      ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <?php if ($id_cliente=="0") {
?>
        <div class="col-lg-4">

          <!-- Website Traffic -->
          <div class="card">


            <div class="card-body pb-0">
              <h5 class="card-title">Vulnerabilidades <span>| Criticidad</span></h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
              <?php

$sentencia_vulns = "select * from vulnerabilidades";  
$consulta_vulns = mysqli_query($conexion, $sentencia_vulns) or die("Error de conexión");

$total_vulns = 0;
$total_bajas = 0;
$total_medias = 0;
$total_altas = 0;
$total_muy_altas = 0;

while($fila_vulns = mysqli_fetch_array($consulta_vulns)){
    $total_vulns ++;

    $gravedad_vuln = $fila_vulns['criticidad'];

    if($gravedad_vuln == 1){
      $total_bajas ++;
    }

    if($gravedad_vuln == 2){
      $total_medias ++;
    }

    if($gravedad_vuln == 3){
      $total_altas ++;
    }

    if($gravedad_vuln == 4){
      $total_muy_altas ++;
    }
    
}

?>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Criticidad',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: "<?php echo $total_bajas; ?>",
                          name: 'Baja'
                        },
                        {
                          value: "<?php echo $total_medias; ?>",
                          name: 'Media'
                        },
                        {
                          value: "<?php echo $total_altas; ?>",
                          name: 'Alta'
                        },
                        {
                          value: "<?php echo $total_muy_altas; ?>",
                          name: 'Muy Alta'
                        }
                        
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Website Traffic -->


                      </div><!-- End Right side columns -->
                      <?php
              } else{
                ?>
                <div class="col-lg-4">

                <!-- Website Traffic -->
                <div class="card">

      
                  <div class="card-body pb-0">
                    <h5 class="card-title">Activos</h5>
      
                    <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                    <?php
                        $sentencia3 = "select * from activos where cliente=".$id_cliente;     
                        $consulta3 = mysqli_query($conexion, $sentencia3) or die("Error de conexión");
                        $filas_activos = 0;
                        while($fila= mysqli_fetch_array($consulta3)){
                          $filas_activos ++;
                        }
                        
                        $sentencia2 = "select * from activos where cliente=".$id_cliente." and vulnerabilidades<>''";     
                        $consulta2 = mysqli_query($conexion, $sentencia2) or die("Error de conexión");
                        $total_vulnerables = 0;
                        while($fila= mysqli_fetch_array($consulta2)){
                          $total_vulnerables ++;
                        }
                        $total_novulnerables=$filas_activos-$total_vulnerables;

      
     
      
      ?>
      
                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        echarts.init(document.querySelector("#trafficChart")).setOption({
                          tooltip: {
                            trigger: 'item'
                          },
                          legend: {
                            top: '5%',
                            left: 'center'
                          },
                          series: [{
                            name: 'Criticidad',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                              show: false,
                              position: 'center'
                            },
                            emphasis: {
                              label: {
                                show: true,
                                fontSize: '18',
                                fontWeight: 'bold'
                              }
                            },
                            labelLine: {
                              show: false
                            },
                            data: [{
                                value: "<?php echo $total_vulnerables; ?>",
                                name: 'Vulnerables'
                              },
                               {
                                value: "<?php echo $total_novulnerables; ?>",
                                name: 'No Vulnerables'
                              }
                              
                            ]
                          }]
                        });
                      });
                    </script>
      
                  </div>
                </div><!-- End Website Traffic -->
      
      
                            </div>
              <?php




              } 
              ?>
              
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>