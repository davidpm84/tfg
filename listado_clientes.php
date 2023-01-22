<!DOCTYPE html>
<?php

include("conexion.php");

?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Listado de clientes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="assets/vendor/mdi/css/materialdesignicons.min.css">

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

    <div class="pagetitle">
      <h1>Listado de clientes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Clientes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div align="right">    <a href="anadir_cliente.php"><button type="button" class="btn btn-primary">Añadir Cliente</button></a>

   </div><br>
   


    <section class="section">
   

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Listado de clientes</h5>

              <!-- Default Table -->
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Web</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>

                  </tr>
                </thead>
                <tbody>

                <?php

                $sentencia = "select * from empresas order by id";    
                $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla empresas");
            
                //vamos a recorrer la consulta y guardar los datos 
                while($fila= mysqli_fetch_array($consulta)){
                        $id=$fila['id'];
                        $nombre=$fila['nombre'];
                        $web=$fila['web'];
                        $logo = "<img src='".$web."/favicon.ico'>";

                 
                ?>

                  <tr>
                    <th scope="row"><?php echo $id ?></th>
                    <td><?php echo $logo ?></td>
                    <td><?php echo $nombre ?></td>
                    <td><?php echo $web ?></td>
                   
                    <td><a href="editar_cliente.php?id=<?php echo $id ?>"><i class="mdi mdi-eye" style="font-size:20px"></i></a></td>
                    <td><a href="eliminar_cliente.php?id=<?php echo $id ?>"><i class="mdi mdi-close-circle-outline" style="color:red; font-size:20px"></i></a></td>
                  </tr>
                  <?php
                }
              ?>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>

          
        


    </section>

  </main><!-- End #main -->
 

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