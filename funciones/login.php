<?php 
function DatosLogin($vDNI, $vClave, $vConexion) {
    $Usuario = array();
    $error = '';
    
    // Preparar la consulta SQL
    $SQL = "SELECT u.IdUser, u.Apellido, u.Nombre, u.Clave, u.Activo,
            n.Denominacion AS Nivel, u.Imagen
            FROM usuarios u
            JOIN nivelesuser n ON u.IdNivel = n.IdNiveles
            WHERE u.DNI = ? AND u.Clave = ?";  // MD5(?) for encrypted passwords

    if ($stmt = mysqli_prepare($vConexion, $SQL)) {
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, 'ss', $vDNI, $vClave);  // 'ss' specifies two string parameters
        
        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);
        
        // Obtener resultados
        $rs = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_array($rs);

        if ($data) {
            $Usuario['NOMBRE'] = $data['Nombre'];
            $Usuario['APELLIDO'] = $data['Apellido'];
            $Usuario['DNI'] = $vDNI;
            $Usuario['CLAVE'] = $data['Clave'];
            $Usuario['ACTIVO'] = $data['Activo'];
            $Usuario['NIVEL'] = $data['Nivel'];
            $Usuario['IMG'] = !empty($data['Imagen']) ? $data['Imagen'] : 'user.png';
            $Usuario['IdUSER'] = $data['IdUser'];
        } else {
            $error = "Usuario no encontrado.";
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        $error = "Error en la consulta a la base de datos: " . mysqli_error($vConexion);
    }
    
    return array('Usuario' => $Usuario, 'Error' => $error);
}
?>

