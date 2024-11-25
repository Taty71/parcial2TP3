<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.php" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">NiceAdmin</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">
    <li class="nav-item dropdown pe-3">
     
       <!-- Mostrar el nombre, apellido, y nivel del usuario -->
       <?php require_once 'userInfo.php'; ?>
       <?php require_once 'menuUser.php'; ?>
      
    </li><!-- End Profile Nav -->
  </ul>
</nav><!-- End Icons Navigation -->
</header><!-- End Header -->