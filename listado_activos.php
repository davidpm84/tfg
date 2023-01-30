<!DOCTYPE html>
<?php

include("conexion.php");

?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Listado de Activos</title>
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

include("header.php");
include("sidebar.html");
?>

  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Listado de Activos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Activos</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div align="right">    <a href="anadir_activo.php"><button type="button" class="btn btn-primary">Añadir Activos</button></a>

   </div><br>

   


    <section class="section">
   

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Listado de Activos</h5>

              <!-- Default Table -->
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Hostname/Web</th>
                    <th scope="col">IP</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">SO/Aplicación</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>


                  </tr>
                </thead>
                <tbody>
                <?php

                $sentencia = "select * from activos order by id";    
                $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla vulnerabilidades");
            
                //vamos a recorrer la consulta y guardar los datos 
                while($fila= mysqli_fetch_array($consulta)){
                  $id=$fila['id'];
                  $cliente=$fila['cliente'];
                  $tipo=$fila['tipo'];
                  if($tipo == 1){
                    $tipo = '<span class="badge bg-primary">Web</span>';
                  }else if ($tipo == 2){
                    $tipo = '<span class="badge bg-secondary">Servidor</span>';
                  }
                  $hostname=$fila['hostname'];
                  $ip=$fila['ip'];
                  $descripcion=$fila['descripcion'];
                  $so=$fila['so'];
                  $vulnerabilidades=$fila['vulnerabilidades'];

                 if (substr_count($vulnerabilidades, ",")>0) {
                  $vulnerable='<span class="badge bg-danger">Vulnerable</span>';

                 }else {
                  $vulnerable='<span class="badge bg-success">No Vulnerable</span>';
                 }

                  $sentencia2 = "select nombre from empresas where id=".$cliente;    
                  $consulta2 = mysqli_query($conexion, $sentencia2) or die("Error de conexión en tabla vulnerabilidades");
                  $fila_check=$consulta2->fetch_assoc();

                  $nombreempresa=$fila_check['nombre'];


                 
                ?>

                
                  <tr>
                    <th scope="row"><?php echo $id ?></th>
                    <td><?php echo $nombreempresa ?></td>
                    <td><?php echo $tipo ?></td>
                    <td><?php echo $hostname ?></td>
                    <td><?php echo $ip ?></td>
                    <td><?php echo substr($descripcion, 0, 100); ?>...</td>
                    <td><?php echo $so ?></td>
                    <td><?php echo $vulnerable ?></td>

                    <td><a href="editar_activo.php?id=<?php echo $id ?>"><i class="mdi mdi-eye" style="font-size:20px"></i></a></td>
                    <td><a href="eliminar_activo.php?id=<?php echo $id ?>"><i class="mdi mdi-close-circle-outline" style="color:red; font-size:20px"></i></a></td>
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