<?php
function Listar_Tipos($vConexion) {

    $ListadoT=array();

    //1) genero la consulta que deseo
    $SQL = "SELECT * FROM tipos ORDER BY Tipos";

    //2) a la conexion actual le brindo mi consulta, y el resultado lo entrego a variable $rs
     $rs = mysqli_query($vConexion, $SQL);
        
     //3) el resultado deberá organizarse en una matriz, entonces lo recorro
     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $ListadoT[$i]['IdTipos'] = $data['IdTipos'];
            $ListadoT[$i]['Tipos'] = $data['Tipos'];
            $i++;
    }


    //devuelvo el listado generado en el array $Listado. (Podra salir vacio o con datos)..
    return $ListadoT;

}
?>