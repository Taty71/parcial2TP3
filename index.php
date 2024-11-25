<?php 
session_start(); 

// Verificar que la sesión esté activa y que el usuario esté logueado
if (!empty($_SESSION['nombreU']) && !empty($_SESSION['apellidoU'])) {
  $Mensaje = ' '. $_SESSION['nombreU'] . ' ' . $_SESSION['apellidoU'] . '!';
} else {
  $Mensaje = 'Por favor, inicia sesión.';
}
// Verificar que la sesión esté activa
if (empty($_SESSION['nombreU']) || empty($_SESSION['apellidoU']) || empty($_SESSION['nivelU'])) {
  header('Location: cerrarsesion.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>2do Desempeño 2024-2</title>
  <meta name="description" content="Bienvenido al sistema de desempeño.">
  <meta name="keywords" content="Desempeño, Bienvenido, Sistema">

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
  <!--<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
--> 
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>
<body>

<?php require_once 'headerTransporte.php'; ?>
  <!-- ======= Sidebar ======= -->
  <?php require_once 'aside.php' ?>


 <main id="main" class="main">

<div class="pagetitle">
  <h1>Bienvenid@ ☺ <?php echo $Mensaje; ?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Customers Card -->
        <div class="col-xxl-12 col-xl-12">

          <div class="card info-card customers-card">

            <div class="card-body">
              <h5 class="card-title">Estamos trabajando en el segundo desempeño. <span>| Muchos exitos!</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <span class="text-danger small pt-1 fw-bold">Puedes seleccionar el menu de la izquierda</span>

                </div>
              </div>
            </div>
          </div>

        </div><!-- End Customers Card -->

      </div>
    </div><!-- End Left side columns -->

  </div>
</section>

</main><!-- End #main -->


  
  <!-- ======= Footer ======= -->
  <?php require_once 'footer.php'; ?>

   <!-- ======= Scripts ======= -->
  <?php require_once 'scripts.php'; ?>
</body>

</html>