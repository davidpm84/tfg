<?php
$url = $_SERVER["REQUEST_URI"];
$urlArray = explode('=', $url);
$id_url = $urlArray[1];

include("../conexion.php");
require_once 'classes/CreateDocx.php';


$sentencia = "select * from informes where id=".$id_url;     
$consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla informes");

//vamos a recorrer la consulta y guardar los datos 
while($fila= mysqli_fetch_array($consulta)){
        $id_informe=$fila['id'];
        $nombre_doc=$fila['nombre_informe'];
        $id_empresa_auditada=$fila['id_cliente'];
        $activos=$fila['activos'];
        $estado=$fila['estado'];
        $fecha=$fila['fecha'];
        $recomendaciones_informe=$fila['recomendaciones'];
        $propuestas_informe=$fila['propuestas'];
}

$sentencia2 = "select * from empresas where id=".$id_empresa_auditada;     
$consulta2 = mysqli_query($conexion, $sentencia2) or die("Error de conexión en tabla informes");

//vamos a recorrer la consulta y guardar los datos 
while($fila= mysqli_fetch_array($consulta2)){
        $nombre_empresa=$fila['nombre'];
        $web_empresa=$fila['web'];

}

//Inicio generación documento
$docx = new CreateDocx('TemplateHeaderAndFooter.docx');// you should include the path to your base template
//$docx ->importHeadersAndFooters('TemplateHeaderAndFooter.docx');

$paramsImg = array(
  'src' => 'imgauditoria.jpg', //path to the image that we would like to insert
  'scaling' => 80, //scaling factor, 100 corresponds to no scaling
  'spacingTop' => 10, //top padding
  'spacingBottom' => 10, //bottom padding
  'spacingLeft' => 10, //left padding
  'spacingRight' => 10, //right padding
  'textWrap' => 1, //corresponding to square format
);
$docx->addImage($paramsImg);



$tableData = array(
  array(
    'Nombre del informe',
    "$nombre_doc"

),
  array(
      'Fecha del informe',
      "$fecha"

  ),
  array(
      'Empresa',
      "$nombre_empresa"

  ),
  array(
      'Web de la Empresa',
      "$web_empresa"

  )
);

$tableProperties = array('tableStyle' => 'LightListPHPDOCX');

$docx->addTable($tableData, $tableProperties);

$docx->addText('');

$docx->addText('AVISO LEGAL');
$textolegal = array();
$textolegal[] = array(
    'text' => 'Este documento contiene información confidencial y propietaria la cual es de uso exclusivo de '
);

$textolegal[] = array(
    'text' => $nombre_empresa,
    'bold' => true,
);

$textolegal[] = array(
    'text' => '. La reproducción o uso no autorizado de este documento está totalmente prohibida.'
);
$docx->addText($textolegal);

$docx->addText('Índice', array('pStyle' => 'Heading1PHPDOCX'));
$docx->addText('Añadir índice de Word');


$docx->addText('Introducción', array('pStyle' => 'Heading1PHPDOCX'));
$docx->addText('Durante las pruebas se simulan las actividades que realizaría un atacante real, descubriendo las vulnerabilidades, su nivel de riesgo, y generando recomendaciones que permitan al cliente realizar la remediación de estas. En cada sección de este informe se detallan los aspectos importantes de la forma en que un atacante podría utilizar la vulnerabilidad para comprometer y obtener acceso no autorizado a información sensible. Se incluyen además directrices que al ser aplicadas mejoraran los niveles de confidencialidad, integridad y disponibilidad de los sistemas analizados.');

$docx->addText('Objetivo', array('pStyle' => 'Heading2PHPDOCX'));
$docx->addText('El objetivo de la evaluación de seguridad es detectar las vulnerabilidades de seguridad existentes en los sistemas analizados para posteriormente generar un informe con los hallazgos y recomendaciones que permitan la remediación de estas.');

