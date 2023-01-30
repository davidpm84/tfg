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

  <title>Editar Usuario</title>
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

  $sentencia = "select * from usuarios where id=".$id_url;    
  $consulta = mysqli_query($conexion, $sentencia) or die("Error de Consulta");

  //vamos a recorrer la consulta y guardar los datos 
  while($fila= mysqli_fetch_array($consulta)){
    $usuario=$fila['usuario'];
    $nombre=$fila['nombre'];
    $rol_num=$fila['rol'];
    if($rol_num == 1){
      $rol = 'Administrador';
    }else if ($rol_num == 2){
      $rol = 'Usuario';
    }

}
?>  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Editar Usuario</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
            <li class="breadcrumb-item active">Editar Usuario</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Usuario</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" form action="" method="post">
                <div class="col-md-6">
                  <label for="usuario" class="form-label">Nombre del Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario?>">
                </div>
                <div class="col-md-6">
                  <label for="password_temp" class="form-label">Contraseña</label>
                  <input type="text" class="form-control" id="password_temp" name="password_temp" value="No Cambiar">
                </div>
                <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre completo</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>">
                </div>
                <div class="col-md-6">
                  <label for="rol" class="form-label">Rol</label>
                  <select id="rol" class="form-select" name="rol">
                    <option selected value="<?php echo $rol_num ?>"><?php echo $rol?></option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>

                  </select>                
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
  $usuario = $_POST['usuario'];
  $password_temp =$_POST['password_temp'];
  if ($password_temp !="No Cambiar") {
    $password = base64_encode($_POST['password_temp']);
  }
  $rol = $_POST['rol'];
  
  if ($password_temp !="No Cambiar") {
    $sentencia = "UPDATE `usuarios` SET `usuario`='$usuario',`password`='$password',`nombre`='$nombre',`rol`='$rol' WHERE id=".$id_url.";";

  } else {
    $sentencia = "UPDATE `usuarios` SET `usuario`='$usuario',`nombre`='$nombre',`rol`='$rol' WHERE id=".$id_url.";";

  }


  $consulta = mysqli_query($conexion, $sentencia)or die("Error de consulta");

  if (mysqli_affected_rows($conexion)!=0) {
    echo '<script type="text/JavaScript"> location.href="listado_usuarios.php" </script>';
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