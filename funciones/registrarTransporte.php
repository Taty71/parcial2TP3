<?php
// Función para insertar transporte
function insertarTransporte($vConexion) {
    $IdMarca = isset($_POST['Marca']) ? mysqli_real_escape_string($vConexion, $_POST['Marca']) : null;
    $IdTipo = isset($_POST['Tipo']) ? mysqli_real_escape_string($vConexion, $_POST['Tipo']) : null;
    $Patente = mysqli_real_escape_string($vConexion, $_POST['Patente']);
    $Modelo = mysqli_real_escape_string($vConexion, $_POST['Modelo']);
    $Disponible = isset($_POST['Disponible']) ? 1 : 0;
    $Combustible = mysqli_real_escape_string($vConexion, $_POST['Combustible']);

    // Comprobar si Marca o Tipo están vacíos
    if (is_null($IdMarca) || is_null($IdTipo)) {
        return "Marca y Tipo son campos obligatorios.";
    }

    file_put_contents('log.txt', "Datos recibidos: Marca=$IdMarca, Tipo=$IdTipo, Patente=$Patente\n", FILE_APPEND);

    $SQL_Insert = "INSERT INTO transportes 
                   (IdMarca, IdTipo, Patente, Modelo, Disponible, Combustible, FechaCarga)
                   VALUES ('$IdMarca', '$IdTipo', '$Patente', '$Modelo', '$Disponible', '$Combustible', NOW())";

    if (!mysqli_query($vConexion, $SQL_Insert)) {
        $mensajeError = mysqli_error($vConexion);
        return "Error al insertar el registro: $mensajeError";
    }

    return true;
}

function Validar_Datos() {
    $vMensaje = '';
    $Clase = 'warning';
    $Icono = 'bi-exclamation-circle';

     // Inicializar errores
     $errores = [];

     // Validar Marca
     if (empty($_POST['Marca']) || $_POST['Marca'] == "Selecciona una opción") {
         $errores[] = 'Debes seleccionar una marca válida.';
     }
 
     // Validar Tipo
     if (empty($_POST['Tipo']) || $_POST['Tipo'] == "Selecciona una opción") {
         $errores[] = 'Debes seleccionar un tipo válido.';
     }
 
     // Validar Patente
     $patente = $_POST['Patente'] ?? '';
     if (strlen($patente) < 6 || strlen($patente) > 7 || !ctype_alnum($patente)) {
         $errores[] = 'La patente debe tener entre 6 y 7 caracteres alfanuméricos.';
     }
 
     // Validar Disponibilidad
     if (empty($_POST['Disponible']) || $_POST['Disponible'] != 1) {
         $errores[] = 'Debes marcar la casilla de disponibilidad.';
     }
 
     // Comprobar si hay errores
     if (empty($errores)) {
         // No hay errores: registro válido
         $Clase = 'success'; // Color verde para éxito
         $Icono = 'bi-check-circle';
         $vMensaje = 'Registro realizado correctamente.';
     } else {
         // Hay errores: mostrar advertencias
         $vMensaje = implode('<br />', $errores);
     }
 
     return [
         'Mensaje' => $vMensaje,
         'Clase' => $Clase,
         'Icono' => $Icono
     ];
       
    }

?>
