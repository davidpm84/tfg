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

  <title>Editar Informe</title>
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

 

  </header><!-- End Header -->
  <?php

      $sentencia = "select * from informes where id=".$id_url;    
      $consulta = mysqli_query($conexion, $sentencia) or die("Error de Consulta");

      //vamos a recorrer la consulta y guardar los datos 
      while($fila= mysqli_fetch_array($consulta)){
        $id_cliente=$fila['id_cliente'];
        $nombre_informe=$fila['nombre_informe'];
        $estado=$fila['estado'];
        $fecha=$fila['fecha'];
        $vulnerabilidades=$fila['vulnerabilidades'];
        $propuestas=$fila['propuestas'];
        $recomendaciones=$fila['recomendaciones'];
        
}
?>  
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Editar Informe</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
            <li class="breadcrumb-item active">Editar Informe</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  


    

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Informe</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" form action="" method="post">
              <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre del Informe</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_informe?>">
                  </div>

                  <div class="col-md-6">
                  <label for="cliente" class="form-label">Cliente</label>
                  <select id="cliente" class="form-select" name="cliente">
                  <?php

                    $sentencia = "select nombre from empresas where id=".$id_cliente; 
                    $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla empresas");
                    $fila=$consulta->fetch_assoc();
                  ?>
                    <option value="<?php echo $id_cliente; ?>" selected><?php echo $fila['nombre'] ?></option>
                    
                    <?php

                      $sentencia = "select * from empresas order by id";    
                      $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla empresas");

                      //vamos a recorrer la consulta y guardar los datos 
                      while($fila= mysqli_fetch_array($consulta)){
                              $id=$fila['id'];
                              $nombre=$fila['nombre'];
                        if ($id!=$id_cliente) {
                      ?>
                    <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                    <?php
                }}
              ?>
                  </select>  
                  </div>

   
                <div class="col-md-6">
                  <label for="fecha" class="form-label">fecha</label>
                  <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha?>">

                  </div>
                <div class="col-md-6">
                  <label for="estado" class="form-label">Estado</label>
                  <select class="form-control" id="estado" name="estado">
                      <option value="<?php echo $estado ?>"><?php echo $estado ?></option>

                      <?php
                        if ($estado=="Terminado") {
                          ?>
                          <option value="En proceso">En proceso</option>
                        <?php
                        } else {
                          ?>
                      <option value="Terminado">Terminado</option>
                      <?php
                        } 
                      ?>
                    </select>

                </div>

            </div>
          </div>

        </div>
    
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Asignar Activos</h5>
              <div class="col-md-12">
                    
                          <div class="card"  style="overflow:scroll; height:420px">
                            
                              <table class="table table-bordered" id="tabla_listado_cve">
                                <thead>
                                  <tr>
                                    <th style="width: 40px">Añadir</th>
                                    <th><center>Tipo</center></th>
                                    <th>nombre</th>
                                    <th>Descripción</th>
                                  </tr>
                                </thead>
                                <tbody>

                                <?php


$sentencia = "select * from activos where cliente=".$id_cliente." order by id";
$consulta = mysqli_query($conexion, $sentencia) or die("Error de Consulta");

//vamos a recorrer la consulta y guardar los datos 
while($fila= mysqli_fetch_array($consulta)){

      $id=$fila['id'];
      $tipo=$fila['tipo'];
      $hostname=$fila['hostname'];
      $ip = $fila['ip'];
      $descripcion = $fila['descripcion'];
      $so = $fila['so'];

      if($tipo == 1){
        $tipo = 'Web';
      }else if ($tipo == 2){
        $tipo = 'Servidor';
      }

      $act_apuntado = '';

      $sentencia_check = "select activos from informes where id=".$id_url; 
      $consulta_check = mysqli_query($conexion, $sentencia_check) or die("Error de Consulta"); 
      $fila_check=$consulta_check->fetch_assoc();

      $activos=$fila_check['activos'];
        $arr_activos = explode(",",trim($activos));
        $i = 0;
        while($i < count($arr_activos)-1)
        {

          if (strcmp($arr_activos[$i], $id) == 0) {//si el ID del activo está en el array de activos del informe
            $act_apuntado = 'checked';
          } 
          $i++;
        }


 

        ?>

                                  <tr>
                                  <td><center><input type="checkbox" name="act[]" value="<?php echo $id ?>" <?php echo $act_apuntado ?>></input></center></td>
                                    <td class="col-md-1"><?php echo $tipo;?></td>
                                    <td><?php echo substr($hostname, 0, 120);?></td>
                                    <td class="col-md-2"><?php echo $descripcion;?></td>
                                  </tr>
                                 <?php
                                }
                              ?>
                                </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="row pt-4">
                        <div class="form-group row">
                          <label for="col-sm-3 col-form-label">Recomendaciones</label>
                          <textarea class="form-control m-3 text-black" name="recomendaciones" id="recomendaciones"><?php echo $recomendaciones ?></textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group row">
                          <label for="col-sm-3 col-form-label">Propuestas</label>
                          <textarea class="form-control m-3 text-black" name="propuestas" id="propuestas"><?php echo $propuestas ?></textarea>
                        </div>
                      </div>
                    </div>    
            
                    <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                  <button type="reset" class="btn btn-secondary">Reset</button>
                  
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>
  
    </section>



  </main><!-- End #main -->

  <?php

if (isset($_POST['submit'])){
  $id_cliente=$_POST['cliente'];
  $nombre_informe=$_POST['nombre'];
  $estado=$_POST['estado'];
  $fecha=$_POST['fecha'];
  $activos=$_POST['activos'];
  $propuestas=$_POST['propuestas'];
  $recomendaciones=$_POST['recomendaciones'];

  
  foreach($_POST['act'] as $selected){
    $activos .= $selected.",";  
  }

  if($activos == ","){
    $activos = "";
  }

 
  $sentencia = "UPDATE `informes` SET `id_cliente`='$id_cliente', `nombre_informe`='$nombre_informe', `estado`='$estado', `fecha`='$fecha', `activos`='$activos', `recomendaciones`='$recomendaciones', `propuestas`='$propuestas' WHERE id=".$id_url.";";
echo $sentencia;
  $consulta = mysqli_query($conexion, $sentencia)or die("Error de consulta");

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