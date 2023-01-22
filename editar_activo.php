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

  <title>Editar Activo</title>
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

      $sentencia = "select * from activos where id=".$id_url;    
      $consulta = mysqli_query($conexion, $sentencia) or die("Error de Consulta");

      //recorremos la consulta y guardamos los datos 
      while($fila= mysqli_fetch_array($consulta)){
        $cliente=$fila['cliente'];
        $tipo=$fila['tipo'];
        $hostname=$fila['hostname'];
        $ip=$fila['ip'];
        $descripcion=$fila['descripcion'];
        $so=$fila['so'];
        $vulnerabilidades=$fila['vulnerabilidades'];
        $propuestas=$fila['propuestas'];
        $recomendaciones=$fila['recomendaciones'];

        if($tipo == 1){
          $tipo_desc = 'Web';
        }else if ($tipo == 2){
          $tipo_desc = 'Servidor';
      }
}
?>  
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Editar Activo</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
            <li class="breadcrumb-item active">Editar Activo</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  


    

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Activo</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" form action="" method="post">
              <div class="col-md-6">
                  <label for="tipo" class="form-label">Tipo</label>
                  <select id="tipo" class="form-select" name="tipo" >
                    <option value="<?php echo $tipo; ?>" selected><?php echo $tipo_desc; ?></option>
                    <option value="1">Web</option>
                    <option value="2">Servidor</option>
                  </select>  
                  </div>



                  <div class="col-md-6">
                  <label for="empresa" class="form-label">Cliente</label>
                  <select id="empresa" class="form-select" name="empresa" >
                  <?php
                    $sentencia = "select nombre from empresas where id=".$cliente; 
                    $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla empresas");
                    $fila=$consulta->fetch_assoc();
                  ?>
                    <option value="<?php echo $cliente; ?>" selected><?php echo $fila['nombre'] ?></option>
                    
                    <?php

                      $sentencia = "select * from empresas order by id";    
                      $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla empresas");

                      //vamos a recorrer la consulta y guardar los datos 
                      while($fila= mysqli_fetch_array($consulta)){
                              $id=$fila['id'];
                              $nombre=$fila['nombre'];
                        if ($id!=$cliente) {

                      ?>
                    <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
                    <?php
                }}
              ?>
                  </select>  
                  </div>

   
                <div class="col-md-6">
                  <label for="hostname" class="form-label">Hostname/Web</label>
                  <input type="text" class="form-control" id="hostname" name="hostname" value="<?php echo $hostname?>">
                </div>
                <div class="col-md-6">
                  <label for="IP" class="form-label">Dirección IP</label>
                  <input type="text" class="form-control" id="ip" name="ip" value="<?php echo $ip?>">
                </div>
                <div class="col-md-6">
                  <label for="descripcion" class="form-label">Descripción</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion?>">
                  </div>
                <div class="col-6">
                  <label for="so" class="form-label">Sistema Operativo</label>
                  <input type="text" class="form-control" id="so" name="so" value="<?php echo $so?>">
                  </div>

 

            </div>
          </div>

        </div>
    
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Asignar Vulnerabilidades</h5>
              <div class="col-md-12">
                    
                          <div class="card"  style="overflow:scroll; height:420px">
                            
                              <table class="table table-bordered" id="tabla_listado_cve">
                                <thead>
                                  <tr>
                                    <th style="width: 40px">Añadir</th>
                                    <th><center>CVE</center></th>
                                    <th>Descripción</th>
                                    <th>Criticidad</th>
                                  </tr>
                                </thead>
                                <tbody>

                                <?php

$sentencia = "select * from vulnerabilidades order by id";    
$consulta = mysqli_query($conexion, $sentencia) or die("Error de Consulta");

//vamos a recorrer la consulta y guardar los datos 
while($fila= mysqli_fetch_array($consulta)){

      $id=$fila['id'];
      $cve=$fila['cve'];
      $descripcion=$fila['descripcion'];
      $criticidad = $fila['criticidad'];

      if($criticidad == 1){
        $criticidad_desc = 'Baja';
      }else if($criticidad == 2){
          $criticidad_desc = 'Media';
      }else if($criticidad == 3){
          $criticidad_desc = 'Alta';
      }else if($criticidad == 4){
        $criticidad_desc = 'Muy Alta';
    }

      $vuln_apuntada = '';

      $sentencia_check = "select vulnerabilidades from activos where id=".$id_url; 
      $consulta_check = mysqli_query($conexion, $sentencia_check) or die("Error de Consulta"); 
      $fila_check=$consulta_check->fetch_assoc();

      $vulnerabilidades=$fila_check['vulnerabilidades'];
        $arr_vulnerabilidades = explode(",",trim($vulnerabilidades));
        $i = 0;
        while($i < count($arr_vulnerabilidades)-1)
        {

          if (strcmp($arr_vulnerabilidades[$i], $id) == 0) {//si el ID de la vulnerabilidad está en el array de vulnerabilidades del activo
            $vuln_apuntada = 'checked';
          } 
          $i++;
        }

        ?>

                                  <tr>
                                  <td><center><input type="checkbox" name="vuln[]" value="<?php echo $id ?>" <?php echo $vuln_apuntada ?>></input></center></td>
                                    <td class="col-md-1"><?php echo $cve;?></td>
                                    <td><?php echo substr($descripcion, 0, 120);?></td>
                                    <td class="col-md-2"><?php echo $criticidad_desc;?></td>
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
  $tipo = $_POST['tipo'];
  $cliente = $_POST['empresa'];
  $hostname = $_POST['hostname'];
  $ip = $_POST['ip'];
  $descripcion = $_POST['descripcion'];
  $so = $_POST['so'];
  $vulnerabilidades = "";
  $recomendaciones = $_POST['recomendaciones'];
  $propuestas = $_POST['propuestas'];

  
  foreach($_POST['vuln'] as $selected){
    $vulnerabilidades .= $selected.",";  
  }

  if($vulnerabilidades == ","){
    $vulnerabilidades = "";
  }

 
  $sentencia = "UPDATE `activos` SET `tipo`='$tipo', `cliente`='$cliente', `hostname`='$hostname', `ip`='$ip', `descripcion`='$descripcion', `so`='$so', `recomendaciones`='$recomendaciones', `propuestas`='$propuestas', `vulnerabilidades`='$vulnerabilidades' WHERE id=".$id_url.";";

  $consulta = mysqli_query($conexion, $sentencia)or die("Error de consulta");

  if (mysqli_affected_rows($conexion)!=0) {
    echo '<script type="text/JavaScript"> location.href="listado_activos.php" </script>';

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