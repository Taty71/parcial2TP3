<?php

function insertarChofer($vConexion) {
    // Validar los datos recibidos
    $Nombre = isset($_POST['Nombre']) ? mysqli_real_escape_string($vConexion, $_POST['Nombre']) : null;
    $Apellido = isset($_POST['Apellido']) ? mysqli_real_escape_string($vConexion, $_POST['Apellido']) : null;
    $DNI = isset($_POST['DNI']) ? mysqli_real_escape_string($vConexion, $_POST['DNI']) : null;
    $Clave = isset($_POST['Clave']) ? mysqli_real_escape_string($vConexion, $_POST['Clave']) : null;
    //$Clave = password_hash($_POST['Clave'], PASSWORD_DEFAULT);
    $idNivel = 3; // Nivel correspondiente al chofer
    $Activo = 1;  // Estado activo

    // Validar campos obligatorios
    if (empty($Nombre) || empty($Apellido) || empty($DNI)) {
        return "Todos los campos son requeridos.";
    }
    

    // Crear la consulta SQL
    $sql = "INSERT INTO usuarios (Apellido, Nombre, DNI, Clave, Activo, IdNivel) 
            VALUES ('$Apellido', '$Nombre', '$DNI', '$Clave', '$Activo', '$idNivel')";


    // Ejecutar la consulta y manejar errores
    if (mysqli_query($vConexion, $sql)) {
        return "Datos insertados correctamente.";
    } else {
        return "Error al insertar el registro: " . mysqli_error($vConexion);
    }
}


?>
