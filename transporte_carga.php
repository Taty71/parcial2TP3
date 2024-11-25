<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 

// Verificar que la sesión esté activa y que el usuario esté logueado
if (empty($_SESSION['nombreU']) || empty($_SESSION['apellidoU']) || empty($_SESSION['nivelU']) || empty($_SESSION['imgU'])) {
    header('Location: cerrarsesion.php');  // Redirigir si no hay sesión activa
    exit;
}
// Solo permitir acceso a administradores u operadores
if ($_SESSION['nivelU'] != 'Admin' && $_SESSION['nivelU'] != 'Operador') {
  header('Location: index.php');  // Redirigir si no tiene permisos
  exit;
}
if (!empty($_POST['btnLimpiar'])) {
  $_POST = array(); // Elimina todos los datos enviados
}
require_once 'funciones/conexion.php';
$MiConexion=ConexionBD();

require_once 'funciones/seleccionMarca.php';
$listadoMarcas = Listar_Marcas($MiConexion);
$cantidadMarcas = count($listadoMarcas);

require_once 'funciones/seleccionTipo.php';
$listadoTipos = Listar_Tipos($MiConexion);
$cantidadTipos = count($listadoTipos);



$Mensaje=''; 
if (!empty($_POST['btnRegistrar'])) {
  require_once 'funciones/registrarTransporte.php';

  $Validacion = Validar_Datos();
  $Mensaje = $Validacion['Mensaje'];
  $Estilo = $Validacion['Clase'];
  $Icono = $Validacion['Icono'];

  if ($Estilo === 'success') {
      $resultado = insertarTransporte($MiConexion);
      if ($resultado === true) {
          $Mensaje = 'Se ha registrado correctamente.';
          $_POST = array();
          $Estilo = 'success';
          $Icono = 'bi-check-circle';
      } else {
          $Mensaje = $resultado; // Error específico
          $Estilo = 'danger';
          $Icono = 'bi-x-circle'; 
          $_POST = array();

      }
  }
}



require_once 'encabezado.php';
?>

</head>

<body>
<?php require_once 'headerTransporte.php'; ?>
  
  <!-- ======= Sidebar ======= -->
  <?php require_once 'aside.php'; ?>
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Registrar un nuevo transporte</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Transportes</li>
          <li class="breadcrumb-item active">Cargar nuevo</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ingresa los datos</h5>
              <form class="row g-3" role="form" method="POST">

                  <div class="col-lg-10">
                    <?php if (!empty($Mensaje)) {
                    echo '<div class="alert alert-' . $Estilo . ' alert-dismissible fade show" role="alert">';
                    echo '<i class="bi ' . $Icono . '"></i> ' . $Mensaje;

                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                    } ?>
                  <label for="selector" class="form-label">Marca (*)</label>
                  <select class="form-select" aria-label="marcaSelector" id="marcaSelector" name="Marca" >
                    <option value="">Selecciona una opción</option>
                    <?php 
                      $selected='';
                      for ($i=0 ; $i < $cantidadMarcas ; $i++) {
                        if (!empty($_POST['Marca']) && $_POST['Marca'] ==  $listadoMarcas[$i]['IdMarcas']) {
                          $selected = 'selected';
                        } else {
                          $selected='';
                        }
                    ?>
                    <option value="<?php echo $listadoMarcas[$i]['IdMarcas']; ?>" <?php echo $selected; ?>  >
                      <?php echo $listadoMarcas[$i]['Marcas']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-6">
                  <label for="selector" class="form-label">Tipo (*)</label>
                  <select class="form-select" aria-label="Selector" id="tipoSelector" name="Tipo" >
                    <option value="">Selecciona una opción</option>
                    <?php 
                      $selected='';
                      for ($i=0 ; $i < $cantidadTipos ; $i++) {
                        if (!empty($_POST['Tipo']) && $_POST['Tipo'] ==  $listadoTipos[$i]['IdTipos']) {
                          $selected = 'selected';
                        } else {
                          $selected='';
                        }
                    ?>
                    <option value="<?php echo $listadoTipos[$i]['IdTipos']; ?>" <?php echo $selected; ?>  >
                      <?php echo $listadoTipos[$i]['Tipos']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-lg-6">
                  <label for="patente" class="form-label">Patente (*)</label>
                  <input type="text" class="form-control" id="patente" name="Patente" value="<?php echo htmlspecialchars($_POST['Patente'] ?? '', ENT_QUOTES); ?>">

                </div>

                <div class="col-lg-6">
                  <label for="modelo" class="form-label">Modelo</label>
                  <input type="text" class="form-control" id="modelo" name="Modelo" value="<?php echo htmlspecialchars($_POST['Modelo'] ?? '', ENT_QUOTES);; ?>">
                </div>

                <div class="col-lg-6">
                  <label class="form-label">Disponibilidad (*)</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="Disponible" value="1" <?php echo (!empty($_POST['Disponible']) && $_POST['Disponible'] == 1) ? 'checked':''; ?> >
                    <label class="form-check-label" for="gridCheck1"> Habilitado</label>
                  </div>
                </div>

                <div class="col-lg-6">
                  <label class="form-label">Combustible</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" id="gridRadios1" name="Combustible" value="GNC" <?php echo (!empty($_POST['Combustible']) && $_POST['Combustible'] == 'GNC') ? 'checked':''; ?> >
                    <label class="form-check-label" for="gridRadios1"> GNC </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" id="gridRadios2" name="Combustible" value="Gasoil" <?php echo (!empty($_POST['Combustible']) && $_POST['Combustible'] == 'Gasoil') ? 'checked':''; ?> >
                    <label class="form-check-label" for="gridRadios2"> Gasoil </label>
                  </div>
                </div>
                <div class="text-center">
                  <button class="btn btn-primary" name="btnRegistrar" type="submit"  value="Registrar" >Registrar</button>
                  <button type="reset" name="btnLimpiar" class="btn btn-secondary" value="Limpiar">Limpiar Campos</button>
                  <a href="index.php" class="text-primary fw-bold">Volver al index</a>
                </div>
              </form>


              

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->


  
  
  <!-- ======= Footer ======= -->
  <?php require_once 'footer.php';?>
  <?php require_once 'scripts.php';?>
  
</body>

</html>