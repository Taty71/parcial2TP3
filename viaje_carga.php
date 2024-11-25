<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Verificar que la sesión esté activa y que el usuario esté logueado
if (empty($_SESSION['nombreU']) || empty($_SESSION['apellidoU']) || empty($_SESSION['nivelU']) ||  empty($_SESSION['idUser'])) {
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
$MiConexion = ConexionBD();

// Consulta para obtener choferes activos
$sqlChoferes = "SELECT IdUser, Apellido, Nombre, DNI FROM usuarios WHERE IdNivel = 3 AND Activo = 1";
$resultadoChoferes = mysqli_query($MiConexion, $sqlChoferes);

// Manejar errores en la consulta
if (!$resultadoChoferes) {
    die('Error en la consulta: ' . mysqli_error($MiConexion));
}

// Almacenar los choferes en un array
$choferes = array();
while ($fila = mysqli_fetch_assoc($resultadoChoferes)) {
    $choferes[] = $fila;
}

// Consulta para obtener transportes habilitados
$sqlTransportes = "SELECT t.IdTransportes, m.Marcas, ti.Tipos, t.Patente, t.Modelo 
                   FROM transportes t
                   JOIN marcas m ON t.IdMarca = m.IdMarcas
                   JOIN tipos ti ON t.IdTipo = ti.IdTipos
                   WHERE t.Disponible = 1";
$resultadoTransportes = mysqli_query($MiConexion, $sqlTransportes);

// Manejar errores en la consulta
if (!$resultadoTransportes) {
    die('Error en la consulta: ' . mysqli_error($MiConexion));
}

// Almacenar los transportes en un array
$transportes = array();
while ($fila = mysqli_fetch_assoc($resultadoTransportes)) {
    $transportes[] = $fila;
}

// Consulta para obtener destinos
$sqlDestinos = "SELECT IdDestinos, Denominacion FROM destinos";
$resultadoDestinos = mysqli_query($MiConexion, $sqlDestinos);

// Manejar errores en la consulta
if (!$resultadoDestinos) {
    die('Error en la consulta: ' . mysqli_error($MiConexion));
}

// Almacenar los destinos en un array
$destinos = array();
while ($fila = mysqli_fetch_assoc($resultadoDestinos)) {
    $destinos[] = $fila;
}

// Manejar el formulario de inserción de viajes 
$Mensaje = '';
$Estilo = '';
$Icono = '';
$errores = [];

if (!empty($_POST['btnRegistrar'])) {
    require_once 'funciones/registrarViaje.php';

    // Validar campos vacíos
    $camposRequeridos = [
        'Chofer' => 'Chofer (*)',
        'Transporte' => 'Transporte Habilitado (*)',
        'FechaViaje' => 'Fecha programada (*)',
        'Destino' => 'Destino (*)',
        'Costo' => 'Costo (*)',
        'PorcentajeChofer' => 'Porcentaje chofer (*)'
    ];

    foreach ($camposRequeridos as $campo => $label) {
        if (empty(trim($_POST[$campo] ?? ''))) {
            $errores[] = $label . ' es requerido.';
        }
    }

    // Validar campos numéricos si ya tienen datos
    if (!empty($_POST['Costo']) && !is_numeric($_POST['Costo'])) {
        $errores[] = 'El campo Costo debe ser un valor numérico.';
    }
    if (!empty($_POST['PorcentajeChofer']) && !is_numeric($_POST['PorcentajeChofer'])) {
        $errores[] = 'El campo Porcentaje chofer debe ser un valor numérico.';
    }

    // Generar mensajes según los errores
    if (empty($errores)) {
        // Todos los campos están completos y válidos
        $IdUsurRegistra = $_SESSION['idUser']; // Obtener el IdUser de la sesión
        $resultado = insertarViaje($MiConexion, $IdUsurRegistra); // Pasar el IdUser al insertarViaje
        if ($resultado === true) {
            $Mensaje = 'Viaje registrado correctamente!';
            $Estilo = 'success';
            $Icono = 'bi-check-circle';
            $_POST = array(); // Limpiar formulario
        } else {
            $Mensaje = $resultado;
            $Estilo = 'danger';
            $Icono = 'bi-x-circle';
        }
    } else {
        // Mostrar errores según correspondan
        if (count($errores) === count($camposRequeridos)) {
            $Mensaje = 'Los campos indicados con (*) son requeridos.';
            $Estilo = 'info';
            $Icono = 'bi-info-circle';
        } else {
            $Mensaje = implode('<br>', $errores);
            $Estilo = 'warning';
            $Icono = 'bi-exclamation-triangle';
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
      <h1>Registrar un nuevo viaje</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Viajes</li>
          <li class="breadcrumb-item active">Carga</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ingresa los datos</h5>
                <?php if (!empty($Mensaje)) { ?> <div class="alert alert-<?php echo $Estilo; ?> alert-dismissible fade show" role="alert"> <i class="bi <?php echo $Icono; ?> me-1"></i> <?php echo $Mensaje; ?> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div> <?php } ?>
                
               <form class="row g-3" role="form" method="POST"> 
                <div class="col-12">
                  <label for="selectorChofer" class="form-label">Chofer (*)</label> 
                  <select class="form-select" aria-label="Selector" id="selectorChofer" name="Chofer"> 
                    <option value="">Selecciona una opcion</option> 
                      <?php foreach ($choferes as $chofer) { ?> <option value="<?php echo $chofer['IdUser']; ?>">
                       <?php echo $chofer['Apellido'] . ', ' . $chofer['Nombre'] . ' (DNI ' . $chofer['DNI'] . ')'; ?> 
                    </option> <?php } ?> 
                  </select> 
                </div> 
                <div class="col-12"> 
                  <label for="selectorTransporte" class="form-label">Transporte Habilitado (*)</label> 
                  <select class="form-select" aria-label="Selector" id="selectorTransporte" name="Transporte"> 
                    <option value="">Selecciona una opcion</option> 
                     <?php foreach ($transportes as $transporte) { ?> <option value="<?php echo $transporte['IdTransportes']; ?>"> <?php echo $transporte['Tipos'] . ' - ' . $transporte['Marcas'] . ' - ' . $transporte['Patente']; ?> 
                    </option> <?php } ?> 
                  </select> 
                </div> 
                <div class="col-12"> 
                  <label for="fecha" class="form-label">Fecha programada (*)</label> 
                  <input type="date" class="form-control" id="fecha" name="FechaViaje" value="<?php echo htmlspecialchars($_POST['FechaViaje'] ?? '', ENT_QUOTES); ?>"> 
                </div> 
                <div class="col-12"> <label for="selectorDestino" class="form-label">Destino (*)</label> 
                <select class="form-select" aria-label="Selector" id="selectorDestino" name="Destino"> 
                  <option value="">Selecciona una opcion</option> 
                  <?php foreach ($destinos as $destino) { ?> 
                    <option value="<?php echo $destino['IdDestinos']; ?>"> 
                      <?php echo $destino['Denominacion']; ?> 
                    </option> <?php } ?> 
                  </select> 
                </div> 
                <div class="col-12">
                  <label for="costo" class="form-label">Costo (*)</label>
                  <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">$</span>
                    <input 
                      type="number" 
                      step="0.01" 
                      class="form-control" 
                      id="costo" 
                      name="Costo" 
                      placeholder="$00000,00"
                      value="<?php echo htmlspecialchars($_POST['Costo'] ?? '', ENT_QUOTES); ?>"> 
                  </div>
                </div>
                <div class="col-12"> 
                  <label for="porc" class="form-label">Porcentaje chofer (*)</label> 
                  <div class="input-group">
                  
                  <input type="number" step="0.01" class="form-control" id="porc" placeholder="00,00%" name="PorcentajeChofer" value="<?php echo htmlspecialchars($_POST['PorcentajeChofer'] ?? '', ENT_QUOTES); ?>"> 
                  <span class="input-group-text" id="inputGroupPrepend">%</span>
                  </div>
                </div> 
                <div class="text-center"> 
                  <button class="btn btn-primary" name="btnRegistrar" type="submit" value="Registrar">Registrar</button> <button type="submit" name="btnLimpiar" class="btn btn-secondary" value="Limpiar">Limpiar Campos</button> <a href="index.php" class="text-primary fw-bold">Volver al index</a> 
</div> 
</form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php require_once 'footer.php';?>
<?php require_once 'scripts.php';?>
  
</body>

</html>