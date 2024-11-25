<?php
function insertarViaje($vConexion, $IdUsurRegistra) {
    $IdChofer = $_POST['Chofer'];
    $IdTransporte = $_POST['Transporte'];
    $FechaViaje = $_POST['FechaViaje'];
    $IdDestino = $_POST['Destino'];
    $Costo = $_POST['Costo'];
    $PorcentajeChofer = $_POST['PorcentajeChofer'];

    // Verificar que la variable de sesión 'idU' esté seteada
    if (!isset($IdUsurRegistra)) {
        return "Error: No se ha encontrado el ID del usuario con sesión activa.";
    }

    if (empty($IdChofer) || empty($IdTransporte) || empty($FechaViaje) || empty($IdDestino) || empty($Costo) || empty($PorcentajeChofer)) {
        return "Todos los campos son requeridos.";
    }

    $sqlInsert = "INSERT INTO viajes (IdChofer, IdTransporte, FechaViaje, IdDestino, FechaCreacion, IdUsurRegistra, Costo, PorcentajeChofer) 
                  VALUES ('$IdChofer', '$IdTransporte', '$FechaViaje', '$IdDestino', NOW(), '$IdUsurRegistra', '$Costo', '$PorcentajeChofer')";
    
    if (!mysqli_query($vConexion, $sqlInsert)) {
        return "Error al registrar el viaje: " . mysqli_error($vConexion);
    }
    
    return true; // Si todo va bien
}
?>
