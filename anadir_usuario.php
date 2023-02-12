<!DOCTYPE html>
<?php
include("conexion.php");
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Añadir Usuario</title>
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
      <h1>Añadir Usuario</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Añadir Usuario</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Añadir Usuario</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                  <label for="username" class="form-label">Nombre del usuario</label>
                  <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="text" class="form-control" id="password" name="password">
                </div>

                <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre Completo</label>
                  <input type="text" class="form-control" id="nombre" name="nombre">
                </div>

                <div class="col-md-6">
                  <label for="rol" class="form-label">Rol</label>
                  <select id="rol" class="form-select" name="rol">
                    <option selected></option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                  </select>                
                </div>
                <div class="col-md-6">
                  <label for="file" class="form-label">Imagen</label>
                  <input type="file" name="file" id="file">
                  </select>                
                </div>

                
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Crear usuario</button>

                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>

        </div>
 

    </section>

  </main><!-- End #main -->

  <?php
$target_dir = "assets/img/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// obtener valores del post y generar consulta SQL
if (isset($_POST['submit'])){


  $check = getimagesize($_FILES["file"]["tmp_name"]);

  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "<script type='text/javascript'>alert('El fichero no cumple los requisitos (Fichero tipo imagen jpg o png y que no supere 500KB)');</script>";
  
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

    $nombre = $_POST['nombre'];
    $usuario = $_POST['username'];
    $password = base64_encode($_POST['password']);
    $rol = $_POST['rol'];
  
    $sentencia = "INSERT INTO `usuarios`(`usuario`, `password`, `nombre`, `rol`, `imagen`)";
    $sentencia .=" VALUES ('$usuario', '$password', '$nombre', '$rol', '$target_file')";
    $consulta = mysqli_query($conexion, $sentencia)or die("Error de la consulta");

    if (mysqli_affected_rows($conexion)!=0) {
      echo '<script type="text/JavaScript"> location.href="listado_usuarios.php" </script>';
  
    }
  } else {
    echo "<script type='text/javascript'>alert('Ha habido un problema al subir el fichero');</script>";
  }



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