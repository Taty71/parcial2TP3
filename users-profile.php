<?php 
session_start();  // Asegúrate de iniciar la sesión aquí

// Verificar si la sesión está activa
if (empty($_SESSION['nombreU']) || empty($_SESSION['apellidoU']) || empty($_SESSION['dniU']) || empty($_SESSION['nivelU']) || empty($_SESSION['imgU'])) {
    header('Location: cerrarsesion.php');  // Redirigir si no hay sesión activa
    exit;
}



require_once 'encabezado.php' ?>
</head>
<body>
<?php require_once 'headerTransporte.php'; ?>
  <!-- ======= Sidebar ======= -->
<?php require_once 'aside.php' ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Bienvenid@!!!</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item">Mi perfil</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <!-- Profile Picture -->
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img src="assets/img/<?php echo htmlspecialchars($_SESSION['imgU']); ?>" alt="Profile" class="rounded-circle" width="150">
          <h2><?php echo htmlspecialchars($_SESSION['nombreU'] . ' ' . $_SESSION['apellidoU']); ?></h2>
          <h3><?php echo htmlspecialchars($_SESSION['nivelU']); ?></h3>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <!-- Profile Details -->
      <div class="card profile-details">
        <div class="card-body pt-3">
          <h5 class="card-title">Detalles del perfil</h5>

         
          <div class="row">
            <div class="col-lg-6 col-md-6 label">Nombre completo</div>
            <div class="col-lg-6 col-md-6"><?php echo htmlspecialchars($_SESSION['nombreU']); ?></div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-6 col-md-6 label">Apellido</div>
            <div class="col-lg-6 col-md-6"><?php echo htmlspecialchars($_SESSION['apellidoU']); ?></div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-6 col-md-6 label">DNI</div>
            <div class="col-lg-6 col-md-6"><?php echo htmlspecialchars($_SESSION['dniU'] ?? 'No disponible'); ?></div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-6 col-md-6 label">Nivel</div>
            <div class="col-lg-6 col-md-6"><?php echo htmlspecialchars($_SESSION['nivelU']); ?></div>
          </div>
         

          <!-- Opcional: Botón para editar perfil -->
          <div class="mt-4">
            <a href="editarPerfil.php" class="btn btn-primary">Editar perfil</a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main 

<?php require_once 'footer.php'; ?>
<!-- ======= Scripts ======= -->
<?php require_once 'scripts.php'; ?>
</body>

</html>