$docx->addText('Alcance', array('pStyle' => 'Heading2PHPDOCX'));
$docx->addText('La evaluación realizada se ha centrado en los objetivos aprobados en el alcance del contrato, en el cual se establece:');



// listado de activos del informe
$lista = array();





$sentencia3 = "select activos from informes where id=".$id_url; 
$consulta3 = mysqli_query($conexion, $sentencia3) or die("Error de Consulta"); 
$fila_activos=$consulta3->fetch_assoc();

$activos=$fila_activos['activos'];
  $arr_activos = explode(",",trim($activos));
  $i = 0;

  while($i < count($arr_activos)-1)
  {

    $sentencia4 = "select * from activos where id=".$arr_activos[$i];     
    $consulta4 = mysqli_query($conexion, $sentencia4) or die("Error de conexión en tabla informes");

    //vamos a recorrer la consulta y guardar los datos 
    while($fila= mysqli_fetch_array($consulta4)){
            $hostname=$fila['hostname'];
            $ip=$fila['ip'];
            $lista[] = array(
              "Nombre: $hostname"." IP: $ip"
            );
    }
    
    $i++;
  }

  
  $docx->addList($lista, 1);
 
  
  $docx->addText('Resultado de las pruebas', array('pStyle' => 'Heading1PHPDOCX'));
  $docx->addText('A continuación se detalla la información de cada activo analizado.');

  $i = 0;
  $todas_vulnerabilidades="";
  while($i < count($arr_activos)-1)
  {
    $sentencia4 = "select * from activos where id=".$arr_activos[$i];     
    $consulta4 = mysqli_query($conexion, $sentencia4) or die("Error de conexión en tabla informes");
    

    //vamos a recorrer la consulta y guardar los datos 
    while($fila= mysqli_fetch_array($consulta4)){
            $hostname=$fila['hostname'];
            $ip=$fila['ip'];
            $descripcion=$fila['descripcion'];
            $so=$fila['so'];
            $vulnerabilidades=$fila['vulnerabilidades'];
            $propuestas=$fila['propuestas'];
            $recomendaciones=$fila['recomendaciones'];

            $todas_vulnerabilidades=$todas_vulnerabilidades.$vulnerabilidades;


            if (substr_count($vulnerabilidades, ",")>0) {
              $tableData = array(
                array(
                  'Hostname',
                  "$hostname"
                ),
                array(
                  'IP',
                  "$ip"
                ),
                array(
                  'Descripción',
                  "$descripcion"
                ),
                array(
                  'Sistema Operativo',
                  "$so"
                ),
                array(
                  'Estado',
                  'El activo tiene vulnerabilidades.'
                ),
                array(
                  'Propuestas',
                  "$propuestas"
                ),
                array(
                  'Recomendaciones',
                  "$recomendaciones"
                )
  
              );

            }else {
              $tableData = array(
                array(
                  'Hostname',
                  "$hostname"
                ),
                array(
                  'IP',
                  "$ip"
                ),
                array(
                  'Descripción',
                  "$descripcion"
                ),
                array(
                  'Sistema Operativo',
                  "$so"
                ),
                array(
                  'Estado',
                  'El activo no tiene vulnerabilidades. No se muestran propuestas ni recomendaciones'
                )
  
              );
            }


            
            
            $tableProperties = array('tableStyle' => 'LightListAccent1PHPDOCX');
            
            $docx->addTable($tableData, $tableProperties);


            $docx->addText('');



    }
    
    $i++;
  }




  $docx->addText('Recomendaciones', array('pStyle' => 'Heading1PHPDOCX'));
  $docx->addText('A continuación, se muestras las recomendaciones generales de la auditoría realizada');
  $docx->addText($recomendaciones_informe);
  $docx->addText('');


  $docx->addText('Propuestas de mejora', array('pStyle' => 'Heading2PHPDOCX'));
  $docx->addText('A continuación, se muestran las propuestas de mejora tras la auditoría realizada.');
  $docx->addText($propuestas_informe);
  $docx->addText('');

  $docx->addText('Tabla de vulnerabilidades y esfuerzos', array('pStyle' => 'Heading2PHPDOCX'));
  $docx->addText('Se muestran todas las vulnerabilidades, criticidad y esfuerzo para solventarlo');

  $array2_vulnerabilidades = explode(",",trim($todas_vulnerabilidades));
