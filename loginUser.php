<?php 

session_start();

require_once 'funciones/conexion.php';
$MiConexion = ConexionBD();

$Mensaje = '';
if (!empty($_POST['BotonLogin'])) {

    require_once 'funciones/login.php';
    $dni = $_POST['DNI'];
    $clave = $_POST['clave'];

    // Verificar que los datos se reciban correctamente 
    echo "**DNI: $dni, Clave: $clave**";

    // Llamar a la función DatosLogin
    $resultado = DatosLogin($dni, $clave, $MiConexion);
    $logueoU = $resultado['Usuario'];
    $error = $resultado['Error'];

    if ($error) {
        // Si hay error, mostrar el mensaje de error correspondiente
        $Mensaje = $error;
    } else {
        // Si no hay error, el usuario fue encontrado
        if (!empty($logueoU)) {
          $Mensaje = 'ok! ya puedes ingresar, Bienvenido ' . $logueoU['NOMBRE'];

            // Generar los valores del usuario (esto va a venir de mi BD)
            $_SESSION['nombreU'] = $logueoU['NOMBRE'];
            $_SESSION['apellidoU'] = $logueoU['APELLIDO']; 
            $_SESSION['dniU'] = $logueoU['DNI']; 
            $_SESSION['nivelU'] = $logueoU['NIVEL']; 
            $_SESSION['imgU'] = $logueoU['IMG']; 
            $_SESSION['idUser'] =$logueoU['IdUSER'];

            if ($logueoU['ACTIVO'] == 0) {
                $Mensaje = 'Ud. no se encuentra activo en el sistema.';
            } else {
                echo $Mensaje;
                header('Location: index.php');
                exit;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>2do Desempeño 2024-2</title>
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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Panel de Administración</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Ingresa tu cuenta</h5>
                    <p class="text-center small">Ingresa tu datos de usuario y clave</p>
                  </div>

                  <form class="row g-3 needs-validation" role="form" novalidate method="POST">
                             <?php if (!empty ($Mensaje)) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <?php echo $Mensaje; ?>
                                </div>
                            <?php } ?>
                            


                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Usuario</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">DNI</span>
                        <input class="form-control" name="DNI" id="yourUsername" type="number" autofocus value='' required>
                        <div class="invalid-feedback">Ingresa tu DNI.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Clave</label>
                      <input class="form-control" name="clave" id="yourPassword" type="password" required>
                      <div class="invalid-feedback">Ingresa tu clave</div>
                    </div>

                
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="BotonLogin" value="Login" type="submit">Login</button>
                    </div>
                  </form> 

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  
  <!-- ======= Footer ======= -->
  <?php require_once 'footer.php';?>
  <?php require_once 'scripts.php';?>
  
</body>

</html>