<!DOCTYPE html>
<?php
include("conexion.php");
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Añadir Informe</title>
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

include("header.php");
include("sidebar.html");
?>

 

  </header><!-- End Header -->

  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Añadir Informe</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Añadir Informe</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Añadir Informe</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" form action="" method="post">
                <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre del Informe</label>
                  <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="col-md-6">
                  <label for="cliente" class="form-label">Cliente</label>
                  <select class="form-control" id="cliente" name="cliente" required>
                                <option value=""></option>

                                <?php 
                        
                                  $sentencia_empresa = "select * from empresas";
                                  $consulta_empresa = mysqli_query($conexion, $sentencia_empresa) or die("Error de Consulta empresas");

                                  //vamos a recorrer la consulta y guardar los datos
                                  while($fila= mysqli_fetch_array($consulta_empresa)){
                                      $id=$fila['id'];
                                      $nombre=$fila['nombre'];
                                      
                                      echo "<option value=".$id.">".$nombre."</option>";
                                  }
                              ?>
                              </select>                </div>
                <div class="col-md-6">
                  <label for="fecha" class="form-label">Fecha</label>
                  <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
               
                
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Guardar</button>

                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>

        </div>
 

    </section>

  </main><!-- End #main -->

  <?php
// obtener valores del post y generar consulta SQL
if (isset($_POST['submit'])){
  $nombre = $_POST['nombre'];
  $fecha = $_POST['fecha'];
  $cliente = $_POST['cliente'];

  $sentencia = "INSERT INTO `informes`(`nombre_informe`, `id_cliente`, `fecha`, `estado`)";
  $sentencia .=" VALUES ('$nombre','$cliente', '$fecha', 'En proceso')";

  $consulta = mysqli_query($conexion, $sentencia)or die("Error de la consulta");

  if (mysqli_affected_rows($conexion)!=0) {
    echo '<script type="text/JavaScript"> location.href="listado_informes.php" </script>';

  }
}
?>

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