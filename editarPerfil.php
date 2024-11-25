<?php 
session_start(); 
var_dump($_SESSION);


// Verificar que la sesión esté activa y que el usuario esté logueado
if (empty($_SESSION['nombreU']) || empty($_SESSION['apellidoU']) || empty($_SESSION['dniU']) || empty($_SESSION['nivelU']) || empty($_SESSION['imgU'])) {
    header('Location: cerrarsesion.php');
    exit;
}

require_once 'funciones/conexion.php';
$MiConexion = ConexionBD();
require_once 'funciones/modificarPerfil.php';

if (!empty($_POST['BtnModificar'])) {
   
    echo"enviando...";
    //el boton se ha pulsado, se tienen que enviar los datos a la base
    $Nombre     =   !empty($_POST['Nombre']) ? $_POST['Nombre'] : '';
    $Apellido   =   !empty($_POST['Apellido'])?  $_POST['Apellido'] : '';
    $DNI      =   !empty($_POST['DNI'])?  $_POST['DNI'] : '';
    $Clave       =   !empty($_POST['ClaveU'])?  $_POST['ClaveU'] : '';
    $NvaClave       =   !empty($_POST['NvaClaveU'])?  $_POST['NvaClaveU'] : '';
    //la clave gralmente se la pide de nuevo
    //el archivo se debe subir de nuevo

    if (ValidarMisDatos() != false) {  //salio bien la validacion
        /**** subo el archivo ***/
        echo"validando";
        if (SubirArchivo() != false ) {
            //modifico en la base
            echo "Archivo subido<br>";
            if (ModificarMisDatos($MiConexion, $_POST['IdUser'])) {
                $_SESSION['Mensaje'] = "Tus datos se han actualizado.";
                $_SESSION['Estilo'] = "success";
            }else {
                $_SESSION['Mensaje'] = "Tus datos no pudieron ser actualizados.";
                $_SESSION['Estilo'] = "warning";
            }
        }
    } 

}/*else { 
    //no pulsa el boton, es decir se estan trayendo los datos de la base
	$Usuario = EncontrarUsuario($_SESSION['idUser'], $MiConexion);
    //Alojo los datos del usuario en variables para mostrarlas en el formulario
    $Nombre =   !empty($Usuario['NOMBRE'])?    $Usuario['NOMBRE'] : '';
    $Apellido   =   !empty($Usuario['APELLIDO'])?  $Usuario['APELLIDO'] : '';
    $DNI  =   !empty($Usuario['DNI'])?     $Usuario['DNI'] : '';
   
    //la imagen la tengo en la session!! */
    

require_once 'encabezado.php' ?>
</head>
<body>
<?php require_once 'headerTransporte.php'; ?>
  <!-- ======= Sidebar ======= -->
<?php require_once 'aside.php' ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Bienvenid@ ☺!!!</h1>
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
            <div class="card-body pt-4">
            <h5 class="card-title">Editar Perfil</h5>
                    <?php if (!empty($_SESSION['Mensaje'])): ?>
                        <div class="alert alert-<?php echo htmlspecialchars($_SESSION['Estilo']); ?>">
                            <?php echo htmlspecialchars($_SESSION['Mensaje']); ?>
                        </div>
                    <?php endif; ?>

                <form  method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Nombre</div>
                            <div class="col-lg-9 col-md-8">
                            <input type="hidden" name="IdUser" value="<?php echo htmlspecialchars($_SESSION['idUser']); ?>">
                                <input type="text" name="Nombre" class="form-control" value="<?php echo htmlspecialchars($_SESSION['nombreU']); ?>" required>
                            </div>
                        </div>
                    <div class="row mt-3">
                        <div class="col-lg-3 col-md-4 label">Apellido</div>
                        <div class="col-lg-9 col-md-8">
                            <input type="text" name="Apellido" class="form-control" value="<?php echo htmlspecialchars($_SESSION['apellidoU']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-lg-3 col-md-4 label">DNI</div>
                        <div class="col-lg-9 col-md-8">
                            <input type="text" name="DNI" class="form-control" value="<?php echo htmlspecialchars($_SESSION['dniU'] ?? ''); ?>" >
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-3 col-md-4 label">Clave</div>
                        <div class="col-lg-9 col-md-8">
                            <input type="password" name="ClaveU" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-3 col-md-4 label">Confirmar clave</div>
                        <div class="col-lg-9 col-md-8">
                            <input type="password" name="NvaClaveU" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-3 col-md-4 label">Foto de perfil</div>
                        <div class="col-lg-9 col-md-8">
                            <input type="file" name="Imagen" class="form-control">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" name="BtnModificar" class="btn btn-success">Guardar cambios</button>
                    </div>
                    <div class="col-lg-3 mt-2">
                                   <div class="form-group">
                                   <img alt="Mi Avatar" class="img-responsive" 
                                   src="./assets/img/<?php echo $_SESSION['imgU'] ; ?>" width="50"/>
                                   </div>
                        </div>

                </form>

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