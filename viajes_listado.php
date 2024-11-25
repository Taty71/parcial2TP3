<?php
// Asegúrate de iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['nivelU']) || !isset($_SESSION['idUser'])) {
    // Redirige a la página de login si no está logueado
    header("Location: login.php");
    exit();
}

// Definir nivel de usuario para el control de acceso
$nivel = $_SESSION['nivelU']; 

// Obtener el id del chofer desde la sesión
$idChofer = $_SESSION['idUser']; 

// Incluir el archivo de conexión a la base de datos
require_once 'funciones/conexion.php';
$MiConexion = ConexionBD();
  // Asegúrate de que este archivo defina la variable $MiConexion correctamente

// Si el usuario es chofer, filtrar los viajes para mostrar solo los viajes asignados a él
$whereChofer = ($nivel == 'Chofer') ? "WHERE v.IdChofer = $idChofer" : ''; 

// Consulta SQL para obtener los viajes
$query = "
    SELECT 
        v.FechaViaje,
        d.Denominacion AS Destino,
        CONCAT(u.Nombre, ' ', u.Apellido) AS Chofer,
        CONCAT(ti.Tipos, ' ', m.Marcas, ' ', t.Patente) AS Transporte,
        v.Costo,
        v.PorcentajeChofer,
        CONCAT('$ ', FORMAT((v.Costo * v.PorcentajeChofer / 100), 2), ' (', v.PorcentajeChofer, '%)') AS MontoChofer
    FROM 
        viajes v
    JOIN 
        destinos d ON v.IdDestino = d.IdDestinos
    JOIN 
        usuarios u ON v.IdChofer = u.IdUser
    JOIN 
        transportes t ON v.IdTransporte = t.IdTransportes
    JOIN
        tipos ti ON t.IdTipo = ti.IdTipos
    JOIN
        marcas m ON t.IdMarca = m.IdMarcas
    $whereChofer
";

// Ejecutar la consulta
$resultado = $MiConexion->query($query);

// Manejar errores en la consulta
if (!$resultado) {
    die("Error en la consulta: " . $MiConexion->error);
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
      <h1>Lista de viajes registrados</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Viajes</li>
          <li class="breadcrumb-item active">Listado</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          

          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Viajes cargados (<?php echo $resultado->num_rows; ?>)</h5>

            <!-- Default Table -->
            <!-- Aquí comienza el HTML -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha Viaje</th>
                        <th scope="col">Destino</th>
                        <th scope="col">Chofer</th>
                        <th scope="col">Transporte</th>
                        <?php if ($nivel == 'Admin' || $nivel == 'Operador') { ?>
                            <th scope="col">Costo Viaje</th>
                        <?php } ?>
                        <th scope="col">Monto Chofer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador = 1;
                    while ($fila = $resultado->fetch_assoc()) {
                        // Eliminar el símbolo '$' y las comas, luego convertir a float
                        $costo = isset($fila['Costo']) ? floatval(str_replace([',', '$'], '', $fila['Costo'])) : 0;
                        $montoChofer = isset($fila['MontoChofer']) ? floatval(str_replace([',', '$'], '', $fila['MontoChofer'])) : 0;
                    
                        echo "<tr>";
                        echo "<th scope='row'>{$contador}</th>";
                        echo "<td>{$fila['FechaViaje']}</td>";
                        echo "<td>{$fila['Destino']}</td>";
                        echo "<td>{$fila['Chofer']}</td>";
                        echo "<td>{$fila['Transporte']}</td>";

                        // Mostrar la columna "Costo Viaje" solo para Admin y Operador
                        if ($nivel == 'Admin' || $nivel == 'Operador') {
                            echo "<td>$ " . number_format($costo, 2, ',', '.') . "</td>";
                        }

                        // Mostrar solo el monto del chofer para los choferes, sin porcentaje
                        if ($nivel == 'Chofer') {
                            echo "<td>$ " . number_format($montoChofer, 2, ',', '.') . "</td>";
                        } else {
                            // Si no es chofer, mostrar el monto con porcentaje
                            echo "<td>$ " . number_format($montoChofer, 2, ',', '.') . " ({$fila['PorcentajeChofer']}%)</td>";
                        }

                        echo "</tr>";
                        $contador++;
                    }
                    ?>
                </tbody>
            </table>
            <!-- End Default Table Example -->              
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