<?php 
session_start(); 

// Verificar que la sesión esté activa y que el usuario esté logueado
if (empty($_SESSION['nombreU']) || empty($_SESSION['apellidoU']) || empty($_SESSION['nivelU']) || empty($_SESSION['imgU'])) {
    header('Location: cerrarsesion.php');  // Redirigir si no hay sesión activa
    exit;
}





/* En este script al ingresar, ya necesitamos tener a mano los datos del usuario logueado */
/* Entonces este sript se va a ejecutar la primera vez, trayendo los datos de SESSION
y por cada vez que se pulsa el guardar, usaremos los datos de POST. */

$Nombre='';
$Apellido='';
$Email='';
$Clave='';
$Nombre='';
$Nombre='';
$Nombre='';
$Nombre='';
if (!empty($_POST['botonModificar'])) {
    //si no pulsamos el boton, traemos los datos de la session
    
}





require_once 'encabezado.php' ?>

</head>
<body>
<?php require_once 'headerTransporte.php'; ?>
  <!-- ======= Sidebar ======= -->
<?php require_once 'aside.php' ?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modifica tu imagen</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                  <?php print_r($_FILES) ; ?>
                        <div class="col-lg-6">
                                        
                            <?php if (!empty($Mensaje)) { ?>
                               <div class="alert alert-<?php echo $Estilo; ?> alert-dismissable">
                               <?php echo $Mensaje; ?>
                               </div>
                            <?php } ?>

                            <form method='post' enctype="multipart/form-data" >    

                                <div class="form-group">
                                    <label>Subi tu avatar</label>
                                    <input type="file" name="Archivo" id="archivo">
                                </div>

                                <button type="submit" class="btn btn-default" value="Subir" name="BotonSubir" >Subir imagen</button>
                            </form>
                        
                            
                    
                   
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php require_once 'footer.inc.php'; ?>