<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Verificar sesión activa
if (empty($_SESSION['nombreU']) || empty($_SESSION['apellidoU']) || empty($_SESSION['nivelU']) || empty($_SESSION['imgU'])) {
    header('Location: cerrarsesion.php');
    exit;
}

// Verificar niveles de acceso
if ($_SESSION['nivelU'] != 'Admin') {
    header('Location: index.php');
    exit;
}
// Variables iniciales
$Mensaje = '';
$Estilo = '';
$Icono = '';
$errores = [];

// Limpiar formulario
if (!empty($_POST['btnLimpiar'])) {
  $_POST = array(); // Esto vacía los valores de todos los campos enviados
  $Mensaje = 'Formulario limpiado correctamente.';
  $Estilo = 'info';
  $Icono = 'bi-info-circle';
  header('Location: ' . $_SERVER['PHP_SELF']); // Recargar la página para aplicar los cambios exit;
}

require_once 'funciones/conexion.php';
$MiConexion=ConexionBD();

// Validación al enviar
if (!empty($_POST['btnRegistrar'])) {
  require_once 'funciones/registrarChofer.php';
    // Lista de campos requeridos
    $camposRequeridos = [
        'Nombre' => 'Nombre (*)',
        'Apellido' => 'Apellido (*)',
        'DNI' => 'DNI (*)',
       
    ];

    // Validar campos vacíos
    foreach ($camposRequeridos as $campo => $label) {
        if (empty(trim($_POST[$campo] ?? ''))) {
            $errores[] = $label . ' es requerido.';
        }
    }
// Validar longitud del DNI
    if (!empty($_POST['DNI']) && (strlen($_POST['DNI']) < 8 || !ctype_digit($_POST['DNI']))) {
      $errores[] = 'El DNI debe ser un número de hasta 8 caracteres.';
    }

    // Validar longitud de la clave
    if (!empty($_POST['Clave']) && strlen($_POST['Clave']) < 5) {
      $errores[] = 'La clave debe tener al menos 5 caracteres.';
}

  
    // Generar mensajes según los errores
    if (empty($errores)) {
        // Todos los campos están completos
        insertarChofer($MiConexion);
        $Mensaje = 'Los datos se guardaron correctamente!';
        $Estilo = 'success';
        $Icono = 'bi-check-circle';
    } elseif (count($errores) === count($camposRequeridos)) {
        // Todos los campos están vacíos
        $Mensaje = 'Los campos indicados con (*) son requeridos.';
        $Estilo = 'info';
        $Icono = 'bi-info-circle';
    } else {
        // Faltan algunos campos
        $Mensaje = implode('<br>', $errores);
        $Estilo = 'warning';
        $Icono = 'bi-exclamation-triangle';
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
      <h1>Registrar un nuevo chofer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Transportes</li>
          <li class="breadcrumb-item active">Carga Chofer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        
        <div class="col-lg-6">

            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ingresa los datos</h5>
                <?php if (!empty($Mensaje)): ?>
                  <div class="alert alert-<?php echo $Estilo; ?> alert-dismissible fade show" role="alert">
                         <i class="bi <?php echo $Icono; ?> me-1"></i>
                          <?php echo $Mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif; ?>

                <form class="row g-3" role="form" method="POST">
                
                <div class="col-12">
                    <label for="Apellido" class="form-label">Apellido (*)</label>
                    <input type="text" class="form-control" id="apellido" name="Apellido" value="<?php echo htmlspecialchars($_POST['Apellido'] ?? '', ENT_QUOTES); ?>">
                </div>

                <div class="col-12">
                    <label for="Nombre" class="form-label">Nombre (*)</label>
                    <input type="text" class="form-control" id="nombre" name="Nombre" value="<?php echo htmlspecialchars($_POST['Nombre'] ?? '', ENT_QUOTES); ?>">
                </div>
                
                <div class="col-12">
                    <label for="dni" class="form-label">DNI (*)</label>
                    <input type="text" class="form-control" id="dni" name="DNI" value="<?php echo htmlspecialchars($_POST['DNI'] ?? '', ENT_QUOTES); ?>" maxlength="8">
                    <small class="text-danger"><?php echo $errores['DNI'] ?? ''; ?></small>
                 
                  </div>
              
                <div class="col-12">
                    <label for="pass" class="form-label">Clave</label>
                    <input type="password" class="form-control" id="pass" name="Clave" value="<?php echo htmlspecialchars($_POST['Clave'] ?? '', ENT_QUOTES); ?>" minlength="5">
                    <small class="text-danger"><?php echo $errores['Clave'] ?? ''; ?></small>
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