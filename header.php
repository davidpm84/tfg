  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="http://localhost/index.php" class="logo d-flex align-items-center">
        <img src="http://localhost/assets/img/logos.png" alt="">
        <span class="d-none d-lg-block">Gestor de Vulnerabilidades</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->




    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

      

   

   
<?php
session_start();
   
// Controlo si el usuario ya está logueado en el sistema.
if(empty($_SESSION['ses_username'])){
  // Si no está logueado lo redireccion a la página de login.
  header("HTTP/1.1 302 Moved Temporarily"); 
  header("Location: login.php"); 
}

  $sentencia = "select * from usuarios order by id";    
  $consulta = mysqli_query($conexion, $sentencia) or die("Error de conexión en tabla usuarios");

  //vamos a recorrer la consulta y guardar los datos 
  while($ses= mysqli_fetch_array($consulta)){
      if ($_SESSION['ses_username'] == $ses['usuario']){ 
        $ses_usuario=$ses['usuario'];
        $ses_nombre=$ses['nombre']; 
        $ses_rol=$ses['rol']; 
        $ses_imagen=$ses['imagen']; 

      }
  }

?>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="http://localhost/<?php echo $ses_imagen; ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $ses_nombre;?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $ses_usuario; ?></h6>
              <?php
              if ($ses_rol=='1'){
                echo "<span>Rol: Administrador</span>";
              } else {
                echo "<span>Rol: Usuario</span>";

              }
              ?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            
         

            <li>
              <a class="dropdown-item d-flex align-items-center" href="http://localhost/info.php">
                <i class="bi bi-question-circle"></i>
                <span>información sobre este programa</span>
              </a>
            </li>


            <?php
            if ($ses_rol=='1'){

            
            ?>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="http://localhost/listado_usuarios.php">
                <i class="bi bi-person"></i>
                <span>Gestión de usuarios</span>
              </a>
            </li>
            <?php
              }
            ?>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="http://localhost/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar Sesión</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->