// quitamos duplicados del array
  $array_vulnerabilidades = array_unique($array2_vulnerabilidades);
  


  $i = 0;
  $tableData = array();
  $tableData[$i] = array(
    'CVE',
    'Criticidad',
    'Esfuerzo',
    'Recomendación'
);

$baja = 0;
$media =0;
$alta = 0;
$muyalta=0;
$bajo = 0;
$medio =0;
$alto = 0;
$muyalto=0;

$categoria1=0;
$categoria2=0;
$categoria3=0;
$categoria4=0;
$categoria5=0;
$categoria6=0;
$categoria7=0;
$categoria8=0;
$categoria9=0;
$categoria10=0;

  while($i < count($array_vulnerabilidades)-1)
  {

    $sentencia5 = "select * from vulnerabilidades where id=".$array_vulnerabilidades[$i];     
    
    $consulta5 = mysqli_query($conexion, $sentencia5) or die("Error de conexión en tabla vulnerabilidades");



    //vamos a recorrer la consulta y guardar los datos 
    while($fila= mysqli_fetch_array($consulta5)){
            $cve=$fila['cve'];
            $criticidad_num=$fila['criticidad'];
            $esfuerzo_num=$fila['esfuerzo'];
            $categoria=$fila['categoria'];
            $recomendacion=$fila['recomendacion'];

            if($criticidad_num == 1){
              $criticidad = 'Baja';
              $baja++;
          }else if ($criticidad_num == 2){
              $criticidad = 'Media';
              $media++;
          }else if ($criticidad_num == 3){
              $criticidad = 'Alta';
              $alta++;
          }else if ($criticidad_num == 4){
          $criticidad = 'Muy Alta';
          $muyalta++;
          }

          if($esfuerzo_num == 1){
              $esfuerzo = 'Bajo';
              $bajo++;
          }else if($esfuerzo_num == 2){
              $esfuerzo = 'Medio';
              $medio++;
          }else if($esfuerzo_num == 3){
            $esfuerzo = 'Alto';
            $alto++;
          }else if($esfuerzo_num == 4){
            $esfuerzo = 'Muy Alto';
            $muyalto++;
          }
          if($categoria == 1){
            $categoria1++;
          }else if ($categoria == 2){
            $categoria2++;
          }else if ($categoria == 3){
            $categoria3++;
          }else if ($categoria == 4){
            $categoria4++;
          }else if ($categoria == 5){
            $categoria5++;
          }else if ($categoria == 6){
            $categoria6++;
          }else if ($categoria == 7){
            $categoria7++;
          }else if ($categoria == 8){
            $categoria8++;
          }else if ($categoria == 9){
            $categoria9++;
          }else if ($categoria == 10){
            $categoria10++;
          }



            $tableData[$i+1] = array(
                "$cve",
                "$criticidad",
                "$esfuerzo",
                "$recomendacion"
            );



    }
    
    $i++;
  }
  $tableProperties = array('tableStyle' => 'LightListAccent1PHPDOCX');
            
  $docx->addTable($tableData, $tableProperties);

  $docx->addText('Gráficas', array('pStyle' => 'Heading1PHPDOCX'));


  $docx->addText('Gráfica de esfuerzos', array('pStyle' => 'Heading2PHPDOCX'));
  $docx->addText('El gráfico de esfuerzos sería el siguiente:');

  $data = array(
    'data' => array(
        array(
            'name' => 'Bajo',
            'values' => array($bajo),
        ),
        array(
            'name' => 'Medio',
            'values' => array($medio),
        ),
        array(
            'name' => 'Alto',
            'values' => array($alto),
        ),
        array(
          'name' => 'Muy Alto',
          'values' => array($muyalto),
      ),
    ),
);
$paramsChart = array(
  'data' => $data,
  'type' => 'pieChart',
  'title' => 'Vulnerabilidades según el esfuerzo',
  'sizeX' => 17,
  'sizeY' => 8,
  'chartAlign' => 'center',
);
$docx->addChart($paramsChart);

