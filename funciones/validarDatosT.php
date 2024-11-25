<?php
function Validar_Datos($listadoMarcas, $listadoTipos) {
    $respuesta = [
        'Mensaje' => '',
        'Clase' => 'danger',
        'Icono' => 'bi-exclamation-circle'
    ];

    // Validar campos requeridos
    if (empty($_POST['Marca']) || empty($_POST['Tipo']) || empty($_POST['Patente']) || !isset($_POST['Disponible'])) {
        $respuesta['Mensaje'] = 'Todos los campos son obligatorios.';
        return $respuesta;
    }

    // Validar Marca
    $marcasPermitidas = array_column($listadoMarcas, 'IdMarcas');
    if (!in_array($_POST['Marca'], $marcasPermitidas)) {
        $respuesta['Mensaje'] = 'Selecciona una marca válida.';
        return $respuesta;
    }

    // Validar Tipo
    $tiposPermitidos = array_column($listadoTipos, 'IdTipos');
    if (!in_array($_POST['Tipo'], $tiposPermitidos)) {
        $respuesta['Mensaje'] = 'Selecciona un tipo válido.';
        return $respuesta;
    }

    // Validar longitud de patente
    if (strlen($_POST['Patente']) < 6) {
        $respuesta['Mensaje'] = 'La patente debe tener al menos 6 caracteres.';
        return $respuesta;
    }

    // Validar disponibilidad (opcional, ya manejado con checkbox)
    if (!isset($_POST['Disponible'])) {
        $respuesta['Mensaje'] = 'Debes indicar la disponibilidad.';
        return $respuesta;
    }

    // Validaciones exitosas
    $respuesta['Mensaje'] = 'Validación exitosa.';
    $respuesta['Clase'] = 'success';
    $respuesta['Icono'] = 'bi-check-circle';
    return $respuesta;
}



?>
/*function Validar_Datos($vConexion) {
    $respuesta = [
        'Mensaje' => '',
        'Clase' => '',
        'Icono' => ''
    ];

    // Verificar si todos los campos requeridos están vacíos
    if (empty($_POST['Marca']) || empty($_POST['Tipo']) || empty($_POST['Patente']) || !isset($_POST['Disponible'])) {
        $respuesta['Mensaje'] = 'Todos los campos son requeridos!!!';
        $respuesta['Clase'] = 'danger';
        $respuesta['Icono'] = 'bi-exclamation-circle';
        return $respuesta;
    }

    // Validaciones específicas de cada campo (ejemplo para patente)
    if (strlen($_POST['Patente']) < 6) {
        $respuesta['Mensaje'] = 'La patente debe tener al menos 6 caracteres.';
        $respuesta['Clase'] = 'danger';
        $respuesta['Icono'] = 'bi-exclamation-circle';
        return $respuesta;
    }

    // Validar Disponibilidad
    /*if (!isset($_POST['Disponible'])) {
        $vMensaje .= 'Debes indicar la disponibilidad. <br />';
        return ['Mensaje' => $vMensaje, 'Clase' => 'danger', 'Icono' => 'bi-x-circle'];
    }*/

     // Si todo está correcto
     $respuesta['Mensaje'] = 'Validación correcta.';
     $respuesta['Clase'] = 'success';
     $respuesta['Icono'] = 'bi-check-circle';
     return $respuesta;
}
?>