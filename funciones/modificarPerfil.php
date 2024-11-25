<?php
/***** seccion Mis Datos ****/
function ValidarMisDatos() {
    $_SESSION['Mensaje']='';
    $_SESSION['Estilo']='warning';
    
    if (strlen($_POST['Nombre']) < 3) {
        $_SESSION['Mensaje'].='Debes ingresar un nombre con al menos 3 caracteres. <br />';
    }
    if (strlen($_POST['Apellido']) < 3) {
        $_SESSION['Mensaje'].='Debes ingresar un apellido con al menos 3 caracteres. <br />';
    }
    if (strlen($_POST['DNI']) < 8) {
        $_SESSION['Mensaje'].='Debes ingresar el DNI con al menos 8 caracteres. <br />';
    }

    if (strlen($_POST['ClaveU']) > 0 && $_POST['ClaveU'] != $_POST['NvaClaveU']) {
        $_SESSION['Mensaje'].='Las claves ingresadas deben coincidir. <br />';
    }
       
    
    //con esto aseguramos que limpiamos espacios y limpiamos de caracteres de codigo ingresados
    foreach($_POST as $Id=>$Valor){
        $_POST[$Id] = trim($_POST[$Id]);
        $_POST[$Id] = strip_tags($_POST[$Id]);
    }

    if (empty($_SESSION['Mensaje'])) 
        return true;
    else
        return false;

}

function EncontrarUsuario($vidUser, $vConexion){
    $Usuario = array();
    
    $SQL = "SELECT u.*, n.IdNiveles as Id_Nivel, n.Denominacion as Nivel
            FROM usuarios u
            JOIN nivelesuser n ON u.IdNivel = n.IdNiveles
            WHERE u.IdUser = $vidUser";

    $rs = mysqli_query($vConexion, $SQL);
        
    $data = mysqli_fetch_array($rs);
    if (!empty($data)) {
        $Usuario['NOMBRE'] = $data['Nombre'];
        $Usuario['APELLIDO'] = $data['Apellido'];
        $Usuario['DNI'] = $data['DNI'];
        $Usuario['NIVEL'] = $data['Nivel'];
        if (empty($data['Imagen'])) {
            $data['Imagen'] = 'user.png'; 
        }
        $Usuario['IMG'] = $data['Imagen'];
        $Usuario['ACTIVO'] = $data['Activo'];
        $Usuario['ID'] = $data['IdUser'];
        $Usuario['IDNIVEL'] = $data['Id_Nivel'];
    }
    return $Usuario;
}


function SubirArchivo() {
    $TamanioMaximo = 5000000;  // 5MB
    $DatoArchivo = pathinfo($_FILES["Imagen"]["name"]);
    $_SESSION['Mensaje'] = '';
    $_SESSION['Estilo'] = 'warning';

    if (!empty($_FILES['Imagen']['name'])) {
        $CarpetaAlojamiento = 'assets/img';

        if ($_FILES['Imagen']['size'] > $TamanioMaximo) {
            $_SESSION['Mensaje'] = 'Tu imagen supera el tamaño permitido';
            return false;
        }

        $extensionesPermitidas = array('png', 'jpg', 'jpeg', 'bmp');
        if (!in_array(strtolower($DatoArchivo['extension']), $extensionesPermitidas)) {
            $_SESSION['Mensaje'] = 'El archivo debe ser una imagen.';
            return false;
        }
        
        
        if (is_uploaded_file($_FILES['Imagen']['tmp_name'])) {
            if (!is_dir($CarpetaAlojamiento)) {
                mkdir($CarpetaAlojamiento, 0777, true);
            }
            move_uploaded_file($_FILES['Imagen']['tmp_name'], "$CarpetaAlojamiento/{$_FILES['Imagen']['name']}");
            return true;
        } else {
            $_SESSION['Mensaje'] = "Problemas al intentar subir el archivo {$_FILES['Imagen']['name']}";
            return false;
        }
        if (!move_uploaded_file($_FILES['Imagen']['tmp_name'], "$CarpetaAlojamiento/{$_FILES['Imagen']['name']}")) {
            $_SESSION['Mensaje'] = "No se pudo mover el archivo.";
            return false;
        }
    }
    return true;
}


function ModificarMisDatos($vConexion, $vidUser) {
    $SQL = "UPDATE usuarios SET 
            Nombre = '{$_POST['Nombre']}', 
            Apellido = '{$_POST['Apellido']}'";
    if (!empty($_POST['ClaveU'])) {
        $SQL .= ", Clave = '{$_POST['ClaveU']}'";
    }
    if (isset($_FILES['Imagen']) && !empty($_FILES['Imagen']['name'])) {
        // Continuar con la lógica de archivo...   
        $SQL .= ", Imagen = '{$_FILES['Imagen']["name"]}'";
    }
    $SQL .= " WHERE IdUser = $vidUser";

    if (!mysqli_query($vConexion, $SQL)) {
        return false;
    } else if (!empty($_FILES['Imagen']["name"])) {
        $_SESSION['imgU'] = $_FILES['Imagen']["name"];
    }
    echo $SQL;

    return true;
}

//***********************/

?>