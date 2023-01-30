<!DOCTYPE html>
<?php
include("conexion.php");
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Añadir Vulnerabilidad</title>
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
      <h1>Añadir Vulnerabilidad</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Añadir Vulnerabilidad</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Añadir Vulnerabilidad</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" form action="" method="post">
                <div class="col-md-6">
                  <label for="cve" class="form-label">CVE</label>
                  <input type="text" class="form-control" id="cve" name="cve">
                </div>
                <div class="col-md-6">
                  <label for="criticidad" class="form-label">Criticidad</label>
                  <select id="criticidad" class="form-select" name="criticidad">
                    <option selected></option>
                    <option value="1">Baja</option>
                    <option value="2">Media</option>
                    <option value="3">Alta</option>
                    <option value="4">Muy Alta</option>
                  </select>                
                </div>
                <div class="col-md-6">
                  <label for="esfuerzo" class="form-label">Esfuerzo</label>
                  <select id="esfuerzo" class="form-select" name="esfuerzo">
                    <option selected></option>
                    <option value="1">Bajo</option>
                    <option value="2">Medio</option>
                    <option value="3">Alto</option>
                    <option value="4">Muy Alto</option>
                  </select>  
                  </div>
                <div class="col-6">
                  <label for="categoria" class="form-label">Categoría OWASP10</label>
                  <select id="categoria" class="form-select" name="categoria">
                    <option selected></option>
                    <option value="1">A01:2021-Broken Access Control</option>
                    <option value="2">A02:2021-Cryptographic Failures</option>
                    <option value="3">A03:2021-Injection</option>
                    <option value="4">A04:2021-Insecure Design</option>
                    <option value="5">A05:2021-Security Misconfiguration</option>
                    <option value="6">A06:2021-Vulnerable and Outdated Components</option>
                    <option value="7">A07:2021-Identification and Authentication Failures</option>
                    <option value="8">A08:2021-Software and Data Integrity Failures</option>
                    <option value="9">A09:2021-Security Logging and Monitoring Failures</option>
                    <option value="10">A10:2021-Server-Side Request Forgery</option>
                  </select>  
                                </div>
                <div class="col-12">
                  <label for="descripcion" class="form-label">Descripción</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion">
                </div>
                <div class="col-md-12">
                  <label for="solucion" class="form-label">Solución</label>
                  <input type="text" class="form-control" id="solucion" name="solucion">
                </div>
                <div class="col-md-24">
                  <label for="recomendacion" class="form-label">Recomendación para la tabla de criticidad</label>
                  <input type="text" class="form-control" id="recomendacion" name="recomendacion">

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
  $cve = $_POST['cve'];
  $criticidad = $_POST['criticidad'];
  $descripcion = $_POST['descripcion'];
  $solucion = $_POST['solucion'];
  $esfuerzo = $_POST['esfuerzo'];
  $categoria = $_POST['categoria'];
  $recomendacion = $_POST['recomendacion'];

 
  $sentencia = "INSERT INTO `vulnerabilidades`(`criticidad`, `cve`, `descripcion`, `solucion`, `esfuerzo`, `categoria`, `recomendacion`)";
  $sentencia .=" VALUES ('$criticidad', '$cve','$descripcion', '$solucion', '$esfuerzo', '$categoria', '$recomendacion')";

  $consulta = mysqli_query($conexion, $sentencia)or die("Error de la consulta");

  if (mysqli_affected_rows($conexion)!=0) {
    echo '<script type="text/JavaScript"> location.href="listado_vulnerabilidades.php" </script>';

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