$docx->addText('');

$docx->addText('Gráfica de criticidades', array('pStyle' => 'Heading2PHPDOCX'));

$docx->addText('El gráfico de criticidad sería el siguiente:');

 

  $data = array(
    'data' => array(
        array(
            'name' => 'Bajas',
            'values' => array($baja),
        ),
        array(
            'name' => 'Medias',
            'values' => array($media),
        ),
        array(
            'name' => 'Altas',
            'values' => array($alta),
        ),
        array(
          'name' => 'Muy Altas',
          'values' => array($muyalta),
      ),
    ),
);
$paramsChart = array(
  'data' => $data,
  'type' => 'pieChart',
  'title' => 'Vulnerabilidades según su criticidad',
  'sizeX' => 17,
  'sizeY' => 8,
  'chartAlign' => 'center',
);
$docx->addChart($paramsChart);

$docx->addText('');
$docx->addText('');


$docx->addText('Gráfica OWASPtop10', array('pStyle' => 'Heading2PHPDOCX'));

$docx->addText('El gráfico de vulnerabilidades en categorías OWASP sería el siguiente:');

  

$data = array(
  'legend' => array('Vulnerabilidades'),
  'data' => array(
      array(
          'name' => 'Categoria 1',
          'values' => array($categoria1),
      ),
      array(
          'name' => 'Categoria 2',
          'values' => array($categoria2),
      ),
      array(
          'name' => 'Categoria 3',
          'values' => array($categoria3),
      ),
      array(
          'name' => 'Categoria 4',
          'values' => array($categoria4),
      ),
      array(
          'name' => 'Categoria 5',
          'values' => array($categoria5)
      ),
      array(
        'name' => 'Categoria 6',
        'values' => array($categoria6),
      ),
      array(
          'name' => 'Categoria 7',
          'values' => array($categoria7),
      ),
      array(
          'name' => 'Categoria 8',
          'values' => array($categoria8),
      ),
      array(
          'name' => 'Categoria 9',
          'values' => array($categoria9),
      ),
      array(
          'name' => 'Categoria 10',
          'values' => array($categoria10)
      ),

  ),
);

$args = array(
  'data' => $data,
  'type' => 'radar',
  'style' => 'radar',
  'title' => 'Vulnerabilidades por categorías OWASPtop10',
  'sizeX' => 15,
  'sizeY' => 15,
  'legendpos' => 't',
  'border' => 1,
  'vgrid' => 1
);


$docx->addChart($args);










//Fin generación documento

$nombre_informe="informe_$id_url"."_"."$nombre_doc";
$docx->createDocx('informe_'.$id_url.'_'.$nombre_doc);
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Descargar Informes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<?php

include("../header.html");
include("../sidebar.html");
?>

 

  </header><!-- End Header -->

  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Descargar Informe</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
            <li class="breadcrumb-item active">Descargar Informe</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  

          

          <div class="card">
            <div class="card-body">
              <br>
              <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">

                    <h2>Informe Generado</h2>
                    <a class="nav-link btn btn-warning col-lg-1 col-12 create-new-button" aria-expanded="false" href="<?php echo $nombre_informe;?>.docx">Descargar Informe</a>
                    <br>
                    <a class="nav-link btn btn-info col-lg-1 col-12 create-new-button" aria-expanded="false" href="../listado_informes.php">Volver</a>
                  </div>
                </div>
              </div>
            </div>
              <!-- Multi Columns Form -->
              
            </div>
          </div>

        </div>
 

    </section>

  </main><!-- End #main -->

  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
