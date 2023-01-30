<!DOCTYPE html>
<?php

include("conexion.php");


$url = $_SERVER["REQUEST_URI"];
$urlArray = explode('=', $url);
$id_url = $urlArray[1];
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Editar Cliente</title>
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

<?php

  $sentencia = "select * from empresas where id=".$id_url;    
  $consulta = mysqli_query($conexion, $sentencia) or die("Error de Consulta");

  //vamos a recorrer la consulta y guardar los datos 
  while($fila= mysqli_fetch_array($consulta)){
    $nombre=$fila['nombre'];
    $web=$fila['web'];

}
?>  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Editar Cliente</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
            <li class="breadcrumb-item active">Editar Cliente</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Cliente</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" form action="" method="post">
                <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre del cliente</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>">
                </div>
                <div class="col-md-6">
                  <label for="web" class="form-label">Web</label>
                  <input type="text" class="form-control" id="web" name="web" value="<?php echo $web?>">
                </div>
                
               
                
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>

        </div>
 

    </section>

  </main><!-- End #main -->

  <?php

if (isset($_POST['submit'])){
  $nombre = $_POST['nombre'];
  $web = $_POST['web'];
  
  $sentencia = "UPDATE `empresas` SET `nombre`='$nombre',`web`='$web' WHERE id=".$id_url.";";


  $consulta = mysqli_query($conexion, $sentencia)or die("Error de consulta");

  if (mysqli_affected_rows($conexion)!=0) {
    echo '<script type="text/JavaScript"> location.href="listado_clientes.php" </script>';
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